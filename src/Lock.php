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


class Lock
{
	/**
	 * @var string
	 */
	private $clientId = '';
	/**
	 * @var string
	 */
	private $clientSecret = '';
	/**
	 * @var string
	 */
	private $accessToken = '';

	public function __construct( string $clientId, string $clientSecret, string $accessToken )
	{
		$this->clientId     = $clientId;
		$this->clientSecret = $clientSecret;
		$this->accessToken  = $accessToken;
	}

	public function initialize() : array
	{
		return [
			'lockId' => 121212,
			'keyId'  => 121212,
		];
	}

	public function list( int $pageNo, int $pageSize, int $date ) : array
	{
		return [
			"list" => [
				[
					"lockId"             => 123156,
					"date"               => 1235545850000,
					"lockName"           => "M201-d9223",
					"lockAlias"          => "Outdoor lock",
					"lockMac"            => "52:A6:D8:B2:C1:00",
					"electricQuantity"   => 100,
					"keyboardPwdVersion" => 1,
					"specialValue"       => 1288,
				],
			],
		];
	}

	public function listKey( int $lockId, int $pageNo, int $pageSize, int $date ) : array
	{
		return [
			"list" => [
				[
					"keyId"     => 21703,
					"lockId"    => 3215,
					"openid"    => 1234567890,
					"username"  => "1234567890",
					"keyStatus" => "110402",
					"startDate" => 0,
					"endDate"   => 0,
					"remarks"   => "this is for you ",
					"date"      => 1449816232000,
				],
			],
		];
	}

	public function deleteAllKey( string $lockId, int $date ) : bool
	{
		return true;
	}

	public function listKeyboardPwd( int $lockId, int $pageNo, int $pageSize, int $date ) : array
	{

	}

	public function changeAdminKeyboardPwd( int $lockId, string $password, int $date ) : bool
	{

	}

	public function changeDeletePwd( int $lockId, string $password, int $date ) : bool
	{

	}

	public function rename( int $lockId, string $lockAlias, int $date ) : bool
	{

	}

	public function resetKey( int $lockId, $date ) : bool
	{

	}

	public function resetKeyboardPwd( int $lockId, string $pwdInfo, int $timestamp, int $date ) : bool
	{

	}

	public function getKeyboardPwdVersion( int $lockId, int $date ) : array
	{
		return [
			'keyboardPwdVersion' => 1,
		];
	}

	public function updateElectricQuantity( int $lockId, int $electricQuantity, int $date ) : bool
	{

	}

	public function transfer( string $receiverUsername, string $lockIdList, int $date ) : bool
	{

	}
}