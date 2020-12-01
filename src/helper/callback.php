<?php

namespace ofi\mobilepulsa\helper;

/**
 * Refrensi
 * https://developer.mobilepulsa.net/documentation#api-callback_url
 * https://developer.mobilepulsa.net/documentation#api-Sample_Code
 */

use Exception;

trait callback {

    // define callback chain method to false
    protected static $callback_status = false;

    // define callback result to empty array
    protected static $callback_result = [];

    /**
     * To start all callback chain method
     */
    public function callback()
    {
        self::$callback_status = true;
        self::$callback_result = file_get_contents('php://input');
        return $this;
    }

    /**
     * To catch all callback response from mobilepulsa server
     */
    public function catch()
    {
        if(!self::$callback_status) {
            throw new Exception("Please call callback() method first before you can call catch() method");
        }

        return $this->result();
    }

    /**
     * To save all callback response as txt log
     */
    public function saveAsLog($logs_path)
    {
        if(self::$callback_result) {
            $filename = $logs_path . DIRECTORY_SEPARATOR . 'callbackLog.txt';

            if(!file_exists(dirname($filename))) {
                mkdir(dirname($filename));
            }   

            // create .gitignore file (jika file belum ada)
            $gitignore = $logs_path . DIRECTORY_SEPARATOR . '.gitignore';
            if(!file_exists($gitignore)) {
                $gitignore_fp = fopen($gitignore, 'a');
                fwrite($gitignore_fp, "*.txt");
            }

            $fp = fopen($filename, 'a');

            foreach ($this->result() as $key => $value) {
                fwrite($fp, "> ". $key ." :  ". $value ." \n");
            }

            fwrite($fp, "\n");
            return true;
        } else {
            return false;
        }
    }

    /**
     * Catch all result
     */
    private function result()
    {
        $result = json_decode(self::$callback_result, 1);
        $hasil = $result['data'];
        
        if(empty(self::$callback_result)) {
            $hasil['catched_status'] = 'no callback catched from server';
        } else {
            $hasil['catched_status'] = 'catched';
            $hasil['catched_at'] = date('d/m/Y H:i:s');
        }

        return $hasil;
    }
}