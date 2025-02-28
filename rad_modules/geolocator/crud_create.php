<?php
/* USERS.CRUD_UPDATE */
/*****************************************************************/
?>

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
					echo '<div class="col-md-8">'.messages($message).'</div>';
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

                            <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form">                    
                            
                            <!-- row 1 -->
                            <div class="col-xs-3">
                            	First Name:<br />
                            	<input name="NAME_FIRST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_FIRST']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	Last Name:<br />
                            	<input name="NAME_LAST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_LAST']; ?>" />
                            </div>
                            
                            <div class="col-xs-3">
                            	Email:<br />
                            	<input name="EMAIL" type="email" class="form-control" value="<?php echo $_SESSION['EMAIL']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	Password:<br />
                            	<input name="PASSWORD" type="password" class="form-control" value="<?php echo $_SESSION['PASSWORD']; ?>" />
                            </div>
							
							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <!-- row 2 -->
                            <div class="col-xs-3">
                            	Primary Phone:<br />
                            	<input name="NAME_FIRST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_FIRST']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	Emergency Phone:<br />
                            	<input name="NAME_LAST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_LAST']; ?>" />
                            </div>
                            
                            <div class="col-xs-3">
                            	Fax:<br />
                            	<input name="EMAIL" type="email" class="form-control" value="<?php echo $_SESSION['EMAIL']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	<!-- empty -->
                            </div>

							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <!-- row 3 -->
                            <div class="col-xs-3">
                            	Address:<br />
                            	<input name="NAME_FIRST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_FIRST']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	Zip:<br />
                            	<input name="NAME_LAST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_LAST']; ?>" />
                            </div>
                            
                            <div class="col-xs-3">
                            	State:<br />
                            	<input name="EMAIL" type="email" class="form-control" value="<?php echo $_SESSION['EMAIL']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	City:<br />
                            	<input name="EMAIL" type="email" class="form-control" value="<?php echo $_SESSION['EMAIL']; ?>" />
                            </div>

							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                             <!-- row 4 -->
                            <div class="col-xs-3">
                            	Organization:<br />
                            	<input name="NAME_FIRST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_FIRST']; ?>" />
                            </div>

                            <div class="col-xs-3">
                            	Level:<br />
                            	<input name="NAME_LAST" type="text" class="form-control" value="<?php echo $_SESSION['NAME_LAST']; ?>" />
                            </div>
                            
                            <div class="col-xs-3">
                            	<!-- empty -->
                            </div>

                            <div class="col-xs-3">
                            	<!-- empty -->
                            </div>

							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                                                       							
							<!-- buttons -->
                          	<div class="col-xs-6">
                          		<button name="create" class="btn btn-info btn-outline"> Create </button>
                          		<button name="create" class="btn btn-info btn-outline"> Create & Email User </button>            
                          	</div>
                          	
                          	<div class="col-xs-6">
                          		 <!-- empty -->              
                          	</div>
                        	
                        	
                        	</form>
                        	

                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->

<?php include('../templates/admin_footer.php'); ?>
  