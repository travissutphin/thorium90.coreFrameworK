<?php
/* LOGIN.FUNCTIONS */
/*****************************************************************/

/**
  * @desc   Attempts to log the user in by validating email and password, 
  *         setting session variables, and redirecting upon success or failure.
  * @param  $_POST['email'] - the user's email
  * @param  $_POST['password'] - the user's password
  * @return none
  * @edited	2024-11 php 8.3
*/
function validate_Login() 
{
    // Start the session if not already started
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Filter and sanitize user inputs
	if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
		header('Location: login.php?99');
		exit ();
	} else {
		$email  = $_POST['email'];
	}
	
	$password_hash = $_POST['password_hash'] ?? '';

    if (empty($email) || empty($password_hash)) {
        $_SESSION['message'] = 'Email and password are required.';
        header('Location: index.php');
        exit;
    }

    // Prepare and execute the SQL statement to find the user by email
    $sql = "SELECT id, email, name_first, name_last, password_hash, role, created_at FROM users WHERE email = ? AND password_hash = ? ";

	$stmt = mysqli_prepare($_SESSION['connection'], $sql);
	
    if ($stmt) {
        // Bind the email parameter
        mysqli_stmt_bind_param($stmt, 'ss', $email,$password_hash);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
			
        // Check if user exists
        if ($result && mysqli_num_rows($result) === 1) {
            			
			// Fetch the user data
            $user = mysqli_fetch_assoc($result);

            // Verify the provided password with the hashed password
            if($password_hash == $user['password_hash']) {
                // Call the function to set session variables for the user
                set_variables_Login($user['id']);
                // Redirect to the account page after successful login
				
				$_SESSION['message'] = 'Incorrect password.';
				header('Location: dashboard.php');
                exit;
            } else {
                // Incorrect password
                $_SESSION['message'] = 'Incorrect password.';
				header('Location: index.php?zz');
				exit;
            }
        } else {
            // No user found with that email
            $_SESSION['message'] = 'User not found.';
			header('Location: index.php?oo');
			exit;
        }
		
		$_SESSION['users']['login_time'] = time();
		
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // SQL statement preparation failed
        $_SESSION['message'] = 'Database query failed.';
		header('Location: index.php?rr');
		exit;
    }

    // Redirect back to login page on error
    header('Location: index.php?tt');
    exit;
}
/*****************************************************************/

/**
  * @desc   Retrieves user details from the database by ID, sets session variables, and redirects.
  * @param  int $id - the user's ID
  * @return none
  * @edited	2024-11 php 8.3
*/
function set_variables_Login($id)
{
	// Validate the $id input
	if (!filter_var($id, FILTER_VALIDATE_INT)) {
		$_SESSION['message'] = 'Invalid user ID.';
		header('Location: index.php?2');
		exit;
	}

	$sql = 'SELECT id, email, name_first, name_last, password_hash, role, created_at FROM users ';	
	$sql.= ' WHERE id = ? ';	
  
	$stmt = mysqli_prepare($_SESSION['connection'], $sql);

	if ($stmt) 
	{
		// Bind and execute the statement
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	
			// Check if user is found
			if ($result && mysqli_num_rows($result) === 1) 
			{
				$user = mysqli_fetch_assoc($result);
				
				// Securely store user session variables
				$_SESSION['users'] = [
					'id' => $user['id'],
					'email' => $user['email'],
					'name' => $user['name'],
					'role' => $user['role'],
					'permissions' => $user['permissions'], // example array of specific permissions
					'login_time' => time(),
					'last_activity' => time(),
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'mfa_verified' => false,
					'failed_attempts' => 0,
				];
				
				// Generate and store CSRF token
				$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

				// Regenerate the session ID upon login to prevent session fixation
				session_regenerate_id(true);
				
			} else {
				
				// User not found; handle gracefully
				$_SESSION['message'] = 'User not found.';
				header('Location: index.php');
				exit;	
			}
		
			// Close statement
			mysqli_stmt_close($stmt);
			
	} else {
		
		// Handle database errors
		$_SESSION['message'] = 'Database query failed.';
		header('Location: login.php?b');
		exit;
	}		
	
}
/*****************************************************************/


/**
  * @desc   Clears all session variables related to the logged-in user and redirects to the login page.
  * @param  none
  * @return none
  * @edited	2024-11 php 8.3
*/
function clear_variables_Login() {
    // Start session if not already started
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Set a session message to indicate the user is logged out
    $_SESSION['message'] = 'logout';

    // Clear specific user-related session variables
    unset($_SESSION['users']['id']);
    unset($_SESSION['users']['email']);
    unset($_SESSION['users']['name_first']);
    unset($_SESSION['users']['name_last']);
    unset($_SESSION['users']['role_id']);
    unset($_SESSION['users']['createdAt']);
    unset($_SESSION['users']['login_attempts']);

    // Redirect to the login page
    header('Location: index.php');
    exit;
}
/*****************************************************************/

/**
  * @desc   Validates if the user is logged in by checking specific session variables; redirects if not.
  * @param  none
  * @return none
  * @edited	2024-11 php 8.3
*/
function validate_variables_Login() 
{
    // Start session if not already started
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Check if the user session is set (indicating a logged-in state)
    if (empty($_SESSION['users']['role_id'])) {
        // Set a session message for the timeout or invalid session
        $_SESSION['message'] = "timed_out";

        // Redirect to the site URL (e.g., homepage or login page)
        header('Location: ' . app_Url() . 'login/');
        exit;
    }
}
/*****************************************************************/
?>