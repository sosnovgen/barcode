@extends('site.main')
@section('content')

    <div class="container">

        <button type="button" class="close" onclick="history.back();">&times;</button>
        <div class="col-md-9">

            <form role="form"
                  method="POST" action="{{action('CategoriesController@store')}}" enctype="multipart/form-data">

                <div class="row ">
                    <h3>Новая категория</h3>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-4">
                            <label >Название</label>
                            <input type="text" name="title" class="form-control"><br>
                    </div>
                    <div class="col-md-4">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" class="form-control" onfocus='this.size=8;' onchange='this.size=1;' onblur='this.size=1;'>
                                <option value="-211">root</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select><br>
                    </div>

                    <div class="col-md-4">
                            <label>Картинка</label>
                            <input type="file" name="preview" class="filestyle" data-buttonText=" Выбрать"><br>
                    </div>

                </div>
                <br>
                <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
                <label for="comment">Описание:</label>
                <textarea class="form-control" rows="5" id="editor" name = "body"></textarea>

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