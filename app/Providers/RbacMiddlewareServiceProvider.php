<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RbacMiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Je n’enregistre rien dans register() pour ce besoin.
     */
    public function register(): void
    {
        // rien à faire ici
    }

    /**
     * Dans boot(), j’enregistre explicitement les alias de middleware
     * auprès du router, ce qui garantit leur présence au runtime,
     * même si $middlewareAliases/$routeMiddleware du Kernel n’étaient pas pris en compte.
     */
    public function boot(): void
    {
        // je récupère le router de l’application
        $router = $this->app['router'];

        // j’enregistre les alias Spatie (namespace au singulier "Middleware")
        $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
        $router->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
        $router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);
    }
}
