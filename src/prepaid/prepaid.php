<?php

namespace ofi\mobilepulsa\prepaid;
use Exception;
use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

trait prepaid {

    protected static $prepaid_status = false;

    /**
     * To start prepaid chain method
     */
    public function prepaid()
    {
        self::$prepaid_status = true;
        return $this;
    }

    /**
     * Prepaid pricelist
     * https://developer.mobilepulsa.net/documentation#api-Price_List
     */
    public function pricelist(String $type, String $operator)
    {
        self::cekPrepaid();
        return httpRequest::post([
            'commands' => 'pricelist',
            'username' => self::$username,
            'sign' => signGenerator::generate('pl'),
            'status' => 'all'
        ],'/v1/legacy/index/'. $type .'/' . $operator);

    }

    /**
     * Check game id
     * https://developer.mobilepulsa.net/documentation#api-Check_Game_ID
     */
    public function checkGameId($gameId, $gameCode)
    {
        self::cekPrepaid();
        return httpRequest::post([
            "commands"   => "check-game-id",
            "username"   => self::$username,
            "game_code"  => $gameCode,
            "hp"         => $gameId,
            'sign' => signGenerator::generate($gameCode)
        ], '/v1/legacy/index');
    }

    /**
     * Check server list from a game
     * https://developer.mobilepulsa.net/documentation#api-Game_Server_List
     */
    public function gameServerList($gameCode)   
    {
        self::cekPrepaid();
        return httpRequest::post([
            "commands"   => "game-server-list",
            "username"   => self::$username,
            "game_code"  => $gameCode,
            'sign' => signGenerator::generate($gameCode)
        ], '/v1/legacy/index');
    }

    /**
     * Top up request
     * https://developer.mobilepulsa.net/documentation#api-Top_Up_Request
     */
    public function topUpRequest($pulsa_code, $hp, $ref_id)
    {
        self::cekPrepaid();
        return httpRequest::post([
            "commands"   => "topup",
            "ref_id" => $ref_id,
            "username"   => self::$username,
            "hp" => $hp,
            "pulsa_code"  => $pulsa_code,
            'sign' => signGenerator::generate($ref_id)
        ], '/v1/legacy/index');
    }

    /**
     * Check transaction status
     * https://developer.mobilepulsa.net/documentation#api-Inquiry_Pre_Paid
     */
    public function checkStatus($ref_id)
    {
        self::cekPrepaid();
        return httpRequest::post([
            "commands"   => "inquiry",
            "ref_id" => $ref_id,
            "username"   => self::$username,
            'sign' => signGenerator::generate($ref_id)
        ], '/v1/legacy/index');
    }

