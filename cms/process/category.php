<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Category = new category();
	$Categor = new category();
	 debugger($_POST);
	if($_POST){
		$data = array(
			'categoryname' => sanitize($_POST['categoryname']),
			'description' => htmlentities($_POST['description']),
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
			// 'updated_date' => 
		);
		// debugger($data);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$category_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$category_id = false;
	}

	if ($category_id) {
		$category_info = $Category->getCategorybyId($category_id);
		if ($category_info) {
			if ($_SESSION['user_id'] == $category_info[0]->added_by) {
				$Categor->addCategory($data);
				$success = $Category->updateCategorybyId($data,$category_id);
			}else{
				redirect('../category','error','You are not allowed to edit.');
			}
		}else{
			redirect('../category','error','Category Not Found');
		}
	}else{		//Add	
	$success = $Category->addCategory($data);
	}
	if ($success) {
		redirect('../category','success','Category '.$act.'ed Succesfully');
	}else{
		redirect('../category','error','Problem While '.$act.'ing Category');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$category_id = (int)$_GET['id'];
		if ($category_id) {
			$act = substr(md5("Delete-Category-".$category_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$category_info = $Category->getCategorybyId($category_id);
					if ($category_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Category->updateCategorybyId($data,$category_id);
						if ($success) {
							redirect('../category','success','Category Deleted Succesfully.');
						}else{
							redirect('../category','error','Error while Deleting.');
						}
					} else {
						redirect('../category','error','Category Not Found.');
					}
				}else{
					redirect('../category','error',"Invalid Action");
				}
			}else{
				redirect('../category','error','action is required');
			}
		}else{
			redirect('../category','error','Id is Invalid');
		}
	}else{
		redirect('../category','error','Id is required.');
	}
}
else{
	redirect('../category','error','Error Occurs during submitting');
}
?>