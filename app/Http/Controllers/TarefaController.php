<?php

namespace App\Http\Controllers;

use App\Models\Tareda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){

            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;

            return "ID: $id | Nome: $name | Email: $email";

        }else{

            return 'Voce nao esta logado';

        }

        /*
        if(auth()->check()){
            $id = auth()->user()->id;
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            return "ID: $id | Nome: $name | Email: $email";
        }else{
            return 'Voce nao esta logado';
        }
        */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tareda  $tareda
     * @return \Illuminate\Http\Response
     */
    public function show(Tareda $tareda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tareda  $tareda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tareda $tareda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tareda  $tareda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tareda $tareda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tareda  $tareda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tareda $tareda)
    {
        //
    }
}
