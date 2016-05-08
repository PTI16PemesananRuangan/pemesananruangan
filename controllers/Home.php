<?php 

	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Home extends user_controller{

		public function _construct(){
			 parent::__construct();
		}
		public function index(){
			$this->content = 'home';
			$this->layout();
		}



	}





?>