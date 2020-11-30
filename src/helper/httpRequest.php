<?php 

namespace ofi\mobilepulsa\helper;
use ofi\mobilepulsa\mobilepulsa;
use Exception;

class httpRequest extends mobilepulsa {

    /**
     * To help post data to server
     */
    public static function post($arrayData, $url)
    {
        $logs_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
        if(!file_exists($logs_path)) {
            mkdir($logs_path);
        }

        try {
            $json = json_encode($arrayData);
            $url =  self::$baseurl . $url;

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $fp = fopen($logs_path . DIRECTORY_SEPARATOR . 'errorlog.txt', 'a');
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_STDERR, $fp);
            $data = json_decode(curl_exec($ch), 1);
            curl_close($ch);
            fwrite($fp, "##############################################\n");

            $data['env'] = self::$env;
            return $data;
        } catch (\Throwable $th) {
            throw new Exception($th);
        }
    }
}