<?php
/* USERS.VIEW */
/*****************************************************************/
if(isset($_SESSION['dev_mode'])){
	error_reporting(E_ALL); 
	ini_set('display_errors',1);
}

include('../_system/config.php');
include('controller.php'); 
?>

<?php include('../templates/admin_header.php'); ?>

        <!-- =========================================
        Main Wrapper
        ========================================== -->
        <!-- main-wrapper -->
        <div id="main-wrapper">




            <!-- =========================================
            Header
            ========================================== -->
            <!-- header -->
            <header class="header top-header-light header-menu-light sub-menu-light">




                <!-- top-header -->
                <!-- /top-header -->




                <!-- header-menu-wrapper -->
                <div class="header-menu-wrapper">
                    <!-- header-menu -->
                    <div class="header-menu">



                        <!-- navbar -->
                        <nav class="navbar" role="navigation">

                            <!-- container -->
                            <div class="container">
                                <!-- row -->
                                <div class="row">


                                    <!-- col-md-12 -->
                                    <div class="col-md-12">


                                        <?php include('../templates/admin_nav.php'); ?>


                                        <!-- navbar-collapse -->
                                        <!-- /navbar-collapse -->


                                    </div><!-- /col-md-12 -->


                                </div><!-- /row -->
                            </div><!-- /container -->

                        </nav><!-- /navbar -->



                    </div><!-- /header-menu -->
                </div><!-- /header-menu-wrapper -->




            </header><!-- /header -->




            <!-- =========================================
            Breadcrumb Section
            ========================================== -->				
			<?php 
				if(isset($message)){
					echo '<div class="col-md-2"> </div>';
					echo '<div class="col-md-8">'.$message.'</div>';
					echo '<div class="col-md-2"> </div>';
				}else{
					echo '<div class="well"> </div> ';
				}
			?>
	            



            <!-- =========================================
            Light Section
            ========================================== -->
            <!-- light-section -->
            <div class="light-section">

                <!-- main-section -->
                <div class="main-section">

                        <!-- container -->
                        <div class="container container-min-height-01">
                            <!-- row -->
                            <div class="row">

                                <!-- col-md-12 -->
                                <div class="col-md-12">
                                                                        
                                	<br />
                                	<div class="table-responsive">
                                	<table class="table">
                                		<thead>
                                		<tr>
                                			<th>First Name</th>
                                			<th>Last Name</th>
                                			<th>Email</th>
                                			<th>Phone</th>
                                		</tr>
                                		</thead>
                                		
                                		<?php while($row = $read_Users) { ?>
                                		<tr>
                                			<td scope="row"><?php echo $row['US_NAME_FIRST']; ?></td>
                                			<td scope="row"><?php echo $row['US_NAME_LAST']; ?></td>
                                			<td scope="row"><?php echo $row['US_EMAIL']; ?></td>
                                			<td scope="row"><?php echo $row['US_PHONE_PRIMARY']; ?></td>
                                		</tr>
                                		<?php } ?>
                                		
                                	</table>
                                	</div>
                                   
                                </div><!-- /col-md-12 -->


                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->

<?php include('../templates/admin_footer.php'); ?>