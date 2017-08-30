#!/usr/local/bin/php

<?php

	$ch1 = curl_init();
	curl_setopt_array($ch1, array(
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://yobit.net/api/3/ticker/hodl_btc',
    	CURLOPT_USERAGENT => 'HodlCoin Miner'
	));

	$resp1 = json_decode(curl_exec($ch1));
	
	curl_close($ch1);

	$ch2 = curl_init();
	curl_setopt_array($ch2, array(
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://yobit.net/api/3/ticker/btc_usd',
    	CURLOPT_USERAGENT => 'HodlCoin Miner'
	));
	
	$resp2 = json_decode(curl_exec($ch2));

	curl_close($ch2);

	$ch3 = curl_init();
	curl_setopt_array($ch3, array(
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://chainz.cryptoid.info/erc/api.dws?q=nethashps',
    	CURLOPT_USERAGENT => 'HodlCoin Miner'
	));
	
	$resp3 = json_decode(curl_exec($ch3));

	curl_close($ch3);

	$ch4 = curl_init();
	curl_setopt_array($ch4, array(
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://chainz.cryptoid.info/erc/api.dws?q=getblockcount',
    	CURLOPT_USERAGENT => 'HodlCoin Miner'
	));
	
	$resp4 = json_decode(curl_exec($ch4));

	curl_close($ch4);

	$exchangeHODLBTC = $resp1->hodl_btc->last;
	$exchangeBTCUSD = $resp2->btc_usd->last;

	$netHashRate = $resp3->data->networkhashps;
	$lastBlock = $resp3->data->blocks;


	//$exchangeRate = $exchangeHODLBTC * $exchangeBTCUSD;


	$file = dirname(__FILE__) . '/hodldata.js';
	$data = 'var hodlData = {"netHashRate":'. $netHashRate . ',"exchangeHODLBTC":' . number_format($exchangeHODLBTC, 8) . ',"exchangeBTCUSD":'. $exchangeBTCUSD . ',"lastBlock":'. $lastBlock . ',"reward":28050,"updated":' . time() .'};';
	file_put_contents($file, $data, LOCK_EX);
?>
