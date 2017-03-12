<?php

namespace App\Http\Controllers;

use App\Contragent;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Http\Requests;

class ContragentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contragents = Contragent::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $contragents->render());

        return view('site.contragents.view',
            [
                'contragents' => $contragents,
                'links' => $links,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
        Contragent::create($all);

        Session::flash('message', 'Контрагент сохранен!');
        return Redirect::to('/contragents');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contragent = Contragent::find($id);
        $all = $request->all();
        $contragent->update($all);

        Session::flash('message', 'Контрагент изменён!');
        return Redirect::to('/contragents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contragent = Contragent::find($id);
        $contragent -> delete();

        Session::flash('message', 'Контрагент удалён!');
        return redirect()->back();
    }
}
