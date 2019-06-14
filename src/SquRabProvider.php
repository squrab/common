<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/6/14
 * Time: 14:19
 */

namespace SquRab\Common;

use Illuminate\Support\ServiceProvider;

class SquRabProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('squrab.php'),
        ]);
    }
}
