@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat with {{ $conversation->peer->name }}</div>
                <chat conversation_id="{{ $conversation->id }}" me="{{ $user->name }}"></chat>
            </div>
        </div>
    </div>
</div>
@endsection
