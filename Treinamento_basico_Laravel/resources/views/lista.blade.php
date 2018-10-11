@extends('principal')

@section('conteudo')
    <div class="container">
        <h1>Listagem de produtos</h1>
        <br/>
        @if(old('nome'))
            <div class="alert alert-success">
                {{ old('nome') }} adicionado com sucesso!
            </div>
        @endif

        <table class="table">

            <th>NOME</th>
            <th>VALOR</th>
            <th>DESCRICAO</th>
            <th>QUANTIDADE</th>
            <th>TAMANHO</th>
            <th>AÇÃO</th>

            @foreach ($produtos as $p)

            <tr class="{{ $p->quantidade <=1 ? 'p-3 mb-2 bg-danger text-white': ''}}">
                <td>{{$p->nome }} </td>
                <td>{{$p->valor}}  </td>
                <td>{{$p->descricao }} </td>
                <td>{{$p->quantidade }}</td>
                <td>{{$p->tamanho }}</td>
                <td>
                    <a href="/produto/detalhe/{{$p->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> detalhe | </a>
                    <a href="/produto/delete/{{$p->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> delete </a>
                </td>
            </tr>

            @endforeach

        </table>

        <a class="btn btn-success" href="/produto/novo">Cadastrar</a>

    </div>

@stop
