<?php
   include_once ("DataAccess/Database.class.php"); 
   $database = new Database ("localhost", "ikea_exercise", "root", "");
   $table = $database->findTable("supplier", "id_supplier");

    if ($_GET["action"]=="edit") {
        $title = "Edit";
        $supplier = $table->findById($_GET["id"]);
    }
    
    if ($_GET["action"]=="add") {
        $title = "Add";
        $supplier = $table->newRow();
        $supplier->id_supplier = "";
        $supplier->name_supplier = "";
        $supplier->address_line1 = "";
        $supplier->address_city = "";
        $supplier->address_country = "";
        $supplier->Contact = "";
        $supplier->date_issue = "";
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
                    <h3 style="text-align:center;"><?php echo "$title "; ?> Supplier</h3></div> 
                <div class="col-md-4">
                    <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "ikea.php">Home</a></button></p>
                </div> 
            </div>
        </div>    
    </header>

    <div id="imageformpage" class="container">
        <div class="row"> 
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <form style="text-align:right;" method= "post" action="supplier_backend.php?action=<?php echo $_GET["action"]; ?>">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for=id_product> Id Supplier :</label>
                        </span>
                    </div>
                    <input class="w-50" type="number" value="<?php echo $supplier->id_supplier; ?>" name="id_supplier" >
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="name_supplier"> Name Supplier :</label>
                        </span>
                    </div>
                    <input class="w-50" type="text" value="<?php echo $supplier->name_supplier; ?>" name="name_supplier" >
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="address_line1"> Address :</label>
                        </span>
                    </div>
                    <input class="w-50" type="text" value="<?php echo $supplier->address_line1 ?>"  name="address_line1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="address_city"> City :</label>
                        </span>
                    </div>
                    <input class="w-50" type="text" value="<?php echo $supplier->address_city ?>" name="address_city" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="address_country"> Country :</label>
                        </span>
                    </div>
                    <input class="w-50" type="text" value="<?php echo $supplier->address_country ?>" name="address_country" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><label for="Contact"> Contact :</label>
                        </span>
                    </div>
                    <input class="w-50" type="text" value="<?php echo $supplier->Contact ?>" name="Contact" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-warning">Send</button>
                </form>  
            </div> 
            <div class="col-md-2"></div>   
        </div>    
    </div>
</body>        
</html>