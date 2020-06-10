<?php
  include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
  
  $Subscriber = new subscriber();
   debugger($_GET);
  
 if ($_GET) {   //Delete
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $subscriber_id = (int)$_GET['id'];
    if ($subscriber_id) {
      $seen_act = substr(md5("Seen-Subscriber-".$subscriber_id.$_SESSION['token']), 3,15);
      $delete_act = substr(md5("Delete-Subscriber-".$subscriber_id.$_SESSION['token']), 3,15);
        if ($seen_act == $_GET['act']){
          $subscriber_info = $Subscriber->getSubscriberbyId($subscriber_id);
          if ($subscriber_info) {
            $data =  array(
              'state'=>'Seen'
              );
            $success = $Subscriber->updateSubscriberbyId($data,$subscriber_id);
            if ($success) {
              redirect('../subscriber','success','Subscriber Seen');
            }else{
              redirect('../subscriber','error','Error');
            }
          } else {
            redirect('../subscriber','error','Subscriber Not Found.');
          }
        }
        else if ($delete_act == $_GET['act']){
          $subscriber_info = $Subscriber->getSubscriberbyId($subscriber_id);
          if ($subscriber_info) {
            $data =  array(
              'state'=>'deleted'
              );
            $success = $Subscriber->updateSubscriberbyId($data,$subscriber_id);
            if ($success) {
              redirect('../subscriber','success','Subscriber Deleted Succesfully.');
            }else{
              redirect('../subscriber','error','Error while Deletinging.');
            }
          } else {
            redirect('../subscriber','error','Subscriber Not Found.');
          }
        }
        else{
          redirect('../subscriber','error',"Invalid Action");
        }
    }else{
      redirect('../subscriber','error','Id is Invalid');
    }
  }else{
    redirect('../subscriber','error','Id is required.');
  }
}
else{
  redirect('../subscriber','error','Error Occurs during submitting');
}
?>