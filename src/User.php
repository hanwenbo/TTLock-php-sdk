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


class User
{
	/**
	 * @var string
	 */
	private $clientId = '';
	/**
	 * @var string
	 */
	private $clientSecret = '';

	public function __construct( string $clientId, string $clientSecret )
	{
		$this->clientId     = $clientId;
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @method GET
	 * @param string $username
	 * @param string $password
	 * @return array
	 * @author 韩文博
	 */
	public function register( string $username, string $password ) : array
	{
		return [
			'username' => 'xxxx',
		];
	}

	public function resetPassword( string $username, string $password, int $date ) : bool
	{

	}

	public function list( int $startDate, int $endDate, int $pageNo, int $pageSize, int $date ) : array
	{
		return [
			'pageNo'   => 0,
			'pageSize' => 0,
			'pages'    => 0,
			'total'    => 0,
			'list'     => [
				[
					'userid'  => '',
					'regtime' => '',
				],
			],
		];
	}

	public function delete( string $username, int $date ) : bool
	{

	}
}