<?php

namespace Database\Seeders;

use App\Models\RouteList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class RouteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($map as $parent_name => $items) {
            $parent_route = RouteList::create([
                'name' => $parent_name,
            ]);
            foreach ($items as $name => $route) {
                RouteList::create([
                    'name' => $name,
                    'route' => $route,
                    'parent_id' => $parent_route->id,
                ]);
            }
        }
    }
}
