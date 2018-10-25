@extends('layouts.app')

@section('content')

@include('admin.includes.errors')

<div class="container">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel heading">
                    Update category : {{$category->nome}}
            </div>
            <div class="panel body">
                <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                    {{ csrf_field() }}

                    <a href="{{ route('category.index') }}">This of categories</a>
                    <div class="form group">
                        <label for="name">Category name: </label>
                        <input type="text" name="name" value="{{ $category->nome }}" class="form control">
                    </div>

                    <div class="form group">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
