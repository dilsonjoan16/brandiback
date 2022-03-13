<?php

namespace App\Exports;

use App\Models\TipoCurso;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class UsersExport implements /*FromCollection,*/ ShouldAutoSize, FromView
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.tipoCurso', [
            'tipos' => TipoCurso::with('UsuarioCreador', 'UsuarioModificador','ModalidadDeCurso')->get()
        ]);
    }
}
