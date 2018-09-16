<?php
return [
	'open'=>true,
	'loop_time'=>1,// 秒
	'task_list' =>[
		'TTLockUser'   => [
			"interval_time" => 5 ,
			"script"        => "\App\Cron\TTLockUser::register",
		],

	]

];