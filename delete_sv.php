<?php
if (isset($_POST['ID'])) {
	$id = $_POST['ID'];

	require_once ('dbhelp.php');
	$sql = 'delete from students where ID = '.$id;
	execute($sql);

}