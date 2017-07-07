@extends('site.main')
@section('content')
    <div class="container">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6">
                    <div class="cap_011">Накладная № {{$products->first()->jurnal -> id}}</div>
                </div>
                <div class="col-md-6">
                    <div class="arrow_detals pull-right">
                        <img src="{{asset('images/front/back_arrow.jpg')}}">
                        <a href="{{asset('jurnal')}}">Вернуться в журнал</a>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <label>Дата создания</label>
                    <label class="form-control text24">{{$products->first()->jurnal -> created_at -> Format('d-m-Y')}}</label>
                </div>
                <div class="col-md-3">
                    <label>Операция</label>
                    <label class="form-control text24">{{$products->first()->jurnal -> operation}}</label>
                </div>

                <div class="col-md-3">
                    <label>Контрагент</label>
                    <label class="form-control text24">{{$products->first()->jurnal -> contragent}}</label>
                </div>
                <div class="col-md-3">
                    <label>Точка</label>
                    <input type="text" name="created_at" value = "{{$products->first()->jurnal ->sklad}}" class="form-control">
                </div>

            </div>
            <br>

            <div class="cap_012">Список товаров</div>
            <table class="table table-bordered" id="token-keeper_12" data-token="{{ csrf_token() }}">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th class="text-center">Название</th>
                    <th>Цена</th>
                    <th>Кол.</th>

                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product -> article_id}}</td>
                        <td>{{$product -> title}}</td>
                        <td>{{$product -> cena}}</td>
                        <td>{{$product -> kol}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text25">Сумма: <span class ="text26">{{$products->first()->jurnal -> sum}}</span></div>
            <br><br><br>

        </div>

    </div>

    <br>


@stop