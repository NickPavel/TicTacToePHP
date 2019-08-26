<?php require('script.php'); ?>
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
		<div class="top">
			<div class="one">Score:&nbsp;&nbsp;</div>
			<div class="one">X = <?= $_SESSION['xpoints'] ?>,&nbsp;&nbsp;</div>
			<div class="one">O = <?= $_SESSION['opoints'] ?>,&nbsp;&nbsp;</div>
			<div class="one">Ties = <?= $_SESSION['tiepoints'] ?></div>
		</div>
		<div class="top">
			<div class="one">
				<form method="post" action="./">
					<input type="hidden" name="reset" value="7">
					<input class="two" type="submit" value="Reset">
				</form>
			</div>
			<div class="one">&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div class="one">
				<form method="post" action="./">
					<input type="hidden" name="switch" value="7">
					<input class="two" type="submit" value="Switch Turns: <?= $_SESSION['switch'] ?>">
				</form>
			</div>
		</div>
<?php if ($_SESSION['switch'] == 'No') { ?>
		<div class="top">
			<div class="one">
				<form method="post" action="./">
					<input type="hidden" name="start" value="7">
					<input class="two" type="submit" value="Play <?= $_SESSION['start'] ?>">
				</form>
			</div>
		</div>
<?php } ?>
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
			<p>X = Player, O = Computer</p>
			<br>
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
				<input type="hidden" name="new" value="7">
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
