<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

require_once("./../../models/user.php");
require_once("./../../factories/userFactory.php");

if (isset($_GET["Name"]) &&
	isset($_GET["Password"]) &&
	isset($_GET["Email"]))
{	
	$user = new User();
	$user->SetName($_GET["Name"]);
	$user->SetPassword($_GET["Password"]);
	$user->SetEmail($_GET["Email"]);
	
	$userFactory = new UserFactory();
	$userFactory->Set($user);
}
