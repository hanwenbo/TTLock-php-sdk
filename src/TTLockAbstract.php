<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/9/13
 * Time: 下午9:28
 *
 */

namespace ttlock;

/**
 * Class BaseAbstract
 */
abstract class TTLockAbstract
{
	/**
	 * @var string
	 */
	protected $clientId = '';
	/**
	 * @var string
	 */
	protected $clientSecret = '';
	/**
	 * @var \GuzzleHttp\Client
	 */
	protected $client;

	final function __construct( string $clientId, string $clientSecret, \GuzzleHttp\Client $client )
	{
		$this->clientId     = $clientId;
		$this->clientSecret = $clientSecret;
		$this->client       = $client;
	}
}