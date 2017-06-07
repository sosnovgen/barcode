@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>
        <div class="row" >

            <div class="col-md-9">
                <div class="row">
                    <h3 class="text-center">Наличие</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cat-select-over">
                    <div class="cat-select">
                        <label for="category_id">Выбрать точку</label>
                        <select onchange="window.location.href=this.options[this.selectedIndex].value" class="form-control" onfocus='this.size=12;' onchange='this.size=1;' onblur='this.size=1;'>
                            <option value="{{action('JurnalsController@balance')}}"  >Все</option>
                            @foreach($sklads as $row)

                                <option value="{{action('JurnalsController@balance2',['id'=>$row->title])}}"
                                        @if(($sklads ->count() >0)&&($sort2 == 1))
                                            @if   ($select_sklad == $row->id)
                                                selected
                                            @endif
                                        @endif
                                >{{$row ->title}}</option>

                            @endforeach
                            @if(!($sklads ->count() >0))
                                <option value="" selected>--</option>
                            @endif



                        </select>
                    </div>
                </div>

            </div>

        </div><br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" >
                <thead>
                <tr class="leaf">
                    <th>id</th>
                    <th class="text-center">Название</th>
                    <th>Точка</th>
                    <th>Цена</th>
                    <th>Кол.</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($detals as $row)
                    <tr>
                        <td>{{$row['article_id']}}</td>
                        <td>{{$row['title']}}</td>
                        <td>{{$row['sklad']}}</td>
                        <td>{{$row['cena']}}</td>
                        <td>{{$row['kol']}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@stop