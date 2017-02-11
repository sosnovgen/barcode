@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" onclick="history.back();">&times;</button>

        <div class="col-md-8">
            <form role="form"
                  method="POST" action="{{action('ArticlesController@update',['articles'=>$article->id])}}" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="put">
                <div class="row ">
                    <h3>Редактировать товар</h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label >Название Товара</label>
                        <input type="text" name="title" value = "{{$article->title}}" class="form-control"><br>
                    </div>

                    <div class="col-md-3">
                        <label >Штрих-код</label>
                        <input type="text" name="barcode" value="{{$article->barcode}}" class="form-control"><br>
                    </div>

                    <div class="col-md-4">
                        <label>Картинка</label>
                        <input type="file" name="preview" value="{{asset($article->preview)}}" class="filestyle" data-buttonText=" Выбрать"><br>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="category_id"><a href="#treeModal" data-toggle ="modal">Категория</a></label>
                        <select name="category_id" class="form-control" onfocus='this.size=12;' onchange='this.size=1;' onblur='this.size=1;'>
                            @foreach($categories as $category)
                                @if($article->category_id == $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                            @endforeach

                        </select><br>
                    </div>

                    <div class="col-md-4">
                        <label for="group_id">Группа</label>
                        <select name="group_id" class="form-control">

                            @foreach($groups as $group)
                                @if($article->group_id == $group -> id)
                                    <option value="{{$group -> id}}" selected>{{$group -> title}}</option>
                                @else
                                    <option value="{{$group->id}}">{{$group->title}}</option>
                                @endif
                            @endforeach

                        </select><br>

                    </div>

                    <div class="col-md-2">
                        <label >Цена_покуп.</label>
                        <input type="text" name="cena_in" value = "{{$article->cena_in}}" class="form-control"><br>
                    </div>
                    <div class="col-md-2">
                        <label >Цена_прод.</label>
                        <input type="text" name="cena_out" value = "{{$article->cena_out}}" class="form-control"><br>
                    </div>

                </div>

                <div class="form-group">
                    <label for="comment">Описание:</label>
                    <textarea class="form-control" rows="5" id="editor" name ="content">{{$article -> content}}</textarea>
                </div>

                <br>

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="submit" value="Сохранить" class="btn btn-default">

            </form>

        </div>

        <div class="col-md-4">
            <div class="description small">
                <p>* Здесь можно добавить/отредактировать товар.</p>
                <p>* Сначала создать категорию, затем добавить товар.</p>
                <p>* Поле "Группа" - не обязательна к заполнению.</p>
                <p>* Размер картинки примерно 300Х300.</p>
                <p>* Перенос строки в описании: "Shift + Enter". </p>

            </div>
        </div>

    </div>


    <!------------- Modal ----------------->
    <div class="modal fade" id="treeModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Выберите категорию</h4>
                </div>
                <div class="modal-body bigtree">

                    <!------------------ Content ------------------------->
                <?php

                if  (count($categories) > 0){

                    $cats = array(); //создать новый массив
                    //заполнить:
                    foreach($categories as $cat) {
                        $cats_ID[$cat['id']][] = $cat;
                        $cats[$cat['parent_id']][$cat['id']] =  $cat;
                    }
                }

                function build_tree($cats,$parent_id,$only_parent = false){
                    if(is_array($cats) and isset($cats[$parent_id])){
                        $tree = '<ul>';
                        if($only_parent==false){
                            foreach($cats[$parent_id] as $cat){
                                /*$st = Url::toRoute(['articles/entercat', 'id' => $cat['id']]);
                                $tree .= '<li><a href="'.$st.'">'.$cat['title'];*/
                                $tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];
                                $tree .=  build_tree($cats,$cat['id']);
                                $tree .= '</a></li>';
                            }
                        }elseif(is_numeric($only_parent)){
                            $cat = $cats[$parent_id][$only_parent];
                            /*$st = Url::toRoute(['articles/entercat', 'id' => $cat['id']]);
                            $tree .= '<li><a href="'.$st.'">'.$cat['title'];*/
                            $tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];
                            $tree .=  build_tree($cats,$cat['id']);
                            $tree .= '</a></li>';
                        }
                        $tree .= '</ul>';
                    }
                    else return null;
                    return $tree;
                }


                echo build_tree($cats,-211);;
                ?>

                <!------------------ /Content ------------------------->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


@stop
