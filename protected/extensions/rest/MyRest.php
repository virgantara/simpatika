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

	public static function api_getObatLike($params){
		$host = Yii::app()->rest->baseurl_apigateway;
		
		

		$url = $host."/obat/like";

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getListRekapDokterBulanan($params){
		$host = Yii::app()->rest->baseurl_apigateway;
		
		

		$url = $host."/d/rekap";

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getRefProsedur($param)
	{
		$host = Yii::app()->rest->baseurlVClaim;
			
		$url = $host."/referensi/procedure/".$param;	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonVClaim();
		$result = $api->get($url, array(), $headers);
		
		try{
			if(Yii::app()->helper->contains($result->response, '404'))
				throw new RestClientException($result->response);
			
			$hasil = $result->decode_response();

		}

		catch(RestClientException  $e){
			$metaData = array(
				'code' => 'Error404',
				'message' => 'BPJS Server Error: Resource not found'
			);

			$metaData = (object) $metaData;
			$hasil = array(
				'metaData' => $metaData
			);

			$hasil = (object) $hasil;
		}
		
		return $hasil;
	}

	public static function getRefDiagnosa($param)
	{
		$host = Yii::app()->rest->baseurlVClaim;
			
		$url = $host."/referensi/diagnosa/".$param;	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonVClaim();
		$result = $api->get($url, array(), $headers);
		
		try{
			if(Yii::app()->helper->contains($result->response, '404'))
				throw new RestClientException($result->response);

			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e)
		{
			$metaData = array(
				'code' => 'Error404',
				'message' => 'BPJS Server Error: Resource not found'
			);

			$metaData = (object) $metaData;
			$hasil = array(
				'metaData' => $metaData
			);

			$hasil = (object) $hasil;

		}
		
		return $hasil;
	}

	public static function getHapusRuang($koderuang, $kodekelas)
	{
		$host = Yii::app()->rest->baseurlAplicare;
			
		$url = $host."/rest/bed/delete/".Yii::app()->params->kodeppk;	

		$hasil = null;

		$datarequest = array(
			'kodekelas' => $kodekelas,
			'koderuang' => $koderuang
		);

		$request = json_encode($datarequest);

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonAplicare();
		$result = $api->post($url, $request, $headers);
		
		try{
			
			$hasil = $result->decode_response();
			// print_r($hasil);exit;
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getKetersediaanRuang($start, $limit)
	{
		$host = Yii::app()->rest->baseurlAplicare;
			
		$url = $host."/rest/bed/read/".Yii::app()->params->kodeppk.'/'.$start.'/'.$limit;	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonAplicare();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
			// print_r($hasil);exit;
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getRefRuang()
	{
		$host = Yii::app()->rest->baseurlAplicare;
			
		$url = $host."/rest/ref/kelas";	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonAplicare();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
			// print_r($hasil);exit;
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getRefVclaimList($jenis)
	{
		$host = Yii::app()->rest->baseurlVClaim;
			
		$url = $host."/referensi/".$jenis;	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonVClaim();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getRefVclaim($jenis, $param)
	{
		$host = Yii::app()->rest->baseurlVClaim;
			
		$url = $host."/referensi/".$jenis."/".$param;	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonVClaim();
		$result = $api->get($url, array(), $headers);
		// print_r($result);exit;
		try{
			
			$hasil = $result->decode_response();
			
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getRefPoli()
	{
		$host = Yii::app()->rest->baseurlVClaim;
			
		$url = $host."/referensi/poli";	

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJsonVClaim();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function aplicareRuanganUpdate($params = array())
	{

		if(empty($params)) return null;

		$datarequest = array(
			'kodekelas' => $params['kodekelas'],
			'koderuang' => $params['koderuang'],
			'namaruang' => $params['namaruang'],
			'kapasitas'=> $params['kapasitas'],
			'tersedia'=> $params['tersedia'],
			'tersediapria'=> $params['tersediapria'],
			'tersediawanita'=> $params['tersediawanita'],
			'tersediapriawanita'=> $params['tersediapriawanita'],	
		);



		$request = json_encode($datarequest);

		$headers = Yii::app()->rest->getHeaderJsonAplicare();
		$host = Yii::app()->rest->baseurlAplicare;
		$url = $host."/rest/bed/update/".Yii::app()->params->kodeppk;
		$api = new RestClient;

		$result = $api->post($url, $request, $headers);

		// print_r($result);exit;
		return  $result->decode_response();
		
	}

	public static function aplicareRuanganBaru($params = array())
	{

		if(empty($params)) return null;

		$datarequest = array(
			'kodekelas' => $params['kodekelas'],
			'koderuang' => $params['koderuang'],
			'namaruang' => $params['namaruang'],
			'kapasitas'=> $params['kapasitas'],
			'tersedia'=> $params['tersedia'],
			'tersediapria'=> $params['tersediapria'],
			'tersediawanita'=> $params['tersediawanita'],
			'tersediapriawanita'=> $params['tersediapriawanita'],	
		);



		$request = json_encode($datarequest);

		$headers = Yii::app()->rest->getHeaderJsonAplicare();
		$host = Yii::app()->rest->baseurlAplicare;
		$url = $host."/rest/bed/create/".Yii::app()->params->kodeppk;
		$api = new RestClient;

		$result = $api->post($url, $request, $headers);

		// print_r($result);exit;
		return  $result->decode_response();
		
	}

	
	public static function getRujukanByOrigin($origin, $jns, $param)
	{
		$host = Yii::app()->rest->baseurl;
		$url = '';
		switch ($jns) {
			case 0:
				switch ($origin) {
					case 1:
						$url = $host."/Rujukan/".$param;
						break;
					
					case 2:
						$url = $host."/Rujukan/Peserta/".$param;
						break;
				}
				
				break;
			
			case 1:
				switch ($origin) {
					case 1:
						$url = $host."/Rujukan/RS/".$param;
						break;
					
					case 2:
						$url = $host."/Rujukan/RS/Peserta/".$param;
						break;
				}

				break;
		}

		$hasil = null;


		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, array(), $headers);

		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getFaskes($param, $start, $limit)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/provider/ref/provider/query?nama=".$param."&start=".$start."&limit=".$limit;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, array(), $headers);
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	

	public static function getPoli($param)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/poli/ref/poli/".$param;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, array(), $headers);
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getDiagnosa($param)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/diagnosa/ref/diagnosa/".$param;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeaderJson();
		$result = $api->get($url, array(), $headers);
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getDataKunjungan($noSep)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/sep/integrated/Kunjungan/sep/".$noSep;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeader();
		$result = $api->get($url, array(), $headers);
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getDetailSep($noSep)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/SEP/".$noSep;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeader();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function updateSEP($params = array())
	{

		if(empty($params)) return null;

		$datarequest = array(
			'request' => array(
				't_sep' => array(
					'noSep' => $params['noSep'],
					'noKartu' => $params['noKartu'],
					'tglSep' => $params['tglSep'],
					'tglRujukan' => $params['tglRujukan'],
					'noRujukan'=> $params['noRujukan'],
					'ppkRujukan'=> $params['ppkRujukan'],
					'ppkPelayanan'=> $params['ppkPelayanan'],
					'jnsPelayanan'=> $params['jnsPelayanan'],
					'catatan'=> $params['catatan'],
					'diagAwal'=> $params['diagAwal'],
					'poliTujuan'=> $params['poliTujuan'],
					'klsRawat'=> $params['klsRawat'],
					'lakaLantas'=> $params['lakaLantas'],
					'lokasiLaka'=> $params['lokasiLaka'],
					'user'=> $params['user'],
					'noMr'=> $params['noMr']
				)
			)
		);

		$request = json_encode($datarequest);

		$headers = Yii::app()->rest->getHeader();
		$host = Yii::app()->rest->baseurl;
		$url = $host."/Sep/Update";
		$api = new RestClient;

		$result = $api->put($url, $request, $headers);

		return  $result->decode_response();
		
	}

	public static function updateTglPulang($noSEP, $tgl, $ppk)
	{
		$host = Yii::app()->rest->baseurl;
		
		$json_body = array(
			'request' => array(
				't_sep' => array(
					'noSep'=>$noSEP,
					'tglSep' => $tgl,
					'ppkPelayanan'=>Yii::app()->params->kodeppk
				)
			)
		);
		
		$json_body = json_encode($json_body);

		$url = $host."/Sep/updtglplg";

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeader();
		$result = $api->put($url, $json_body, $headers);

		$response_json = $result->response_status_lines;
		
		return $response_json[0];
	}

	public static function hapusSEP($noSEP)
	{
		$host = Yii::app()->rest->baseurl;
		
		$json_body = array(
			'request' => array(
				't_sep' => array(
					'noSep'=>$noSEP,
					 'ppkPelayanan'=>Yii::app()->params->kodeppk
				)
			)

		);
		
		$json_body = json_encode($json_body);

		$url = $host."/SEP/delete";

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeader();
		$result = $api->delete($url, $json_body, $headers);

		$response_json = $result->response_status_lines;
		
		return $response_json[0];
	}

	public static function getRiwayatTerakhir($nokartu)
	{
		$host = Yii::app()->rest->baseurl;
		
		$url = $host."/sep/peserta/".$nokartu;

		$hasil = null;

		$api = new RestClient;
		$headers = Yii::app()->rest->getHeader();
		$result = $api->get($url, array(), $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}
		
		return $hasil;
	}

	public static function getNoSEPlama($params = array())
	{

		if(empty($params)) return null;

		$xml_body = '
			<request>
			<data>
			<t_sep>
			<noKartu>'.$params['noKartu'].'</noKartu>
			<tglSep>'.$params['tglSep'].'</tglSep>
			<tglRujukan>'.$params['tglRujukan'].'</tglRujukan>
			<noRujukan>'.$params['noRujukan'].'</noRujukan>
			<ppkRujukan>'.$params['ppkRujukan'].'</ppkRujukan>
			<ppkPelayanan>'.$params['ppkPelayanan'].'</ppkPelayanan>
			<jnsPelayanan>'.$params['jnsPelayanan'].'</jnsPelayanan>
			<catatan>'.$params['catatan'].'</catatan>
			<diagAwal>'.$params['diagAwal'].'</diagAwal>
			<poliTujuan>'.$params['poliTujuan'].'</poliTujuan>
			<klsRawat>'.$params['klsRawat'].'</klsRawat>
			<lakaLantas>'.$params['lakaLantas'].'</lakaLantas>
			<user>'.$params['user'].'</user>
			<noMr>'.$params['noMr'].'</noMr>
			</t_sep>
			</data>
			</request>
		';

		$headers = Yii::app()->rest->getHeader();
		$host = Yii::app()->rest->baseurl;
		$url = $host."/SEP/sep";
		//$api = new RestClient;

		//$result = $api->post($url, $xml_body, $headers);

		//return  $result->decode_response();


	}

	public static function getNoSEP($params = array())
	{

		if(empty($params)) return null;

		$datarequest = array(
			'request' => array(
				't_sep' => array(
					'noKartu' => $params['noKartu'],
					'tglSep' => $params['tglSep'],
					'tglRujukan' => $params['tglRujukan'],
					'noRujukan'=> $params['noRujukan'],
					'ppkRujukan'=> $params['ppkRujukan'],
					'ppkPelayanan'=> $params['ppkPelayanan'],
					'jnsPelayanan'=> $params['jnsPelayanan'],
					'catatan'=> $params['catatan'],
					'diagAwal'=> $params['diagAwal'],
					'poliTujuan'=> $params['poliTujuan'],
					'klsRawat'=> $params['klsRawat'],
					'lakaLantas'=> $params['lakaLantas'],
					'lokasiLaka'=> $params['lokasiLaka'],
					'user'=> $params['user'],
					'noMr'=> $params['noMr']
				)
			)
		);

		$request = json_encode($datarequest);

		$headers = Yii::app()->rest->getHeader();
		$host = Yii::app()->rest->baseurl;
		$url = $host."/SEP/insert";
		$api = new RestClient;

		$result = $api->post($url, $request, $headers);

		return  $result->decode_response();
		
	}

	public static function getPesertaByNomor($param = array())
	{

		$host = Yii::app()->rest->baseurl;
		$url = '';
		if($param['jenis'] == 'nik')
			$url = $host."/Peserta/peserta/nik/".$param['nomor'];
		else if($param['jenis'] == 'kartu')
			$url = $host."/Peserta/nokartu/".$param['nomor'].'/tglSEP/'.date('Y-m-d');

		if($url != '')
		{
			$api = new RestClient;
			$headers = Yii::app()->rest->getHeader();
			$result = $api->get($url, array(), $headers);

			return $result->decode_response();
		}
		else
			return null;

	}
/*
=========================HEADER WS================================================
*/
	public static function getHeaderJsonAplicare()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurlAplicare;

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
			'Content-Type' => 'application/json'
		);
	}

	public static function getHeaderAplicare()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurlAplicare;

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

	public static function getHeaderJsonVClaim()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurlVClaim;

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

	public static function getHeaderVClaim()
	{
		$data = Yii::app()->rest->id;
		$key = Yii::app()->rest->secretkey;
		$host = Yii::app()->rest->baseurlVClaim;

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