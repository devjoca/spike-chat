@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Discover these people :)</div>

                <div class="panel-body">
                    @if(! $users->isEmpty())
                        <form method="POST" action="{{ url('/conversations') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select class="form-control" name="receiver_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Chat">
                            </div>
                        </form>
                    @else
                        You are so popular that you have talked to` all the fellows in the app
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">People who actually have a conversation with you</div>

                <div class="panel-body">
                    <ul>
                        @foreach($conversations as $conversation)
                            <li>
                                <a href="{{ url('/conversations/'. $conversation->id) }}">
                                  {{ $conversation->peer->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
