<?php
	class subscriber extends database{
		function __construct(){
			$this->table = 'subscribers';
			database::__construct();
		}
		public function addSubscriber($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getSubscriberbyId($subscriber_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $subscriber_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllSubscriber($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',

						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		public function getAllUnseenSubscriber($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'unseen'


						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		public function getAllAcceptSubscriberByBlog($blog_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'subscriberType' => 'subscriber'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//reply
		public function getAllAcceptReplyByBlogBySubscriber($blog_id,$subscriber_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'subscriberType' => 'reply',
							'subscriberid' => $subscriber_id
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//count subscriber
		public function getNumberSubscriberByBlog($blog_id,$is_die=false){
			
			$args = array(
				'fields'=>	['COUNT(id) as total'],           
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateSubscriberbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteSubscriberbyId($id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->deleteData($args,$is_die);
		}
	}

?>