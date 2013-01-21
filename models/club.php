<?php

class Club extends DatabaseObject{
	
	public $id;
	public $name;
	public $foundation_date;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "clubs";
	protected static $db_fields = array(	
										"id"              => INTEGER,
										"name"            => STRING,
										"foundation_date" => STRING,
										);

	/**
	 * Cria a relacao de jogados com clubs.
	 * @access public
	 * @param $players array
	 * @param $club integer
	 */
	public static function set_players($first_players, $reserve_players, $captain, $club_id) {
		global $database;

		self::clear_players_set($club_id);
		foreach($first_players as $player) {
			$query = sprintf("INSERT INTO players_to_club(player_id, club_id, situation) VALUES('%s', '%s', 2)",
							$database->escape_value($player),
							$database->escape_value($club_id));
			$database->query($query);
		}

		foreach($reserve_players as $player) {
			$query = sprintf("INSERT INTO players_to_club(player_id, club_id, situation) VALUES('%s', '%s', 3)",
							$database->escape_value($player),
							$database->escape_value($club_id));
			$database->query($query);
		}

		self::set_captains_club($captain, $club_id);
	}


	/**
	 * Retorna todos os jogadores de um club.
	 * @access public
	 * @param $club_id string
	 */
	public static function get_players($club_id) {
		global $database;

		$query = sprintf("SELECT player_id, situation, captain FROM players_to_club WHERE club_id = %s", $database->escape_value($club_id));

		return $database->result_to_array($database->query($query));
	}

	/**
	 * Seta o jogador como captain
	 * @access public
	 */
	public static function set_captains_club($captain_id, $club_id) {
		global $database;

		$query = sprintf("UPDATE players_to_club SET captain = 1 WHERE player_id = %s AND club_id = %s LIMIT 1",
						 $database->escape_value($captain_id),
						 $database->escape_value($club_id));

		$database->query($query);
	}

	/**
	 * Retorna a "forca" de cada club.
	 */
	public static function get_overall($club_id) {
		global $database;

		$query = sprintf("SELECT SUM(acceleration + stamina + aggression + marking + balance) as overall, 
								 count(id) as total  
						  FROM `players` 
						  RIGHT JOIN players_to_club 
						  ON players.id = players_to_club.player_id 
						  WHERE players_to_club.club_id = %s 
						  AND situation = 2
						  LIMIT 6",
						 $database->escape_value($club_id));

		$result = $database->fetch_array($database->query($query));

		return $result['total'] > 0 ? (int)$result['overall'] : 0;
	}

	/**
	 * Limpa remove todas as relacoes entre um e time e seus jogadores.
	 */
	protected static function clear_players_set($club) {
		global $database;
		$query = sprintf('DELETE FROM players_to_club WHERE club_id = %s', $database->escape_value($club));
		$database->query($query);
		return ($database->affected_rows() >= 1) ? true : false;
	}

}

?>