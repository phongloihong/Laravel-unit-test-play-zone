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
                @include("profile.activities.{$record->type}")
            @endforeach
        @endforeach
    </div>
@endsection