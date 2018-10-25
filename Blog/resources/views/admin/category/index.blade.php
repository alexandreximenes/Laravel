@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <table class="table table hover">
            <thead>
                <th>Name</th>
                <th>Editing</th>
                <th>Deleting</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                    <td> {{ $category->nome }} </td>
                    <td> <a href="{{ route('category.edit', ['id' => $category->id]) }}"><button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil">Editing</span></button></a> </td>
                    <td> <a href="{{ route('category.delete', ['id' => $category->id]) }}"><button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash">Deleting</span></button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
