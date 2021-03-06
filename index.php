<?php 

	require('database.php');

	$heroes = "SELECT id, name, alias, about_me, image_url FROM heroes";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Bat-Net</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php include('header.php');?>

	<div class="container">

		<table class="table table-hover">

			<tr>
				<th></th>
				<th>Name</th>
				<th>Alias</th>
				<th>About Me</th>
			</tr>

			<?php foreach (dbQuery($heroes) as $hero) : ?>
				<tr>
					<td>
						<?= "<a href='profile.php?id={$hero['id']}'>" ?>
							<?= "<img height='100px' width='100px' src='{$hero['image_url']}'>" ?>
						</a>
					</td>
					<td class='align-middle'>
						<?= "<a href='profile.php?id={$hero['id']}'>" ?>
							<?= $hero['name'] ?>
						</a>
					</td>
					<td class='align-middle'><?= $hero['alias'] ?></td>
					<td class='align-middle'><?= $hero['about_me'] ?></td>
				</tr>
			<?php endforeach; ?>

		</table>

	</div>

</body>
</html>