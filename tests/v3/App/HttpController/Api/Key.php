<?php

namespace App\HttpController\Api;

use ttlock\TTLock;
use App\Utils\Code;

class Key extends Api
{
	/**
	 * @var TTLock
	 */
	private $ttlock;

	public function _initialize()
	{
		$this->ttlock = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
	}

	public function sendKey()
	{
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_1', '123456', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->key->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->key->send( 1264731, 'sygxyj_u26', $this->ttlock->getDateTimeMillisecond( '2018-9-16 21:22' ), $this->ttlock->getDateTimeMillisecond( '2018-9-17 21:22' ) );

			$this->send( Code::success, $result);
		} catch( \Exception $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}

	public function syncData()
	{
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_1', '123456', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->key->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->key->syncData( 0, $this->getMillisecond() );
			$this->send( Code::success, $result );
		} catch( \Exception $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}
	public function syncUserData()
	{
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_u26', '123123', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->key->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->key->syncData( 0, $this->getMillisecond() );
			$result['token'] = $token;
			$this->send( Code::success, $result );
		} catch( \Exception $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}

	/**
	 * @method GET
	 * @param string $name 锁的名字 M101T_d83b32
	 * @author 韩文博
	 */
	public function unlockInfo(){
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_u26', '123123', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->key->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->key->syncData( 0, $this->getMillisecond() );
			$res['token'] = $token;
			$res['lastUpdateDate'] = $result['lastUpdateDate'];
			$res['key'] = null;
			if(isset($result['keyList'])){
				foreach($result['keyList'] as $key){
					if($key['lockName'] === $this->get['name']){
						$res['key'] =$key;
						$result['token'] = $token;
						return $this->send( Code::success, $res );
					}
				}
			}
			return $this->send( Code::error, [],'没有权限' );
		} catch( \Exception $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}
}

?>