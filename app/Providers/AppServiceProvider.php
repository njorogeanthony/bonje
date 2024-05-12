<?php

namespace App\Providers;

use App\Support\Enums\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Request::macro('userIsAdmin', function () {
            return $this->user()->role === Roles::ADMIN;
        });

        Request::macro('userIsUploader', function () {
            return $this->user()->role === Roles::UPLOADER;
        });

        Request::macro('userIsValidator', function () {
            return $this->user()->role === Roles::VALIDATOR;
        });

        Blade::directive('isAdmin', fn () => "<?php if (request()->userIsAdmin()): ?>");
        Blade::directive('endisAdmin', fn () => "<?php endif; ?>");

        Blade::directive('isUploader', fn () => "<?php if (request()->userIsUploader()): ?>");
        Blade::directive('endisUploader', fn () => "<?php endif; ?>");

        Blade::directive('isValidator', fn () => "<?php if (request()->userIsValidator()): ?>");
        Blade::directive('endisValidator', fn () => "<?php endif; ?>");
    }
}
