<?php function getDb() {

			$raw_url = 'postgres://ibxqbxmakaeptv:cb99fc2b41e6e9ab6cb6b6514f7cc21ac7b186b579d4a5c3f7ca9cf0fd42cd6a@ec2-184-73-159-137.compute-1.amazonaws.com:5432/d652anc14vc3r';

			$url = parse_url($raw_url);

			$db_port = $url['port'];
			$db_host = $url['host'];
			$db_user = $url['user'];
			$db_pass = $url['pass'];
			$db_name = substr($url['path'], 1);

			$db = pg_connect(
			"host=" . $db_host .
			" port=" . $db_port .
			" dbname=" . $db_name .
			" user=" . $db_user .
			" password=" . $db_pass
			);

			return $db;

		}

?>