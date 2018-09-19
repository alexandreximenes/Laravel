@extends('principal')

@section('conteudo')
    <div class="container">
        <h1>Detalhes do produto</h1>

        <table class="table">
            <tr>
                <td>NOME : </td><td> {{$produto->nome }}</td>
            </tr>
            <tr>

                <td>VALOR : </td><td>{{ $produto->valor }} </td></br>
            </tr>
            <tr>
                <td>DESCRIÇÃO : </td><td>{{$produto->descricao }} </td></br>
            </tr>
            <tr>
                <td>QUANTIDADE : </td><td>{{$produto->quantidade }}</td></br>
            </tr>
            <tr>
                <td></td><td><a href="/">listagem de produtos</a></td></br>
            </tr>

        </table>

    </div>

@stop