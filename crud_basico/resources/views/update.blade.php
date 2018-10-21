@extends('layout')

@section('content')

    <div class="container">
        <form action="/todos/save" method="post">
            <div class="row">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $todo->id }}"/>
                <input type="text" class="class form-control" name="todo" value="{{ $todo->todo }}" placeholder="Digit a new todo"/>
            </div>
        </form>
    </div>
@stop
