<?php

class FeederController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionMkprodi($id_sms)
	{
		$host = Yii::app()->rest->baseurl_apigateway;
		

		$url = $host."/recordset";

		$hasil = null;

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$params = [
			'table' => 'mata_kuliah',
			'filter' =>  'id_sms = \'95679f39-382b-43a6-b13e-12b963b21b54\'',
			'order' =>  '',
			'limit' => 0,
			'offset' => 0 
		];

		$result = $api->post($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}

		print_r($id_sms);
		print_r($hasil);exit;

		// print_r($hasil->values->output->result->item[1]->email);exit;
		$this->render('mkprodi',[
			'hasil' => $hasil
		]);
	}

	public function actionProdi()
	{
		$host = Yii::app()->rest->baseurl_apigateway;
		
		

		$url = $host."/recordset";

		$hasil = null;

		$api = new RestClient;
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$params = [
			'table' => 'sms',
			'filter' =>  'id_sp = \'715253d2-bafa-429a-9ff7-a85b34ff955d\'',
			'order' =>  '',
			'limit' => 0,
			'offset' => 0 
		];

		$result = $api->post($url, $params, $headers);
		
		try{
			
			$hasil = $result->decode_response();
		}

		catch(RestClientException  $e){
			//print_r($e);
			//throw new RestClientException;
			$hasil = null;
		}

		// print_r($hasil->values->output->result->item[1]->email);exit;
		$this->render('prodi',[
			'hasil' => $hasil
		]);
	}

	public function actionHome()
	{
		$this->render('home');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	
}