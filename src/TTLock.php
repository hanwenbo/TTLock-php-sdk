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

/**
 * @property User $user
 * @property Lock $lock
 */
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

	/**
	 * @var  \GuzzleHttp\Client
	 */
	private $client;


	public function __construct( string $clientId, string $clientSecret )
	{
		$this->clientId     = $clientId;
		$this->clientSecret = $clientSecret;
		$this->client = new \GuzzleHttp\Client([
			'base_uri'=>'https://api.ttlock.com.cn'
		]);
	}

	protected $container = [];
	protected $providers
		= [
			"user" => User::class,
			"lock" => Lock::class,
		];

	/**
	 * @param $name
	 * @return mixed
	 * @throws \Exception
	 * @author 韩文博
	 */
	public function __get( $name )
	{
		if( !isset( $this->providers[$name] ) ){
			throw new \Exception( "class not found" );
		} else{
			if( !isset( $this->container[$name] ) || !$this->container[$name] instanceof TTLockAbstract ){
				try{
					$this->container["{$name}"] = new $this->providers[$name]( $this->clientId, $this->clientSecret,$this->request );
				} catch( \Exception $e ){
					throw new $e;
				}
			}
			return $this->container["{$name}"];
		}
	}
}