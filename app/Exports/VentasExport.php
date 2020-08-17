<?php

namespace App\Exports;


use App\ventas;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;


class VentasExport implements FromView
{
    protected $id;


    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        
        $ventasB = request()->all();
        
        $ventas = ventas::with('products')->where('id_venta',$ventasB['id_venta'])->get();
        
        $clientes =DB::table('clientes')->get();
        return view('ventas.VentaExcel',compact('ventas','clientes'));
        
    }
   
}
