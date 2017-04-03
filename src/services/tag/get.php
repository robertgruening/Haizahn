<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("./../../factories/tagFactory.php");

if (isset($_GET["Id"]))
{
    $id = intval($_GET["Id"]);

    $tagFactory = new TagFactory();
    echo json_encode($tagFactory->ConvertToAssocArray($tagFactory->GetById($id)));
}
