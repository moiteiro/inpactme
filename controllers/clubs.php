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
$object = "club";
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
require_once(MODEL_PATH.DS."player.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		$output = array();

		if (isset($params['id'])) {

			$club = $Class::find_by_id($params['id']);
			$output = $club->attributes();

			unset($output['foundation_date']);

			$output['captain'] = 0;
			$output['firstTeam'] = array();
			$output['reserveTeam'] = array();

			$output['overall'] = $Class::get_overall($club->id);

			$output['foundationDate'] = date_format_DMY($club->foundation_date);

			$players = $Class::get_players($params['id']);
			
			foreach($players as $player) {
				if ($player['situation'] == Player::first_team) {
					$output['firstTeam'][] = $player['player_id'];
				} else if ($player['situation'] == Player::reserve_team) {
					$output['reserveTeam'][] = $player['player_id'];
				}

				if ($player['captain'] == Player::captain) {
					$output['captain'] = $player['player_id'];
				}
			}

		} else {

			$clubs = $Class::find_all();
			foreach($clubs as $club) {

				$overall = $Class::get_overall($club->id);

				$output[] = array("id" => $club->id,
								  "name" => $club->name,
								  "foundationDate" => date_format_DMY($club->foundation_date),
								  "overall" => $overall);
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
		$params['foundation_date'] = date_format_YMD($params['foundation_date']);

		if (!isset($params['first_team']) || !is_array($params['first_team'])) {
			$params['first_team'] = array();
		}

		if (!isset($params['reserve_team']) || !is_array($params['reserve_team'])) {
			$params['reserve_team'] = array();
		}

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

		$Class::set_players($params['first_team'], $params['reserve_team'], $params['captain'], $$object->id);

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

		$first_team = array();
		$reserve_team = array();

		foreach($input as $entry) {
			$aux = explode('=', $entry);
			$params[$aux[0]] = urldecode($aux[1]);

			if (strpos($aux[0], 'first') !== 0) {
				echo $aux[0];
				echo "<br>";
			}
		}
		
		print_r($params);
		exit();
		$output = array();

		$$object = $Class::find_by_id($params['id']);

		$db_fields = $$object->get_attributes_type();

		foreach($db_fields as $attribute=>$type)
			if(isset($obj->$attribute))
				$params[$attribute] = $obj->$attribute;


		/********************
			Tratando Datas
		*********************/
		$params['foundation_date'] = date_format_YMD($params['foundation_date']);
		

		// campos da tabela que não serão avalidados
		$not_evaluate = array();
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
		echo $$object;
		
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