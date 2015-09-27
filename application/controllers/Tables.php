<?php


	class Tables extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('Table');
		}

		public function index() {
			$this->load->view('tables');
		}

		public function retrieve() {
			$this->Table->retrieve($this->input->post());
		}

		public function testform() {
			$this->load->view('testform');
		}

	}


?>
