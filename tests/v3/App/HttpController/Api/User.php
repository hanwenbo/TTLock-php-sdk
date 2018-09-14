<?php

namespace App\HttpController\Api;

use ttlock\TTLock;
class User extends Api
{
	/**
	 * @var TTLock
	 */
	private $ttlock;

	public function _initialize()
	{
		$this->ttlock = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
	}

	public function register()
	{
		try{
			$result = $this->ttlock->user->register( '6', '123456',$this->getMillisecond() );
			var_dump($result);
		} catch( \Exception $e ){
			var_dump( $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			var_dump( $e->getMessage() );
		}
	}
	public function resetPassword(){
		try{
			$result = $this->ttlock->user->resetPassword( 'sygxyj_1', '123456',$this->getMillisecond() );
			var_dump($result);
		} catch( \Exception $e ){
			var_dump( $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			var_dump( $e->getMessage() );
		}
	}

}

?>