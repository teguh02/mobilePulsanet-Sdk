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
        try {
            $json = json_encode($arrayData);
            $url =  self::$baseurl . $url;

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = json_decode(curl_exec($ch), 1);
            curl_close($ch);

            $data['env'] = self::$env;
            return $data;
        } catch (\Throwable $th) {
            throw new Exception($th);
        }
    }

}