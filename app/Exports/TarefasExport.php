<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TarefasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Tarefa::all();
        return auth()->user()->tarefas()->get(); //Retornar uma collection das tarefas pertencentes ao usuario
    }

    public function headings(): array
    {
        return [
            'Id da tarefa', 
            'Id do usuario',
            'Data Limite conclusão',
            'Data Criação',
            'Data Atualização'
        ];
    }
}
