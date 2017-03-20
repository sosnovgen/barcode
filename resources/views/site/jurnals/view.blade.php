@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <input type="hidden" name="width" id="_size">

        <div class="row" >
            <div class="col-md-9">
                <h3 class="text-center">Журнал</h3>
            </div>

            <div class="col-md-3">

            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper5" data-token="{{ csrf_token() }}">
                <thead>
                <tr>
                    <th class="td-1">Дата</th>
                    <th>id</th>
                    <th>Название</th>
                    <th>Контрагент</th>
                    <th>Тор-точка</th>
                    <th>Операция</th>
                    <th>Цена</th>
                    <th>Кол.</th>
                    <th>Действие</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($jurnals as $row)
                    <tr>
                        <td class="td-1" style="width: 8em;">{{$row->created_at ->format('d-m-Y')}}</td>
                        <td>{{$row->id}}</td>
                        <td class="td-2">{{$row->title}}</td>
                        <td>{{$row->contragent}}</td>
                        <td>{{$row->sklad}}</td>
                        <td>{{$row->operation}}</td>
                        <td>{{$row ->cena}}</td>
                        <td>{{$row ->kol}}</td>
                        <td class="td-1" style="width: 8em;">{{$article->updated_at->format('d-m-Y')}}</td>
                        <td >
                            &nbsp;
                            <a href="{{action('AtributesController@add',['id'=>$article->id])}}"><i class="fa fa-font" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                            &nbsp;
                            <a href="{{action('ArticlesController@edit',['id'=>$article->id])}}"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                            &nbsp;
                            <a class="article_link" href="{{$article->id}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
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
    <br>

    <!------------- Modal ----------------->
    <div class="modal fade" id="barcode" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Редактировать</h4>
                </div>

                <form role="form" id="form_bar"
                      method="POST" action="{{action('ArticlesController@update',['articles'=>'-1'])}}" enctype="multipart/form-data">

                    <input type="hidden" name="_method" value="put">

                    <div class="modal-body">

            <!------------------ Content ------------------------->

                        <label >Штрих-код</label>

                        <input type="text" name="barcode" id="bar1" value="
                        <?php
                            if( isset($article)){
                                echo $article->barcode;
                            }
                        ?>"
                             class="form-control" style="width: 65%"
                             onkeypress="if(event.keyCode==13)validForm(this.form)">

                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <br>

            <!------------------ /Content ------------------------->
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Сохранить" class="btn btn-default">
                    </div>
                </form>

            </div>

        </div>
    </div>

@stop