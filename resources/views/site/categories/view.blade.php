@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="location.href='{{asset('/')}}'">&times;</button>

        <div class="row capture">
            <h3 class="text-center">Категории</h3>
        </div>
<br>
        <div class="table-responsive">
            <table class="table table-condensed table-striped" id="token-keeper" data-token="{{ csrf_token() }}">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Картинка</th>
                    <th>Название</th>
                    <th>Родитель</th>
                    <th>Описание</th>
                    <th>Изменён</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                     <tr>
                        <td>{{$category->id}}</td>
                         @if ($category->preview == 'none')
                             <td><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 1.4em"></i></td>
                         @else
                             <?php
                             $fileName = ($category -> preview);
                             $fileName = mb_substr($fileName,1);

                             ?>
                             @if(is_file($fileName))
                                <td><img width=30 height=30 src="{{asset($category->preview)}}"></td>
                             @else
                                 <td><i class="fa fa-eraser" aria-hidden="true" style="font-size: 1.4em"></i></td>
                             @endif
                         @endif

                        <td>{{$category->title}}</td>
                        <?php $p1 = $category->parent_id;  ?>

                            @if ($customer = App\Category::where('id', $p1)->first())
                                <td>{{$customer -> title}}</td>
                            @else
                                <td>root</td>
                            @endif

                        <td>{{$category->body}}</td>
                         <td>{{$category->updated_at->format('d-m-Y')}}</td>
                         <td>&nbsp;
                             <a href="{{action('CategoriesController@edit',['id'=>$category->id])}}"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 1.2em; "></i></a>
                             &nbsp;
                             <a class="cat_link" href="{{$category->id}}" ><i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em"></i></a>
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