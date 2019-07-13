@extends('admin.layouts.master')

@section('content')
Welcome {{ Auth::user()->name }}
@endsection