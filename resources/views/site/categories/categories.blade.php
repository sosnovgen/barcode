@extends('site.main')
@section('content')
    <div class="container">

        <button type="button" class="close" onclick="history.back();">&times;</button>
        <div class="col-md-9">

            <form>


            <div class="row capture">
                <h3>Категория</h3>
            </div>

            <br>

            <div class="row">
                <div class="col-md-4">
                    <label >Название Товара</label>
                    <input type="text" name="title" class="form-control"><br>
                </div>
                <div class="col-md-4">
                    <label for="category_id">Категория</label>
                    <select name="category_id" class="form-control">

                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Картинка</label>
                    <input type="file" name="preview" class="filestyle" data-buttonText=" Выбрать">
                </div>

            </div>
            <br>
            <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
                <label for="comment">Описание:</label>
                <textarea class="form-control" rows="5" id="editor" name ="content"></textarea>

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
                <p>* После вставки чужого текста очистите форматирование:
                    <br>   "Format -> Clear formatting".
                </p>
            </div>
        </div>

    </div>
@stop