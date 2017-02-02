@extends('site.main')
@section('content')
    <div class="container">
        <button type="button" class="close" style="margin: 30px 10px 0 0" onclick="history.back();">&times;</button>

                <?php

                function build_tree($cats,$parent_id,$only_parent = false){
                    if(is_array($cats) and isset($cats[$parent_id])){
                        $tree = '<ul>';
                        if($only_parent==false){
                            foreach($cats[$parent_id] as $cat){
                                $st = action('CategoriesController@edit',['id' => $cat['id']]);
                                $tree .= '<li><a href="'.$st.'">'.$cat['title'];
                                $tree .=  build_tree($cats,$cat['id']);
                                $tree .= '</a></li>';
                            }
                        }elseif(is_numeric($only_parent)){
                            $cat = $cats[$parent_id][$only_parent];
                            $st = action('CategoriesController@edit',['id' => $cat['id']]);
                            $tree .= '<li><a href="'.$st.'">'.$cat['title'];
                            $tree .=  build_tree($cats,$cat['id']);
                            $tree .= '</a></li>';
                        }
                        $tree .= '</ul>';
                    }
                    else return null;
                    return $tree;
                }
                ?>


        <h3>Дерево категорий</h3>
        <br>
        <div class="bigtree"><?php echo build_tree($cats,-211); ?></div>

        <br>
    </div>


@stop