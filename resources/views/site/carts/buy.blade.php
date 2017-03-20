@extends('site.main')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
                <br>

                <div class="row">
                    <form role="form"
                          method="POST" action="{{action('JurnalsController@session')}}" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="col-md-5">
                            <label for="bar" class="text-left" style="margin:0.5em 1em; font-size: 1.2em; color: #2c72e6;">Покупка</label>
                            <input type="text" name="bar" class="bar" autofocus
                                   onkeypress="if(event.keyCode==13)validForm(this.form)">
                        </div>

                        <div class="col-md-5">
                            <label for="contragent" class="text-left" style="margin:1em 1em; font-size: 1.0em;">Поставщики</label>
                            <select name="contragent" class="" style="width: 12em; height: 1.8em;">
                                @foreach($contragents as $row)
                                    @if($row->id == session('contragent'))
                                        <option value="{{$row->id}}" selected>{{$row->title}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="operation" value="Покупка">

                    </form>
                </div>

                @if(Session::has('message'))
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{Session::get('message')}}.
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-condensed table-striped" id="token-keeper7" data-token="{{ csrf_token() }}">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Кол.</th>
                            <th>Сумма</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->title}}</td>
                                <td>{{$order->cena_in}}</td>
                                <td class="input_44">
                                    <input name="kol" id="in45" type="number" value="{{session('sale.'.$order -> id)}}" class="input_45">
                                </td>
                                <td class="summ_row">{{$order -> cena_in}}</td>

                                <td>&nbsp;

                                    <a class="" onclick="return confirm('Удалить товар?')" href="{{action('JurnalsController@del',[$order->id])}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div id="butt" class="pull-right"><a href="{{asset('order')}}" class="btn btn-info " role="button">Провести</a></div>
                        <div class="price_order">Всего:<span class="price_summ"></span></div>
                    </div>
                </div>
                <br>

            </div>
            <div class="col-md-4">
                <br>
                <div class="description small">
                    <p>* Здесь можно добавить ли отредактировать группу товара.</p>
                    <p>* Группа позволяет сортировать товар по заданному признаку (например: "Новинка", "Распродажа" и т.п.)</p>

                </div>
            </div>

        </div>
    </div>



    {{--
        @if(Session::has('error'))
        {{Session::get('error')}}
        @endif
    --}}

        <!------ Вывод выбранных товаров  ------->
    @if (Session::has('sale'))
        {{var_dump(session('sale'))}}
        {{var_dump(session('contragent'))}}
    @endif


@stop