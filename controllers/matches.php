<?php
header("Content-Type: application/json");

// *****************//
// Controller Config
// *****************//

// para acessos via JSON.
if(!defined("MODEL_PATH"))
	require_once("../includes/config.php");

// Object Name
// ************
$object = "match";
$objects = get_filename(__FILE__);


// Class Name
// ************
$Class = ucfirst($object);


// XML - Basci Struture
// ************
$father_node = $objects;
$child_node = $object;


// inclua todas as classes necessárias
require_once(MODEL_PATH.DS."{$object}.php");
require_once(MODEL_PATH.DS."club.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		$output = array();

		if (isset($params['id'])) {
			$match = $Class::find_by_id($params['id']);
			$output = $match->attributes();
			unset($output['host_name']);
			unset($output['host_id']);
			unset($output['guest_name']);
			unset($output['guest_id']);

			$host = Club::find_by_id($match->host_id);
			$guest = Club::find_by_id($match->guest_id);

			$output["host"] = array("id" => $host->id, "name" => $host->name, "score" => $match->host_score);
		  	$output["guest"] = array("id" => $guest->id, "name" => $guest->name, "score" => $match->guest_score);

		} else {

			$today = date('Y-m-d');
			$matches = $Class::find_all();

			foreach($matches as $match) {

				$host = Club::find_by_id($match->host_id);
				$guest = Club::find_by_id($match->guest_id);

				if (!$host || !$guest) {
					continue;
				}

				if ($today <= $match->date) {
					$status = "Scheduled";
				} else if ($match->host_score == "" && $match->guest_score == "") {
					$status = "Waiting for results";
				} else {
					$status = "";
				}
				

				$output[] = array("id" => $match->id,
								  "host" => array("id" => $host->id, 
								  					"name" => $host->name, 
								  					"score" => $match->host_score),
								  "guest" => array("id" => $guest->id, "name" => $guest->name, "score" => $match->guest_score),
								  "date" => date_format_DMY($match->date),
								  "location" => $match->location,
								  "status" => $status);
			}
		}

		$output = json_encode($output);
		echo $output;

	break;
	
	case "POST":

		$output = array();

		$$object = new $Class();
		$db_fields = $$object->get_attributes_type();

		foreach($db_fields as $attribute=>$type)
			if(isset($obj->$attribute))
				$params[$attribute] = $obj->$attribute;

		/********************
			Tratando Datas
		*********************/
		
		$params['date'] = date_format_YMD($params['date']);

		// campos da tabela que não serão avalidados
		$not_evaluate = array("id");
		$validation->avoid_fields($not_evaluate);
		
		// validando os dados submetidos
		#$validation->validate_fields($params, $db_fields);
		
		// ver o resultado das validações
		#echo $validation->get_validation_result(); exit();
		
		if($validation->get_errors() != 0) {

			$output = json_encode($output);
			echo $output;
			exit();

		}
		
		$$object->set_attributes($params);

		$result = $$object->create();

		if ($result) {
			$output['bResult'] = true;
		} else {
			$output['bResult'] = false;
		}


		$output = json_encode($output);
		echo $output;

		exit();

	break;
	
	case "PUT":

		$input = file_get_contents("php://input");
		$input = explode('&', $input);

		foreach($input as $entry) {
			$aux = explode('=', $entry);
			$params[$aux[0]] = urldecode($aux[1]);
		}
		

		$output = array();

		$$object = $Class::find_by_id($params['id']);

		$db_fields = $$object->get_attributes_type();

		foreach($db_fields as $attribute=>$type)
			if(isset($obj->$attribute))
				$params[$attribute] = $obj->$attribute;


		/********************
			Tratando Datas
		*********************/

		// campos da tabela que não serão avalidados
		$not_evaluate = array();
		$validation->avoid_fields($not_evaluate);
		
		// validando os dados submetidos
		#$validation->validate_fields($params, $db_fields);
		
		// ver o resultado das validações
		#echo $validation->get_validation_result(); exit();
		
		/*
		if($validation->get_errors() != 0) {

			$output = json_encode($output);
			echo $output;
			exit();

		}
		*/
		
		$$object->set_attributes($params);
		
		$result = $$object->update();

		if ($result) {
			$output['bResult'] = true;
		} else {
			$output['bResult'] = false;
		}


		$output = json_encode($output);
		echo $output;

		exit();

	break;
	
	case "DELETE":

		exit();
		$$object = new $Class();
		$$object->id = $params['id'];
		$$object->delete();
		
	break;
	
}

exit();
?>