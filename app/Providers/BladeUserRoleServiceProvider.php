<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeUserRoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        Blade::directive('userRole', function($expression){
            $user = Auth::user();
            $roles = explode(',', $expression);
            $isValidatedRole = $roles[0] == 'all' || in_array( $user->role,$roles) ? "true" : "false";
            return "<?php if(".$isValidatedRole.") :; ?>";
        });

        Blade::directive('endUserRole', function($roles){
            return '<?php endif; ?>';
        });
    }
}
