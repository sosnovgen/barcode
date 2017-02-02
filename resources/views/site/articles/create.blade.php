@extends('site.main')
@section('content')
    <div class="container">

        <button type="button" class="close" onclick="history.back();">&times;</button>

        <div class="col-md-7">
            <form role="form"
                  method="POST" action="{{action('ArticlesController@store')}}" enctype="multipart/form-data">

                <div class="row ">
                    <h3>Новый товар</h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label >Название Товара</label>
                        <input type="text" name="title" class="form-control"><br>
                    </div>

                    <div class="col-md-6">
                        <label>Картинка</label>
                        <input type="file" name="preview" class="filestyle" data-buttonText=" Выбрать"><br>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <label for="category_id">Категория</label>
                        <select name="category_id" class="form-control">

                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach

                        </select><br>
                    </div>

                    <div class="col-md-5">
                        <label for="group_id">Группа</label>
                        <select name="group_id" class="form-control">

                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->title}}</option>
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
                    <textarea class="form-control" rows="5" id="editor" name ="content"></textarea>
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
