@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new Thread</div>

                <div class="panel-body">
                  	<form method="POST" action="/threads">
					  	{{ csrf_field() }}
						
						<div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
							<label>Choose a channel: </label>
							<select name="channel_id" id="channel_id" class="form-control" required>
								<option value="">Choose One...</option>
								@foreach($channels as $channel)
									<option 
										value="{{ $channel->id }}"
										{{ old('channel_id') == $channel->id ? 'selected' : '' }}>
										{{ $channel->name }}
									</option>
								@endforeach
							</select>

							{{-- error message handle --}}
							@if ($errors->has('channel_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('channel_id') }}</strong>
                                </span>
                            @endif
						</div>

						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label>Title: </label>
							<input type="text" class="form-control" name="title" id="title" 
								value="{{ old('title') }}" required/>
							
							{{-- error message handle --}}
							@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
							<label for="body">Body</label>
							<textarea name="body" id="body" class="form-control" 
								rows="8" required>{{ old('body') }}</textarea>
							
							{{-- error message handle --}}
							@if ($errors->has('body'))
								<span class="help-block">
									<strong>{{ $errors->first('body') }}</strong>
								</span>
							@endif
						</div>

						<button class="btn btn-primary">Publish</button>
				  	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
