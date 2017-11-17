<?php
	require_once ( 'api.php' );

	if( !$_REQUEST['action']){
		$result = array('result' => "error", "result_msg" => "Action type is not given!" );
		echo json_encode($result);
		return false;		
	} else {
		$action = $_REQUEST['action'];
	}
	
	$api = new API();

	switch ($action) {
		case 'buy':
			if( isset( $_REQUEST['user_id'] ) ){
				$user_id = $_REQUEST['user_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "User id is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['product_id'] ) ){
				$product_id = $_REQUEST['product_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_id" => $user_id,
				"product_id" => $product_id
			);			
			$result = $api->buy($form_data);
		break;

		case 'pay':
			if( isset( $_REQUEST['user_id'] ) ){
				$user_id = $_REQUEST['user_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "User id is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['amount'] ) ){
				$amount = $_REQUEST['amount'];
			} else {
				$result = array('result' => "error", "result_msg" => "Amount id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_id" => $user_id,
				"amount" => $amount
			);
			
			$result = $api->pay($form_data);
		break;

		case 'get_status_by_user':
			if( isset( $_REQUEST['user_id'] ) ){
				$user_id = $_REQUEST['user_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"user_id" => $user_id
			);
			$result = $api->getStatusByUserId($form_data);
		break;		

		case 'get_status':
			$result = $api->getStatus();
		break;	
		
		default:
			$result = array('result' => "error", "result_msg" => "Action type is not recognized!" );
		break;
	}
	
	echo json_encode( $result );
	