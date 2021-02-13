
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
$table = $database->findTable("command", "id_command");
$commands = $table->findAll();

if (count($commands) == 0) $columnNames = [];
else $columnNames = $commands[0]->columnNames ();
?>
<header id="headerformpage">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"><h3>Command List</h3></div>
            <div class="col-md-4">
                <p style="text-align:center;"><button type="submit" class="btn btn-light"><a href= "ikea.php">Home</a></button></p>
            </div> 
        </div>
    </div>  
</header>  

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-8">
            <p style="text-align:right;">
            <button id="addbutton" type="button" class="btn btn-light">
            <a href = 'command_frontend.php?action=add'>Add Command</a></button></p>
        </div>
    </div>

    <div class="row">
        <table class='table table-hover'>

        <?php
            // create the first table row, for showing the header of each column.
            // tr -> table row ; th-> table header
            echo "<tr>";
            foreach($columnNames as $cname) {
                echo "<th>$cname</th>";
            }
            echo "<th>Edit</th>";
            echo "<th>Delete</th>";
            echo "</tr>";

            // data of the table starts to be generated form here
            // foreach object 'objetEmploye' in the data 
            foreach($commands as $command){
                // we ask the object for each of it's fields, and we paste each of them on their correspondant cell 
                // td -> table data
                echo "<tr>";
                foreach($columnNames as $cname) {
                    $cellValue = $command->$cname;
                    echo "<td>$cellValue</td>";
                } 
                // generates ad hoc links to an edit page by using the employee number(as its the primary key)
                // for being able to recognize the concerned employee
                echo "<td> <a href = 'command_display.php?id=". $command->getId(). "'>
                    <button type='button' class='btn btn-primary'>DISPLAY</button></a></td>";
                // generates ad hoc links to an delete page by using the employee number(as its the primary key)
                // for being able to recognize the concerned employee
                echo "<td> <a href= 'command_backend.php?action=delete&id=" . $command->getId() . "'>
                    <button type='button' class='btn btn-warning'>DELETE</button></a></td>";
                echo "</tr>";
            }
        ?>

        </table>     
    </div>
</div>
</body>
</html>