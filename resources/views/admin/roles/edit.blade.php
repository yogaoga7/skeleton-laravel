@extends('admin.layouts.master')
@section('title', 'Edit Role')

@section('content')
<div class="section-wrapper">

    {!! Form::model($role, [ 'route' => ['admin.roles.update', $role->id], 'method' => 'PUT' ]) !!}
        @include('admin.roles._form')
    {!! Form::close() !!}

</div>
@endsection
