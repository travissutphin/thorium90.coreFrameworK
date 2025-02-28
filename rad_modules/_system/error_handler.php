<?php
/* _SYSTEM.ERROR_HANDLER */
/*****************************************************************/


/**
  * @desc	catch and display errors
  * @param	
  * @return 
*/
	// Set error reporting level to catch all errors
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	// Custom error handler function
	function customErrorHandler($errno, $errstr, $errfile, $errline) {
		// Error type mapping
		$errorTypes = array(
			E_ERROR             => 'Fatal Error',
			E_WARNING           => 'Warning',
			E_PARSE            => 'Parse Error',
			E_NOTICE           => 'Notice',
			E_CORE_ERROR       => 'Core Error',
			E_CORE_WARNING     => 'Core Warning',
			E_COMPILE_ERROR    => 'Compile Error',
			E_COMPILE_WARNING  => 'Compile Warning',
			E_USER_ERROR       => 'User Error',
			E_USER_WARNING     => 'User Warning',
			E_USER_NOTICE      => 'User Notice',
			E_STRICT           => 'Strict Notice',
			E_RECOVERABLE_ERROR=> 'Recoverable Error',
			E_DEPRECATED       => 'Deprecated',
			E_USER_DEPRECATED  => 'User Deprecated'
		);

		// Get error type from mapping or use 'Unknown Error'
		$errorType = isset($errorTypes[$errno]) ? $errorTypes[$errno] : 'Unknown Error';

		// Create error message with HTML formatting
		$errorMessage = "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
		$errorMessage .= "<strong>$errorType:</strong> $errstr<br>";
		$errorMessage .= "File: $errfile<br>";
		$errorMessage .= "Line: $errline<br>";
		
		// Add stack trace for more serious errors
		if ($errno == E_ERROR || $errno == E_USER_ERROR || $errno == E_RECOVERABLE_ERROR) {
			$errorMessage .= "Stack trace:<br>";
			$errorMessage .= "<pre>" . print_r(debug_backtrace(), true) . "</pre>";
		}
		
		$errorMessage .= "</div>";

		// Output error message
		echo $errorMessage;

		// Don't execute PHP internal error handler
		return true;
	}

	// Register the custom error handler
	set_error_handler("customErrorHandler");

	// Exception handler for uncaught exceptions
	function customExceptionHandler($exception) {
		echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
		echo "<strong>Uncaught Exception:</strong> " . $exception->getMessage() . "<br>";
		echo "File: " . $exception->getFile() . "<br>";
		echo "Line: " . $exception->getLine() . "<br>";
		echo "Stack trace:<br><pre>" . $exception->getTraceAsString() . "</pre>";
		echo "</div>";
	}

	// Register the exception handler
	set_exception_handler("customExceptionHandler");

	// Handler for fatal errors
	register_shutdown_function(function() {
		$error = error_get_last();
		if ($error !== NULL && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
			echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;'>";
			echo "<strong>Fatal Error:</strong> " . $error['message'] . "<br>";
			echo "File: " . $error['file'] . "<br>";
			echo "Line: " . $error['line'] . "<br>";
			echo "</div>";
		}
	});

	// Optional: Log errors to file
	ini_set('log_errors', 1);
	ini_set('error_log', '/path/to/error.log');  // Change this path as needed

/*****************************************************************/
?>