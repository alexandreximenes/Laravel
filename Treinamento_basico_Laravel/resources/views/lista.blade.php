@extends('principal')

@section('conteudo')
    <div class="container">
        <h1>Listagem de produtos</h1>

        <table class="table">

            <th>NOME</th>
            <th>VALOR</th>
            <th>DESCRICAO</th>
            <th>QUANTIDADE</th>
            <th>AÇÃO</th>

            @foreach ($produtos as $p)

            <tr>
                <td>{{$p->nome }} </td>
                <td>{{$p->valor}}  </td>
                <td>{{$p->descricao }} </td>
                <td>{{$p->quantidade }}</td>
                <td><a href="/detalhes/produto/<?= $p->id ?>"><span class="glyphicon glyphicon-search"></span> > </a></td>
            </tr>

            #endforeach

        </table>

    </div>

@stop
