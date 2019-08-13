@extends('admin.layouts.master')
@section('title', 'Create Role')

@section('content')
<div class="section-wrapper">

    {!! Form::open([ 'route' => 'admin.roles.store', 'method' => 'POST']) !!}
        @include('admin.roles._form')
    {!! Form::close() !!}

</div>
@endsection
