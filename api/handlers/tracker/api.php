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

		public function buy($form_data) {
			$current_date = $this->mysqlNow();
			try {
				$stmt = $this->db->prepare("INSERT INTO `tracker` (`p_id`, `u_id`, `amount`, `p_date`) VALUES (:p_id, :u_id, :amount, :p_date)");
				$result = $stmt->execute( array(
					'p_id' => $form_data['product_id'],
					'u_id' => $form_data['user_id'],
					'amount' => $form_data['product_amount'],
					'p_date' => $current_date
				));

				// Update user's balance
				if($result) {
					$this->updateUserAccount($form_data);
				}

				$data = array('result' => "success", "result_msg" => $result );
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
			return $data;		
		}

		public function pay($form_data) {
			$current_date = $this->mysqlNow();
			try {

				$stmt = $this->db->prepare("INSERT INTO `balance` (`u_id`, `amount`, `date_modified`) VALUES (:u_id, :amount, :date_modified) ON DUPLICATE KEY UPDATE `amount` = VALUES (:amount, :date_modified)");
				$result = $stmt->execute( array(
					'u_id' => $form_data['user_id'],
					'amount' => $form_data['product_amount'],
					'date_modified' => $current_date
				));
				
				$data = array('result' => "success", "result_msg" => $result );
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
			return $data;
		}

		//Helper Function
		public function updateUserAccount($form_data){
			$current_date = $this->mysqlNow();
			try {
				$stmt = $this->db->prepare("INSERT INTO `balance` (`u_id`, `amount`, `date_modified`) VALUES (:u_id, :amount, :date_modified) ON DUPLICATE KEY UPDATE `amount` = VALUES (:amount, :date_modified)");
				$result = $stmt->execute( array(
					'u_id' => $form_data['user_id'],
					'amount' => $form_data['product_amount'],
					'date_modified' => $current_date
				));
			} catch (PDOException $e) {
				$data = array('result' => "error", "result_msg" => $e->getMessage() );
			}
		}

		public function mysqlNow(){
			$stmt = $this->db->prepare("SELECT NOW()");
			$stmt->execute( array() );
			$now = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $now[0]['NOW()'];
		}

	}
