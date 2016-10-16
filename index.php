<?php
	$errors = [];
	$missing = [];

if(isset($_POST['send'])) {
	$expected =['name', 'email', 'comments'];
	$required = ['name', 'comments'];
	$to = 'Brayan Gallardo <brgallar@uci.edu>';
	$subject = 'Feedback from online form';
	$headers = [];
	$headers[] = 'From: webmaster@example.com';
	$headers[] = 'Cc: another@example.com';
	$headers[] = 'Content-type: text/plain; charset=utf-8';
	$authorized = '-f';
	require 'process.php';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title></title>
	</head>
	<body>
		<?php if ($_POST && ($suspect || isset($errors['mailfail']))) : ?>
		<p class="warning">Sorry, your mail couldn't be sent</p>
		<?php endif;?>

		<?php if ($errors || $missing) : ?>
		<p class="warning">Please fix the item(s) indicated</p>
		<?php endif;?>



		<form method="post" action="<?= $_SERVER['PHP_SELF'];?>" >
			<p>
			<label for="name">Name:
			<?php if ($missing && in_array('name', $missing)) :?>
				<span class="warning">Please enter your name</span>
			<?php endif;?>
			</label>
				<input type="text" name="name" id="name"
					<?php
					if ($errors || $missing) {
						echo 'value="' . htmlentities($name) . '"';
					}
					?>
				>
			</p>



			<p>
			<label for="email">Email:
			<?php if ($missing && in_array('email', $missing)) :?>
				<span class="warning">Please enter your email</span>
			<?php elseif (isset($errors['email'])) : ?>
				<span class="warning">Invalid </span>
			<?php endif;?>
			</label>
				<input type="text" name="email" id="email"
					<?php
					if ($errors || $missing) {
						echo 'value="' . htmlentities($email) . '"';
					}
					?>
				>
			</p>



			<p>
			<label for="comments">Comments:
			<?php if ($missing && in_array('comments', $missing)) :?>
				<span class="warning">Please enter your comment</span>
			<?php endif;?>
			</label>
				<textarea name="comments" id="comments"><?php 
					if ($errors ||  $missing) {
						echo htmlentities($comments);
					}
				?></textarea>
			</p>



			<p>
				<input type="submit" name="send" id="send" value="Send">
			</p>
		</form>
	</body>

</html>