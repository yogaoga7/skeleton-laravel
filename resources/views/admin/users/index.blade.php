@extends('admin.layouts.master')

@section('content')
<div class="section-wrapper">
    <label class="section-title">Basic Form Input</label>
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

@push('scripts')
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });

</script>
@endpush
