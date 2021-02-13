<?php
   include_once ("DataAccess/Database.class.php"); 
   $database = new Database ("localhost", "ikea_exercise", "root", "");
   $table = $database->findTable("product", "id_product");

    if ($_GET["action"]=="edit") {
        $title = "Edit";
        $product = $table->findById($_GET["id"]);
    }
    
    if ($_GET["action"]=="add") {
        $title = "Add";
        $product = $table->newRow();
        $product->id_product = "";
        $product->name_product = "";
        $product->color = "";
        $product->Weight = "";
        $product->date_issue = "";
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
                    <h3 style="text-align:center;" ><?php echo "$title "; ?> Product</h3></div> 
                <div class="col-md-4">
                    <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "ikea.php">Home</a></button></p>
                </div> 
            </div>
    </header>

    <div  id="imageformpage" class="container">
        <div class="row"> 
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <form style="text-align:right;" method= "post" action="product_backend.php?action=<?php echo $_GET["action"]; ?>">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for=id_product> Id Product :</label>
                        </span>
                    </div>
                    <input  class="w-50" type="number" value="<?php echo $product->id_product; ?>" name="id_product" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="name_product"> Name Product :</label>
                        </span>
                    </div>
                    <input  class="w-50" type="text" value="<?php echo $product->name_product; ?>" name="name_product" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="color"> Color :</label>
                        </span>
                    </div>
                    <input  class="w-50" type="text" value="<?php echo $product->color ?>"  name="color" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="Weight"> Weight :</label>
                        </span>
                    </div>
                    <input  class="w-50" type="text" value="<?php echo $product->Weight ?>" name="Weight" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <!-- <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="date_issue"> Date Issue :</label>
                        </span>
                    </div>
                    <input type="date" value="<?php echo $product->date_issue ?>" name="date_issue" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div> -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="id_supplier"> Id Supplier :</label></span>
                    </div>
                    <?php 
                    $suppliertable= $database->findTable("supplier", "id_supplier");
                    echo $suppliertable->createCombo("id_supplier", 1, "name_supplier");
                    ?>
                    <!-- <input type="date" value="<?php echo $product->id_supplier ?>" name="id_supplier" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> -->
                </div>
                <button type="submit" class="btn btn-warning">Send</button>
                </form>  
            </div>  
            <div class="col-md-2"></div>      
        </div>    
    </div>
       
</body>        
</html>