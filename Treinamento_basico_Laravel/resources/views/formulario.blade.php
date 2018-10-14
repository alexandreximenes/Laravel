@extends('principal')

@section('conteudo')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Novo produto</h1>

        <table class="table">
            <form method="POST" action="/produto/adicionar" class="form-group">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <tr>
                    <td></td><td><a href="/">listagem de produtos</a></td></br>
                </tr>
                <tr>
                    <td>NOME : </td><td> <input class="form-control" type="text" name="nome" autofocus></td>
                </tr>
                <tr>

                    <td>VALOR : </td><td><input class="form-control" type="text" name="valor"></td></br>
                </tr>
                <tr>
                    <td>DESCRIÇÃO : </td><td><input class="form-control" type="text" name="descricao"></td></br>
                </tr>
                <tr>
                    <td>QUANTIDADE : </td><td><input class="form-control" type="text" name="quantidade"></td></br>
                </tr>
                <tr>
                    <td>TAMANHO: </td><td><input class="form-control" type="text" name="tamanho"></td></br>
                </tr>
                <tr>
                    <td>COR: </td><td><input class="form-control" type="text" name="cor"></td></br>
                </tr>
                <tr>
                    <td>CUSTO: </td><td><input class="form-control" type="text" name="custo"></td></br>
                </tr>
                <tr>
                    <td></td><td><button class="btn btn-primary" type="submit">Adicionar</button></td></br>
                </tr>

            </form>
        </table>

    </div>

@stop