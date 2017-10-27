<!DOCTYPE html>
<html>
<head>
	<title>Herobook</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php 

		include('database.php');

		function getHeroes() {
			$request = pg_query(getDb(), "
				SELECT id, name, alias, about_me, image_url FROM heroes;

			");

			return pg_fetch_all($request);
		}

	?>




	<?php include('header.php');?>

	<div class="container-fluid">

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
			echo "<td class='align-middle'><a href='./profile.php?id=" . $hero['id'] . "'>" . $hero['name'] . "</td>";
			echo "<td class='align-middle'>" . $hero['alias'] . "</td>";
			echo "<td class='align-middle'>" . $hero['about_me'] . "</td>";
			echo "</tr>";
		}
	?>

	</table>

</div>

</body>

</html>