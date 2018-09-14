<?php

namespace App\HttpController\Api;

use ttlock\TTLock;
class Oauth2 extends Api
{
	/**
	 * @var TTLock
	 */
	private $ttlock;

	public function _initialize()
	{
		$this->ttlock = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
	}

	public function token()
	{
		try{
			$result = $this->ttlock->oauth2->token( 'sygxyj_test2', md5('adaasdasd'), config( 'ttlock.redirect_url' ) );
			var_dump( $result );
		} catch( \Exception $e ){
			var_dump('xxx');
			var_dump( $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			var_dump( $e->getMessage() );
		}
	}
}

?>