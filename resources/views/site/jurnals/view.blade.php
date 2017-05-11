@extends('site.main')
@section('content')

    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <input type="hidden" name="width" id="_size">

        <div class="row" >
            <div class="col-md-12">
                <div class="row capture">
                    <h3 class="text-center">Журнал</h3>
                </div>
                <div class="row" style="margin-bottom: 1em;">
                    <div class="col-md-12">
                        <a class="pull-right" style="padding: 0 1em 0 0;" data-toggle="modal" href="#myModal" ><i class="fa fa-filter" aria-hidden="true" style="font-size: 1.2em;"> Открыть фильтр</i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper5" data-token="{{ csrf_token() }}">
                <thead>
                <tr>
                    <th class="td-1">Дата</th>

                    <th>Название</th>
                    <th>Контрагент</th>
                    <th>Точка</th>
                    <th>Операция</th>
                    <th>Цена</th>
                    <th>Кол.</th>
                    <th>Сумма</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($jurnals as $row)
                    <tr>
                        <td class="td-1" style="width: 8em;">{{$row->created_at ->format('d-M H:i')}}</td>

                        <td class="td-2">{{$row->title}}</td>
                        <td>{{$row->contragent}}</td>
                        <td>{{$row->sklad}}</td>
                        <td>{{$row->operation}}</td>
                        <td>{{$row ->cena}}</td>
                        <td>{{$row ->kol}}</td>
                        <td>{{$row ->kol*$row ->cena}}</td>
                        <td >
                            <form  onsubmit="return confirm('Удалить запись?')" style="float: left" method="POST" action="{{action('JurnalsController@deljur',['id'=>$row->id])}}">
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

        {{--begin of pagination--}}
        {{--<div style="width: 50%; margin: 0 auto; text-align: center"> {!! $links !!} </div>--}}
        {{--end of pagination--}}

        @if(Session::has('message'))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> {{Session::get('message')}}.
            </div>
        @endif
    </div>
    <br>

    @if (Session::has('filter'))
        {{var_dump(session('filter'))}}

    @endif





    <!-- Modal Filter -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Фильтр</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="POST" action="{{action('JurnalsController@filter')}}" class="form-group" enctype="multipart/form-data"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="col-md-4">
                            <label>Контрагенты</label>
                            <?php $contragents = App\Contragent::orderBy('title')->get(); ?>
                            <select name="contragent" class="form-control" style="width: 16em; ">
                                <?php
                                    if(Session::has('filter.contragent'))
                                    {
                                       $contragent = Session::get('filter.contragent');
                                    }
                                    else {$contragent =0; }
                                ?>

                                    <option value="0">Все</option>
                                @foreach($contragents as $row)
                                    @if($row->id == $contragent)
                                        <option value="{{$row->id}}" selected>{{$row->title}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>

                            <label>Точки</label>
                            <?php $sklads = App\Sklad::orderBy('title')->get(); ?>
                            <select name="sklad" class="form-control" style="width: 16em; ">
                                <?php
                                if(Session::has('filter.sklad'))
                                {
                                    $sklad = Session::get('filter.sklad');
                                }
                                else {$sklad =0; }
                                ?>

                                    <option value="0">Все</option>
                                @foreach($sklads as $row)
                                    @if($row->id == $sklad)
                                        <option value="{{$row->id}}" selected>{{$row->title}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>

                            <label>Операция</label>
                            <?php $operations = App\Operation::orderBy('title')->get(); ?>
                            <select name="operation" class="form-control" style="width: 16em; ">
                                <?php
                                if(Session::has('filter.operation'))
                                {
                                    $operation = Session::get('filter.operation');
                                }
                                else {$operation = 0; }
                                ?>

                                <option value="0">Все</option>
                                @foreach($operations as $row)
                                    @if($row->id == $operation)
                                        <option value="{{$row->id}}" selected>{{$row->title}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br><br>

                            <label>Период</label>
                            <br>
                                <div class="time">
                                    <div class="lab12 pull-left">от</div>
                                        <input type="text" class="form-control pull-left" name="date_1" value="{{substr(Session::get('filter.date_start'), 0,10)}}" id="dpd1" >
                                    <div class="lab12 pull-left">до</div>
                                        <input type="text" class="form-control pull-left" name="date_2" value="{{substr(Session::get('filter.date_end'), 0,10) }}" id="dpd2" >
                                </div>



                            <script>
                                $( "#dpd1" ).datepicker({
                                    gotoCurrent: true,
                                    firstDay: 1,
                                    dateFormat: "yy-mm-dd",
                                    dayNamesMin: [ "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                                    monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ]
                                });

                                $( "#dpd2" ).datepicker({
                                    gotoCurrent: true,
                                    firstDay: 1,
                                    dateFormat: "yy-mm-dd",
                                    dayNamesMin: [ "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                                    monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ]
                                });




                            </script>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Применить</button>
                    <a class="pull-left"  href="{{action('JurnalsController@clear')}}" ><i class="fa fa-ban" aria-hidden="true" style="font-size: 1.0em; margin: 6px 0 0 8px;"> Сбросить фильтр</i></a>
                </div>
                </form>

            </div>

        </div>
    </div>





@stop