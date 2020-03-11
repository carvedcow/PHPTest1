<?php

// values

// functions
/**
 * Retrieve all the files in the specified folder.
 *
 * @param string $directory	Directory to be search
 * @return array List of all files in the specified directory
 */
function listFilesInDirectory($directory){
	$files = array();
	if ( is_dir($directory) ){
		$tmp_files = scandir($directory);
		$path = $path = rtrim($directory, '/') . '/';
		foreach ($tmp_files as $f) if (is_file($path . $f)) array_push($files, $f);
	}else{
		throw new Error("DIRECTORY NOT FOUND. Check that you are using the correct path.");
		die();
	}
	return $files;
} 
// --- YOU SHOULD HAVE HAVE TO MODIFY ANYTHING IN THIS FUNCTION
// --- You are not obligated to use this function

// controllers
if ($_SERVER['REQUEST_METHOD'] == "GET") {

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mad Lib</title>
</head>
<body>
	<?php
		$madLibFiles = listFilesInDirectory("madlibs/");
		foreach($madLibFiles as $file) {
			$filename = basename($file);
			$splitStringArray = explode(".", $filename);
			$convertedTime = date("d-M-y H:i", $splitStringArray[0]);
			echo "Filename: "?> <a href=<?php echo "single.php?filename=$filename"?>><?php echo "$filename"?></a><?php echo " --- Date Created: $convertedTime<br>";
		}

	?>
	<!-- <form method="GET" action="single.php">
		<input type="hidden" name="fileName" value="<?php //echo "$filename"?>">
		<input type="submit" name="test">
	</form> -->
	<hr>
	<br>
	<a href="create.php">Create a new Mad Lib</a>
</body>
</html>