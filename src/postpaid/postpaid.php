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
    protected static $inquiry_status = false;

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

    /**
     * To start a inquiry chain method
     * inquiry = membuat tagihan pada pascabayar yang akan dibayar menggunakan fungsi payment
     */
    public function inquiry()
    {
        self::cekPostpaid();
        self::$inquiry_status = true;
        return $this;   
    }

    /**
     * To make inquiry bpjs
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryBpjs
     */
    public function inq_BPJS($bpjs_participant_number, $code, $month = 1, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $bpjs_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id),
            'month' => $month
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make gas negara
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryGasNegara
     */
    public function inq_GasNegara($gas_negara_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $gas_negara_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry MULTIFINANCE (NON FNADIRA)
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryFNMEGA
     */
    public function inq_Multifinance_Non_FNADIRA($contract_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $contract_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    protected static function cekPostpaid()
    {
        if(self::$postpaid_status == false) {
            throw new Exception("Please call postpaid() method first");
        }

        return true;
    }

    protected static function cekinquiry()
    {
        if(self::$inquiry_status == false) {
            throw new Exception("Please call inquiry() method first");
        }

        return true;
    }

}