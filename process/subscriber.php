<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Subscriber = new subscriber();
	 // debugger($_POST);
	if($_POST){
		$data = array(
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'status' =>	'Active',
			'state' => 'unseen'
			// 'updated_date' => 
		);
		// debugger($data,true);
	if ($data) {
		$success = $Subscriber->addSubscriber($data);
	}else{
		redirect('../index','error','message or emali was not entered');
	}

	if ($success) {
		redirect('../index','success','Message sent Succesfully');
	}else{
		redirect('../index','error','Problem While sending Message');
	}
}

?>