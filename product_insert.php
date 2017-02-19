<?php
ob_start();
session_start();
include "connection.php";

$error = false;

if ( isset($_POST['submit_form']) )
{
	
	// create variables
	$productname = $_POST['productname'];
	$quantity = $_POST['quantity'];
	$image = $_POST['image'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	
	$type = trim($_POST['type']);
	
	//check if product already exists
	$exists = mysqli_query($link,"SELECT * FROM products WHERE productname = '$productname'");
	$exists = mysqli_num_rows($exists);
	  
	//Check valid productname
	if (empty($productname))
	{
		$error = true;
		$nameError = "Please enter a product name.";
	}
	else if ($exists > 0)
	{
		$error = true;
		$nameError = "Sorry, that product already exists";
	}
	
	//Check valid quantity
	if (empty($quantity))
	{
		$error = true;
		$quantityError = "Please enter a quantity.";
	}
	elseif (!is_numeric($quantity))
	{
		$error = true;
		$quantityError = "The Quantity is not a number.";
	}
	elseif (strlen(utf8_decode($quantity)) < 0)
	{
		$error = true;
		$quantityError = "Value too low. Minimum is 0.";
	}
	elseif (strlen(utf8_decode($quantity)) > 999)
	{
		$error = true;
		$quantityError = "Value too high. Maximum is 999.";
	}
	
	//Check valid image 
	if (empty($image))
	{
		$error = true;
		$imageError = "Please enter a image name.";
	}
	
	//Check valid price 
	if (empty($price))
	{
		$error = true;
		$priceError = "Please enter a price.";
	}
	elseif (!is_numeric($price))
	{
		$error = true;
		$priceError = "Please enter a number for the price.";
	}
	elseif (strlen(utf8_decode($price)) < 0.01)
	{
		$error = true;
		$priceError = "Value too low. Minimum is 0.01.";
	}
	elseif (strlen(utf8_decode($price)) > 999)
	{
		$error = true;
		$priceError = "Value too high. Maximum is 999.";
	}
	
	//Check valid description 
	if (empty($description))
	{
		$error = true;
		$descError = "Please enter a description.";
	}
	elseif (strlen(utf8_decode($description)) > 1000)
	{
		$error = true;
		$descError = "Description is too long. Maximum description length is 1000 characters.";
	}
	
	//No errors, create account
	if (!$error)
	{
		//create product
		$sql = "INSERT INTO products (productname, quantity, image, price, description) VALUES ('".$productname."','".$quantity."','".$image."','".$price."','".$description."')";
		$result = mysqli_query($link, $sql);
		$feedback = "Product successfully added.";
		?> <script type="text/javascript"> document.getElementById('prodFrame').contentWindow.location.reload(); </script><?php		
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="../style.css" rel="stylesheet" type="text/css">
<style>
html {
	padding-left: 0%;
	padding-right: 0%;
}
</style>
</head>
<body>
<h3>New Product</h3>
<?php echo "$feedback"; ?>
<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
  <div class="form-group">
    <div class="input-group">
      <input name='productname' type='text' placeholder='Product Name' value='<?php echo "$productname";?>'>
      </input>
      <?php if(isset($nameError)) {echo "<img src='../img/alert.png' alt='Error' width='15px' height='15px'> "; echo "$nameError";}?>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <input name='quantity' type='number' placeholder='Quantity' min="0" max="999" value='<?php if(!isset($quantity)){echo "0";} else{echo "$quantity";}?>' >
      </input>
      <?php if(isset($quantityError)) {echo "<img src='../img/alert.png' alt='Error' width='15px' height='15px'> "; echo "$quantityError";}?>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <input name='image' type='text' placeholder='Image Name' value='<?php echo "$image";?>'>
      </input>
      <?php if(isset($imageError)) {echo "<img src='../img/alert.png' alt='Error' width='15px' height='15px'> "; echo "$imageError";}?>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <input name='price' type='number' placeholder='Price' min="0" max="999" step="0.10" value='<?php if(!isset($price)){echo "0";} else{echo "$price";}?>' >
      </input>
      <?php if(isset($priceError)) {echo "<img src='../img/alert.png' alt='Error' width='15px' height='15px'> "; echo "$priceError";}?>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <input name='description' type='text' placeholder='Description' width='100px' height='25px' value='<?php echo "$description";?>'>
      </input>
      <?php if(isset($descError)) {echo "<img src='../img/alert.png' alt='Error' width='15px' height='15px'> "; echo "$descError";}?>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <input name='submit_form' type='submit' value='Add Product'>
      </input>
    </div>
  </div>
</form>
</body>
</html>
<?php ob_end_flush(); ?>
