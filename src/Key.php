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
class Key extends TTLockAbstract
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
	 * @param int    $lockId
	 * @param string $receiverUsername
	 * @param int    $startDate
	 * @param int    $endDate
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function send( int $lockId, string $receiverUsername, int $startDate, int $endDate )
	{
		$response = $this->client->request( 'POST', '/v3/key/send', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'receiverUsername' => $receiverUsername,
				'startDate'        => $startDate,
				'endDate'          => $endDate,
				'date'             => $this->getMillisecond(),
				'remoteEnable'     => 2,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200  ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @method GET
	 * @param int $lastUpdateDate
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function syncData( int $lastUpdateDate, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/key/syncData', [
			'form_params' => [
				'clientId'       => $this->clientId,
				'accessToken'    => $this->accessToken,
				'lastUpdateDate' => $lastUpdateDate,
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

}