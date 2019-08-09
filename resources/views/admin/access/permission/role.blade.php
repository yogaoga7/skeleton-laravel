@extends('admin.layouts.master')
@section('title', 'Permission')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Access permission</h4>
                    <div class="list-group rounded-0">
                        @foreach($roles as $role)
                        <a href="{{ $user->can('attach-permission-access') ? url('/administrator/access/permission/' . $role->id) : 'javascript:alert(\'Forbidden access\');' }}"
                            class="list-group-item list-group-item-action">{{ $role->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop
