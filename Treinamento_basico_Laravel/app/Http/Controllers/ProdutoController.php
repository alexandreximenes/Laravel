<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class ProdutoController extends Controller {
    public function lista(){

        $produtos = DB::select("select * from produtos");
        //response->json_encode($produtos,200);
        return view('lista')->with('produtos', $produtos);
    }

    public function detalhe(){
        $id = (int) Request::route('id');
        $produto = DB::select("SELECT * FROM produtos WHERE id = ?", [$id]);
        return view('detalhes')->with('produto', $produto[0]);
    }

    public function novo(){
        return view('formulario');
    }

//    public function adicionar(Request $request){
    public function adicionar(){
        // $_POST só pra zuar hehehehe
        $_POST = Request::All();

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];

//        dd('insert into produtos (nome, quantidade, descricao, valor) values (?,?,?,?), array($nome, $valor, $quantidade, $descricao)');

//      DB::insert('insert into produtos (nome, quantidade, descricao, valor) values (?,?,?,?)', [$nome, $valor, $quantidade, $descricao]);
        DB::insert('insert into produtos (nome, quantidade, descricao, valor) values (?,?,?,?)', array($nome, $valor, $quantidade, $descricao));

//      return view('adicionado')->with('produto', $nome);

        return redirect('/')->withInput();
    }
}