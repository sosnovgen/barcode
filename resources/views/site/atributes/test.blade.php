@extends('site.main')
@section('content')

    @foreach ($attrs as $row)
    <table>
        <tr>
       <td>{{$row ->id}}</td>
        <td>{{$row ->key}}</td>
    </tr>
    </table>
    @endforeach

@stop
