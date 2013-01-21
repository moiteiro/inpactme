<?php

class Match extends DatabaseObject{
	
	public $id;
	public $host_id;
	public $guest_id;
	public $host_score;
	public $guest_score;
	public $date;
	public $time;
	public $location;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "matches";
	protected static $db_fields = array(	
										"id"          => INTEGER,
										"host_id"     => INTEGER,
										"guest_id"    => INTEGER,
										"host_score"  => INTEGER,
										"guest_score" => INTEGER,
										"date"        => STRING,
										"time"        => STRING,
										"location"    => STRING
										);

}

?>