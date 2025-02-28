<?php
/* _SYSTEM.MESSAGE_CENTER */
/*****************************************************************/

/**
  * @desc	collection of return messages to the user based on param
  * @param	$result
  * @return $return
*/
	function messages($result)
	{
	  switch($result)
	  {
		case("mass_email_sent"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Mass Email has been Sent</strong>
				   </div>';
		break;
					
		case("duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Duplicate entry not allowed.</strong>
				   </div>';
		break;

		case("alias_duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Duplicate Alias entry not allowed.</strong>
				   </div>';
		break;
				
		case("vars_saved"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>All data has been saved</strong>
				   </div>';
		break;
		
		case("vars_cleared"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>All data in this form has been cleared</strong>
				   </div>';
		break;
		
		case("email_duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Email address has already been registered<br /><br /></strong>
					<a data-toggle="modal" href="#forgot-password" class="btn btn-danger">Forgot Password</a> 
				   </div>';
		break;
		
		case("email_invalid"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Email address is either not formatted correctly or the domain does not exist.</strong>
				   </div>';
		break;

		case("email_not_found"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Not able to find that email address.</strong>
				   </div>';
		break;

		case("link_expired"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>The requested link has expired.</strong>
					<br />
					<p>Please click "Forgot Password" to rest your password</p>
				   </div>';
		break;

		case("email_sent"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Email has been sent with login credentials</strong><br />
					Please check your email for detials and verify '.EMAIL_GENERAL_REPLY_ADDRESS.' is in your safe sender list.
				   </div>';
		break;

		case("email_password_sent"):		
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					An email has been sent <br />
					<strong>Please verify <br /> '.EMAIL_NO_REPLY_ADDRESS.' <br /> is in your safe sender list.</strong> 
				   </div>';
		break;
		
		case("email_not_sent"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Email has NOT been sent due to an error.</strong>
				   </div>';
		break;
		
		case("change_password"):
		$return = '<div class="alert alert-danger fade in">
					<strong>Please change your password and email address</strong>
				   </div>
				   <div class="alert alert-info fade in">
					As a security measure, you must change the login credentials.<br />
					Once you have changed it, you will be logged out and will need to enter your new credentials.<br />
					You will also receive an email to the email address you type below.<br />
				   </div>
				  ';
		break;

		case("password_changed"):
		$return = '<div class="alert alert-success fade in">
					<strong>Your password has been changed</strong>
				   </div>
				  ';
		break;


		case("password_to_short"):
		$return = '<div class="alert alert-danger fade in">
					<strong>Please use a password that is at least 6 characters long</strong>
				   </div>
				  ';
		break;

		case("values_do_not_match"):
		$return = '<div class="alert alert-danger fade in">
					<strong>Passwords do not match</strong>
				   </div>
				  ';
		break;
		
		case("category_duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<strong>A Category with that name has already been created<br /><br /></strong>
				   </div>';
		break;
		
		case("login"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Please log in.</strong> 
				   </div>';			
		break;
		
		case("logout"):
		$return = '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>You have successfully logged out.</strong> 
				   </div>';			
		break;
		
		case("timed_out"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Your session has expired.<br />Please login again</strong> 
				   </div>';			
		break;
		
		case("user_not_found"):
		$return = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Ah KRAKEN!!</strong>
					<p>Please verify your login or click Forgot Your Password to reset</p>
				   </div>';	
		break;
		
		case("created"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Entry has been created</strong> 
				   </div>';			
		break;
		
		case("user_registered"):
		$return = '
				   <div class="col-md-4">&nbsp;</div>
				   <div class="col-md-4">
				   <div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Registration is complete, Please check your email then login <a href="'.app_Url().'">here</a></strong> 
				   </div>
				   </div>';			
		break;
		
		case("updated"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Entry has been updated</strong> 
				   </div>';			
		break;
		
		case("deleted"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Entry has been deleted</strong> 
				   </div>';			
		break;

		case("not_able_to_delete"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Not able to delete</strong> 
				   </div>';			
		break;
				
		case("error"):		
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>An error has occured.</strong> 
				   </div>';
		break;

		case("sequence_updated"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Order has been updated</strong> 
				   </div>';			
		break;		

		case("required_fields"):
		$return = '<div class="alert alert-danger fade in">
					<strong>* Please enter all Required fields</strong> 
				   </div>';			
		break;	
		
		default:
		$return = '';

	  }
	  return $return;
	}
/*****************************************************************/

?>