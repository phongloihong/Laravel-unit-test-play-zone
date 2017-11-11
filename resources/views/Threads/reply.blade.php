<div class="panel panel-default">
	<div class="panel-heading level">
		<h5 class="flex">
			<a href="#">
				{{ $reply->owner->name }}
			</a> said
			{{ $reply->created_at->diffForHumans() }}
		</h5>
        <form action="{{url('/replies/'. $reply->id . '/favorites')}}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                {{ $reply->getFavoritesCount() }} Favorited
            </button>
        </form>
	</div>

	<div class="panel-body">
		{{ $reply->body }}
	</div>
</div>