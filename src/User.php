<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/9/13
 * Time: 下午8:59
 *
 */

namespace ttlock;


class User extends TTLockAbstract
{
	/**
	 * @param string $username
	 * @param string $password
	 * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function register( string $username, string $password, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/user/register', [
			'form_params' => [
				'clientId'     => $this->clientId,
				'clientSecret' => $this->clientSecret,
				'username'     => $username,
				'password'     => md5($password),
				'date'         => $date,
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
	 * @param string $username
	 * @param string $password
	 * @param int    $date
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException  | \Exception
	 * @author 韩文博
	 */
	public function resetPassword( string $username, string $password, int $date ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/user/resetPassword', [
			'form_params' => [
				'clientId'     => $this->clientId,
				'clientSecret' => $this->clientSecret,
				'username'     => $username,
				'password'     => md5($password),
				'date'         => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $startDate
	 * @param int $endDate
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function list( int $startDate, int $endDate, int $pageNo, int $pageSize, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/user/list', [
			'form_params' => [
				'clientId'     => $this->clientId,
				'clientSecret' => $this->clientSecret,
				'startDate'    => $startDate,
				'endDate'      => $endDate,
				'pageNo'       => $pageNo,
				'pageSize'     => $pageSize,
				'date'         => $date,
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
	 * @param string $username
	 * @param int    $date
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function delete( string $username, int $date ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/user/delete', [
			'form_params' => [
				'clientId'     => $this->clientId,
				'clientSecret' => $this->clientSecret,
				'username'     => $username,
				'date'         => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}