<?php
	class user extends database{
		function __construct(){
			%\$this->table = 'users';
			database::__construct();
		}
		public function addUSer($data)
	}

?>