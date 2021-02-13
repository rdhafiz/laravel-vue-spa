<?php

namespace Rdhafiz\LaravelVueSpa\Commands;

use Illuminate\Console\Command;
use Rdhafiz\Console\ConsoleCommand;

class LaravelVueSpa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LaravelVueSpa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Vue SPA  - A php library to setup a Laravel Vue SPA project environment by couple of small commands';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $webRoute = file_get_contents(base_path().'/routes/web.php');
        $webRoute = str_replace("'/'", "'/app'", $webRoute);
        $webRoute = str_replace("Route::get('/{any}', 'LaravelVueSpaController@index')->where('any', '.*')->name('lvs.home');", "", $webRoute);
        $webRoute .= PHP_EOL.PHP_EOL;
        $webRoute .= "Route::get('/{any}', 'LaravelVueSpaController@index')->where('any', '.*')->name('lvs.home');";
        file_put_contents(base_path().'/routes/web.php', $webRoute);

        $scssFolder = base_path().'/resources/sass';
        if(!file_exists($scssFolder)){
            mkdir($scssFolder, 0777);
        }
        file_put_contents($scssFolder.'/app.scss', "");


        $jsFolder = base_path().'/resources/js';
        if(!file_exists($jsFolder)){
            mkdir($jsFolder, 0777);
        }
        $appJs = file_get_contents(__DIR__.'/../Helpers/app.js.txt');
        file_put_contents($jsFolder.'/app.js', $appJs);

        if(!file_exists($jsFolder.'/Router')){
            mkdir($jsFolder.'/Router', 0777);
        }
        $routerJs = file_get_contents(__DIR__.'/../Helpers/router.js.txt');
        file_put_contents($jsFolder.'/Router/router.js', $routerJs);


        if(!file_exists($jsFolder.'/Store')){
            mkdir($jsFolder.'/Store', 0777);
        }
        $storeJs = file_get_contents(__DIR__.'/../Helpers/store.js.txt');
        file_put_contents($jsFolder.'/Store/store.js', $storeJs);


        if(!file_exists($jsFolder.'/Pages')){
            mkdir($jsFolder.'/Pages', 0777);
        }
        $pageJs = file_get_contents(__DIR__.'/../Helpers/Pages/App.vue.txt');
        file_put_contents($jsFolder.'/App.vue', $pageJs);
        $pageJs = file_get_contents(__DIR__.'/../Helpers/Pages/Home.vue.txt');
        file_put_contents($jsFolder.'/Pages/Home.vue', $pageJs);
        $pageJs = file_get_contents(__DIR__.'/../Helpers/Pages/About.vue.txt');
        file_put_contents($jsFolder.'/Pages/About.vue', $pageJs);
        $pageJs = file_get_contents(__DIR__.'/../Helpers/Pages/Contact.vue.txt');
        file_put_contents($jsFolder.'/Pages/Contact.vue', $pageJs);

        $webpackJs = base_path().'/webpack.mix.js';
        if(!file_exists($webpackJs)){
            file_put_contents($webpackJs, "");
        }
        $mixJs = file_get_contents(__DIR__.'/../Helpers/webpack.mix.js.txt');
        file_put_contents($webpackJs, $mixJs);


        $spaController = file_get_contents(__DIR__.'/../Helpers/LaravelVueSpaController.php.txt');
        file_put_contents(base_path().'/app/Http/Controllers/LaravelVueSpaController.php', $spaController);


        if(!file_exists(base_path().'/resources/views/Lvs')){
            mkdir(base_path().'/resources/views/Lvs', 0777);
        }
        $spaView = file_get_contents(__DIR__.'/../Helpers/index.blade.php.txt');
        file_put_contents(base_path().'/resources/views/Lvs/index.blade.php', $spaView);



    }
}
