<?php namespace App\Http\Controllers;

use App\Produto;
use Request;
use Validator;
use App\Http\Requests\ProdutoRequest;

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
        $produto = self::findById($id); //findOrFail($id);
        if(is_null($produto)){
            return "Produto não cadastrado em nosso sistema!";
        }
        //DB::select("SELECT * FROM produtos WHERE id = ?", [$id]);
        return view('detalhes')->with('produto', $produto);
    }
    
    public function findById($id){
        return Produto::find($id);
    }

    public function detalheJson($id){
        $produto = self::findById($id);
        if(is_null($produto)){
            return response()->json("Produto nao cadastrado em nosso sistema", "404");
        }
        return response()->json($produto);
    }

    public function novo()
    {
        return view('formulario');
    }

    public function adicionar()
    {
        $validator = Validator::make(
            ['nome' => Request::input('nome')],
            ['nome' => 'required|min:3']
        );

        if($validator->fails()){
            return redirect('/produto/novo');
        }
//        $produto = $request->all();
        Produto::create( Request::all());
        return redirect('/')->withInput();

    }

    public function delete($id){
//        $id = Request::route('id'); // posso passar o id como parametro do metodo.
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()->action('ProdutoController@lista') ;
    }
}