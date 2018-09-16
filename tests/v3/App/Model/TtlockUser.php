<?php

namespace App\Model;

use ezswoole\Model;

class TtlockUser extends Model
{
	protected $resultSetType = 'collection';

	/**
	 * 添加用户
	 * @param array $data 用户信息
	 * @author 韩文博
	 * @throws \Exception
	 */
	public function addTtlockUser( array $data )
	{
		$now_time = time();
		$user_id  = $this->insertGetId( array_merge( $data, [
			'create_time' => $now_time,
		] ) );
		return $user_id;
	}

	/**
	 * 添加多条
	 * @datetime 2017-04-20 15:49:43
	 * @author   韩文博
	 * @param array $data
	 * @return boolean
	 */
	public function addTtlockUserAll( $data )
	{
		return $this->insertAll( $data );
	}

	/**
	 * 修改
	 * @datetime 2017-04-20 15:49:43
	 * @author   韩文博
	 * @param    array $condition
	 * @param    array $data
	 * @return   boolean
	 */
	public function editTtlockUser( $condition = [], $data = [] )
	{
		return $this->update( $data, $condition, true );
	}

	/**
	 * 删除
	 * @datetime 2017-04-20 15:49:43
	 * @author   韩文博
	 * @param    array $condition
	 * @return   boolean
	 */
	public function delTtlockUser( $condition = [] )
	{
		return $this->where( $condition )->delete();
	}

	/**
	 * 计算数量
	 * @datetime 2017-04-20 15:49:43
	 * @author   韩文博
	 * @param array $condition 条件
	 * @return int
	 */
	public function getTtlockUserCount( $condition )
	{
		return $this->where( $condition )->count();
	}


	/**
	 * 用户列表
	 * @param array  $condition
	 * @param string $field
	 * @param number $page
	 * @param string $order
	 */
	public function getTtlockUserList( $condition = [], $field = '*', $order = 'id desc', $page = "1,10" )
	{
		$list = $this->where( $condition )->order( $order )->field( $field )->page( $page )->select();
		return $list ? $list->toArray() : false;
	}

	/**
	 * 获取单个用户信息
	 * @datetime 2017-04-20T15:23:09+0800
	 * @author   韩文博
	 * @param    array  $condition
	 * @param    string $field
	 * @param    array  $extends
	 * @return   array
	 */
	public function getTtlockUserInfo( $condition = [], $field = '*', $extends = [] )
	{
		$result    = $this->field( $field )->where( $condition )->find();
		$user_info = $result ? $result->toArray() : [];
		unset( $user_info['pay_password'] );
		return $user_info;
	}

}
