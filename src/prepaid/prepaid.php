<?php

namespace ofi\mobilepulsa\prepaid;
use Exception;
use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

trait prepaid {

    protected static $prepaid_status = false;

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

    protected static function cekPrepaid()
    {
        if(self::$prepaid_status == false) {
            throw new Exception("Please call prepaid() method first");
        }

        return true;
    }

}