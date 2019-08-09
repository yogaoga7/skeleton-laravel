@extends('admin.layouts.master')
@section('title')
Users 
<a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary "> <i class="fa fa-plus"></i> Add New </a>
@endsection

@section('content')
<div class="section-wrapper">
    @component('admin.components.datatables', [
        'name' => 'data-tables',
        'thead' => [  __('Name'), __('Email'), __('State'), __('Created at'), __('Action') ],
        'options' => [
            'processing' => true,
            'serverSide' => true,
            'ajax' => route('admin.users.index'),
            'columns' => [
                ['data' => 'name'],
                ['data' => 'email'],
                ['data' => 'state'],
                ['data' => 'created_at'],
                ['data' => 'action', 'class' => 'text-right'],
            ]
        ]
    ])
    @endcomponent

</div>
@endsection