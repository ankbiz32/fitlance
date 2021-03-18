<?php
require 'db_conn.php';
page_protect();
include('vish_info/head.php');
?>
    		<div class="main-content">
				<div class="row">
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
					</div>
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">

							<li>Welcome <?php echo $_SESSION['full_name']; ?> 
							</li>					
						
							<li>
								<a href="logout.php">
									Log Out <i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
                <hr>
                <?php
				if(file_exists($_GET['vis'].'.php'))
				{
				   include($_GET['vis'].'.php');
				}else
				{
					include('vish_info/center.php');
				}
				?>
    	<?php include('vish_info/footer.php'); ?>
</div>

    <script src="../../vishnu/js/gsap/main-gsap.js" id="script-resource-1"></script>
    <script src="../../vishnu/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
    <script src="../../vishnu/js/bootstrap.min.js" id="script-resource-3"></script>
    <script src="../../vishnu/js/joinable.js" id="script-resource-4"></script>
    <script src="../../vishnu/js/resizeable.js" id="script-resource-5"></script>
    <script src="../../vishnu/js/vishnu-api.js" id="script-resource-6"></script>
    <script src="../../vishnu/js/jquery.validate.min.js" id="script-resource-7"></script>
    <script src="../../vishnu/js/vishnu-login.js" id="script-resource-8"></script>
    <script src="../../vishnu/js/vishnu-custom.js" id="script-resource-9"></script>
    <script src="../../vishnu/js/vishnu-demo.js" id="script-resource-10"></script>
    </body>
</html>
