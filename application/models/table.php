<?php


	class Table extends CI_Model {


		function retrieve($post) 
			{

				if (empty($post['name']) && empty($post['from']) && empty($post['to'])) {
					$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads";
					$data = $this->db->query($query)->result_array();
					echo json_encode($data);
				} else if (!empty($post['name']) && empty($post['from']) && empty($post['to'])) {
					$name = $post['name'];
					if (strpos($name, ' ')) {
						$name = explode(' ', $name);
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND last_name = ?";
						$data = $this->db->query($query, array($name[0], $name[1]))->result_array();
						echo json_encode($data);
					} else {
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ?";
						$data = $this->db->query($query, array($name))->result_array();
						echo json_encode($data);
					}	
				} else if (!empty($post['name']) && !empty($post['from']) && empty($post['to'])) {
					$name = $post['name'];
					$from = date('Y-m-d 00:00:00', strtotime($post['from']));
					if (strpos($name, ' ')) {
						$name = explode(' ', $name);
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND last_name = ? AND registered_datetime > ?";
						$data = $this->db->query($query, array($name[0], $name[1], $to))->result_array();
						echo json_encode($data);
					} else {
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND registered_datetime > ?";
						$data = $this->db->query($query, array($post['name'], $from))->result_array();
						echo json_encode($data);
					}
				} else if (!empty($post['name']) && empty($post['from']) && !empty($post['to'])) {
					// Name is present, to is present, from is empty
					$name = $post['name'];
					$to = date('Y-m-d 00:00:00', strtotime($post['to']));
					if (strpos($name, ' ')) {
						$name = explode(' ', $name);
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND last_name = ? AND registered_datetime < ?";
						$data = $this->db->query($query, array($name[0], $name[1], $to))->result_array();
						echo json_encode($data);
					} else {
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND registered_datetime < ?";
						$data = $this->db->query($query, array($post['name'], $to))->result_array();
						echo json_encode($data);
					}
				} else if (!empty($post['name']) && !empty($post['from']) && !empty($post['to'])) {
					// Name is present, to is present, from is present
					$name = $post['name'];
					$to = date('Y-m-d 00:00:00', strtotime($post['to']));
					$from = date('Y-m-d 00:00:00', strtotime($post['from']));
					if (strpos($name, ' ')) {
						$name = explode(' ', $name);
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND last_name = ? AND registered_datetime BETWEEN ? AND ?";
						$data = $this->db->query($query, array($name[0], $name[1], $from, $to))->result_array();
						echo json_encode($data);
					} else {
						$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE first_name = ? AND registered_datetime BETWEEN ? AND ?";
						$data = $this->db->query($query, array($name, $from, $to))->result_array();
						echo json_encode($data);
					}
				} else if (empty($post['name']) && !empty($post['from']) && !empty($post['to'])) {
					// From is present, to is present, name is empty
					$from = date('Y-m-d 00:00:00', strtotime($post['from']));
					$to = date('Y-m-d 00:00:00', strtotime($post['to']));
					$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE registered_datetime BETWEEN ? AND ?";
					$data = $this->db->query($query, array($from, $to))->result_array();
					echo json_encode($data);
				} else if (empty($post['name']) && !empty($post['from']) && empty($post['to'])) {
					// From is present, to is empty, name is empty
					$from = date('Y-m-d 00:00:00', strtotime($post['from']));
					$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE registered_datetime > ?";
					$data = $this->db->query($query, array($from))->result_array();
					echo json_encode($data);
				} else if (empty($post['name']) && empty($post['from']) && !empty($post['to'])) {
					// To is present, name is empty, from is empty
					$to = date('Y-m-d 00:00:00', strtotime($post['to']));
					$query = "SELECT first_name, last_name, email, leads_id, DATE_FORMAT(registered_datetime, '%m/%d/%Y') as registered_datetime FROM leads WHERE registered_datetime < ?";
					$data = $this->db->query($query, array($to))->result_array();
					echo json_encode($data);
				}
				
				
			}

		// public function retrieve($name = null, $from = null, $to = null)
		// {
		// 	// If all parameters are null, return all records
		// 	if ($name == null && $from == null && $to == null) {
		// 		$query = "SELECT * FROM leads";
		// 		$data = $this->db->query($query)->result_array();
		// 		echo json_encode($data);
		// 	} else if ($name !== null && $from !== null && $to !== null) {
		// 		$name = explode(" ", $name);
		// 		$query = "SELECT * FROM leads WHERE first_name = ?, last_name = ?, registered_datetime WHERE registered_datetime BETWEEN ? AND ?";
		// 		$data = $this->db->query($query, array($name[0], $name[1], $from, $to))->result_array();
		// 		echo json_encode($data);
		// 	} else if ($name !== null && ($to !== null && $from == null)) {
		// 		$name = explode(" ", $name);
		// 		$query = "SELECT * FROM leads WHERE first_name = ?, last_name = ?, registered_datetime WHERE registered_datetime < ?";
		// 		$data = $this->db->query($query, array($name[0], $name[1], $to))->result_array();
		// 		echo json_encome($data);
		// 	} else if ($name !== null && ($from !== null && $to == null)) {
		// 		$name = explode(" ", $name);
		// 		$query = "SELECT * FROM leads WHERE first_name = ?, last_name = ?, registered_datetime WHERE registered_datetime > ?";
		// 		$data = $this->db->query($query, array($name[0], $name[1], $from))->result_array();
		// 		echo json_encome($data);
		// 	} else if ($to !== null && $from !== null) {
		// 		$query = "SELECT * FROM leads WHERE registered_datetime BETWEEN ? AND ?";
		// 		$data = $this->db->query($query, array($to, $from))->result_array();
		// 		echo json_encome($data);
		// 	} else if ($to !== null && $from == null) {
		// 		$name = explode(" ", $name);
		// 		$query = "SELECT * FROM leads WHERE registered_datetime < ?";
		// 		$data = $this->db->query($query, array($to))->result_array();
		// 		echo json_encome($data);
		// 	} else if ($from !== null && $to == null) {
		// 		$name = explode(" ", $name);
		// 		$query = "SELECT * FROM leads WHERE registered_datetime > ?";
		// 		$data = $this->db->query($query, array($from))->result_array();
		// 		echo json_encome($data);
		// 	}
		// }


	}


?>
