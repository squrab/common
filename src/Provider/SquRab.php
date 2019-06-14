<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/6/14
 * Time: 14:19
 */

namespace SquRab\Common\Provider;

use Illuminate\Support\ServiceProvider;

class SquRab extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../squrab.php' => config_path('squrab.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('avatar', function ($app) {

        });
    }
}
