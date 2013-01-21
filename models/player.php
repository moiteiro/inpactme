<?php

class Player extends DatabaseObject{
	
	public $id;
	public $first_name;
	public $last_name;
	public $age;
	public $gender;
	public $position;
	public $shirt_number;
	public $acceleration;
	public $stamina;
	public $aggression;
	public $marking;
	public $balance;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;

	// enum for players functions
	const goalkeeper = 1;
	const defender = 2;
	const midfielder = 3;
	const attacker = 4;


	const captain = 1;
	const first_team = 2;
	const reserve_team = 3;

	
	protected static $table_name = "players";
	protected static $db_fields = array(	
										"id"           => INTEGER,
										"first_name"   => STRING,
										"last_name"    => STRING,
										"age"          => INTEGER,
										"gender"       => INTEGER,
										"position"     => INTEGER,
										"shirt_number" => INTEGER,
										"acceleration" => INTEGER,
										"stamina"      => INTEGER,
										"aggression"   => INTEGER,
										"marking"      => INTEGER,
										"balance"      => INTEGER,
										);

	/**
	 * Retorna o clube ao qual o jogador pertence
	 */
	public static function get_club_name($player_id) {
		global $database;

		$query = sprintf("SELECT clubs.name 
						  FROM clubs 
						  RIGHT JOIN players_to_club 
						  ON players_to_club.club_id = clubs.id
						  WHERE player_id = %s LIMIT 1", 
					$database->escape_value($player_id));

		$result = $database->fetch_array($database->query($query));

		return $result['name'] ? $result['name'] : "no club";
	}
}

?>