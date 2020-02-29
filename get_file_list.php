<?php
$path = $_POST['path'];

$flist = scandir($path);

foreach ($flist as $fval) {
	if ($fval != "." && $fval != "..") {
		echo $fval."##";
	}
}
?>