<?php

namespace App\HttpController\Api;

use ttlock\TTLock;

class Lock extends Api
{
	/**
	 * @var TTLock
	 */
	private $ttlock;

	public function _initialize()
	{
		$this->ttlock = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
	}


	public function list()
	{
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_1', '123456', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->lock->setAccessToken($token['access_token']);
			$result = $this->ttlock->lock->list( 1, 10, $this->getMillisecond() );
			var_dump( $result );
		} catch( \Exception $e ){
			var_dump( $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			var_dump( $e->getMessage() );
		}
	}

}

?>