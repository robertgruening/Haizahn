<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("./../../models/tag.php");
require_once("./../../factories/tagFactory.php");

$tagJSON = $_POST;
$tag = new Tag();

/*
if (isset($_GET["Id"])) {
    //Bestehenden ändern

    $user->SetName($userJSON["Name"]);
    //$user->SetPassword($_POST["Password"]);
    $user->SetEmail($userJSON["Email"]);
    $userFactory = new UserFactory();
    $userFactory->Set($user);
} 
else */
    {
    //Neu anlegen
    //file_get_contents('php://input');

    $userFactory = new UserFactory();
    $user = $userFactory->GetById($tagJSON["User"]["Id"]);
    
    $tag->SetUser($user);
    $tag->SetText($tagJSON["Text"]);
    $tagFactory = new TagFactory();
    
    //ToDo: in Tagfactory nach dem set, direkt den tag mit erzeugentem index zurück geben 09.10.2017
    //$tagFactory->Set($tag);
    //$tag = $tagFactory->GetByText($tag->GetId());
}

$tagAssocArray = $tagFactory->ConvertToAssocArray($tag);
 
echo json_encode($tagAssocArray);
