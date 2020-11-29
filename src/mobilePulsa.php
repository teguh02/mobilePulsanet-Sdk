<?php 

namespace ofi\mobilepulsa;

require dirname(__DIR__) . '/vendor/autoload.php';
use ofi\mobilepulsa\helper\checkBalance;
use ofi\mobilepulsa\prepaid\prepaid;

class mobilepulsa {

    protected static $env;
    protected static $baseurl;
    protected static $apikey;
    protected static $username;

    use checkBalance, prepaid;

    public function __construct(String $username, String $apikey, String $env = 'development')
    {
        $this->pretyErrorPage();

        // username yang terdaftar di https://developer.mobilepulsa.net/
        self::$username = $username;

        // mobile pulsa api key
        self::$apikey = $apikey;

        // app environment
        self::$env = $env;

        if($env != 'development' && $env == 'production') {
            self::$baseurl = 'https://api.mobilepulsa.net';
        } else {
            self::$baseurl = 'https://testprepaid.mobilepulsa.net';
        }
        
    }

    protected function pretyErrorPage()
    {
        $whoops = new \Whoops\Run;
        // $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
} 