@extends('site.main')
@section('content')

    <div class="container">

        <button type="button" class="close" onclick="history.back();">&times;</button>
        <div class="col-md-9">

            <form role="form"
                  method="POST" action="{{action('CategoriesController@update',['category'=>$category->id])}}" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="put">
                <div class="row capture">
                    <h3>Редактировать категорию</h3>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-4">
                        <label >Название</label>
                        <input type="text" name="title" value = "{{$category->title}}" class="form-control"><br>
                    </div>

                    <div class="col-md-4">
                        <label for="parent_id">Родитель</label>

                        <select name="parent_id" class="form-control" onfocus='this.size=12;' onchange='this.size=1;' onblur='this.size=1;'>
                            <option value="-211">root</option>
                            @foreach($categories as $row)
                                @if($row->id == $category->parent_id)
                                    <option value = "{{$row->id}}" selected>{{$row->title}}</option>
                                @else
                                    <option value = "{{$row->id}}">{{$row->title}}</option>
                                @endif
                            @endforeach
                        </select><br>
                    </div>

                    <div class="col-md-4">
                        <label>Картинка</label>
                        <input type="file" name="preview" value="{{asset($category->preview)}}" class="filestyle" data-buttonText=" Выбрать"><br>
                    </div>

                </div>
                <br>
                <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
                <label for="comment">Описание:</label>
                <textarea class="form-control" rows="5" id="editor" name = "body">{{$category ->body}}</textarea>

                <br>

                <div class="form-group">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" value="Сохранить" class="btn btn-default">
                </div>

            </form>

        </div>

        <div class="col-md-3">
            <div class="description small">
                <p>* Здесь можно добавить/отредактировать категорию товара.</p>
                <p>* Можно создавать вложенные категории, для этого нужно указать родительскую категорию.</p>
                <p>* Дерево категорий можно просмотреть в пункте меню: "Дерево".</p>
                <p>* Размер картинки примерно 300Х300.</p>
                <p>* Перенос строки: "Shift + Enter". </p>

            </div>
        </div>

    </div>
@stop