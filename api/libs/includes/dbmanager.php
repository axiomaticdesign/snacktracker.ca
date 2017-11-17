<?php 
	require('dbconfig.php');
	
	class dbmanager extends PDO {
		private $stmt; 
		public function __construct(){
			try{ 
				parent::__construct( DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.CHARSET, DB_USER, DB_PASS );
			} catch( Exception $e ) {
				$result = array('result' => 'error', 'result_msg' => 'Error : DB Configration is wrong.' );
				echo json_encode($result);
				die();
			}
		} 
	}