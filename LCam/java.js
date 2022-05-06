// JavaScript Document
function changeDisplay(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("display").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("display").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "test.php?q="+str, true);
  xhttp.send();
  $("#thumbnails").load("test2.php");
}
function cleanup(str)
{
	return str.replace(/[^a-z0-9]/gi, '');
}
function finder(arr, k) {
	for (var i = 0; i < arr.length; i++) {
		if (!(arr[i][0].localeCompare(k))) {
			return i;
		}
	}
	return -1;
}
function operation()
{
	$('#display').html("");
	$('#thumbnails').html("");
	var offset = -4;
	var date = new Date(new Date().getTime() + offset * 3600 * 1000).toUTCString().replace( / GMT$/, "" );
	$.get("/LCam/fromCam/detection_results.csv", function (CSVdata){
		var csv = $.csv.toArrays(CSVdata);
		var length = csv.length;
		$.get("database.txt", function (rawTxt){
			var dba = JSON.parse(rawTxt);
			for (var i = 0; i < length; i++) {
				var plate = cleanup(csv[i][1]);
				var result = finder(dba, plate);
				var thumb = $('<div class="col-lg-3 col-6 text-center" style="background-color:lavender;" onclick=\'$("#pos'+i+'").modal("show")\'>' +
				'<img class="img-fluid img-thumbnail center-block" src="/LCam/fromCam/Detection_Images/' + csv[i][0] + '" alt="Thumnail failed to load">' +
				'<h3>'+plate+'</h3><p>StudentID:' + ((result>-1) ? dba[result][1] : "Unknown") + '</p></div>' +
				'<div class="modal fade" id="pos'+i+'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
				'<div class="modal-dialog">' +
					'<div class="modal-content">' +
						'<div class="modal-header">' +
							'<h5 class="modal-title" id="exampleModalLabel">'+plate+'\'s Information</h5>' +
							'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
						'</div>' +
						'<div class="modal-body">' +
							'<img class="img-fluid img-thumbnail center-block" src="/LCam/fromCam/Detection_Images/' + csv[i][0] + '" alt="Thumnail failed to load">' +
							'<p>Student ID: '+ ((result>-1) ? dba[result][1] : "Unknown") +'</p>' +
							'<p>Parking Type: '+ ((result>-1) ? dba[result][2] : "Unknown") +'</p>' +
							'<p>Parking License: '+ ((result>-1) ? dba[result][3] : "Unknown") +'</p>' +
							'<p>Register Date: '+ ((result>-1) ? dba[result][4] : "Unknown") +'</p>' +
							'<p>Image Taken: '+ date +'</p><br>' +
						'</div>' +
						'<div class="modal-footer">' +
							'<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
						'</div></div></div></div>');
				$('#thumbnails').append(thumb);
			}
			var result = finder(dba, cleanup(csv[length-1][1]));
			var disp = $('<div class="col-md-12"><img class="img-fluid center-block" src="/LCam/fromCam/Detection_Images/' + csv[length-1][0] + '" alt="Image failed to load"></div>' +
					'<div>' +
					'<h1>'+cleanup(csv[length-1][1])+'</h1>' +
					'<p>Student ID: '+ ((result>-1) ? dba[result][1] : "Unknown") +'</p>' +
					'<p>Parking Type: '+ ((result>-1) ? dba[result][2] : "Unknown") +'</p>' +
					'<p>Parking License: '+ ((result>-1) ? dba[result][3] : "Unknown") +'</p>' +
					'<p>Register Date: '+ ((result>-1) ? dba[result][4] : "Unknown") +'</p>' +
					'<p>Image Taken: '+ date +'</p><br>' +
				'</div>');
			$('#display').append(disp);
		});
	});
	
}