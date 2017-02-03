@extends('site.main')
@section('content')
    <div class="container">
        <div class="col-md-8">
            <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
            <div class="row capture">
                <h3 class="text-center">Группы</h3>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-condensed table-striped" id="token-keeper3" data-token="{{ csrf_token() }}">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Изменён</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{$group->id}}</td>
                            <td>{{$group->title}}</td>
                            <td>{{$group->updated_at->format('d-m-Y')}}</td>
                            <td>&nbsp;

                                <a class="group_link" href="{{$group->id}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
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
    </div>
@stop