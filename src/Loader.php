<?php
namespace iO\Framework;

require ( BASE_PATH . 'app/Constants.php' );
require ( BASE_PATH . 'app/Functions.php' );

class Loader {

    protected $fnc;
    protected $cont;

    function __construct() {
        global $fnc, $const;
        /**
         * Load .env data to PHP Environment
         */
        if(is_file(BASE_DIR . '.env')) {
            $dotenv = new Dotenv\Dotenv(BASE_PATH);
            $dotenv->load();
        }

        /**
         * Check environment.
         */
        $this->environment();

        $this->fnc = $fnc;
        $this->cont = $cont;
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
        foreach ($this->fnc as $fn => $fv) {
            register_func_alias($fn, $fv);
        }
    }

    /**
     * Route initial
     */
    public function Route() {
        $app            = System\App::instance();
        $app->request   = System\Request::instance();
        $app->route     = System\Route::instance($app->request);
        $route          = $app->route;

        /**
         * Load route config.
         */
        require (BASE_PATH . 'routes/api.php');
        require (BASE_PATH . 'routes/web.php');

        $route->end();
    }
}
