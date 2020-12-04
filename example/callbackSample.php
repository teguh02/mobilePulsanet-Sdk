<?php

use ofi\mobilepulsa\mobilepulsa;

/**
 * Refrensi 
 * https://developer.mobilepulsa.net/documentation#api-callback_url
 */

class callbackSample {

    /**
    * Contoh testing callback, disini developer sdk ini menggunakan
    * postman seperti pada gambar ini, untuk melempar pesan callback
    * dan akan ditangkap oleh sdk ini
    * 
    * Contoh :
    * > https://freeimage.host/i/FkGG6X
    * > setelah copy json, masukan json kedalam postman
    * > https://freeimage.host/i/FkEsEX    
    */

    protected $client;

    public function __construct()
    {
        $username = '089655541804';
        $apikey = '1195eaba63dc90ee';
        $this->client = new mobilepulsa($username, $apikey);
        return $this->client;
    }

    /**
     * Tangkap pesan callback yang datang dari server mobilepulsa
     * dan cetak hasilnya
     */
    public function tangkapCallback()
    {
        return $this->client 
                    -> callback() 
                    -> catch();
    }

    /**
     * Tangkap pesan callback yang datang dari server mobilepulsa
     * dan simpan menjadi file txt didalam folder logCallback
     */
    public function simpanSebagaiLogTxt()
    {
        // simpan kedalam foler logCallback (yang ada didalam folder example ini)
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR .  'logCallback';
        // dan panggil method saveAsLog() untuk menyimpannya
        return $this->client 
                    -> callback()
                    -> saveAsLog($path);
    }

}