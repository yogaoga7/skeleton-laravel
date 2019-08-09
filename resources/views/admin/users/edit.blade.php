@extends('admin.layouts.master')
@section('title', 'Edit User')

@section('content')
<div class="section-wrapper">

    {!! Form::model($user, [ 'route' => ['admin.users.update', $user->id], 'method' => 'PUT' ]) !!}
        @include('admin.users._form')
    {!! Form::close() !!}

</div>
@endsection
