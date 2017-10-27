<!DOCTYPE html>
<html>
<head>

	<title><?php $profile['name']?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php 

	include('header.php');
	include('database.php');

	$id = intval(htmlentities($_GET["id"]));

	function getProfile($id) {
      $sql = "select * from heroes where id=" . $id;
      $request = pg_query(getDb(), $sql);
      return pg_fetch_assoc($request);
    }

    $profile = getProfile($id);

	?>

	<div class="container-fluid">

	<?php 

		echo "<div class='row'>";

		echo "<div class='col'>";
		echo "<img height='400px' width='400px' src='" . $profile['image_url'] . "'>";
		echo "<h1>" . $profile['name'] . "</h1>";
		echo "<p><span class='profInfo'>Alias: </span>" . $profile['alias'] . "</p>";
		echo "<p><span class='profInfo'>First Appearance: </span>" . $profile['first_appearance'] . "</p>";
		echo "<p><span class='profInfo'>About Me: </span>" . $profile['about_me'] . "</p>";
		echo "</div>";

		echo "<div class='col bio'>";
		echo "<h1>Biography</h1>";
		echo "<br />";
		echo "<p>" . $profile['biography'] . "</p>";
		echo "</div>";

		echo "</div>"; 

	?>

	</div>

</body>
</html>