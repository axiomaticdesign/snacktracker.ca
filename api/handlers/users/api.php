<?php
	require_once(__DIR__."../../libs/includes/includes.php");

	class API {
		private $db;
		private $opt;

		function __construct() {
			$this->opt = [ 
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			$this->db = new DBManager($this->opt);
		}

		public function addSnacker($form_data) {
			$current_date = $this->mysqlNow();
			try {
				$stmt = $this->db->prepare("INSERT INTO `users` (`name`, `account_name`, `account_type`, `photo`, `account_status`, `date_created`) VALUES (:name, :account_name, :account_type, :photo, :account_status, :date_created)");
				$result = $stmt->execute( array(
					'name' => $form_data['user_name'],
					'account_name' => $form_data['account_name'],
					'account_type' => $form_data['account_type']
					'account_status' => $form_data['account_status'],
					'date_created' => $current_date			
				));
				$data = array('result' => "success", "result_msg" => $result );
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
			return $data;		
		}

		public function deactivateSnacker($form_data) {
			$deactivate = 0;
			try {
				$stmt = $this->db->prepare("UPDATE `users` SET  `users`.`account_status` = :deactivate WHERE `users`.`user_id` = :user_id");			
				$result = $stmt->execute( array(
					'deactivate' => $deactivate, 
					'user_id' => $form_data['user_id']
				));
				$data = array('result' => "success", "result_msg" => $result );
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
			return $data;
		}

		public function deleteSnacker($form_data) {
			$delete = 1;
			try {
				$stmt = $this->db->prepare("UPDATE `users` SET  `users`.`is_deleted` = :del_true WHERE `users`.`user_id` = :user_id");			
				$result = $stmt->execute( array(
					'del_true' => $delete, 
					'user_id' => $form_data['user_id']
				));
				$data = array('result' => "success", "result_msg" => $result );
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
			return $data;
		}

		public function mysqlNow(){
			$stmt = $this->db->prepare("SELECT NOW()");
			$stmt->execute( array() );
			$now = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $now[0]['NOW()'];
		}

	}
