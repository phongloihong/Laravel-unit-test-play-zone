@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header level">
            <h1 class="flex">
                {{ $user->name }}
            </h1>
        </div>

        @foreach($activities as $date => $activity)
            <h3>{{$date}}</h3>
            @foreach($activity as $record)
                @if(view()->exists("profile.activities.{$record->type}"))
                    @include("profile.activities.{$record->type}")
                @endif
            @endforeach
        @endforeach
    </div>
@endsection