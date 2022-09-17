@extends('layouts.app')

@section('content')
<div class="main">
    <h1 class="center">Discussion Board</h1>
    
    @if($boards->isEmpty())
        <p class="center empty">まだボードがありません。</p>
    @else
        @foreach ($boards as $board)
            <div class="board-title-card">
                <div class="small-content">
                    <p class="small">{{ $board->user->name}}</p>
                    <p class="small">{{ $board->created_at }}</p>
                </div>
                <div>
                    {!! link_to_route('board.show',$board->title,[$board->id],['class'=>'board-title']) !!}
                </div>

                @if(\Auth::id() === 1)
                    {{ Form::open(['route'=>['board.delete',$board->id],'method'=>'delete']) }}
                        {{ Form::submit('削除',['class'=>'delete']) }}
                    {{ Form::close() }}
                @endif
            </div>
            
        @endforeach
    @endif

    {!! link_to_route('home','topへ',[],['class'=>'block center']) !!}

    <a  class="add" href={{ route('board.create') }} ><i  class="fas fa-plus-square"></i></a>

</div>


@endsection