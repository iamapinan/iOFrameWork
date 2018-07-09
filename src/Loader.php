<?php
namespace IO\Framework;

class Loader {

    protected $fnc;
    protected $cont;

    function __construct() {
        /**
         * Load .env data to PHP Environment
         */
        if(is_file(BASE_PATH . '.env')) {
            $dotenv = new \Dotenv\Dotenv(BASE_PATH);
            $dotenv->load();
        }

        /**
         * Check environment.
         */
        $this->environment();
        
        /**
         * Load constant and utility
         */
        require ( BASE_PATH . 'app/configs/Constants.php' );
        require ( 'Utility/StaticFunctions.php' );

        $this->fncs = $fnc;
        $this->cont = $const;
    }
    
    /**
     * Check environment mode production or development
     * production: any error will disappear best for production.
     * development: any error will debug to user browser best for local develoment.
     */
    public function environment() {
        if( getenv('environment') == 'development' ) {
            /**
             * Show errors
             */
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            /**
             * Error handle
             */
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();

        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
        }
    }

    /**
     * Register function to alias.
     */
    public function registerFunction() {
        
        foreach ($this->fncs as $fn => $fv) {
            register_func_alias($fn, $fv);
        }
    }

    /**
     * Route initial
     */
    public function Route() {
        $app            = \System\App::instance();
        $app->request   = \System\Request::instance();
        $app->route     = \System\Route::instance($app->request);
        $route          = $app->route;

        /**
         * Load route config.
         */
        require (BASE_PATH . 'routes/api.php');
        require (BASE_PATH . 'routes/web.php');

        $route->end();
    }
}
