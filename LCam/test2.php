<?
session_start();
$arr = $_SESSION['arrayStore'];
$index = sizeof($arr)-1;
for ($i=0;$i<=$index;$i++)
{
	echo "<div class=\"col-lg-3 col-6 text-center\" style=\"background-color:lavender;\" onclick=\"$('#pos".$i."').modal('show');\">";
	echo "<img class=\"img-fluid img-thumbnail center-block\" src=\"images/testPlatePic.jpg\" alt=\"Thumbnail picture\">";
	echo "<h3>".$arr[$i][0]."</h3>
		  <p>StudentID: ".$arr[$i][1]."</p>";
	echo "</div>";
	?>
	<div class="modal fade" id="pos<? echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><? echo $arr[$i][0] ?>'s Information</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
		  <?
		  echo "<p>Student ID: ".$arr[$i][1]."</p>
				<p>Parking Type: ".$arr[$i][2]."</p>
				<p>Parking License: ".$arr[$i][3]."</p>
				<p>Register Date: ".$arr[$i][4]."</p>
				<p>Date Image Taken: ".$arr[$i][5]."</p><br>";
		  ?>	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<?
}
?>