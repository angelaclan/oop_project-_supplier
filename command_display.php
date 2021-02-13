
<?php
include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$tableHeader = $database->findTable("command", "id_command");
$header = $tableHeader->query("
    SELECT c.id_command, c.date_command, s.name_supplier
    FROM command c, supplier s
    WHERE c.id_supplier = s.id_supplier
    AND c.id_command=".$_GET['id']);
$header = $header[0];

$tableContent = $database->findTable("compose", "id");
$contents = $tableContent->query("
SELECT p.id_product as Id, p.name_product as Product, p.price_unit as PU, c.quantity as QTY,  p.price_unit * c.quantity as Subtotal
FROM compose c,  product p
WHERE c.id_product = p.id_product  
AND id_command=".$_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header id="headerformpage">
        <div class="container-fluid">
            <div class="row"> 

                <div class="col-md-4">
                    <h3 style="text-align:center;"><?php echo "Command Number: ".$header->id_command; ?></h3>
                </div> 
                <div class="col-md-3">
                    <h3 style="text-align:center;"><?php echo "Supplier : " . $header->name_supplier; ?></h3>
                </div> 
                <div class="col-md-3">
                    <h3 style="text-align:center;"><?php echo "Date : " . $header->date_command; ?></h3>
                </div> 
                <div class="col-md-2">
                    <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "command_list.php">Return</a></button></p>
                </div> 
                
            </div>
        </div>    
    </header>

    <div id="imageformpage" class="container">
    <div class="row">
        <table class='table table-hover'>
        <?php
        if (count($contents) == 0) $columnNames = [];
        else $columnNames = $contents[0]->columnNames();
                      
            echo "<tr>";
            foreach($columnNames as $cname) {
                echo "<th>$cname</th>";
            }
            echo "</tr>";

            // data of the table starts to be generated form here
            // foreach object 'objetEmploye' in the data 
            foreach($contents as $content){
                // we ask the object for each of it's fields, and we paste each of them on their correspondant cell 
                // td -> table data
                echo "<tr>";
                foreach($columnNames as $cname) {
                    $cellValue = $content->$cname;
                    echo "<td>$cellValue</td>";
                } 
                
                echo "</tr>";
            }
            ?>

        </table>   
        
    </div> 
    </div> 


</body>                                                                 



</html>