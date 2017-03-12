@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <input type="hidden" name="width" id="_size">

        <div class="row" >
            <div class="col-md-9">
                <h3 class="text-center">Ассортимент</h3>
                <a class="pull-right"  href="{{action('ArticlesController@create')}}" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 1.2em;"> Добавить новый</i></a>
            </div>
            <div class="col-md-3">
                <div class="cat-select-over">
                <div class="cat-select">
                <label for="category_id">Выбрать категорию</label>
                <select onchange="window.location.href=this.options[this.selectedIndex].value" name="category_id" class="form-control" id="select_cat" onfocus='this.size=12;' onchange='this.size=1;' onblur='this.size=1;'>
                    <option value="{{action('ArticlesController@index')}}"  >Все</option>

                    @foreach($categories as $category)

                        <option value="{{action('ArticlesController@indexid',['id'=>$category->id])}}"
                                @if(($articles->count() >0)&&($sort == 1))
                                    @if   ($articles ->first()->category->title == $category->title)
                                        selected
                                    @endif
                                @endif
                        >{{$category->title}}</option>

                    @endforeach
                    @if(!($articles->count() >0))
                        <option value="" selected>--</option>
                    @endif

                </select>
                </div>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper2" data-token="{{ csrf_token() }}">
                <thead>
                <tr>
                    <th>id</th>
                    <th class="td-1">Картинка</th>
                    <th>Ш-код</th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Группа</th>
                    <th class="td-1">Описание</th>
                    <th>Цена_пок.</th>
                    <th>Цена_прод.</th>
                    <th class="td-1">Изменён</th>
                    <th>Действие</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        @if ($article->preview == 'none')
                            <td class="td-1"><i class="fa fa-ban" aria-hidden="true"
                                                style=
                                                "font-size: 1.4em;
                                                color:#b92c28;
                                                padding: 2px 0 0 8px;
                                                "></i></td>
                        @else
                            <?php
                            $fileName = ($article -> preview);
                            $fileName = mb_substr($fileName,1);

                            ?>
                            @if(is_file($fileName))
                                <td class="td-1"><img width=30 height=30 src="{{asset($article->preview)}}"></td>
                            @else
                                <td class="td-1"><i class="fa fa-eraser" aria-hidden="true" style="
                                font-size: 1.4em;
                                color:#2c72e6;
                                padding: 2px 0 0 8px;
                                "></i></td>
                            @endif
                        @endif

                        <td>
                            @if($article->barcode =='')
                                <a href="#barcode" class="bar_link" data-toggle ="modal" data-id ="{{$article->id}}" >none</a></td>
                            @else
                                <a href="#barcode" class="bar_link" data-toggle ="modal" data-id ="{{$article->id}}" >{{$article->barcode}}</a></td>
                            @endif


                        <td class="td-2">{{$article->title}}</td>

                        @if ($customer = App\Category::where('id', $article -> category_id)->first())
                            <td>{{$article -> category -> title}}</td>
                        @else
                            <td><i class="fa fa-question" aria-hidden="true" style="font-size: 1.4em; color: red; "></i></td>
                        @endif
                        @if ($customer = App\Group::where('id', $article ->group_id)->first())
                            <td>{{$article -> group -> title}}</td>
                            @else
                            <td><i class="fa fa-question" aria-hidden="true" style="font-size: 1.4em; color: red; "></i></td>
                        @endif
                        <td class="td-1">{{str_limit($article->content,45,' ...')}}</td>
                        <td>{{$article->cena_in}}</td>
                        <td>{{$article->cena_out}}</td>
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