<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

require_once("./../../factories/userFactory.php");

if (isset($_GET["Id"]))
{	
	$id = intval($_GET["Id"]);		
	$userFactory = new UserFactory();		
	echo json_encode($userFactory->ConvertToAssocArray($userFactory->GetById($id)));
}
