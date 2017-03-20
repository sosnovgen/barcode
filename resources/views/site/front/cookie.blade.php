@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 1.2em;">Склад</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form"  method="POST" action="{{action('HomeController@sklad') }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <br>
                            <div class="form-group">
                                <label for="sklad32" class="col-md-4 control-label">Имя склада</label>

                                <div class="col-md-6">
                                    <select id="sklad32" class="form-control" name="sklad">
                                      @foreach($sklads as $sklad)
                                                <option value="{{$sklad->title}}">{{$sklad->title}}</option>
                                      @endforeach

                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-home"></i> OK
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
