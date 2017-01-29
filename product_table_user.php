<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Page</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<style>
html {
	padding-left: 0%;
	padding-right: 0%;
}
</style>
<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
</head>
<?php 
include "connection.php";

//Clean inputs from user	
//$search= $_GET['Search'];
$search = htmlspecialchars(strip_tags(trim($_GET['Search'])));

//Choose and make query
if ($search == "")
{
	$result = mysqli_query($link, "SELECT * FROM products ORDER BY id");
}
else 
{
	$result = mysqli_query($link, "SELECT * FROM products WHERE productname OR description LIKE '%$search%' ORDER BY id");
}

$count = mysqli_num_rows($result);

//check for errors
if($count == 0)
{
	$error = true;
	$countError = "<br>No results found for $search.";
}
if (!$dbcon == "Connected")
{
	$error = true;
	$dbError = "<br>Error connecting to database.";
}
//no errors, display table
if (!$error)
{
	if (!$search == "")
	{
		echo "<p>Searching for $search.</p>";
	}
	//table container 
	echo "<div id='table_container'>";

	while ($row = mysqli_fetch_array($result))//repeated for products being shown
	{
		//product box
		echo "<div id='product_container'>";
			//image
			echo "<div id='product_left_surround'>";
				echo "<div id='product_rightbreak'>";
					echo "<div id='product_left_1'><img src='../img/$row[3]' alt='$row[1]' height='90px'></div>";
					echo "<div id='product_left_2'>$row[1]</div>";
				echo "</div>";
			echo "</div>";
			//description
			echo "<div id='product_mid_container'>";
				echo "<div id='product_mid_1'><b>Description</b></div>";
				echo "<div id='product_mid_2'>$row[5]</div>";
			echo "</div>";
			//price stock basket
			echo "<div id='product_right_surround'>";
				echo "<div id='product_leftbreak'>";
					echo "<div id='product_right_1'><b>Price:</b> £$row[4]</div>";
					echo "<div id='product_right_2'><b>Stock:</b> $row[2]</div>";
					echo "<div id='product_right_3'><form action='cart_item_add.php' method='post' target='hiddenFrame'>";
					echo "<input name='quantity' type='number' id='quantity' size='20px' padding='0' value='1' mix='-10000' max='50' />";	
					echo "<input name='id' type='hidden' value='$row[0]'/>";
					echo "<input name='productname' type='hidden' value='$row[1]'/> <input name='add' type='submit' value='Add to cart'/>";
					echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div> </br>";
	}
	echo "</div>";
	echo "<iframe name='feedback' width='60' height='0' border='0' style='display: none;' onload=resizeIframe(this)></iframe>";
	echo "<iframe name='hiddenFrame' width='0' height='0' border='0' style='display: none;'></iframe>";
}
//errors, explain why
else
{
	if (isset($countError))
	{
		echo $countError;
	}
	elseif(isset($dbError))
	{
		echo $dbError;
	}
	else
	{
		echo "An unknown error has occured.";
	}
}
?>
</html>
