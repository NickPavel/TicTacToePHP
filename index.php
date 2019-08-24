<?php require('functions.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/ico" href="favicon.ico" />
		<link rel="stylesheet" href="style.css">
		<title>TicTacToe2</title>
	</head>
	<body>
		<fieldset>
			<header>
				<br>
				<h1>Tic-Tac-Toe</h1>
				<br>
				<hr>
				<br>
			</header>
<?php if ($win == 'T') echo '<h2>'.$array[$winner[0]].' wins!</h2><br>'; ?>
<?php if ($tie == 'T') echo '<h2>It\'s a tie!</h2><br>'; ?>
			<table>
<?php for ($i = 0; $i <= 8; $i++) {
	if ($i % 3 == 0) { ?>
				<tr>
<?php } if (($array[$i] == '') && ($turn == 'X') && ($win == 'F')) { ?>
					<td>
						<form method="post" action="./">
							<input type="hidden" name="index" value="<?= $i ?>">
							<input class="grid" type="submit" value="S">
						</form>
					</td>
<?php } elseif ($array[$i] == '') { ?>
					<td style="opacity:0;">S</td>
<?php } else { ?>
					<td><?= $array[$i] ?></td>
<?php } if (($i + 1) % 3 == 0) { ?>
				</tr>
<?php }} ?>
			</table>
<?php if (($tie == 'T') || ($win == 'T')) { ?>
			<br>
			<form method="post" action="./">
				<input type="hidden" name="new" value="new">
				<input type="submit" value="NEW GAME">
			</form>
<?php } ?>
			<footer>
				<br>
				<hr>
				<p><a href="https://github.com/NickPavel/TicTacToePHP">HTML, CSS, PHP</a></p>
			</footer>
		</fieldset>
	</body>
</html>
