<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	redirect('cms/index'); 

	$user = new user();
	$data = array(
		'username'=>'ms',
		'email'=>'manandharsudip8@gmail.com',
		'role'=>'Admin',
		'session_token'=>tokenize()
	); 
	#$user->addUser($data);
	#$datas=$user->getUserbyEmail('manandharsudip8@gmai.com');
	// $datas=$user->updateUserbyEmail($data,'manandharsudip8@gmai.com');
	// debugger($datas);
	$user->deleteUserbyEmail('manandharsudip8@gmail.com');
?>
