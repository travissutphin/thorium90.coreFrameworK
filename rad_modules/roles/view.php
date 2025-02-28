<?php
/* ROLES.VIEW */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
?>

<div class="container-fluid" id="container">

	<div class="span2"><?php include('../templates/left.php'); ?></div>
    
    <div class="span10" id="content">
     
        <div class="row-fluid">

            <h2>Roles</h2>
            <table class="table table-bordered table-hover">
                <form name="manager" action="view.php" method="post">
                <thead>	
                    <tr bgcolor="#eeeeee">
                      <th>Name</th>
                      <th>
                      <a href="#create"  data-toggle="modal" class="open-create">
                      <button name="create_record" class="btn btn-info btn-mini" data-dismiss="modal" aria-hidden="true">Add</button>
                      </a>
                      </th>
                    </tr>
                </thead>
                </form>

                <tbody>
                  <?php while ($row = mysql_fetch_array($records_all)){ ?>
                  <form name="manage" action="view.php" method="post">
                  <tr>
                    <td><input name="name" type="text" value="<?php echo $row['name']; ?>" /></td>                                    
                    <td>
                    <a href="#">
                      <button name="update" class="btn-mini">Update</button>
                    </a>
                    <?php if($row['id'] != "1" and $row['id'] != "2") { ?>
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