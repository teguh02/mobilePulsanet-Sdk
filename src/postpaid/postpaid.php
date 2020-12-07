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
     * To make inquiry gas negara
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

    /**
     * To make inquiry PDAM
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPDAM
     */
    public function inq_PDAM($pdam_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $pdam_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry PLN
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPLNPOSTPAID
     */
    public function inq_PLN($pln_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $pln_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry Tv Berlangganan
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTVBIG
     */
    public function inq_Tv($tv_berlangganan_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $tv_berlangganan_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry Telepon Pascabayar
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTeleponPascabayar
     */
    public function inq_TelpPasca($telepon_pasca_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $telepon_pasca_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry Internet
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryCBN
     */
    public function inq_Internet($internet_registered_participant_number, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $internet_registered_participant_number,
            'ref_id' => $order_id,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To make inquiry E Samsat
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryESAMSAT
     */
    public function inq_Esamsat($Esamsat_payment_code, $nomor_identitas, $code, $ref_id = null)
    {
        self::cekPostpaid();
        self::cekinquiry();
        $order_id = $ref_id ?? $order_id = time();
        $data = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'code' => $code,
            'hp' => $Esamsat_payment_code,
            'ref_id' => $order_id,
            'nomor_identitas' => $nomor_identitas,
            'sign' => signGenerator::generate($order_id)
        ];
        return httpRequest::postPostPaid($data,'/api/v1/bill/check/');
    }

    /**
     * To pay a inquiry by tr_id
     * https://developer.mobilepulsa.net/documentation#api-Payment
     */
    public function pay($tr_id)
    {
        self::cekPostpaid();
        self::cekinquiry();
        return httpRequest::postPostPaid([
            'commands' => 'pay-pasca',
            'username' => self::$username,
            'tr_id' => $tr_id,
            'sign' => signGenerator::generate($tr_id)
        ],'/api/v1/bill/check/');
    }

    /**
     * To download from postpaid pay transaction
     * https://developer.mobilepulsa.net/documentation#api-Download_receipt
     */
    public function downloadReceipt($tr_id)
    {
        self::cekPostpaid();
        $url = self::$baseurl_postpaid .'/api/v1/download/' . $tr_id;
        return header('Location: '. $url);
    }

    /**
     * To check a transaction status
     * https://developer.mobilepulsa.net/documentation#api-Check_Status_post
     */
    public function CheckStatusPostpaid($ref_id)
    {
        self::cekPostpaid();
        return httpRequest::postPostPaid([
            'commands' => 'checkstatus',
            'username' => self::$username,
            'ref_id' => $ref_id,
            'sign' => signGenerator::generate('cs')
        ],'/api/v1/bill/check/');
    }

    /**
     * To print all response code in postpaid
     * https://developer.mobilepulsa.net/documentation#api-Response_code_post
     */
    public function responseCodePostpaid(): array
    {
        self::cekPostpaid();
        $response_code = array(
            array('response_code' => '00', 'description' => 'PAYMENT / INQUIRY SUCCESS', 'transaction_status' => 'Success'),
            array('response_code' => '01', 'description' => 'INVOICE HAS BEEN PAID', 'transaction_status' => 'Failed'),
            array('response_code' => '02', 'description' => 'BILL UNPAID', 'transaction_status' => 'Failed'),
            array('response_code' => '03', 'description' => 'INVALID REF ID', 'transaction_status' => 'Failed'),
            array('response_code' => '04', 'description' => 'BILLING ID EXPIRED', 'transaction_status' => 'Failed'),
            array('response_code' => '05', 'description' => 'UNDEFINED ERROR', 'transaction_status' => 'Pending'),
            array('response_code' => '06', 'description' => 'INQUIRY ID NOT FOUND', 'transaction_status' => 'Failed'),
            array('response_code' => '07', 'description' => 'TRANSACTION FAILED', 'transaction_status' => 'Failed'),
            array('response_code' => '08', 'description' => 'BILLING ID BLOCKED', 'transaction_status' => 'Failed'),
            array('response_code' => '09', 'description' => 'INQUIRY FAILED', 'transaction_status' => 'Failed'),
            array('response_code' => '10', 'description' => 'BILL IS NOT AVAILABLE', 'transaction_status' => 'Failed'),
            array('response_code' => '11', 'description' => 'DUPLICATE REF ID', 'transaction_status' => 'Failed'),
            array('response_code' => '13', 'description' => 'CUSTOMER NUMBER BLOCKED', 'transaction_status' => 'Failed'),
            array('response_code' => '14', 'description' => 'INCORRECT DESTINATION NUMBER', 'transaction_status' => 'Failed'),
            array('response_code' => '15', 'description' => 'NUMBER THAT YOU ENTERED IS NOT SUPPORTED', 'transaction_status' => 'Failed'),
            array('response_code' => '16', 'description' => 'NUMBER DOESN\'T MATCH THE OPERATOR', 'transaction_status' => 'Failed'),
            array('response_code' => '17', 'description' => 'BALANCE NOT ENOUGH', 'transaction_status' => 'Failed'),
            array('response_code' => '20', 'description' => 'PRODUCT UNREGISTERED', 'transaction_status' => 'Failed'),
            array('response_code' => '30', 'description' => 'PAYMENT HAVE TO BE DONE VIA COUNTER / PDAM', 'transaction_status' => 'Failed'),
            array('response_code' => '31', 'description' => 'TRANSACTION REJECTED DUE TO EXCEEDING MAXIMAL TOTAL BILL ALLOWED', 'transaction_status' => 'Failed'),
            array('response_code' => '32', 'description' => 'TRANSACTION FAILED, PLEASE PAY BILL OF ALL PERIOD', 'transaction_status' => 'Failed'),
            array('response_code' => '33', 'description' => 'TRANSACTION CAN\'T BE PROCESS, PLEASE TRY AGAIN LATER', 'transaction_status' => 'Failed'),
            array('response_code' => '34', 'description' => 'BILL HAS BEEN PAID', 'transaction_status' => 'Failed'),
            array('response_code' => '35', 'description' => 'TRANSACTION REJECTED DUE TO ANOTHER UNPAID ARREAR', 'transaction_status' => 'Failed'),
            array('response_code' => '36', 'description' => 'EXCEEDING DUE DATE, PLEASE PAY IN THE COUNTER / PDAM', 'transaction_status' => 'Failed'),
            array('response_code' => '37', 'description' => 'PAYMENT FAILED', 'transaction_status' => 'Failed'),
            array('response_code' => '38', 'description' => 'PAYMENT FAILED, PLEASE DO ANOTHER REQUEST', 'transaction_status' => 'Failed'),
            array('response_code' => '39', 'description' => 'PENDING / TRANSACTION IN PROCESS', 'transaction_status' => 'Pending'),
            array('response_code' => '40', 'description' => 'TRANSACTION REJECTED DUE TO ALL OR ONE OF THE ARREAR/INVOICE HAS BEEN PAID', 'transaction_status' => 'Failed'),
            array('response_code' => '41', 'description' => 'CAN\'T BE PAID IN COUNTER, PLEASE PAY TO THE CORRESPONDING COMPANY', 'transaction_status' => 'Failed'),
            array('response_code' => '42', 'description' => 'PAYMENT REQUEST HAVEN\'T BEEN RECEIEVED', 'transaction_status' => 'Failed'),
            array('response_code' => '43', 'description' => 'DATE INTERVAL CANNOT MORE THAN 31 DAYS', 'transaction_status' => 'Failed'),
            array('response_code' => '91', 'description' => 'DATABASE CONNECTION ERROR', 'transaction_status' => 'Failed'),
            array('response_code' => '92', 'description' => 'GENERAL ERROR', 'transaction_status' => 'Failed'),
            array('response_code' => '93', 'description' => 'INVALID AMOUNT', 'transaction_status' => 'Failed'),
            array('response_code' => '94', 'description' => 'SERVICE HAS EXPIRED', 'transaction_status' => 'Failed'),
            array('response_code' => '100', 'description' => 'INVALID SIGNATURE', 'transaction_status' => 'Failed'),
            array('response_code' => '101', 'description' => 'INVALID COMMAND', 'transaction_status' => 'Failed'),
            array('response_code' => '102', 'description' => 'INVALID IP ADDRESS', 'transaction_status' => 'Failed'),
            array('response_code' => '103', 'description' => 'TIMEOUT', 'transaction_status' => 'Failed'),
            array('response_code' => '105', 'description' => 'MISC ERROR / BILLER SYSTEM ERROR', 'transaction_status' => 'Failed'),
            array('response_code' => '106', 'description' => 'PRODUCT IS TEMPORARILY OUT OF SERVICE', 'transaction_status' => 'Failed'),
            array('response_code' => '107', 'description' => 'XML FORMAT ERROR', 'transaction_status' => 'Failed'),
            array('response_code' => '108', 'description' => 'SORRY, YOUR ID CAN\'T BE USED FOR THIS PRODUCT TRANSACTION', 'transaction_status' => 'Failed'),
            array('response_code' => '109', 'description' => 'SYSTEM CUT OFF', 'transaction_status' => 'Failed'),
            array('response_code' => '110', 'description' => 'SYSTEM UNDER MAINTENANCE', 'transaction_status' => 'Failed'),
            array('response_code' => '117', 'description' => 'PAGE NOT FOUND', 'transaction_status' => 'Failed'),
            array('response_code' => '201', 'description' => 'UNDEFINED RESPONSE CODE', 'transaction_status' => 'Pending'),
        );

        return ['data' => $response_code, 'env' => self::$env];
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