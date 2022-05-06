<? 
function plateGen()
{
	include 'db.php';
	if ($db->connect_error) 
	{
		die("Database Error: " . $db->connect_error);
	}
	else
	{
		$plateArr = array();
		$select = $db->prepare("SELECT LNum FROM License");
		$select->execute();
		$rows = $select->fetchAll();
		if (count($rows)>0)
		{
			foreach($rows as $rownum => $row)
			{
				$plateArr[] = $row[0];
			}
			return $plateArr;
		}
		else
		{
			echo "<h2>Failed to generate plate array</h2>";
		}
	}
}
function checkDB()
{
	session_start();
	include 'db.php';
	if ($db->connect_error) 
	{
		die('<script>alert("Database Error: ' . $db->connect_error.'<br>Cannot connect to Licence plate database, internal database may not be up to date!"</script>');
	}
	else
	{
		$file = fopen('database.txt', 'r') or die ('<script>alert("Failed to open local database file!")</script>');
		$arrr = array();
		$select = $db->prepare("SELECT * FROM License");
		$select->execute();
		$rows = $select->fetchAll();
		if (count($rows)>0)
		{
			foreach($rows as $rownum => $row)
			{
				$arrr[] = array($row["LNum"], $row["StudentID"], $row["ParkType"], $row["LStatus"], $row["RegisteredDate"]);
			}
		}
		else
		{
			fclose($file);
			die ('<script>alert("Failed to fetch up to date files from License plate database!")</script>');
		}
		if (json_encode($arrr)==fread($file, filesize("database.txt")))
			echo '<script>alert("Local database is up to date!")</script>';
		else
		{
			file_put_contents("database.txt", json_encode($arrr));
			echo '<script>alert("Local database successfully updated!")</script>';
		}
		fclose($file);
	}
	$_SESSION['database']=json_decode((file_get_contents("database.txt")));
}
function readCam()
{
	if (($handle = fopen("fromCam/detection_results.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$arr[][0] = '<img class="img-fluid img-thumbnail center-block" src="fromCam/Detection_Images/'.$data[0].'" alt="Image could not be found"><br>';
			end($arr)[1] = '<h2>Plate: '.substr($data[1], 2, (strpos($data[1], " "))-2).'</h2>';
		}
	}
	else
		echo '<script>alert("Results from LPC cannot be found!")</script>';
	fclose($handle);
	if (isset($arr))
		$_SESSION['arrayStore'] = $arr;
}
?>