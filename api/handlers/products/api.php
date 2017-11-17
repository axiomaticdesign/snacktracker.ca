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

					$form_data = array(
				"product_name" => $product_name,
				"" => $product_price,
				"product_quantity" => $product_quantity
			);

		public function addProduct($form_data) {
			$current_date = $this->mysqlNow();
			$active_status = 1;
			$photo = 1;
			try {
				$stmt = $this->db->prepare("INSERT INTO `products` (`name`, `price`, `quantity`, `status`, `photo`, `date_created`) VALUES (:name, :price, :quantity, :status, :photo, :date_created)");
				$result = $stmt->execute( array(
					'name' => $form_data['product_name'],
					'price' => $form_data['product_price'],
					'quantity' => $form_data['product_quantity']
					'status' => $active_status,
					'photo' => $photo,
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
				$stmt = $this->db->prepare("UPDATE `products` SET  `products`.`status` = :deactivate WHERE `products`.`p_id` = :p_id");			
				$result = $stmt->execute( array(
					'deactivate' => $deactivate, 
					'p_id' => $form_data['product_id']
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
