<?php

namespace App\Exports;
use App\compras;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ComprasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
      
        $comprasB = request()->all();
        
        $compras = compras::with('relacion')->where('id_compra',$comprasB['id_compra'])->get();
        
        $proveedores =DB::table('proveedores')->get();
        return view('compras.CompraExcel',compact('compras','proveedores'));
        
    }
}
