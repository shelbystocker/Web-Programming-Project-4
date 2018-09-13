#!/usr/bin/php

<?php
/*Authors: Jen Lee & Shelby Stocker
 *File: project4.php
 *Date: 4/12/18
 *Project: Project 4 - php
 *Purpose: a very basic web application in PHP that will create a dynamic 
  search form. The PHP script will take user input from theform and perform 
  basic searches on files local to the web server.
  Searches will involve JSON objects stored in those files.
 *Access: http://www.cs.uky.edu/~jmle265/Project4/project4.php
*/

// function to begin html
function start_html() {

	echo "
	<html>
	<head>
	<title>¯\_(ツ)_/¯ <- Paul</title>
	</head>
	<body>
	<h1>Entertainment Database!</h1>
	";

}

// function to end html
function end_html() {

	echo "
	</body>
	</html>
	";
}

// function called after user hits submit
function process_form() {

	start_html();
	
	//get drop down box selections
	$catOption = $_GET["category"];
	$keyOption = $_GET["keyToMatch"];
	$matchOption = $_GET["matchValue"];
	$infoOption = $_GET["infoToProcess"];
	$SorAOption = $_GET["sumOrAvg"];

	//decode Media file
        $MEDIA_file = file_get_contents("./Media.json");
        $Media = json_decode($MEDIA_file, true);
	json_last_error();
	$cat_files = $Media["categories"];
	//store catOption in variable to see if it's changed
	$ogCatOption = $catOption;

	//loop through Media.json to confirm file is a valid
	foreach ($cat_files as $key => $keyValue) {
		if(!is_array($keyValue)) {
			//retrieve data file
			if($key == $catOption) 
				$catOption = $keyValue;
		}	
	}
	//if catOption was not found, return
	if ($catOption == $ogCatOption) {
		echo "Invalid File! Sneaky.";
		return;
	}

	//decode chosen JSON data file
	$DATA_file = file_get_contents($catOption);
	$Data = json_decode($DATA_file, true);
	json_last_error();
	$works = $Data["works"];
	$comments = $Data["comments"];

	//echo comment information
	foreach($comments as $array => $comment) {
		foreach($comments[$array] as $comment => $heading) {
			echo "$heading";
			?> <br> <?php
		}
	}
	?> <br> <?php

	//set counts for sum and total
	$sum = 0;
	$total = 0;
	//set bool for if any results are found
	$resultsFound = false;	

	//Print out selected data file
	foreach($works as $array=> $key) {
		foreach($works[$array] as $key => $keyVal) {
			//if matchOption is in works, bold it
			if ($works[$array][$keyOption] == $matchOption) {
				$resultsFound = true;
				?><b><?php
				echo "$key: $keyVal";
				?></b><?php
			}
			//else, print regularly
			else {
				echo "$key: $keyVal";
			}
			?><br><?php
			//add to sum and total
			if ($key == $infoOption){
                        	$sum = $sum + $keyVal;
                                $total = $total + 1;
                        }
		}
		?><br><?php
	}
	
	//output if no results are found
	if ($resultsFound == false) 
		echo "Sorry, no results found for $keyOption: $matchOption."

	//Output Sum or Average
	?><br><?php	
	if ($SorAOption == "sum") {
		echo "Sum of $infoOption = $sum";
	}
	else if ($SorAOption == "average") {
		if ($total != 0) 
			echo "Average of $infoOption = " . $sum/$total;
		else //don't divide by 0
			echo "Average of $infoOption = " . $total;
	}

	end_html();
}

// function called to display the form
function display_form() {

	start_html();
	?>

	<form action="project4.php" method="get">
	Categories:
		<select name = "category">
		<?php
		get_data("categories");
		?>
		</select>
		<br><br>
	Key to Match:
		<select name = "keyToMatch">
		<?php
		get_data("find");
		?>
		</select>
		<br><br>
	Match Value:
		<input type='text' name = 'matchValue'><br><br>
	Info to Process:
		<select name = "infoToProcess">
		<?php
		get_data("info");
		?>
		</select>
		<br><br>
	Sum or Average:
		<select name = "sumOrAvg">
		<option value ="sum">Sum</option>
		<option value ="average">Average</option>
		</select>
		<br><br>
	<input type='submit' name = "submit" value='Submit'>
	</form>

	<?php
	end_html();
}

// function to get drop down options from json file
function get_data($whichOption) {
	//decode JSON file
        $JSON_file = file_get_contents("./Media.json");
        $Media = json_decode($JSON_file, true);
	json_last_error();
	$info = $Media[$whichOption];
	
	// loop through Media file to echo data for dropbox
        foreach ($info as $key => $keyInfo) {
	        if(!is_array($keyInfo)) {
			if ($whichOption == "categories") 
				echo "<option value='$key'> $key </option>";
			else
                        	echo "<option value='$keyInfo'> $keyInfo </option>";
                }
        }
}

//The actual code to run file
if(isset($_GET["submit"])) {
        process_form();
} 
else {
        display_form();
}

?>

