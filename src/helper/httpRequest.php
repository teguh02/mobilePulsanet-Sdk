<?php 

namespace ofi\mobilepulsa\helper;
use ofi\mobilepulsa\mobilepulsa;
use Exception;

class httpRequest extends mobilepulsa {

    /**
     * To help post data to server (only for prepaid class)
     */
    public static function post($arrayData, $url)
    {
        date_default_timezone_set('Asia/Jakarta');

        try {

            $logs_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
            if(!file_exists($logs_path)) {
                mkdir($logs_path);
            }

            $gitignore = $logs_path . DIRECTORY_SEPARATOR . '.gitignore';
            if(!file_exists($gitignore)) {
                $gitignore_fp = fopen($gitignore, 'a');
                fwrite($gitignore_fp, "*.txt");
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
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            $data = json_decode(curl_exec($ch), 1);

            if(curl_errno($ch)) {   
                $fp = fopen($logs_path . DIRECTORY_SEPARATOR . 'errorlog.txt', 'a');
                fwrite($fp, "\n=========== Error At ". date('d/m/Y H:i:s') ." ============\n");
                fwrite($fp, "> Server Status : \n");
                curl_setopt($ch, CURLOPT_STDERR, $fp);
                fwrite($fp, "> CURL Status : \n");
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

    /**
     * To help post data to server (only for postpaid class)
     */
    public static function postPostPaid($arrayData, $url)
    {
        date_default_timezone_set('Asia/Jakarta');

        try {

            $logs_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
            if(!file_exists($logs_path)) {
                mkdir($logs_path);
            }

            $gitignore = $logs_path . DIRECTORY_SEPARATOR . '.gitignore';
            if(!file_exists($gitignore)) {
                $gitignore_fp = fopen($gitignore, 'a');
                fwrite($gitignore_fp, "*.txt");
            }

            $json = json_encode($arrayData);
            $url =  self::$baseurl_postpaid . $url;

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            $data = json_decode(curl_exec($ch), 1);

            if(curl_errno($ch)) {   
                $fp = fopen($logs_path . DIRECTORY_SEPARATOR . 'errorlog.txt', 'a');
                fwrite($fp, "\n=========== Error At ". date('d/m/Y H:i:s') ." ============\n");
                fwrite($fp, "> Server Status : \n");
                curl_setopt($ch, CURLOPT_STDERR, $fp);
                fwrite($fp, "> CURL Status : \n");
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

    /**
     * To help post data to server (only for train class)
     */
    public static function postTrain($arrayData, $url)
    {
        date_default_timezone_set('Asia/Jakarta');

        try {

            $logs_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
            if(!file_exists($logs_path)) {
                mkdir($logs_path);
            }

            $gitignore = $logs_path . DIRECTORY_SEPARATOR . '.gitignore';
            if(!file_exists($gitignore)) {
                $gitignore_fp = fopen($gitignore, 'a');
                fwrite($gitignore_fp, "*.txt");
            }

            $json = json_encode($arrayData);
            $url =  self::$baseurl_train . $url;

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            $data = json_decode(curl_exec($ch), 1);

            if(curl_errno($ch)) {   
                $fp = fopen($logs_path . DIRECTORY_SEPARATOR . 'errorlog.txt', 'a');
                fwrite($fp, "\n=========== Error At ". date('d/m/Y H:i:s') ." ============\n");
                fwrite($fp, "> Server Status : \n");
                curl_setopt($ch, CURLOPT_STDERR, $fp);
                fwrite($fp, "> CURL Status : \n");
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