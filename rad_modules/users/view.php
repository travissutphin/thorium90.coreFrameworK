<?php
/* USERS.VIEW */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
?>

<div class="container-fluid" id="container">
	<?php 
		if(isset($_GET['return']))
		{
			echo messages($_GET['return']); 
		}
	?>
	<!--<div class="span2"><?php //include('../templates/left.php'); ?></div>-->
    
    <div class="span12" id="content">
     
        <div class="row-fluid">

            <h2>Users</h2>
            <table class="table table-bordered table-hover">
                <form name="manager" action="view.php" method="post">
                <thead>	
                    <tr bgcolor="#eeeeee">
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>
                      <a href="#create"  data-toggle="modal" class="open-create">
                      <button name="create_record" class="btn btn-info btn-mini" data-dismiss="modal" aria-hidden="true">Add</button>
                      </a>
                      </th>
                    </tr>
                </thead>
                </form>
                <tbody>
                  <?php while ($row = mysqli_fetch_array($records_all)){ ?>
                  <form name="manage" action="view.php" method="post">
                  <tr>
                    <td><?php echo $row['name_first']; ?></td>
                    <td><?php echo $row['name_last']; ?></td>
                    <td><?php echo decrypt_Security($row['email'],ENCRYPTION_KEY); ?></td>                                           
                    <td><?php $role = read_values_Roles($row['role_id']); 
							  echo $role['name']; 
						?>
                    </td>
                    <td>
                    <a href="#update<?php echo $row['id']; ?>"  data-toggle="modal" class="update<?php echo $row['id']; ?>">
                      <button name="update" class="btn-mini">Update</button>
                    </a>
                    <?php if($records_all_num_rows != 1 and $row['id'] != 1) { ?>
                    <button name="delete" class="btn btn-danger btn-mini" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                    <?php } ?>
                    
                    <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
                    </td>
                  </tr>
                  </form>
                  <?php } ?>
                </tbody>
            </table>
        
        </div><!-- // row-fluid -->
        
    </div> <!-- // span12 -->                 

</div> <!-- //container-fluid --> 

<?php
include('modals.php');
include('../templates/footer.php');
?>