@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
        <div class="col-md-9">

            <h3 class="text-center">Атрибуты</h3>
            <div class="row">
                <div class="col-md-8" >
                    <div class="capton01">
                        <div>Название товара: "<span style="color:#009f00;">{{$article ->title}}</span>" (id={{$article ->id}})</div>
                        <div>Название категории: "<span style="color:#009f00;">{{$article ->category ->title}}</span>" (id={{$article ->category_id}})</div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-top: 6px;">
                    <a href="{{action('AtributesController@tample',['id'=>$article->id])}}" class="btn btn-info" role="button">Сохранить как шаблон</a>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-condensed table-striped" id="#token-keeper4" data-token="{{ csrf_token() }}">
                    <thead>
                    <tr>
                        <th class="td-1">id</th>
                        <th>Свойство</th>
                        <th>Значение</th>
                        <th class="td-1">Изменён</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($atributes as $row)
                        <tr>
                            <td class="td-1">{{$row->id}}</td>
                            <td>{{$row->key}}</td>
                            <td>{{$row->value}}</td>
                            <td class="td-1" style="width: 8em">{{$row->updated_at->format('d-m-Y')}}</td>
                            <td style="width: 8em">
                                &nbsp;
                                <a href="{{action('AtributesController@add2',['id'=>$article->id])}}"><i class="fa fa-plus" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                                &nbsp;
                                <a href="{{action('AtributesController@edit',['id'=>$row->id])}}"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 1.2em; "></i></a>

                                <form  onsubmit="return confirm('Удалить атрибут?')" style="float: left" method="POST" action="{{action('AtributesController@destroy',['id'=>$row->id])}}">
                                    <input type="hidden" name="_method" value="delete"/>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <button type="submit" class="butt2">
                                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-info fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{Session::get('message')}}.
                </div>
            @endif

        </div>
        <div class="col-md-3">
            <div class="description small">
                <p>* Здесь можно добавить/отредактировать атрибут товара.</p>
                <p>* Сначала нужно заполнить поля товара и сохранить его, затем, перейдя в окно просмотра "Товар->Показать всё" добавить свойства товара ("А" кнопка в столбце "Деёствия").</p>
                <p>* Атрибуты одной категории товаров схожи, поэтому можно использовать для их заполнения шаблон.
                <p>* Для каждой категории товаров можно создать один шаблон. Выбирается товар нужной категории, затем переходим по кнопке "А" в столбце "Действие" в окно "Атрибуты товара" -> "Сохранить как шаблон".</p>
                <p>* Затем можно заполнять атрибуты, загрузив их из шабона ("Загрузить шаблон") с последующим редактированием отдельных полей.</p>

            </div>
        </div>

        {{--begin of pagination--}}
        <div style="width: 50%; margin: 0 auto; text-align: center"> {!! $links !!} </div>
        {{--end of pagination--}}

    </div>

@stop