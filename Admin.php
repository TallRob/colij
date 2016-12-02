<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Store - Admin Panel</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<!--<script src="//code.jquery.com/jquery-3.1.1.js"></script>-->
<script> 
$(function(){
  $("#header").load("header.php"); 
  $("#footer").load("footer.php"); 
});
</script>
</head>
<body>
<div id="header"></div>
&nbsp;
<div id="main">
  <div id="section">
    <h2>Welcome to my shop</h2>
    <p>This is the Admin Page</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get"> 
      Search by:
      <select name='selection'>
        <option value='userid' selected>User ID</option>
	    <option value='username'>Username</option>
	    <option value='type'>Access level</option>
      </select>
      <input name="Search" type="text">
      <input name="Submit" type="submit">
    </form>
    <br />
    <?php
include "script/connection.php";

//Set search variables
if ($_GET['selection'] == userid)
{
	$selection = "userid";
}
elseif ($_GET['selection'] == username)
{
	$selection = "username";	
}
elseif ($_GET['selection'] == type)
{
	$selection = "type";
}

$search= $_GET['Search'];

//make query
if ($selection == "")
{
	$sql = "SELECT * FROM users ORDER BY userid";
}
else 
{
$sql = "SELECT * FROM users WHERE $selection LIKE '$search' ORDER BY userid";
}

$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 0)
{
	echo "$sql";
	echo "<p>Searching \"$selection\" for \"$search\".</p>";
	echo "<p>No results found</p>";
}
else
{
	echo "$sql";
	echo "<p>Searching \"$selection\" for \"$search\".</p>";
	
	echo "<table>";
	//top of table
	echo "<tr>";
	
	echo "<th width='20px'>";
	echo "ID";
	echo "</th>";
	
	echo "<th width='120px'>";
	echo "Username";
	echo "</th>";
	
	echo "<th width='120px'>";
	echo "Password";
	echo "</th>";
	
	echo "<th width='35px'>";
	echo "Access Level";
	echo "</th>";
	
	echo "<th width='165px'>";
	echo "Date Created";
	echo "</th>";
	
	echo "<th width='75px'>";
	echo "Update Account";
	echo "</th>";
	
	echo "<th width='75px'>";
	echo "Delete Account";
	echo "</th>";
	
	echo "</tr>";
	
	//main rows, repeated for users being shown
	while ($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
 	echo "<form action='script/update.php' method='post'>";
	//show user id
//	echo "<td><input name= 'userid' type='text' value='$row[0]' readonly></input></td>";
	echo "<td>$row[0]</td>";
	//show username textbox
	echo "<td><input name='username' type='text' value='$row[1]'></input></td>";
	//Show password textbox
	echo "<td><input name='password' type='text' value='$row[2]'></input></td>";
	//Show access level drop-down
	echo "<td><select name='type'>";
	if($row[3]== Admin)
	{
	echo "<option value='Guest'>Guest</option>";
	echo "<option value='Admin' selected>Admin</option>";
	}
	else
	{
	echo "<option value='Guest' selected>Guest</option>";
	echo "<option value='Admin'>Admin</option>";
	}
	echo "</select></td>";
	//Show date create
	echo "<td>$row[4]</td>";
	//Update button
	echo "<td><input name='Update' type='submit' style='padding: 1px 15px;'></input></td>";
	echo "</form>";
	
	echo "<td>";
	echo "<form action='script/delete.php' method='post'>";
	echo "<input name='userid' type='hidden' value='$row[0]'></input>";
	echo "<input name='' type='submit' value='Delete' style='padding: 1px 18px;'></input>";
    echo "</form>";
	echo "</td>";
	echo "</tr>";
}
//form to add a new user
	echo "<tr><form action='script/insert.php' method='post'>";
	echo "<td>New</td>";
	echo "<td><input name='username' type='text'></td>";
	echo "<td><input name='password' type='text'></td>";
	echo "<td><select name='type'>";
	echo "<option value'Guest'>Guest</option>";
	echo "<option value'Admin'>Admin</option>";
	echo "</select>";
	echo "</td>";
	echo "<td style='text-align: center;'><input name='' type='submit' value='Create new account' style='padding: 0px 18px;'></td>";
	echo "</form>";
	echo "<td></td>";
	echo "<td></td>";
    echo "</tr>";
	
echo "</table>";
}
?>
  </div>
</div>
&nbsp;
<div id="footer"></div>
</body>
</html>
