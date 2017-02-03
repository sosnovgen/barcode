<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use Storage;
use App\Group;
use App\Http\Requests;

class GroupsController extends Controller
{
    public function index()
        {
            $groups = Group::all();

            return view('site.groups.view', ['groups' => $groups]);
        }

    public function create()
        {
            return view('admin.groups.create');
        }


    public function store(Request $request)
    {
        $all = $request->all();
        Group::create($all);

        Session::flash('message', 'Группа сохранена!');
        return Redirect::to('/groups');

    }

    public function destroy($id)
        {
            $group = Group::find($id);
            $group->delete(); //Удалить строку из БД


            Session::flash('message', 'Группа удалена!');
            return Redirect::to('/groups');
        }



    
    
    
    
    
}
