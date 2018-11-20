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
 * @property User   $user
 * @property Lock   $lock
 * @property Oauth2 $oauth2
 * @property Key    $key
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
		$this->client       = new \GuzzleHttp\Client( [
			'base_uri' => 'https://api.ttlock.com.cn',
		] );
	}

	protected $container = [];
	protected $providers
		= [
			"user"     => User::class,
			"lock"     => Lock::class,
			"oauth2"   => Oauth2::class,
			"key"      => Key::class,
			"passcode" => Passcode::class,
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
					$this->container["{$name}"] = new $this->providers[$name]( $this->clientId, $this->clientSecret, $this->client );
				} catch( \Exception $e ){
					throw new $e;
				}
			}
			return $this->container["{$name}"];
		}
	}

	/**
	 * 根据日期时间返回毫秒时间戳
	 * @param string $dateTime
	 * @return int
	 * @author 韩文博
	 */
	static function getDateTimeMillisecond( string $dateTime ) : int
	{
		$dateTime = $dateTime.".0";
		list( $usec, $sec ) = explode( ".", $dateTime );
		$date        = strtotime( $usec );
		$return_data = str_pad( $date.$sec, 13, "0", STR_PAD_RIGHT ); //不足13位。右边补0
		return (int)$return_data;
	}
}