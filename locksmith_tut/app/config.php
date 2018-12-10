<?php
ini_set( "display_errors", true );

date_default_timezone_set( "Europe/Berlin" );
define( "DB_HOST", "localhost" );
define( "DB_NAME", "melinashop" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define( "DB_DSN", "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "app/skin/templates" );
define( "MODULE_PATH", "app/modules" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>