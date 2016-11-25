@extends('layout.base')

@section('pageTitle', 'Create a your new Action Tracker')

@section('container')
<div id="form-action-tracker" class="col-md-6 col-md-offset-3">
    @unless (Auth::check())
        <a class="pull-right" href="{{ route('googleAuth') }}">Login with Google</a>
    @endunless
    @if (Auth::check())
    <span class="pull-right text-warning">Hi, {{  Auth::user()->name }}</span>
    @endif
    <h1 class="title">Action Tracker</h1>
    
    <div class="form-group">
        <input type="text" class="form-control input-lg" id="input-tracker" placeholder="ex: QOLEGA" v-on:keyup="create($event)" autocomplete="off" v-model="tracker_name">
        <p class="help-block">Press Enter to create.</p>
    </div>
    
    <hr/>
</div>
@endsection