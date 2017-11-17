<?php
	require_once ( 'api.php' );

	if( !$_REQUEST['action']){
		$result = array('result' => "error", "result_msg" => "Action type is not recognized!" );
		echo json_encode($result);
		return false;		
	} else {
		$action = $_REQUEST['action'];
	}
	
	$api = new API();

	switch ($action) {
		case 'add_snacker':
			if( isset( $_REQUEST['user_name'] ) ){
				$user_name = $_REQUEST['user_name'];
			} else {
				$result = array('result' => "error", "result_msg" => "User name is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['account_name'] ) ){
				$account_name = $_REQUEST['account_name'];
			} else {
				$result = array('result' => "error", "result_msg" => "Account name is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['account_type'] ) ){
				$account_type = $_REQUEST['account_type'];
			} else {
				$result = array('result' => "error", "result_msg" => "Account type is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_name" => $user_name,
				"account_name" => $account_name,
				"account_type" => $account_type
			);
			
			$result = $api->addSnacker($form_data);
		break;

		case 'deactivate_snacker':
			if( isset( $_REQUEST['user_id'] ) ){
				$user_id = $_REQUEST['user_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "User id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_id" => $user_id
			);
			
			$result = $api->deactivateSnacker($form_data);
		break;

		case 'delete_snacker':
			if( isset( $_REQUEST['user_id'] ) ){
				$user_id = $_REQUEST['user_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "User id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_id" => $user_id
			);
			
			$result = $api->deleteSnacker($form_data);
		break;


		default:
			$result = array('result' => "error", "result_msg" => "Action type is not recognized!" );
		break;
	}
	
	echo json_encode( $result );
	