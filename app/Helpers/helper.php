<?php

function sidebarList()
{
    return [
        'Dashboard' => [
            'icon' => 'bi bi-speedometer',
            'route' => 'admin.dashboard.index',
        ],
        'User Management' => [
            "icon" => 'bi bi-person-circle',
            "Users" => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.users.index',
            ],
            "User Role" => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.user-role.index',
            ],
            "User Permission" => [
                'icon' => 'bi bi-circle',
                'route' => "admin.user-role.create",
            ],
        ],
    ];
}
function is_multidimensional_array(array $array): bool
{
    foreach ($array as $value) {
        if (is_array($value)) {
            return true;
        }
    }
    return false;
}

function is_active_sidebar($menuItems)
{
    $route_name = request()->route()?->getName();
    foreach ($menuItems as $key => $value) {
        if (isset($value['route']) && $route_name === $value['route']) {
            return 'menu-open';
        }
    }
    return '';
}
function is_active_menu($routeName)
{
    $currentRoute = request()->route()?->getName();

    return $currentRoute === $routeName ? 'active' : '';
}
