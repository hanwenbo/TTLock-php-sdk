<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/9/13
 * Time: 下午9:50
 *
 */

namespace ttlock;


class Oauth2 extends TTLockAbstract
{
	/**
	 * @param string $username
	 * @param string $password
	 * @param string $redirect_uri
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function token( string $username, string $password, string $redirect_uri )
	{
		$response = $this->client->request( 'POST', '/oauth2/token', [
			'form_params' => [
				'client_id'     => $this->clientId,
				'client_secret' => $this->clientSecret,
				'grant_type'    => 'password',
				'username'      => $username,
				'password'      => md5( $password ),
				'redirect_uri'  => $redirect_uri,
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
	 * @param string $refresh_token
	 * @param string $redirect_uri
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function refreshToken( string $refresh_token, string $redirect_uri )
	{
		$response = $this->client->request( 'POST', '/oauth2/token', [
			'form_params' => [
				'client_id'     => $this->clientId,
				'client_secret' => $this->clientSecret,
				'grant_type'    => 'refresh_token',
				'refresh_token' => $refresh_token,
				'redirect_uri'  => $redirect_uri,
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