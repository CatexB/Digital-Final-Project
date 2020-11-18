<?php


$username = getenv("DB_USER"); //if you're deploying this yourself, replace this stuff.
$password = getenv("DB_PASSWORD"); //and ask the question why are you deploying this
$host = getenv("DB_HOST"); //you can't get me, mr. Man
$dbname = getenv("DB_NAME");


/******************************/

$dsn = "mysql:host=$host;dbname=$dbname";
$db = "";

/** connect to the database **/
try 
{
   $db = new PDO($dsn, $username, $password);   
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, 
   // use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
}

?>