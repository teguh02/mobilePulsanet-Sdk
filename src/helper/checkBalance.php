<?php

namespace ofi\mobilepulsa\helper;

use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

trait checkBalance {

    /**
     * To check balance
     */
    public function checkBalance()
    {
        $array = [
            'commands' => 'balance',
            'username' => self::$username,
            'sign' => signGenerator::generate('bl'),
        ];

        $data =  httpRequest::post($array, '/v1/legacy/index');
        return $data;
    }

}