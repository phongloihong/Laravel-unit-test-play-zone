@component('profile.activities.activity')
    @slot('header')
        <a href="{{$record->subject->favorited->path()}}">{{$user->name}} favotited a reply</a>
    @endslot

    @slot('body')
        {{ $record->subject->favorited->body }}
    @endslot
@endcomponent