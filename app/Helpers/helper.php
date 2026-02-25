<?php

use Illuminate\Support\Facades\Route;

function sidebarList()
{
    return [
        'Dashboard' => [
            'icon' => 'bi bi-speedometer',
            'route' => 'admin.dashboard.index',
        ],
        'User Management' => [
            'icon' => 'bi bi-person-circle',
            'Users' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.users.index',
            ],
            'User Role' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.user-role.index',
            ],
            'User Permission' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.user-role.create',
            ],
        ],
    ];
}
function getAdminRouteMap(): array
{
    $routes = Route::getRoutes()->getRoutes();
    $map = [];

    foreach ($routes as $route) {
        $name = $route->getName();
        $action = $route->getAction();

        // Skip routes without a name or controller
        if (! $name || ! isset($action['controller'])) {
            continue;
        }

        // Only process admin routes (optional filter)
        if (! str_starts_with($name, 'admin.')) {
            continue;
        }

        // Extract controller name: "App\Http\Controllers\UserController@index" → "User"
        $controllerClass = explode('@', $action['controller'])[0];
        $controllerShortName = class_basename($controllerClass);                  // "UserController"
        $controllerKey = str_replace('Controller', '', $controllerShortName);     // "User"

        // Extract last segment of route name: "admin.users.create.view" → "view"
        $routeKey = last(explode('.', $name));                                    // "view"

        $map[$controllerKey][$routeKey] = $name;
    }

    return $map;
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
