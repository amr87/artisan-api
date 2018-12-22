<?php namespace App\Modules;
class ServiceProvider extends  \Illuminate\Support\ServiceProvider
{

    public function boot()
    {

        $modules = config("module.modules");
        foreach ($modules as $module) {
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }
            if(is_dir(__DIR__.'/'.$module.'/views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/views', $module);
            }
        }
    }

    public function register(){}

}
