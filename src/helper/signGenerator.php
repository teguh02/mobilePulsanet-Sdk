<?php

namespace ofi\mobilepulsa\helper;

use ofi\mobilepulsa\mobilepulsa;

class signGenerator extends mobilepulsa {

    /**
     * To generate sign
     */
    public static function generate($command): String
    {
        return md5(self::$username.self::$apikey.$command);
    }

}