<Reply :attribute="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="panel panel-default">
        <div class="panel-heading level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner->name) }}">
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
            <div v-if="editReply">
                <textarea class="form-control" v-model="body"></textarea>
                <br>
                <button class="btn btn-primary btn-sm mr-1" @click="updateReply">Update</button>
                <button class="btn btn-link btn-sm mr-1" @click="editReply = false">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
            <div class="panel-footer level">
                <button class="btn btn-default btn-sm mr-1" @click="editReply = true">Edit</button>
                <form action="/replies/{{$reply->id}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        @endcan
    </div>
</Reply>