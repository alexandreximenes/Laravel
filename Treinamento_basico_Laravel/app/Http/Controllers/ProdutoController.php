<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class ProdutoController extends Controller {
    public function lista(){

        $produtos = DB::select("select * from produtos");

        return view('lista')->with('produtos', $produtos);
    }

    public function detalhe(){
        $id = (int) Request::route('id');
        $produto = DB::select("SELECT * FROM produtos WHERE id = ?", [$id]);
        return view('detalhes')->with('produto', $produto[0]);
    }
}