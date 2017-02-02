@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <div class="row capture">
            <h3 class="text-center">Ассортимент</h3>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper2" data-token="{{ csrf_token() }}">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Картинка</th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Группа</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Изменён</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        @if ($article->preview == 'none')
                            <td><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 1.4em"></i></td>
                        @else
                            <?php
                            $fileName = ($article -> preview);
                            $fileName = mb_substr($fileName,1);

                            ?>
                            @if(is_file($fileName))
                                <td><img width=30 height=30 src="{{asset($article->preview)}}"></td>
                            @else
                                <td><i class="fa fa-eraser" aria-hidden="true" style="font-size: 1.4em"></i></td>
                            @endif
                        @endif

                        <td>{{$article->title}}</td>
                        <td>{{$article -> category -> title}}</td>
                        @if ($customer = App\Group::where('id', $article ->group_id)->first())
                            <td>{{$article -> group -> title}}</td>
                         @else
                            <td><i class="fa fa-question" aria-hidden="true" style="font-size: 1.4em; color: red; "></i></td>
                        @endif
                        <td>{{$article->content}}</td>
                        <td>{{$article->cena}}</td>
                        <td>{{$article->updated_at->format('d-m-Y')}}</td>
                        <td>&nbsp;
                            <a href="{{action('ArticlesController@edit',['id'=>$article->id])}}"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                            &nbsp;
                            <a class="cat_link" href="{{$article->id}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
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

@stop