<?php 

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

	<title><?= $title ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php include('header.php') ?>

	<div class="container">

		<div class='row'>
			<div class='col-5'>
				<?= "<img height='400px' width='100%' src='{$profile['image_url']}'>" ?>
				<div class='container profileBox'>
					<h1><?= $profile['name'] ?></h1>
					<p>
						<span class='profInfo'>Alias: </span>
						<?= $profile['alias'] ?>
					</p>
					<p>
						<span class='profInfo'>First Appearance: </span>
						<?= $profile['first_appearance'] ?>
					</p>
					<p>
						<span class='profInfo'>About Me: </span>
						<?= $profile['about_me'] ?>
					</p>
					<p>
						<span class='profInfo'>Attributes: </span>
					</p>
					<ul>

						<?php foreach(getAbilities($id) as $ability) : ?>
							<li><?=$ability['ability'] ?></li>
						<?php endforeach; ?>

					</ul>
				</div>
			</div>
			<div class='col-7 bio'>
				<div class='container bioBox'>
					<h1 class='text-center'>Biography</h1>
					<br />
					<p><?= $profile['biography'] ?></p>
				</div>

			</div>
		</div>

	</div>

</body>
</html>