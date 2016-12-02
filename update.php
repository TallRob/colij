<?php
include "connection.php";

//$sql = "UPDATE users SET username='".$_POST['username']."', password='".$_POST['password']."', type='".$_POST['type']."'";
//$sql = "UPDATE users SET username='".$_POST['username']."', password='".$_POST['password']."', type='".$_POST['type']."'WHERE username='".$_POST['username'] . "'";
$sql = "UPDATE users SET username='".$_POST['username']."', password='".$_POST['password']."', type='".$_POST['type']."' WHERE userid ='".$_POST['userid']."'";

//echo "<br>";
//echo $sql;

$result = mysqli_query($link, $sql);
?>
<html>
<meta http-equiv="refresh" content="0; URL='../admin.php'" />
</html>
