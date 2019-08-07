<?php 

	return [
		[
            'display' => ' Users',
            'uniqkey' => 'users.menu',
            'url' => '/administrator/users',
            'classId' => '',
            'className' => '',
            'classIcon' => 'ion-ios-person-outline',
        ],
        [
			'display' => ' Access menus',
			'uniqkey' => 'access.group.menu',
			'url' => null,
			'classId' => '',
			'className' => '',
			'classIcon' => 'ion-ios-locked-outline',
			'childs' => [
				[
					'display' => ' Roles',
					'uniqkey' => 'access.master.roles',
					'url' => '/administrator/roles',
					'classId' => '',
					'className' => '',
					'classIcon' => ''
				],
				[
					'display' => ' Access Role',
					'uniqkey' => 'access.role.menu',
					'url' => '/administrator/access/role',
					'classId' => '',
					'className' => '',
					'classIcon' => ''
				],
				[
					'display' => ' Access Permissions',
					'uniqkey' => 'access.permissions.menu',
					'url' => '/administrator/access/permission',
					'classId' => '',
					'className' => '',
					'classIcon' => ''
                ],
			]
        ],
        [
            'display' => ' Settings',
            'uniqkey' => 'settings.menu',
            'url' => '/administrator/settings',
            'classId' => '',
            'className' => '',
            'classIcon' => 'ion-ios-cog-outline',
        ],
	];