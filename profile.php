<?php 

	include('header.php');
	include('database.php');

	$id = intval(htmlentities($_GET["id"]));

	function getProfile($id) {
      $sql = "select * from heroes where id=" . $id;

      $request = pg_query(getDb(), $sql);
      return pg_fetch_assoc($request);
    }

    function getAbilities($hero_id) {
    	$sql = "SELECT ability FROM abilities 
				RIGHT JOIN hero_abilities ON abilities.id=hero_abilities.abilities_id
				WHERE hero_id=" . $hero_id;
    	$request = pg_query(getDb(), $sql);
      	return pg_fetch_all($request);
    }

    $profile = getProfile($id);

    $title = $profile['name'];

	?>

<!DOCTYPE html>
<html>
<head>

	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>


	<div class="container-fluid">

	<?php 

		echo "<div class='row'>";

		echo "<div class='col-5'>";
		echo "<img height='400px' width='100%' src='" . $profile['image_url'] . "'>";
		echo "<div class='container profileBox'>";
		echo "<h1>" . $profile['name'] . "</h1>";
		echo "<p><span class='profInfo'>Alias: </span>" . $profile['alias'] . "</p>";
		echo "<p><span class='profInfo'>First Appearance: </span>" . $profile['first_appearance'] . "</p>";
		echo "<p><span class='profInfo'>About Me: </span>" . $profile['about_me'] . "</p>";
		echo "<p><span class='profInfo'>Attributes: </span></p>";
		echo "<ul>";

		foreach (getAbilities($id) as $ability) {
			echo "<li>" . $ability['ability'] . "</li>";
		}

		echo "</ul>";
		echo "</div>";
		echo "</div>";

		echo "<div class='col-7 bio'>";
		echo "<div class='container bioBox'>";
		echo "<h1 class='text-center'>Biography</h1>";
		echo "<br />";
		echo "<p>" . $profile['biography'] . "</p>";
		echo "</div>";

		echo "</div>";
		echo "</div>"; 

	?>

	</div>

</body>
</html>