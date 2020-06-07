<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Contact = new contact();
	 //debugger($_POST);
	if($_POST){
		$data = array(
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'message' => sanitize(htmlentities($_POST['message'])),
			'status' =>	'Active',
			'state' => 'unseen'
			// 'updated_date' => 
		);
		//debugger($data,true);
	if ($data) {
		$success = $Contact->addContact($data);
	}else{
		redirect('../contact','error','message or emali was not entered');
	}

	if ($success) {
		redirect('../contact','success','Message sent Succesfully');
	}else{
		redirect('../contact','error','Problem While sending Message');
	}
}

?>