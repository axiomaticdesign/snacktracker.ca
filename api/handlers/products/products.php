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
		case 'add_product':
			if( isset( $_REQUEST['product_name'] ) ){
				$product_name = $_REQUEST['product_name'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product name is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['product_price'] ) ){
				$product_price = $_REQUEST['product_price'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product price is missing" );
				echo json_encode($result);
				return false;	
			}
			if( isset( $_REQUEST['product_quantity'] ) ){
				$product_quantity = $_REQUEST['product_quantity'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product quantity is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"product_name" => $product_name,
				"product_price" => $product_price,
				"product_quantity" => $product_quantity
			);			
			$result = $api->addProduct($form_data);
		break;

		case 'deactivate_product':
			if( isset( $_REQUEST['product_id'] ) ){
				$product_id = $_REQUEST['product_id'];
			} else {
				$result = array('result' => "error", "result_msg" => "Product id is missing" );
				echo json_encode($result);
				return false;	
			}
			$form_data = array(
				"product_id" => $product_id
			);
			
			$result = $api->deactivateSnacker($form_data);
		break;

		default:
			$result = array('result' => "error", "result_msg" => "Action type is not recognized!" );
		break;
	}
	
	echo json_encode( $result );
	