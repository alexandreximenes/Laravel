@extends('layout')

@section('content')

    <div class="container">
        <form action="/todos/create" method="post">
            <div class="row">
                {{ csrf_field() }}
                <input type="text" class="class form-control" name="todo" placeholder="Digit a new todo"/>
            </div>
        </form>

        <ul>
        @foreach($todos as $todo)
            <li> {{ $todo->todo }}
                <a href="/todos/delete/{{$todo->id}}" class="btn btn danger"> X </a>
                <a href="/todos/update/{{$todo->id}}" class="btn btn danger"> up </a>

                @if(!$todo->completed)
                    <a href="/todos/completed/{{$todo->id}}" class="btn btn danger"> complete </a>
                @else
                    <span>Completed!</span>
                @endif
            </li>

            <hr/>
        @endforeach
        </ul>
    </div>
@stop
