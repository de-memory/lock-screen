<?php

namespace DeMemory\LockScreen;


use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Layout\Navbar;

class LockScreenServiceProvider extends ServiceProvider
{


    protected $middleware = [
        'middle' => [ // 注册中间件
            \DeMemory\LockScreen\Http\Middleware\LockScreen::class,
        ],
    ];

    public function init()
    {
        parent::init();

//        $this->app->booted(function () {
//            LockScreen::routes(__DIR__ . '/../routes/web.php');
//        });

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lock-screen');

        Admin::requireAssets(['@de-memory.lock-screen']);

        Admin::booting(function () {
            Admin::navbar(function (Navbar $navbar) {
                $navbar->right(LockScreen::link());
            });
        });
    }


}
