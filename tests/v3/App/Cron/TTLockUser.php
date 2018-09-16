<?php

namespace App\Cron;

use ttlock\TTLock;

class TTLockUser
{
	/**
	 * 第三方服务器用户注册
	 * @author 韩文博
	 */
	static function register()
	{
		$state = cache( 'cron_ttlock_register' );
		if( $state === false || !$state ){
			cache( 'cron_ttlock_register', true );
			try{
				$userModel = model( 'User' );
				$ttlock    = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
				$user_list = $userModel->alias( 'user' )->join( 'ttlock_user ttlock', 'user.id = ttlock.user_id', 'LEFT' )->where( ['ttlock.username' => null] )->field( 'user.id' )->limit( 30 )->select();
				if( !empty( $user_list ) ){
					$user_list = $user_list->toArray();
					foreach( $user_list as $user ){
						$userName       = "u{$user['id']}";
						$password       = "123123";
						$registerResult = $ttlock->user->register( $userName, $password, self::getMillisecond() );
						if( isset( $registerResult['username'] ) ){
							model( 'ttlock_user' )->addTTLockUser( [
								'user_id'         => $user['id'],
								'username' => $registerResult['username'],
								'password' => $password,
							] );
						} elseif( $registerResult['errcode'] === 30003){
							model( 'ttlock_user' )->addTTLockUser( [
								'user_id'         => $user['id'],
								'username' => "sygxyj_{$userName}",
								'password' => $password,
							] );
						}else{
							trace( ['ttlock_username' => $userName, 'message' => '注册失败'], 'error' );
						}
					}
				} else{
					wsdebug()->send( ['cron' => 'ttlock_register 没有可以注册的了'], 'debug' );
				}
			} catch( \GuzzleHttp\Exception\GuzzleException $e ){
				wsdebug()->send( [
					'message' => $e->getMessage(),
					'file'    => $e->getFile(),
					'line'    => $e->getLine(),
					'code'    => $e->getCode(),
					'trace'   => $e->getTraceAsString(),
				], 'debug' );
			} catch( \Exception $e ){
				wsdebug()->send( [
					'message' => $e->getMessage(),
					'file'    => $e->getFile(),
					'line'    => $e->getLine(),
					'code'    => $e->getCode(),
					'trace'   => $e->getTraceAsString(),
				], 'debug' );
			} finally{
				cache( 'cron_ttlock_register', false );
			}

		}
		return true;
	}

	static function getMillisecond()
	{
		list( $t1, $t2 ) = explode( ' ', microtime() );
		return (float)sprintf( '%.0f', (floatval( $t1 ) + floatval( $t2 )) * 1000 );
	}
}
