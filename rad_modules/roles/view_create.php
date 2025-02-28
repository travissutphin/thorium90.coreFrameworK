<?php
/* ROLES.CREATE */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
?>

<table class="table table-bordered">
  <tr>
    <th width="150">First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th width="250">Access</th>
    <th>&nbsp;</th>
  </tr>
  <form name="manage" action="view.php" method="post">
  <tr>
    <td><input name="FIRST_NAME" type="text" class="input-large" value="" /></td>
    <td><input name="LAST_NAME" type="text" class="input-large" value="" /></td>
    <td><input name="EMAIL" type="text" class="input-large" value="" /></td>
    <td><input name="ACCESS" type="text" class="input-large" value="" /></td>
    <td>
      <button name="create" class="btn">Save</button>
    </td>
  </tr>
  </form>
</table>

<?php
include('../templates/footer.php');
?>