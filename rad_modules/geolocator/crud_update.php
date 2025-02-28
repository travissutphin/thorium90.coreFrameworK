<?php
/* .CRUD_UPDATE */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>

<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage User Permissions for <?php echo $values_Users['name_first'].' '.$values_Users['name_last']; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
      
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo messages($message); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
					
					<table class="table table-striped table-bordered" id="activate_table_filter">
                        <thead>
                            <tr>
                                <th width="150">Name</th>
                                <th width="250">Permission</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php while ($row = $_SESSION['FETCH_ARRAY']($records_Companies)){ ?> 
                            <?php $records_user_x_company_x_permissions = read_User_x_Company_x_Permissions($id=FALSE,$_REQUEST['USER_ID'],$row['COMPANY_ID']); ?>
                            <form name="manage" action="crud_update.php" method="post">
                            <tr>
                                <td>
									<a name="<?php echo $row['NAME']; ?>" id="<?php echo $row['NAME']; ?>"></a>
									<?php echo $row['NAME']; ?>
                                </td>
                                <td>
                                	<?php $opt1 = ""; $opt2 = ""; $opt3 == ""; $opt4 = ""; ?>
									
									<?php 
										$array = array();
										while($row_uxcxp = $_SESSION['FETCH_ARRAY']($records_user_x_company_x_permissions)) {
											$array = array_merge($array, array($row_uxcxp['PERMISSION_ID']));										
                                    } ?>
                                    <!--<input name="permissions[]" type="checkbox" value="1" <?php //if(in_array("1", $array)) { echo "checked"; } ?> />Monthly and/or Quarterly Access<br />-->
                                    <input name="permissions[]" type="checkbox" value="2" <?php if(in_array("2", $array)) { echo "checked"; } ?> />Monthly Reporting <br />
                                    <input name="permissions[]" type="checkbox" value="4" <?php if(in_array("4", $array)) { echo "checked"; } ?> />Quarterly Reporting <br />      
                                    <input name="permissions[]" type="checkbox" value="3" <?php if(in_array("3", $array)) { echo "checked"; } ?> />Access to Results <br />
                                    <!--<input name="permissions[]" type="checkbox" value="4" <?php //if(in_array("4", $array)) { echo "checked"; } ?> />Reporting and Results-->
                                </td>
                                <td><button name="crud_update" class="btn btn-mini btn-success" type="submit"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> &nbsp; Save <strong><i><?php echo $values_Users['name_first'].' '.$values_Users['name_last'];?></i></strong> Permissions</button></td>
                                <td>&nbsp;</td>
                            </tr>
                            <input name="USER_ID" type="hidden" value="<?php echo trim($_REQUEST['USER_ID']); ?>" />
                            <input name="COMPANY_FK" type="hidden" value="<?php echo trim($row['COMPANY_ID']); ?>" />
                            <input name="ACTION" type="hidden" value="SET_PERMISSIONS" />
                            </form>
                            <?php } ?>
                        </tbody>
                	</table> 
        
                    </div>
                    <!-- /.table-responsive -->
                   
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
            
</div>

<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>