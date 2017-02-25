@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <div class="row">
            <h3 class="text-center">Атрибуты</h3>
        </div>

        <div class="capton01">
            <div>Название товара: {{$article ->title}} (id={{$article ->id}})</div>
            <div>Название категории: {{$article ->category ->title}} (id={{$article ->category_id}})</div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper" data-token="{{ csrf_token() }}">
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
                        <td>&nbsp;
                            <a href="{{action('AtributesController@add2',['id'=>$article->id, 'id2'=>$article->category_id])}}"><i class="fa fa-plus" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                            <a href="{{action('AtributesController@edit',['id'=>$row->id])}}"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                            <a class="atr_link" href="{{$row->id}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{--begin of pagination--}}
        <div style="width: 50%; margin: 0 auto; text-align: center"> {!! $links !!} </div>
        {{--end of pagination--}}

        @if(Session::has('message'))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> {{Session::get('message')}}.
            </div>
        @endif
    </div>

@stop