    /**
     * Auto Detect operator pricelist
     * https://developer.mobilepulsa.net/documentation#api-Auto_Detect_Operator
     */
    public function autoDetectOperator()
    {
        self::cekPrepaid();
        return [
            'data' => [
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa10000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 10000,
                    'pulsa_code' => 'pulsa10000',
                    'pulsa_price' =>	10000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa100000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 100000,
                    'pulsa_code' => 'pulsa100000',
                    'pulsa_price' =>	100000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa1000000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 1000000,
                    'pulsa_code' => 'pulsa1000000',
                    'pulsa_price' =>	1000000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa150000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 150000,
                    'pulsa_code' => 'pulsa150000',
                    'pulsa_price' =>	150000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa20000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 20000,
                    'pulsa_code' => 'pulsa20000',
                    'pulsa_price' =>	20000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa200000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 200000,
                    'pulsa_code' => 'pulsa200000',
                    'pulsa_price' =>	200000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa25000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 25000,
                    'pulsa_code' => 'pulsa25000',
                    'pulsa_price' =>	25000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa30000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 30000,
                    'pulsa_code' => 'pulsa30000',
                    'pulsa_price' =>	30000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa300000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 300000,
                    'pulsa_code' => 'pulsa300000',
                    'pulsa_price' =>	300000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa5000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 5000,
                    'pulsa_code' => 'pulsa5000',
                    'pulsa_price' =>	5000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa50000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 50000,
                    'pulsa_code' => 'pulsa50000',
                    'pulsa_price' =>	50000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],
                
                [
                    'status' => 'active',
                    'icon_url' => null,
                    'pulsa_op' => 'pulsa500000',
                    'pulsa_details' => '-',
                    'masaaktif' => '0',
                    'pulsa_nominal' => 500000,
                    'pulsa_code' => 'pulsa500000',
                    'pulsa_price' =>	500000,
                    'pulsa_type' => 'pulsa_auto_detect_oprator'
                ],                                     
            ]
        ];
    }

    /**
     * Use this method to check whether PLN Prepaid 
     * Subscriber is valid or invalid
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPlnToken
     */
    public function checkPlnSubscriber($subscriber_id)
    {
        self::cekPrepaid();
        return httpRequest::post([
            "commands"   => "inquiry_pln",
            "username"   => self::$username,
            'hp'         => $subscriber_id,
            'sign' => signGenerator::generate($subscriber_id)
        ], '/v1/legacy/index');
    }

    /**
     * To print prepaid response code
     * https://developer.mobilepulsa.net/documentation#api-Response_code_pre
     */
    public function responseCode()
    {
        self::cekPrepaid();
        return array (
            'data' => 
                array (
                  0 => array ('code' => '00',  'description' => 'SUCCESS',  'status' => 'Success',),
                  1 => array ('code' => '06',  'description' => 'TRANSACTION NOT FOUND',  'status' => 'Failed',),
                  2 => array ('code' => '07',  'description' => 'FAILED',  'status' => 'Failed',),
                  3 => array ('code' => '13',  'description' => 'CUSTOMER NUMBER BLOCKED',  'status' => 'Failed',),
                  4 => array ('code' => '14',  'description' => 'INCORRECT DESTINATION NUMBER',  'status' => 'Failed',),
                  5 => array ('code' => '16',  'description' => 'NUMBER NOT MATCH WITH OPERATOR',  'status' => 'Failed',),
                  6 => array ('code' => '17',  'description' => 'INSUFFICIENT DEPOSIT',  'status' => 'Failed',),
                  7 => array ('code' => '20',  'description' => 'CODE NOT FOUND',  'status' => 'Failed',),
                  8 => array ('code' => '39',  'description' => 'PROCESS',  'status' => 'Pending',),
                  9 => array ('code' => '43',  'description' => 'DATE INTERVAL CANNOT MORE THAN 31 DAYS',  'status' => 'Failed',),
                  10 => array ('code' => '102',  'description' => 'INVALID IP ADDRESS',  'status' => 'Failed',),
                  11 => array ('code' => '106',  'description' => 'PRODUCT IS TEMPORARILY OUT OF SERVICE',  'status' => 'Failed',),
                  12 => array ('code' => '107',  'description' => 'ERROR IN XML FORMAT',  'status' => 'Failed',),
                  13 => array ('code' => '117',  'description' => 'PAGE NOT FOUND',  'status' => 'Failed',),
                  14 => array ('code' => '201',  'description' => 'UNDEFINED RESPONSE CODE',  'status' => 'Pending',),
                  15 => array ('code' => '202',  'description' => 'MAXIMUM 1 NUMBER 1 TIME IN 1 DAY',  'status' => 'Failed',),
                  16 => array ('code' => '203',  'description' => 'NUMBER IS TOO LONG',  'status' => 'Failed',),
                  17 => array ('code' => '204',  'description' => 'WRONG AUTHENTICATION',  'status' => 'Failed',),
                  18 => array ('code' => '205',  'description' => 'WRONG COMMAND',  'status' => 'Failed',),
                  19 => array ('code' => '206',  'description' => 'THIS DESTINATION NUMBER HAS BEEN BLOCKED',  'status' => 'Failed',),
                  20 => array ('code' => '207',  'description' => 'MAXIMUM 1 NUMBER WITH ANY CODE 1 TIME IN 1 DAY',  'status' => 'Failed',),
                ),

            'env' => $data['env'] = self::$env,
        );
    }

    protected static function cekPrepaid()
    {
        if(self::$prepaid_status == false) {
            throw new Exception("Please call prepaid() method first");
        }

        return true;
    }

}