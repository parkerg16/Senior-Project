<? 
	session_start();
	$arr = $_SESSION['arrayStore'];
	$database = $_SESSION['database'];
	$arrr = array();
	if (!isset($_GET['q']))
		$_GET['q']="ERROR";
	foreach ($database as $subArr)
	{
		if ($subArr[0]==$_GET['q'])
		{
			$arrr = $subArr;
		}
	}
	if ($arrr)
	{
		echo '<div class="col-md-12"><img class="img-fluid center-block" src="images/testPlatePic.jpg" alt="Image failed to load"></div>';
		$arr[] = array($_GET['q'], $arrr[1], $arrr[2], $arrr[3], $arrr[4], date('F jS\, Y h:i:s A'));
		echo "<h1>".end($arr)[0]."</h1>
			  <p>Student ID: ".end($arr)[1]."</p>
			  <p>Parking Type: ".end($arr)[2]."</p>
			  <p>Parking License: ".end($arr)[3]."</p>
			  <p>Register Date: ".end($arr)[4]."</p>
			  <p>Date Image Taken: ".end($arr)[5]."</p><br>";
	}
	else
	{
		$arr[] = array($_GET['q'], "NOT A STUDENT", "Unavailable", "Unavailable", "Unavailable", date('F jS\, Y h:i:s A'));
		echo "<h2>This plate does not exist in the database.</h2>";
	}
	$_SESSION['arrayStore'] = $arr;
?>