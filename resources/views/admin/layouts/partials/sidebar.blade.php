@php

$require = require(app_path('/Helpers/menus.php'));
$html = '';
$access = auth()->user()->menu_access();
$htmlview = function($menus, $icon = true, $isSub = false) use (&$htmlview, $access) {
	$html = '';
	foreach($menus as $name => $menu) {
		if(in_array($menu['uniqkey'], $access)) {
			$hasSubs = isset($menu['childs']) ? ' with-sub' : false;
			$class = $isSub ? 'nav-sub-item' : 'sidebar-nav-item';
			$link = $isSub ? 'nav-sub-link' : 'sidebar-nav-link';
			$active = !is_null($menu['url']) && request()->is(ltrim($menu['url'], '/') . '*' ) ? ' active' : '';
			$html .= '<li class="'. $class . $hasSubs.' ">';
			$url = is_null($menu['url']) ? 'javascript:void(0);' : url($menu['url']);
			$html .= '<a class="'. $link . $active .'" href="' . ($url) . '"><i class="' . $menu['classIcon'] . ' mr-2 fa-lg"></i>' . $menu['display'] . '</a>';
			if($hasSubs) {
				$html .= '<ul class="nav sidebar-nav-sub">';
				$html .= $htmlview($menu['childs'], false, true);
				$html .= '</ul>';
			}
			$html .= '</li>';
		}
	}
	return $html;
};
@endphp
<ul class="nav nav-sidebar">
	<li class="sidebar-nav-item">
		<a class="sidebar-nav-link {{ request()->is('administrator') ? 'active' : '' }}" href="{{ url('/administrator') }}"><i class="icon ion-ios-speedometer-outline"></i> Dashboard</a>
	</li>
	{!! $htmlview($require) !!}
</ul>
