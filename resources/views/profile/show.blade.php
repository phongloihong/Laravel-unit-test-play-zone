@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header level">
            <h1 class="flex">
                {{ $user->name }}
                <small>Since {{ $user->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach($threads as $thread)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="level">
                        <h4 class="flex">
                            <a href="{{ $thread->path() }}">
                                {{ $thread->title }}
                            </a>
                        </h4>
                        <strong>
                            {{ $thread->created_at->diffForHumans() }}
                        </strong>
                    </div>

                    <div class="body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        @endforeach
        {{ $threads->links() }}
    </div>
@endsection