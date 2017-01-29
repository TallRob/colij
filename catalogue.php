<?php //ob_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home!</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script> 
$(function(){
  $("#header_holder").load("header.php"); 
  $("#footer_holder").load("footer.php"); 
});
</script>
<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
<script language="javascript">
function youClicked() {
	if (confirm("Are you sure you want to logout?") == true) {
		document.getElementById('frmlogout').submit();
	}
}
</script>
<!--<script type="text/javascript">
  document.getElementById('jsform').submit();
</script>-->
</head>
<body>
<div id="header_holder"></div>
<div id="main">
  <div id="section">
    <h2>Welcome to my shop</h2>
    <p>Here I'm selling stuff for people's consumption.<br />
      <!--script/product_table_user.php--> 
      Buy stuff if you wish.</p>
    <form name="products" id="jsform" action="script/product_table_user.php" method="get" target="prodFrame">
      Search Products:
      <input name="Search" type="text" />
      <input name="Submit" type="submit" />
    </form>
    <br />
    <iframe name="prodFrame" width="100%" scrolling="no" frameborder="0" onload="resizeIframe(this)" ></iframe>
    <iframe name='hiddenFrame' width='0' height='0' style='display: none;'></iframe>
  </div>
</div>
<div id="footer_holder"></div>
</body>
<script type="text/javascript">
  document.getElementById('jsform').submit();
</script>
</html>
<?php //ob_flush(); ?>
