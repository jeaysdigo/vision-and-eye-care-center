
<?php
	$conn = mysqli_connect("localhost","root","");
	$query = "SET GLOBAL max_allowed_packet=64*1024*1024";
	mysqli_query($conn, $query);
	date_default_timezone_set("Asia/Manila");
	if(!mysqli_select_db($conn,"eyecare"))
	{
		die("connection error");
	}
?>
