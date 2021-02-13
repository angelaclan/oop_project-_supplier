<?php

if (!isset($_GET["action"])) die ("No action supplied");

include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$table = $database->findTable("supplier", "id_supplier");

// In the case of an ADD 
if ($_GET["action"] == "add") {
    $supplier = $table->newRow();
    foreach ($_POST as $propertyName=> $propertyValue) {
        $supplier->$propertyName = $propertyValue;
    }
    $supplier->insert();
}
// In the case of an EDIT 
if ($_GET["action"] == "edit") {
    $supplier = $table->newRow();
    foreach ($_POST as $propertyName => $propertyValue) {
        $supplier->$propertyName = $propertyValue;
    }
    $supplier->update();
}
// In the case of an REMOVE 
if ($_GET["action"] == "delete") {
    $supplier = $table->findById($_GET["id"]);
    $supplier->delete();
}

header ("Location: supplier_list.php");


?>