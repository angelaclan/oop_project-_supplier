<?php
header ("Location: command_list.php");

include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$commandItemsTable = $database->findTable("compose", "id");
$commandHeaderTable = $database->findTable("command", "id_command");


$commandHeader = $commandHeaderTable->newRow();
$commandHeader->date_command = date("y-m-d");
$commandHeader->id_supplier = $_GET["id_supplier"];

$commandHeader->insert();


foreach ($_POST as $id_product => $quantity){
    if ($quantity != 0){
        $row = $commandItemsTable->newRow();
        $row->id_command = $commandHeader->getId();
        $row->id_product = $id_product;
        $row->quantity = $quantity;
        $row->insert();
    }
}



?>