<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<?php
include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$table = $database->findTable("product", "id_product");
$productOfSupplier = $table->findWhere($_POST['id_supplier'] . "= id_supplier");

if (count($productOfSupplier) == 0) $columnNames = [];
else  {
    $columnNames = $productOfSupplier[0]->columnNames ();
    $key = array_search("date_issue", $columnNames);
    unset($columnNames[$key]);
}
?>
<header id="headerformpage">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4"><h3>Product of Supplier</h3>
            </div>
            <div class="col-md-4">
                <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "ikea.php">Home</a></button></p>
            </div> 
        </div>
    </div>    
</header>   

<div id="imageformpage" class="container">
    <form method= "post" action="command_backend.php?id_supplier=<?php echo $_POST['id_supplier']; ?>">
        <div class="row">
            <table class='table table-hover'>

            <?php
                echo "<tr>";
                foreach ($columnNames as $cname){
                    echo "<th>$cname</th>";
                }
                echo "<th>Quantity</th>";
                echo "</tr>";

                foreach ($productOfSupplier as $product){
                    echo "<tr>";
                    foreach ($columnNames as $cname){
                        $cellvalue= $product->$cname;
                        echo "<td>$cellvalue</td>";
                    }
                    $id = $product->getId();
                    echo "<td><input type='number' name='$id' value='0'></td>";
                }
            ?>
    
            </table>  
        </div>
        <p style="text-align:right"><button  type="submit" class="btn btn-warning">Send</button></p>
    </form>
    
</div>    
</body>        
</html>