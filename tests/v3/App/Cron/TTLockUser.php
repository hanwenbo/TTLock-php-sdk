<?php

namespace App\Cron;

use TTLock\TTLock;
use Hashids\Hashids;

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
			$userModel = model( 'User' );
			$prefix    = 'china_v1_';
			try{
				$ttlock    = new TTLock( config( 'ttlock.client_id' ), config( 'ttlock.client_secret' ) );
				$user_list = $userModel->alias( 'user' )->join( 'ttlock', 'user.id = ttlock.user_id', 'LEFT' )->where( ['ttlock.username' => null] )->field( 'user.id,user.nickname,user.avatar,user.sex,ttlock.ttlock_email' )->limit( 30 )->select();
				$time      = time();
				$hashids   = new Hashids( 'gxyj' );
				if( !empty( $user_list ) ){
					$user_list = $user_list->toArray();
					foreach( $user_list as $user ){
						$hash_user_id   = $hashids->encode( $user['id'] );
						$userName       = "{$prefix}{$hash_user_id}_{$time}";
						$password       = "temp_{$hash_user_id}";
						$registerResult = $ttlock->user->register( $userName, $password, self::getMillisecond() );
						if( isset( $registerResult['username'] ) ){
							// 注册
							model( 'TTLockUser' )->addTTLockUser( [
								'user_id'         => $user['id'],
								'ttlock_username' => $registerResult['username'],
								'ttlock_password' => $password,
							] );
						} else{
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
