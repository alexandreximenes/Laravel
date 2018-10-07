<?php namespace App\Http\Controllers;

use App\Produto;
use Request;

class ProdutoController extends Controller
{
    public function lista()
    {
        return view('lista')->with('produtos', self::all());
    }


    public function listaJson()
    {
        return response()->json(self::all());
    }

    public function all()
    {
        return Produto::All();
    }

    public function detalhe($id)
    {
        $produto = Produto::find($id); //DB::select("SELECT * FROM produtos WHERE id = ?", [$id]);
        return view('detalhes')->with('produto', $produto);
    }

    public function novo()
    {
        return view('formulario');
    }

//    public function adicionar(Request $request){
    public function adicionar()
    {
        $produto = Request::All();
        Produto::create($produto);
        return redirect('/')->withInput();

    }

    public function delete($id){
//        $id = Request::route('id');
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()->action('ProdutoController@lista') ;
    }
}