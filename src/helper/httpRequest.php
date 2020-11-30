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
        date_default_timezone_set('Asia/Jakarta');

        try {

            $logs_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
            if(!file_exists($logs_path)) {
                mkdir($logs_path);
            }

            $json = json_encode($arrayData);
            $url =  self::$baseurl . $url;

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $fp = fopen($logs_path . DIRECTORY_SEPARATOR . 'errorlog.txt', 'a');
            fwrite($fp, "\n=========== ". date('d/m/Y H:i:s') ." ============\n");
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_STDERR, $fp);
            $data = json_decode(curl_exec($ch), 1);

            if(curl_errno($ch)) {   
                fwrite($fp, curl_error($ch) . ' - at ' . date('d - m - Y'));
                throw new Exception(curl_error($ch));
            }

            curl_close($ch);

            $data['env'] = self::$env;
            return $data;

        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}