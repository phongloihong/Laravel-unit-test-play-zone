@component('profile.activities.activity')
    @slot('header')
        {{$user->name}} created thread <a href="{{ $record->subject->path() }}">{{ $record->subject->title }}</a>
    @endslot

    @slot('body')
        {{ $record->subject->body }}
    @endslot
@endcomponent