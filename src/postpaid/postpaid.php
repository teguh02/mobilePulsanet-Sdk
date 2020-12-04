<?php

namespace ofi\mobilepulsa\postpaid;

use Exception;
use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

/**
 * Postpaid
 * https://developer.mobilepulsa.net/documentation#api-post_paid
 */

trait postpaid {
    
    protected static $postpaid_status = false;

    /**
     * To start postpaid chain method
     */
    public function postpaid()
    {
        self::$postpaid_status = true;
        return $this;
    }

    /**
     * Price list pascabayar / postpaid
     * https://developer.mobilepulsa.net/documentation#api-Price_List_post
     * https://developer.mobilepulsa.net/documentation#pascaType
     */
    public function pricelistPasca($type, $province_for_pdam = null)
    {
        self::cekPostpaid();
        // request array untuk pdam
        if(!empty($province_for_pdam)) {
            $request = [
                'commands' => 'pricelist-pasca',
                'username' => self::$username,
                'sign' => signGenerator::generate('pl'),
                'status' => 'all',
                'province' => $province_for_pdam
            ];
        } else {
            $request = [
                'commands' => 'pricelist-pasca',
                'username' => self::$username,
                'sign' => signGenerator::generate('pl'),
                'status' => 'all',
            ];
        }

        return httpRequest::postPostPaid($request,'/api/v1/bill/check/' . $type);
    }

    protected static function cekPostpaid()
    {
        if(self::$postpaid_status == false) {
            throw new Exception("Please call postpaid() method first");
        }

        return true;
    }

}