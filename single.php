<?php
	//values
	$filenameFromGet = $_GET['filename'];
	$convertedTime = strtoupper(date("Y F d", $filenameFromGet));
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Preview a Mad Lib</title>
	</head>
	<body>
		<?php
			$lines = file("madlibs/$filenameFromGet.log");
			$name1 = trim($lines[0]);
			$color = trim($lines[1]);
			$noun = trim($lines[2]);
			$food = trim($lines[3]);
			$pluralNoun = trim($lines[4]);
			$holiday = trim($lines[5]);
			$number = trim($lines[6]);
			$name2 = trim($lines[7]);
			$occupation = trim($lines[8]);

			if (!is_null($name1) && !empty($name1)) {
		?>

<pre> <?php
echo "
Dear $name1,\n
\n
Thanks for ordering via the $color $noun Candy Company website.\n
Unfortunately, your $food flavoured snacks are no longer available because $pluralNoun accidentally fell into our mixer.\n
We apologize for the inconvenience.\n
Since you were ordering these for a party to celebrate $holiday, we are offering you a discount of $number dollars instead.\n
\n
Sincerely,\n
$name2,  $occupation   \n";
		?> </pre>

		<hr>
		<br>
		<p>Created on <?php echo "$convertedTime" ?></p>
		<a href="index.php">Back to Index</a>
			<?php }
			else {
				header("Location:index.php");
			}
			?>
	</body>
</html>