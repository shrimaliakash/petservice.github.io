<?php

return [
  //admin
  [
    'link'        => '/dashboard',
    'title'       => [
      'en'        => 'dashboard',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/menu',
    'title'       => [
      'en'        => 'menu',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/home',
    'title'       => [
      'en'        => 'home',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/about',
    'title'       => [
      'en'        => 'about',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/shop',
    'title'       => [
      'en'        => 'shop',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/service',
    'title'       => [
      'en'        => 'service',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/plan',
    'title'       => [
      'en'        => 'plan',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  [
    'link'        => '/contact',
    'title'       => [
      'en'        => 'contact',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],

  //general settings
  [
    'link'        => '#',
    'title'       => [
      'en'        => 'General settings',
      'ar'        => 'الإعدادات العامة'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => ['admins', 'groups', 'settings', 'error_logs'],
    'submenu'     => [
      //administrators
      [
        'link'        => '/admin/admins',
        'title'       => [
          'en'        => 'Adminstrators',
          'ar'        => 'مديرين الموقع'
        ],
        'icon'        => '<i class="fa fa-user-secret"></i>',
        'permission'  => 'admins',
        'submenu'     => []
      ],
      //groups
      [
        'link'        => '/admin/groups',
        'title'       => [
          'en'        => 'Groups',
          'ar'        => 'المجموعات'
        ],
        'icon'        => '<i class="fa fa-users"></i>',
        'permission'  => 'groups',
        'submenu'     => []
      ],
      //settings
      [
        'link'        => '/admin/settings',
        'title'       => [
          'en'        => 'Settings',
          'ar'        => 'الإعدادات'
        ],
        'icon'        => '<i class="fa fa-cog"></i>',
        'permission'  => 'settings',
        'submenu'     => []
      ],
      //error loga
      [
        'link'        => '/admin/error_logs',
        'title'       => [
          'en'        => 'Error Logs',
          'ar'        => 'سجلات الأخطاء'
        ],
        'icon'        => '<i class="fa fa-bug"></i>',
        'permission'  => 'error_logs',
        'submenu'     => []
      ],
    ]
  ],
];
