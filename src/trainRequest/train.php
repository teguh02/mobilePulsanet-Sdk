<?php

namespace ofi\mobilepulsa\trainRequest;
use Exception;
use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

/**
 * Kereta API Section
 * https://developer.mobilepulsa.net/documentation#kai-section
 */

trait train {

    protected static $train_status = false;

    /**
     * To start train chain method
     */

    public function train()
    {
        self::$train_status = true;
        return $this;
    }

    /**
     * To print all train price list
     */
    public function stationList()
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'station-list',
            'username' => self::$username,
            'sign' => md5('IsYk1?2P3De/')
        ], '/api/v1/tiketv2');
    }

    protected static function cekTrain()
    {
        if(self::$train_status == false) {
            throw new Exception("Please call train() method first");
        }

        return true;
    }

}