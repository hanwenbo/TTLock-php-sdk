<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/9/13
 * Time: 下午8:29
 *
 */

namespace ttlock;


class TTLock
{
	/**
	 * @var string
	 */
	private $clientId = '';
	/**
	 * @var string
	 */
	private $clientSecret = '';
	public function __construct(string $clientId ,string $clientSecret)
	{
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
	}

}