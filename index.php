<?php

// import autoload
include __DIR__ . '/vendor/autoload.php';

// import package mobilepulsa
use ofi\mobilepulsa\mobilepulsa;

/**
 * Import class class contoh
 */
include __DIR__ . '/example/checkBalance.php';
include __DIR__ . '/example/prepaid.php';

echo "<pre>";

// untuk mengecek saldo
$checkBalance = new checkBalance;

// print_r($checkBalance->cekSaldo());

// @ prepaid section
$prepaid = new prepaid;

// print_r($prepaid->daftarHarga());
// print_r($prepaid->cekIdPemain());
// print_r($prepaid->daftarServerGame());
// print_r($prepaid->topUpPulsa());
// print_r($prepaid->topUpVoucherGame());
// print_r($prepaid->autoDetectOperatorPriceList());

// deteksi jenis operator nomor hp
print_r(mobilepulsa::deteksiOperatorNoHp('08986642927'));

echo "</pre>";