<?php

if (!isset($_GET["action"])) die ("No action supplied");

include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$table = $database->findTable("product", "id_product");

// In the case of an ADD 
if ($_GET["action"] == "add") {
    $product = $table->newRow();
    foreach ($_POST as $propertyName=> $propertyValue) {
        $product->$propertyName = $propertyValue;
    }
    $product->Date_Issue = date("y-m-d");
    $product->insert();
}
// In the case of an EDIT 
if ($_GET["action"] == "edit") {
    $product = $table->newRow();
    foreach ($_POST as $propertyName => $propertyValue) {
        $product->$propertyName = $propertyValue;
    }
    $product->update();
}
// In the case of an REMOVE 
if ($_GET["action"] == "delete") {
    $product = $table->findById($_GET["id"]);
    $product->delete();
}

//header ("Location: product_list.php");


?>