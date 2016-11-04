@extends('layout.base')

@section('pageTitle', 'Create a your new Action Tracker')

@section('container')
<div id="form-action-tracker" class="col-md-6 col-md-offset-3">
    <a href="{{ route('googleAuth') }}">Login Google</a>
    <h1 class="title">Action Tracker</h1>
    <form action="/" method="post">
        <div class="form-group">
            <input type="text" class="form-control input-lg" id="input-tracker" placeholder="ex: QOLEGA">
            <p class="help-block">Press Enter to create.</p>
        </div>
    </form>
    <hr/>
</div>
@endsection