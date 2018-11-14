<?php

function convert_btc($a)
	{

	//$url ="https://api.blockchain.info/stats";
	$url ="https://apiv2.bitcoinaverage.com/convert/global?from=USD&to=BTC&amount=".$a;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$amount = json_decode($output, true);
	//print_r($amount);
	$amt= number_format((float)$amount['price'], 8, '.', ''); 
return  $amt;	

	}
echo 	convert_btc(2);
?>