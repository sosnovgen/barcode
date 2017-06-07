@extends('site.main')
@section('content')

@foreach($detals as $row)
    {{$row->id}}
@endforeach

@stop
