<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Image\Image;

function sidebarList()
{
    return [
        'Dashboard' => [
            'icon' => 'bi bi-speedometer',
            'route' => 'admin.dashboard.view',
            'permission' => has_permission('admin.dashboard.view'),
        ],
        'User Management' => [
            'icon' => 'bi bi-person-circle',
            'permission' => has_permissions(['admin.users.view', 'admin.user-role.view']),
            'Users' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.users.view',
                'permission' => has_permission('admin.users.view'),
            ],
            'User Role' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.user-role.view',
                'permission' => has_permission('admin.user-role.view'),
            ],
        ],
        'Product Management' => [
            'icon' => 'bi bi-person-circle',
            'permission' => has_permissions(['admin.products.view', 'admin.categories.view']),
            'Products' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.products.view',
                'permission' => has_permission('admin.products.view'),
            ],
            'Product Category' => [
                'icon' => 'bi bi-circle',
                'route' => 'admin.categories.view',
                'permission' => has_permission('admin.categories.view'),
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
        if (! $name || ! isset($action['controller']) || str_contains($action['controller'], 'LoginController')) {
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

        // Extract last segment of route name: "admin.users.createPage" → "view"
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

// Is permission exist in role permissions
function has_permission($permission)
{
    $permissions = explode(',', Auth::user()->Role?->permissions ?? '');

    return in_array($permission, $permissions);
}
function has_permissions(array $permissions): bool
{
    foreach ($permissions as $permission) {
        if (has_permission($permission)) {
            return true;
        }
    }

    return false;
}

// upload image and return path
if (! function_exists('upload_file')) {

    function upload_file($file, $folder = 'images', $quality = 80)
    {
        // Base upload path
        $basePath = public_path("storage/uploads/{$folder}");
        $webpPath = "{$basePath}/webp";

        // Ensure directories exist
        if (! File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true);
        }

        if (! File::exists($webpPath)) {
            File::makeDirectory($webpPath, 0755, true);
        }

        // Generate unique file name
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::uuid().'.'.$extension;
        $webpFileName = Str::uuid().'.webp';

        // Move original file
        $file->move($basePath, $fileName);

        // Create WebP version
        Image::load("{$basePath}/{$fileName}")
            ->format('webp')
            ->quality($quality)
            ->save("{$webpPath}/{$webpFileName}");

        $originalPath = "storage/uploads/{$folder}/{$fileName}";
        $webpPath = "storage/uploads/{$folder}/webp/{$webpFileName}";

        return [
            'original' => asset($originalPath),
            'webp' => asset($webpPath),
        ];
    }
}
