<?php 

namespace ofi\mobilepulsa;

require dirname(__DIR__) . '/vendor/autoload.php';
use ofi\mobilepulsa\helper\checkBalance;
use ofi\mobilepulsa\prepaid\prepaid;
use ofi\deteksinohpindonesia\Client as deteksinohpindonesia;
use ofi\mobilepulsa\helper\callback;
use ofi\mobilepulsa\postpaid\postpaid;

class mobilepulsa {

    protected static $env;
    protected static $baseurl;
    protected static $baseurl_postpaid;
    protected static $apikey;
    protected static $username;

    use checkBalance, prepaid, callback, postpaid;

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
            self::$baseurl_postpaid = "https://mobilepulsa.net";
        } else {
            self::$baseurl = 'https://testprepaid.mobilepulsa.net';
            self::$baseurl_postpaid = "https://testpostpaid.mobilepulsa.net";
        }

        date_default_timezone_set('Asia/Jakarta');
        
    }

    protected function pretyErrorPage()
    {
        $whoops = new \Whoops\Run;
        // $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }

    /**
     * Deteksi jenis nomor hp
     */
    public static function deteksiOperatorNoHp($noHp)
    {
        $deteksi = new deteksinohpindonesia;
        return [
            'data' => $deteksi->detect($noHp)
        ];
    }
} 