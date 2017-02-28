@extends('site.main')
@section('content')
    <div class="container">

        <button type="button" class="close" onclick="history.back();">&times;</button>

        <div class="col-md-8">

            <form role="form"
                  method="POST" action="{{action('AtributesController@update',['id'=>$atribute->id])}}" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="put">

                <br>
                <div class="row">
                    <?php $article = App\Article::where('id', $atribute ->article_id)->first(); ?>
                    <span style="font-size: 1.2em;" >Атрибут товара "<span style="color:#009f00;">{{str_limit($article->title,45,' ...').' (id='. $article->id.')'}}</span>"</span>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <label >Свойство</label>
                        <input type="text" name="key" value="{{$atribute ->key}}" class="form-control"><br>
                    </div>
                    <div class="col-md-6">
                        <label >Значение</label>
                        <input type="text" name="value" value="{{$atribute ->value}}" class="form-control"><br>
                    </div>

                    <input type="hidden" name="article_id" value="{{$atribute ->article_id}}">
                    <?php
                        $id2 = $article -> category_id;
                    ?>
                    <input type="hidden" name="category_id" value="{{$atribute ->category_id}}">

                </div>
                <br><br>
                <div class="row" style="margin-bottom: 12px; padding-left: 14px;">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" value="Сохранить" class="btn btn-primary load-bt">
                        <input type="button" value="Загрузить шаблон" style="margin-left: 2em;" class="btn btn-default load-bt">

                    </div>
                </div>

            </Form>


        </div>

        <div class="col-md-4">
            <div class="description small">
                <p>* Здесь можно добавить/отредактировать атрибуты товара (цвет, размер, вес, и т.п.).</p>
                <p>* Атрибуты одной категории товаров схожи, поэтому можно использовать для их заполнения шаблон.</p>
                <p>* Для каждой категории товаров можно создать один шаблон. Выбирается товар нужной категории, затем
                    переходим по кнопке "А" в столбце "Действие" в окно "Атрибуты товара" -> "Сохранить как шаблон".</p>
                <p>* Затем можно заполнять атрибуты, загрузив их из шабона ("Загрузить шаблон") с последующим редактированием отдельных полей.</p>
            </div>
        </div>

    </div>
@stop