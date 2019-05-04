<?php

require_once "restclient.php";


class MyRest extends CApplicationComponent
{
	
	public $id = '';
	public $secretkey = '';
	public $baseurl = '';
	public $baseurl_apigateway = '';
	public $baseurlVClaim = '';
	public $baseurlAplicare = '';

	

	public static function getListDosenJadwal($params){
		$host = Yii::app()->rest->baseurl_apigateway;

		$url = $host."/d/jadwal";

		$hasil = null;

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/json; charset=utf-8'
		];
		$result = $api->get($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			print_r($e->getMessage());
			exit;
			// throw new RestClientException;
			$hasil = null;
		}


		
		return $hasil;
	}

	
	public static function getHeaderJson()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurl;

		date_default_timezone_set('UTC');
		$tStamp= strval(time()-strtotime('1970-01-01 00:00:00'));
		// Computes the signature by hashing the salt with the secret key as the key
		$signature= hash_hmac('sha256', $data."&".$tStamp, $key, true);
		// base64 encode…
		$encodedSignature= base64_encode($signature);
		

		return array(
			'x-cons-id' => $data,
			'x-timestamp' => $tStamp,
			'x-signature' => $encodedSignature,
			'Content-Type' => 'application/json; charset=utf-8'
		);
	}

	public static function getHeader()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurl;

		date_default_timezone_set('UTC');
		$tStamp= strval(time()-strtotime('1970-01-01 00:00:00'));
		// Computes the signature by hashing the salt with the secret key as the key
		$signature= hash_hmac('sha256', $data."&".$tStamp, $key, true);
		// base64 encode…
		$encodedSignature= base64_encode($signature);
		

		return array(
			'x-cons-id' => $data,
			'x-timestamp' => $tStamp,
			'x-signature' => $encodedSignature,
			'Content-Type' => 'Application/x-www-form-urlencoded'
		);
	}
}