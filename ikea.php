<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
include_once ("DataAccess/Database.class.php"); 
$database = new Database ("localhost", "ikea_exercise", "root", "");
$tableProduct = $database->findTable("product", "id_product");
$date = date("y-m-d");
$dateArray = $tableProduct->findWhere("date_issue='$date'");
$numberOfNotification = count($dateArray);

$tableSupplier = $database->findTable("supplier", "id_supplier");
$date = date("y-m-d");
$dateArray = $tableSupplier->findWhere("date_issue='$date'");
$numberOfNotification = count($dateArray);

$tableCommand = $database->findTable("command", "id_command");
$date = date("y-m-d");
$dateArray = $tableCommand->findWhere("date_command='$date'");
$numberOfNotification = count($dateArray);

?>

<body>
    <header id="headerhomepage">
        <img src= "image/ikea-logo.svg" id= "logo">
        <nav id="navhomepage">
            <div class= "notification" >
            <a href= "product_list.php" class="badge1" data-badge="<?php echo $numberOfNotification ?>" ><img src="image/product.png" width="55" height="52"></a>
            <a href= "supplier_list.php" class="badge2" data-badge="<?php echo $numberOfNotification ?>"><img src="image/supplier.png" width="50" height="50"></a></button>
            <a href= "command_list.php" class="badge3" data-badge="<?php echo $numberOfNotification ?>" ><img src="image/Cart.png" width="50" height="50"></a></button> 
            </div>
        </nav>   
    </header>  

    <div id="imageshomepage" class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <div class="item active">
            
            <img src="image/image2.webp"  style="width:100%;">
        </div>

        <div class="item">
            <img src="image/image3.jpg"  style="width:100%;">
        </div>
        
        <div class="item">
            <img src="image/image4.webp"  style="width:100%;">
        </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
    </div>

    <footer id="footerhomepage">
        <p >Copyright&copy;2019 </p>
        <a href= "http://angelaclan.github.io"><p>#made by Angela CL</p></a>
    

    </footer>

</body>
</html>

