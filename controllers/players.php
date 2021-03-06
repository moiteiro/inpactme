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
$object = "player";
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

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		$output = array();

		if (isset($params['id'])) {
			$player = $Class::find_by_id($params['id']);
			$output = $player->attributes();
			unset($output['first_name']);
			unset($output['last_name']);
			unset($output['position']);
			unset($output['shirt_number']);


			$output['name'] = array('first' => $player->first_name, "last" => $player->last_name);
			$output['shirtNumber'] = (int)$player->shirt_number;
			$output['fieldPosition'] = (int)$player->position;

			$output['characteristics'] = array("acceleration" => $player->acceleration,
											   "stamina" => $player->stamina,
											   "aggression" => $player->aggression,
											   "marking" => $player->marking,
											   "balance" => $player->balance);

			if ($output['gender'] == 1) {
				$output['gender'] = "Male";
			} else if ($output['gender'] == 2) {
				$output['gender'] = "Female";
			} else {
				$output['gender'] = "Other";
			}

			if ($output['fieldPosition'] == 1) {
				$output['fieldPosition'] = "GoalKeeper";
			} else if ($output['fieldPosition'] == 2) {
				$output['fieldPosition'] = "Defender";
			} else if ($output['fieldPosition'] == 3) {
				$output['fieldPosition'] = "Midfielder";
			} else if ($output['fieldPosition'] == 4) {
				$output['fieldPosition'] = "Attacker";
			} else {
				$output['fieldPosition'] = "";
			}

		} else {

			$players = $Class::find_all();
			
			foreach($players as $player) {

				$overall = $player->acceleration + $player->stamina + $player->aggression + $player->marking + $player->balance;
				$club = $Class::get_club_name($player->id);

				$output[] = array("id" => $player->id,
								  "name" => array("first" => $player->first_name, "last" => $player->last_name ),
								  "age" => $player->age,
								  "overall" => $overall,
								  "club" => $club);
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

		// campos da tabela que não serão avalidados
		$not_evaluate = array("id");
		$validation->avoid_fields($not_evaluate);
		
		// validando os dados submetidos
		$validation->validate_fields($params, $db_fields);
		
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

		// campos da tabela que não serão avalidados
		$not_evaluate = array();
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