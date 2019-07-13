@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <div class="card">
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">{{ $role->name }} access</h4>

                        @php

                        $require = require(app_path('/Helpers/menus.php'));

                        $html = '';
                        $access = $role->access->pluck('uniqkey')->toArray();
                        $htmlview = function($menus, $icon = true) use (&$htmlview, $access) {
                        $html = '';
                        foreach($menus as $name => $menu) {
                        $html .= '<li>';
                            $hasSubs = isset($menu['childs']) ? true : false;
                            $checked = in_array($menu['uniqkey'], $access) ? 'checked' : '';
                            $html .= '<input ' . $checked . ' type="checkbox" name="menus[]" value=\'' .
                                json_encode($menu) . '\' /> ' . __($menu['display']);
                            if($hasSubs) {
                            $html .= '<ul>';
                                $html .= $htmlview($menu['childs'], false);
                                $html .= '</ul>';
                            }
                            $html .= '</li>';
                        }
                        return $html;
                        };
                        @endphp
                        <ul>
                            {!! $htmlview($require) !!}
                        </ul>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">Save access</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script>
    $(function () {
        $('input[type=checkbox]').click(function () {
            $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
            var sibs = false;
            $(this).closest('ul').children('li').each(function () {
                if ($('input[type=checkbox]', this).is(':checked')) sibs = true;
            })
            $(this).parents('ul').prev().prop('checked', sibs);
        });
    });

</script>
@endpush
