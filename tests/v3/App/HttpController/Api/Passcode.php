<?php

namespace App\HttpController\Api;

use ttlock\TTLock;
use App\Utils\Code;

class Passcode extends Api
{
	/**
	 * @var TTLock
	 */
	private $ttlock;

	public function _initialize()
	{
		$this->ttlock = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
	}

	public function add()
	{
		try{
			$token = $this->ttlock->oauth2->token( 'sygxyj_1', '123456', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->passcode->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->passcode->add( 1264731, '123456', $this->ttlock->getDateTimeMillisecond( '2018-11-21 12:20' ), $this->ttlock->getDateTimeMillisecond( '2018-11-30 21:22' ), 1, $this->getMillisecond() );
			var_dump( $result );
			$this->send( Code::success, $result );
		} catch( \Exception $e ){
			var_dump( $e );
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}

	public function detail()
	{
		try{
			$lockId    = 1264731;
			$date      = $this->getMillisecond();
			$startDate = $this->ttlock->getDateTimeMillisecond( '2018-11-21 12:57' );
			$endDate   = $this->ttlock->getDateTimeMillisecond( '2018-11-21 13:00' );
			$token     = $this->ttlock->oauth2->token( 'sygxyj_1', '123456', config( 'ttlock.redirect_uri' ) );
			$this->ttlock->lock->setAccessToken( $token['access_token'] );
			$lockVersionRes = $this->ttlock->lock->getKeyboardPwdVersion( $lockId, $date );
			$this->ttlock->passcode->setAccessToken( $token['access_token'] );
			$result = $this->ttlock->passcode->get( $lockId, $lockVersionRes['keyboardPwdVersion'], 3, $startDate, $endDate, $date );
			$this->send( Code::success, $result );
		} catch( \Exception $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		} catch( \GuzzleHttp\Exception\GuzzleException $e ){
			$this->send( Code::server_error, [], $e->getMessage() );
		}
	}
}

?>