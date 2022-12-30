<?php

namespace App\Http\Controllers;

use App\Models\tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NovaTarefaMail;
use App\Exports\TarefasExport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\TesteSozinhoMail;

class TarefaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        if(Auth::check()){

            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;

            return "ID: $id | Nome: $name | Email: $email";

        }else{

            return 'Voce nao esta logado';

        }
        */
        $user_id = Auth::user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->get();
        return view('tarefa.index', ['tarefas' => $tarefas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = Auth::user()->id;
        
        $regras = [
            'tarefa' => 'required',
            'data_limite_conclusao' => 'required'
        ];

        $feedback = [
            'required' => 'Campo obrigatório'
        ];
        
        $request->validate($regras, $feedback);

        $tarefa = Tarefa::create($dados); // Salvar no banco de dados

        $destinatario = Auth::user()->email; //Email do usuario logado
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa)); // Disparar o email de nova tarefa

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(tarefa $tarefa)
    {
        //Verificar se a tarefa pertence ao usuario logado
        $user_id = Auth::user()->id;

        if($tarefa->user_id == $user_id){

            return view('tarefa.edit', ['tarefa' => $tarefa]);

        }else{

            return view('acesso-negado');

        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tarefa $tarefa)
    {
        $user_id = Auth::user()->id;

        if($tarefa->user_id == $user_id){

            $tarefa->update($request->all());
            return redirect()->route('tarefa.show', ['tarefa'=>$tarefa]);

        }else{

            return view('acesso-negado');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(tarefa $tarefa)
    {
        $user_id = Auth::user()->id;

        if($tarefa->user_id == $user_id){

            $tarefa->delete();
            return redirect()->route('tarefa.index');

        }else{

            return view('acesso-negado');

        }
    }

    public function exportacao($extensao){
        if(in_array($extensao, ['xlsx', 'csv', 'pdf'])){

            return Excel::download(new TarefasExport, "Lista_tarefas.$extensao");

        }else{

            return redirect()->route('tarefa.index');

        }
    }
}
