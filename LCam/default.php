<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>PZ LPR Home Page</title>
	<link href="bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap.bundle.min.js"></script>
	<script src="jquery.min.js"></script>
	<script src="jquery-csv.js"></script>
	<link type="text/css" href="styles.css" rel="stylesheet">
	<script src="java.js"></script>
</head>
<body>
<? 
	session_start();
	include "db.php"; 
	include "functions.php";
	date_default_timezone_set('EDT');
	$_SESSION['arrayStore']=$arr;
	checkDB();
?>
<div class="container-fluid">
  <h1>Parker and Zachary LPR Software</h1>
	DEMO: Simulate new plate being scanned by selecting an item from this dropdown
	<form action="">
	<select name="samplePlates" onchange="changeDisplay(this.value)">
		<option value="">Select Plate: </option>
		<option value="ABC1234">Error Test</option>
		<?
		$plateArr = plateGen();
		for($i=0;$i<sizeof($plateArr);$i++)
		{
			echo "<option value=\"".$plateArr[$i]."\">".$plateArr[$i]."</option>";
		}
		?>
	</select>
	</form>
	<button onClick="operation()">Run JS</button>
	<div class="row">
		<div class="col-md-3" style="background-color:lavender;">
			<div class="row">
				<div class="col-md-12" id="display"></div>
			</div>
		</div>
		<div class="col-md-9" style="background-color:lavender;">
			<h3>Scanned Plates</h3>
			<div class="row" id="thumbnails">
			</div>
		</div>
	</div>
</div>
</body>
</html>
