@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
        <div class="row" >
            <div class="col-md-12">
                <div class="row capture">
                    <h3 class="text-center">Наличие</h3>
                </div>
                <div class="row" style="margin-bottom: 1em;">
                    <div class="col-md-12">
                        <div class="arrow_detals pull-right">
                            <img src="{{asset('images/front/back_arrow.jpg')}}">
                            <a href="{{asset('jurnal')}}">Вернуться в журнал</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" >
                <thead>
                <tr class="leaf">
                    <th>id</th>
                    <th class="text-center">Название</th>
                    <th>Точка</th>
                    <th>Цена</th>
                    <th>Кол.</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($detals as $row)
                    <tr>
                        <td>{{$row['article_id']}}</td>
                        <td>{{$row['title']}}</td>
                        <td>{{$row['sklad']}}</td>
                        <td>{{$row['cena']}}</td>
                        <td>{{$row['kol']}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@stop