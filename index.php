<!DOCTYPE html>
<html>
<head>
	<title>Herobook</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">

	<?php 

		function getDb() {

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

		function getHeroes() {
			$request = pg_query(getDb(), "
				SELECT name, alias, about_me, image_url FROM heroes;

			");

			return pg_fetch_all($request);
		}

	?>




	<h1 class="text-center">Herobook</h1>
	<p class="text-center">A social networking platform for superheroes</p>

	<table class="table">
		<tr>
			<th></th>
			<th>Name</th>
			<th>Alias</th>
			<th>About Me</th>
		</tr>

	<?php 

		foreach (getHeroes() as $hero) {
			echo "<tr>";
			echo "<td><img height='100px' width='100px' src='" . $hero['image_url'] . "'></td>";
			echo "<td>" . $hero['name'] . "</td>";
			echo "<td>" . $hero['alias'] . "</td>";
			echo "<td>" . $hero['about_me'] . "</td>";
			echo "</tr>";
		}
	?>

	</table>


</body>
</html>