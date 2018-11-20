<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/11/20
 * Time: 10:31 AM
 *
 */

namespace ttlock;

class Passcode extends TTLockAbstract
{
	/**
	 * @var string
	 */
	private $accessToken = '';

	public function setAccessToken( string $accessToken ) : void
	{
		$this->accessToken = $accessToken;
	}

	/**
	 * 文档地址：http://open.ttlock.com.cn/doc/api/v3/keyboardPwd/get
	 * @param int $lockId
	 * @param int $keyboardPwdVersion
	 * @param int $keyboardPwdType
	 * @param int $startDate
	 * @param int $endDate
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function get( int $lockId, int $keyboardPwdVersion, int $keyboardPwdType, int $startDate, int $endDate, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/keyboardPwd/get', [
			'form_params' => [
				'clientId'           => $this->clientId,
				'accessToken'        => $this->accessToken,
				'lockId'             => $lockId,
				'keyboardPwdVersion' => $keyboardPwdVersion,
				'keyboardPwdType'    => $keyboardPwdType,
				'startDate'          => $startDate,
				'endDate'            => $endDate,
				'date'               => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $lockId
	 * @param int $keyboardPwdId
	 * @param int $deleteType
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function delete( int $lockId, int $keyboardPwdId, int $deleteType, int $date ):array
	{
		$response = $this->client->request( 'POST', '/v3/keyboardPwd/get', [
			'form_params' => [
				'clientId'      => $this->clientId,
				'accessToken'   => $this->accessToken,
				'lockId'        => $lockId,
				'keyboardPwdId' => $keyboardPwdId,
				'deleteType'    => $deleteType,
				'date'          => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @param int    $keyboardPwdId
	 * @param string $newKeyboardPwd
	 * @param int    $startDate
	 * @param int    $endDate
	 * @param int    $changeType
	 * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function change( int $lockId, int $keyboardPwdId, string $newKeyboardPwd, int $startDate, int $endDate, int $changeType, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/keyboardPwd/get', [
			'form_params' => [
				'clientId'       => $this->clientId,
				'accessToken'    => $this->accessToken,
				'lockId'         => $lockId,
				'keyboardPwdId'  => $keyboardPwdId,
				'newKeyboardPwd' => $newKeyboardPwd,
				'startDate'      => $startDate,
				'endDate'        => $endDate,
				'changeType'     => $changeType,
				'date'           => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @method GET
	 * @param int    $lockId
	 * @param string $keyboardPwd
	 * @param int    $startDate
	 * @param int    $endDate
	 * @param int    $addType
	 * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function add( int $lockId, string $keyboardPwd, int $startDate, int $endDate, int $addType, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/keyboardPwd/get', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'keyboardPwd' => $keyboardPwd,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'addType'     => $addType,
				'date'        => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}