@extends('site.main')
@section('content')



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
