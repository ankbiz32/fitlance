<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Cluebix App GYM | Cashier </title>
    <link rel="stylesheet" href="../../vishnu/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
    <link rel="stylesheet" href="../../vishnu/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
    <link rel="stylesheet" href="../../vishnu/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
    <link rel="stylesheet" href="../../vishnu/css/vishnu.css"  id="style-resource-5">
    <link rel="stylesheet" href="../../vishnu/css/custom.css"  id="style-resource-6">
   
	<link rel="stylesheet" href="../../css/plugins/datepicker/datepicker.css">
    <script src="../../vishnu/js/jquery-1.10.2.min.js"></script>
    <!-- Bootstrap -->
	<script src="../../js/bootstrap.min.js"></script>
	<!-- Datepicker -->
	<script src="../../js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Timepicker -->
	<script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function()
		{
		$(".country").change(function()
		{
		var id=$(this).val();
		var dataString = 'id='+ id;

		$.ajax
		({
		type: "POST",
		url: "ajax_city.php",
		data: dataString,
		cache: false,
		success: function(html)
		{
		$(".city").html(html);
		} 
		});

		});
		});
	</script>
    <script type="text/javascript">
		$(document).ready(function()
		{
		$(".country1").change(function()
		{
		var id=$(this).val();
		var dataString = 'id='+ id;

		$.ajax
		({
		type: "POST",
		url: "ajax_city1.php",
		data: dataString,
		cache: false,
		success: function(html)
		{
		$(".city1").html(html);
		} 
		});

		});
		});
    </script>
    <SCRIPT LANGUAGE="JavaScript">
		function checkIt(evt) {
		    evt = (evt) ? evt : window.event
		    var charCode = (evt.which) ? evt.which : evt.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        status = "This field accepts numbers only."
		        return false
		    }
		    status = ""
		    return true
		}
	</SCRIPT>
</head>
<body class="page-body  page-fade">
    <div class="page-container">	
    <div class="sidebar-menu">
        <header class="logo-env">
        <!-- logo -->
        <div class="logo">
            <a href="index.php">
                <img src="../../img/50.png" alt=""  />
            </a>
        </div>
           <!-- logo collapse icon -->
            <div class="sidebar-collapse">
            <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                <i class="entypo-menu"></i>
            </a>
        </div>
                        
        
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                <i class="entypo-menu"></i>
            </a>
        </div>
        
        </header>
        <?php include('nav.php'); ?>
    </div>
