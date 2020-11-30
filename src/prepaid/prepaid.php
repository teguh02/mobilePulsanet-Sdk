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

    protected static function cekPrepaid()
    {
        if(self::$prepaid_status == false) {
            throw new Exception("Please call prepaid() method first");
        }

        return true;
    }

}