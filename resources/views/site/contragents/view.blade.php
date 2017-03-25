@extends('site.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
                <div class="row capture">
                    <h3 class="text-center">Контрагенты</h3>
                </div>
                <br>
                <div class="row" style="margin-bottom: 1em;">
                    <div class="col-md-12">
                        <a class="pull-right" data-toggle="modal" href="#myModal" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 1.2em;"> Добавить новый</i></a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Группа</th>
                            <th>Имя</th>
                            <th>Телефон, прим.</th>
                            <th>Изменён</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contragents as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->group}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->note}}</td>
                                <td>{{$row->updated_at->format('d-m-Y')}}</td>
                                <td style="width: 8em">
                                    &nbsp;
                                    <a class="edit2" data-toggle="modal"

                                       data-id="{{$row ->id}}"
                                       data-group="{{$row ->group}}"
                                       data-title="{{$row ->title}}"
                                       data-note="{{$row ->note}}"

                                       href="#myModal2"><i class="fa fa-pencil edit2" aria-hidden="true" style="font-size: 1.2em;"></i></a>

                                    <form  onsubmit="return confirm('Удалить контрагента?')" style="float: left" method="POST" action="{{action('ContragentsController@destroy',['id'=>$row->id])}}">
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
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{Session::get('message')}}.
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <br>
                <div class="description small">
                    <p>* Здесь можно добавить ли отредактировать Ваших контрагентов.</p>
                    <p>* При создании контрагента обязательно указывать группу.</p>
                    <p>* Осторожно! Изменение имени или группы контрагента может привести к ошибке.</p>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Groups Create -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Создать контрагента</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="POST" action="{{action('ContragentsController@store')}}" class="form-group" enctype="multipart/form-data"/>
                        <div class="col-md-4">
                            <label>Группа</label>
                            <select name="group" class="form-control">
                               <option value="Поставщики">Поставщики</option>
                               <option value="Покупатели">Покупатели</option>

                            </select>
                            <br>
                            <label>Имя</label>
                            <input class="form-control" name="title" type="text"><br>
                            <div class="form-group">
                                <label >Примечание</label>
                                <textarea class="form-control" rows="5" name ="note"></textarea>
                            </div>

                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                </div>
                </form>

            </div>

        </div>
    </div>

    <!-- Modal Groups Edit -->
    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content 2 -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Изменить контрагент</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form_edit2" method="POST" action="{{action('ContragentsController@update',['id' =>'-1'])}}" class="form-group" enctype="multipart/form-data"/>

                        <input type="hidden" name="_method" value="put">

                        <div class="col-md-4">
                            <label>Группа</label>
                            <select name="group" id="group2" class="form-control">
                                <option value="Поставщики">Поставщики</option>
                                <option value="Покупатели">Покупатели</option>

                            </select>
                            <br>
                            <label>Имя</label>
                            <input class="form-control" id="title2" name="title" type="text"><br>
                            <div class="form-group">
                                <label >Примечание</label>
                                <textarea class="form-control" rows="5" id="text2" name ="note"></textarea>
                            </div>

                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                </div>
                </form>

            </div>

        </div>
    </div>

@stop