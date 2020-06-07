<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Archive = new archive();
	 debugger($_POST);
	if($_POST){
		$data = array(
			'date' => sanitize($_POST['date']),
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
			// 'updated_date' => 
		);
		// debugger($data);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$archive_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$archive_id = false;
	}

	if ($archive_id) {
		$archive_info = $Archive->getArchivebyId($archive_id);
		if ($archive_info) {
			if ($_SESSION['user_id'] == $archive_info[0]->added_by) {
				$success = $Archive->updateArchivebyId($data,$archive_id);
			}else{
				redirect('../archive','error','You are not allowed to edit.');
			}
		}else{
			redirect('../archive','error','Archive Not Found');
		}
	}else{		//Add	
	$success = $Archive->addArchive($data);
	}
	if ($success) {
		redirect('../archive','success','Archive '.$act.'ed Succesfully');
	}else{
		redirect('../archive','error','Problem While '.$act.'ing Archive');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$archive_id = (int)$_GET['id'];
		if ($archive_id) {
			$act = substr(md5("Delete-Archive-".$archive_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$archive_info = $Archive->getArchivebyId($archive_id);
					if ($archive_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Archive->updateArchivebyId($data,$archive_id);
						if ($success) {
							redirect('../archive','success','Archive Deleted Succesfully.');
						}else{
							redirect('../archive','error','Error while Deleting.');
						}
					} else {
						redirect('../archive','error','Archive Not Found.');
					}
				}else{
					redirect('../archive','error',"Invalid Action");
				}
			}else{
				redirect('../archive','error','action is required');
			}
		}else{
			redirect('../archive','error','Id is Invalid');
		}
	}else{
		redirect('../archive','error','Id is required.');
	}
}
else{
	redirect('../archive','error','Error Occurs during submitting');
}
?>