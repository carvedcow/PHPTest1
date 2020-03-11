<?php
	/* HUGE MESS
	// values
	$invalidForm = false;
	$hasInputs = false;
	$errors = array();
	$ValidHoliday = ["Valentine's Day", "Mother's Day", "Canada Day", "Thanksgiving", "Halloween"];
	// functions
	// controller
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		// isset for all fields
		// if (isset($_POST['name1']) && isset($_POST['color'])) {
		// 	$hasInputs = true;
		// }
		// else
		// 	$hasInputs = false;
		// if (isset($_POST['noun']) && isset($_POST['food'])) {
		// 	$hasInputs = true;
		// }
		// else
		// 	$hasInputs = false;
		// if (isset($_POST['pNoun']) && isset($_POST['holiday'])) {
		// 	$hasInputs = true;
		// }
		// else
		// 	$hasInputs = false;
		// if (isset($_POST['number']) && isset($_POST['name2'])) {
		// 	$hasInputs = true;
		// }
		// else
		// 	$hasInputs = false;
		// if (isset($_POST['occupation'])) {
		// 	$hasInputs = true;
		// }
		// else
		// 	$hasInputs = false;

		// validate if there are inputs
		//if ($hasInputs) {

			
			// validate name1
			if (isset($_POST['name1']) === false) {
				$invalidForm = true;
				$errors[] = "requires person 1's name";
			}
			// validate color
			if (isset($_POST['color']) === false) {
				$invalidForm = true;
				$errors[] = "requires a color";
			}
			// validate noun
			if (isset($_POST['noun']) === false) {
				$invalidForm = true;
				$errors[] = "requires a noun";
			}
			// validate food
			if (isset($_POST['food']) === false) {
				$invalidForm = true;
				$errors[] = "requires a food";
			}
			// validate PluralNoun
			if (isset($_POST['pNoun']) === false) {
			$invalidForm = true;
			$errors[] = "requires a plural noun";
			}
			// validate Holiday
			if (isset($_POST['holiday']) === false || in_array($_POST['holiday'], $ValidHoliday)) {
				$invalidForm = true;
				$errors[] = "requires a holiday and holiday must be either 'Valentine's Day', 'Mother's Day', 'Canada Day', 'Thanksgiving' or 'Halloween'";
			}
			// validate number
			if (isset($_POST['number']) === false || filter_var($_POST['number'], FILTER_VALIDATE_INT)) {
				$invalidForm = true;
				$errors[] = "requires a number and number must be an integer";
			}
			// validate name2
			if (isset($_POST['name2']) === false) {
				$invalidForm = true;
				$errors[] = "requires person 2's name";
			}
			// validate occupation
			if (isset($_POST['occupation']) === false) {
				$invalidForm = true;
				$errors[] = "requires occupation";
			}
		//}	
	}
*/

// values
$display = false;
$hasInputs = false;
$name1 = "";
$color = "";
$noun = "";
$food = "";
$pluralNoun = "";
$holiday = "";
$number = 0;
$name2 = "";
$occupation = "";
$errors = array();
$ValidHolidays = ["Valentine's Day", "Mother's Day", "Canada Day", "Thanksgiving", "Halloween"];
// functions
function isRequired($string) {
	$updatedString = $string." is required.";
	return $updatedString;
}

// controllers
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	//validation
	if (empty($_POST['name1'])) {
		$errors[] = "Person 1's name is required.";
	} else {
		$name1 = ucfirst(strtolower($_POST['name1']));
		$hasInputs = true;
	}

	if (empty($_POST['color'])) {
		$errors[] = isRequired("Color");
	} else {
		$color = $_POST['color'];
		$hasInputs = true;
	}

	if (empty($_POST['noun'])) {
		$errors[] = isRequired("Noun");
	} else {
		$noun = $_POST['noun'];
		$hasInputs = true;
	}

	if (empty($_POST['food'])) {
		$errors[] = isRequired("Food");
	} else {
		$food = $_POST['food'];
		$hasInputs = true;
	}

	if (empty($_POST['pNoun'])) {
		$errors[] = isRequired("Plural noun");
	} else {
		$pNoun = $_POST['pNoun'];
		$hasInputs = true;
	}

	if (empty($_POST['holiday'])) {
		$errors[] = isRequired("Holiday");
	} else {
		$hasInputs = true;
		if (in_array($_POST['holiday'], $ValidHolidays)) {
			$holiday = $_POST['holiday'];
		} else {
			$errors[] = "Only \"Valentine's Day\", \"Mother's Day\", \"Canada Day\", \"Thanksgiving\" and \"Halloween\" is allowed as a holiday.";
		}
		
	}

	if (empty($_POST['number'])) {
		$errors[] = isRequired("Number");
	} else {
		$hasInputs = true;
		if (filter_var($_POST['number'], FILTER_VALIDATE_INT)) {
			$number = $_POST['number'];
		} else {
			$errors[] = isRequired("Valid Integer for number");
		}
	}

	if (empty($_POST['name2'])) {
		$errors[] = isRequired("Person 2's name");
	} else {
		$hasInputs = true;
		$pNoun = ucfirst(strtolower($_POST['name2']));
	}

	if (empty($_POST['occupation'])) {
		$errors[] = isRequired("Occupation");
	} else {
		$hasInputs = true;
		$occupation = $_POST['occupation'];
	}

	$display = true;
	$name1 = ucfirst(strtolower($_POST['name1']));
	$color = $_POST['color'];
	$noun = $_POST['noun'];
	$food = $_POST['food'];
	$pNoun = $_POST['pNoun'];
	$holiday = $_POST['holiday'];
	$number = $_POST['number'];
	$name2 = ucfirst(strtolower($_POST['name2']));
	$occupation = $_POST['occupation'];

	//$display = true;
	if (empty($errors)) {
	//if ($display) {
		//echo "success";
		// log all variables into .log file
		file_put_contents("madlibs/".time().".log", "$name1\n$color\n$noun\n$food\n$pNoun\n$holiday\n$number\n$name2\n$occupation");
		
		header("Location: single.php?filename=".time());
	}
	elseif ($hasInputs) {
		foreach ($errors as $key => $val) {
			echo "$val\n";
		}
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create a Mad Lib</title>
</head>
<body>
	<h1>Please enter the following: </h1>
	<br>
	<form action="create.php" method="POST" enctype="multipart/form-data">
		<label for="txtPerson1Name">Person 1's name: </label><input type="text" name="name1" id="txtPerson1Name"><br/>
		<label for="txtColor">Color: </label><input type="text" name="color" id="txtColor"><br/>
		<label for="txtNoun">Noun: </label><input type="text" name="noun" id="txtNoun"><br/>
		<label for="txtFood">Food: </label><input type="text" name="food" id="txtFood"><br/>
		<label for="txtPluralNoun">Plural Noun: </label><input type="text" name="pNoun" id="txtPluralNoun"><br/>
		<label for="txtHoliday">Holiday: </label><input type="text" name="holiday" id="txtHoliday"><br/>
		<label for="txtNumber">Number: </label><input type="text" name="number" id="txtNumber"><br/>
		<label for="txtPerson2Name">Person 2's name: </label><input type="text" name="name2" id="txtPerson2Name"><br/>
		<label for="txtOccupation">Occupation: </label><input type="text" name="occupation" id="txtOccupation"><br/>
		<br>
		<button type="submit" name="btnCreateML">Create Mad Lib</button>
	</form>
<?php ?>
</body>
</html>