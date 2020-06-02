<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Comment = new comment();
	//$Categor = new comment();
	 debugger($_POST);
	 $act="Add";
	if($_POST){
		$data = array(
			'name' => sanitize($_POST['name']),
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'website' => $_POST['website'],
			'message' => sanitize(htmlentities($_POST['message'])),
			'status' =>	'Active',
			'blogid' => (int)$_POST['blogid'],
			'state' => 'waiting'
			// 'updated_date' => 
		);
		 debugger($data);
	if (isset($_POST['commentid']) && !empty($_POST['commentid'])) {
		//reply
		$comment_id = (int)$_POST['commentid'];
		$data['commentid'] = $_POST['commentid'];
		$data['commentType'] = 'reply';
	}else{
		//comment
		$comment_id = false;
		$data['commentType'] = 'comment';
	}

	if ($comment_id) {
		$comment_info = $Comment->getCommentbyId($comment_id);
		if ($comment_info) {
				$success = $Comment->addComment($data);
		}else{
			redirect('../blog-post?id='.$data['blogid'],'error','Comment Not Found');
		}
	}else{		//Add	
	$success = $Comment->addComment($data);
	}
	if ($success) {
		redirect('../blog-post?id='.$data['blogid'],'success','Comment '.$act.'ed Succesfully');
	}else{
		redirect('../blog-post?id='.$data['blogid'],'error','Problem While '.$act.'ing Comment');
	}
}

?>