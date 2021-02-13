<?php
   include_once ("DataAccess/Database.class.php"); 
   $database = new Database ("localhost", "ikea_exercise", "root", "");
   $table = $database->findTable("command", "id_command");

    if ($_GET["action"]=="edit") {
        $title = "Edit";
        $product = $table->findById($_GET["id"]);
    }
    
    if ($_GET["action"]=="add") {
        $title = "Add";
        $command = $table->newRow();
        $command->id_command = "";
        $command->date_command = "";
                
    }
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <header id="headerformpage">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-4"></div> 
                <div class="col-md-4">
                    <h3 style="text-align:center;"><?php echo "$title "; ?> Command</h3></div> 
                <div class="col-md-4">
                    <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "ikea.php">Home</a></button></p>
                </div> 
            </div>
        </div>    
    </header>

    <div id="imageformpage" class="container">
        <div class="row"> 
            <div class="col-md-4 offset-md-4">
                <form  style="text-align:center;" method= "post" action="command_product.php?action">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default"><label for=id_supplier> Supplier :</label>
                            </span>
                            <?php 
                                $suppliertable= $database->findTable("supplier", "id_supplier");
                                echo $suppliertable->createCombo("id_supplier", 1, "name_supplier");
                            ?>
                        </div>
                    </div>            
                    <button type="submit" class="btn btn-warning">Send</button>
                </form>  
            </div>    
        </div> 
    </div>   

</body>        
</html>