<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    protected $policies = [
        Product::class => ProductPolicy::class,
    ];
    

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // Gate::before(function ($user) {
        //     if ($user->role->name === 'super-admin') {
        //         return true;
        //     }
        // });

        // Gate::define('creat-product', function ($user) {
        //     return in_array($user->role->name, ['admin', 'super-admin']);
        // });

        // Gate::define('update-product', function ($user, Product $product) {
        //     return $product->user_id === $user->id;
        // });

        // Gate::define('delete-product', function ($user, Product $product) {
        //     return false;
        // });

        // Gate::define('manage-trash', function ($user) {
        //     return ($user->role->name === 'super-admin') ? Response::allow() : Response::deny('its allowed only for super-admin');
        // });

    }
}
