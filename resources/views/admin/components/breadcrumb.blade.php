<div class="slim-pageheader">
    <ol class="breadcrumb slim-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard.index') }}">Home</a>
        </li>
        @for( $i = 2; $i <= count(Request::segments()); $i++)
            <li class="breadcrumb-item">
                <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true))) }}">
                    {{ ucfirst(Request::segment($i)) }}
                 </a>
            </li>
        @endfor
    </ol>
    <h6 class="slim-pagetitle">
        @yield('title')
    </h6>
</div>