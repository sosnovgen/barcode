@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="history.back();">&times;</button>

        <div class="col-md-7">
            <form role="form"
                  method="POST" action="{{action('ArticlesController@update',['articles'=>$article->id])}}" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="put">
                <div class="row ">
                    <h3>Редактировать товар</h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label >Название Товара</label>
                        <input type="text" name="title" value = "{{$article->title}}" class="form-control"><br>
                    </div>

                    <div class="col-md-6">
                        <label>Картинка</label>
                        <input type="file" name="preview" value="{{asset($article->preview)}}" class="filestyle" data-buttonText=" Выбрать"><br>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <label for="category_id">Категория</label>
                        <select name="category_id" class="form-control" onfocus='this.size=8;' onchange='this.size=1;' onblur='this.size=1;'>
                            @foreach($categories as $category)
                                @if($article->category_id == $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                            @endforeach

                        </select><br>
                    </div>

                    <div class="col-md-5">
                        <label for="group_id">Группа</label>
                        <select name="group_id" class="form-control">

                            @foreach($groups as $group)
                                @if($article->group_id == $group -> id)
                                    <option value="{{$group -> id}}" selected>{{$group -> title}}</option>
                                @else
                                    <option value="{{$group->id}}">{{$group->title}}</option>
                                @endif
                            @endforeach

                        </select><br>

                    </div>

                    <div class="col-md-2">
                        <label >Цена</label>
                        <input type="text" name="cena" class="form-control"><br>
                    </div>

                </div>

                <div class="form-group">
                    <label for="comment">Описание:</label>
                    <textarea class="form-control" rows="5" id="editor" name ="content">{{$article -> content}}</textarea>
                </div>

                <br>

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="submit" value="Сохранить" class="btn btn-default">

            </form>

        </div>

        <div class="col-md-5">
            <div class="description small">
                <p>* Здесь можно добавить/отредактировать товар.</p>
                <p>* Сначала создать категорию, затем добавить товар.</p>
                <p>* Поле "Группа" - не обязательна к заполнению.</p>
                <p>* Размер картинки примерно 300Х300.</p>
                <p>* Перенос строки в описании: "Shift + Enter". </p>

            </div>
        </div>

    </div>

@stop
