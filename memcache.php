<?php 
	$mem=new Memcache();
	// var_dump($mem);
	//连接服务器
	$mem->pconnect('127.0.0.1',11211)or die('memcache 连接失败');

	//设置
	// $mem->set('name','zhangsan');
	// $mem->set('name','lisi');
	//获取
	// echo $mem->get('name');

	//添加  如果之前设置过返回的是false
	$mem->add('age','18');
	$mem->replace('age','100');
	echo $mem->get('age');

	// $mem->add('num','2');
	//递增
	// echo $mem->increment('num',5);
	//递减
	//echo $mem->decrement('num');

	//删除单个
	$mem->delete('num');
	var_dump($mem->get('num'));
	//删除多个
	// $mem->flush();
	// var_dump($mem->get('name'));
	// var_dump($mem->get('age'));

	// //获取服务器的版本信息
	// var_dump($mem->getversion());

	// //获取服务器统计信息
	// var_dump($mem->getstats());

	// //检查服务器的在线，离线信息
	// var_dump($mem->getserverstatus('127.0.0.1'));
?>