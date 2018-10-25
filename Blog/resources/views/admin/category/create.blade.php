@extends('layouts.app')

@section('content')

@include('admin.includes.errors')

<div class="container">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel heading">
                    Create a new Category
            </div>
            <div class="panel body">
                <form action="{{ route('category.store') }}" method="POST">
                    {{ csrf_field() }}

                    <a href="{{ route('category.index') }}">List of categories</a>
                    <div class="form group">
                        <label for="name">Category name: </label>
                        <input type="text" name="name" class="form control">
                    </div>

                    <div class="form group">
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
