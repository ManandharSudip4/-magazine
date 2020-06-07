<?php
	class contact extends database{
		function __construct(){
			$this->table = 'contacts';
			database::__construct();
		}
		public function addContact($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getContactbyId($contact_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $contact_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllContact($is_die=false){
			
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
		public function getAllUnseenContact($is_die=false){
			
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
		public function getAllAcceptContactByBlog($blog_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'contactType' => 'contact'
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//reply
		public function getAllAcceptReplyByBlogByContact($blog_id,$contact_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
							'state' => 'accept',
							'blogid' => $blog_id,
							'contactType' => 'reply',
							'contactid' => $contact_id
						)
					),
				'order' => 'ASC'
				);

			return $this->getData($args,$is_die);
		}
		//count contact
		public function getNumberContactByBlog($blog_id,$is_die=false){
			
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

		public function updateContactbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteContactbyId($id,$is_die=false){
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