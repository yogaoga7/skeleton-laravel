@extends('admin.layouts.auth')

@section('content')
<div class="signin-wrapper">

    <div class="signin-box">
        <h2 class="slim-logo"><a href="#">{{ env('APP_NAME') }}<span>.</span></a></h2>
        <h2 class="signin-title-primary">Welcome back!</h2>
        <h3 class="signin-title-secondary">Sign in to continue.</h3>
        {!! Form::open(['route' => 'admin.login.store', 'method' => 'POST']) !!}
        <div class="form-group">
            <input type="text" class="form-control" name="email" required placeholder="Enter your email">
        </div><!-- form-group -->
        <div class="form-group mg-b-50">
            <input type="password" class="form-control" name="password" required placeholder="Enter your password">
        </div><!-- form-group -->
        <button class="btn btn-primary btn-block btn-signin">Sign In</button>
        {!! Form::close() !!}
    </div><!-- signin-box -->

</div><!-- signin-wrapper -->
@endsection
