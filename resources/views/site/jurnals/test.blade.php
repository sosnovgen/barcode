@extends('site.main')
@section('content')

    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}


<div style="margin: 10px;">
    <input id="datepicker" name="pic">
</div>
    <script>

        $( "#datepicker" ).datepicker({
            gotoCurrent: true,
            firstDay: 1,
            dateFormat: "dd.mm.yy",
            dayNamesMin: [ "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ]
        });
    </script>

@stop
