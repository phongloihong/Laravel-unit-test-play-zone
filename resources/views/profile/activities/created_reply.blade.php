@component('profile.activities.activity')
    @slot('header')
        {{$user->name}} replied at <a href="{{ $record->subject->thread->path() }}">{{ $record->subject->thread->title }}</a>
    @endslot

    @slot('body')
        {{ $record->subject->body }}
    @endslot
@endcomponent