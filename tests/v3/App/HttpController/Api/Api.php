<?php
/**
 *
 *
 *
 *
 * @copyright  Copyright (c) 2016-2017 MoJiKeJi Inc. (http://www.fashop.cn)
 * @license    http://www.fashop.cn
 * @link       http://www.fashop.cn
 * @author     $this->author
 * @since      File available since Release v1.1
 */

namespace App\HttpController\Api;

use ezswoole\Request;
use App\Utils\Code;
use App\HttpController\AccessTokenAbstract;

abstract class Api extends AccessTokenAbstract
{
	/**
	 * 当访问
	 * @param $actionName
	 */
	protected function onRequest( $actionName ) : ?bool
	{
		parent::onRequest($actionName);
		$this->request = Request::getInstance();
		if( $this->request->method() === 'OPTIONS' ){
			$this->send( Code::success );
			$this->response()->end();
			return false;
		}else{
			parent::onRequest( $actionName );
			$this->_initialize();
			return true;
		}

	}

	/**
	 * @param \Throwable $throwable
	 * @param            $actionName
	 * @throws \Throwable
	 * @author 韩文博
	 */
	protected function onException(\Throwable $throwable,$actionName):void
	{
		$this->send(Code::server_error,[],$throwable->getFile()." - ".$throwable->getLine(). " - ". $throwable->getMessage());
		$this->response()->end();
	}

	protected function _initialize(){

	}
	protected function getMillisecond() {
		list($t1, $t2) = explode(' ', microtime());
		return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}
}
