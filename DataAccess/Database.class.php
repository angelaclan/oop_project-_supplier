<?php
    include ("ActiveTable.class.php");

    // The database object is going to be connected as soon as we instantiate the object it self.
    class Database {
        private $connection;
        // Once new object is created methode construct will automaticly been run through
        function __construct($host, $databaseName, $userName, $password) { 
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->connection = new mysqli($host, $userName, $password, $databaseName);
        }
        // Close DB connection
        function __destruct(){
            $this->connection->close(); 
        }
        // Sent query to DB thru this connection, and returen fetched data



        function queryAndFetch($preparedStatement){
            $preparedStatement->execute();
            $result = $preparedStatement->get_result();
            if($result->num_rows === 0) return [];
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        function prepareStatement ($stringsql) {
            return $this->connection->prepare($stringsql);
        }

		function execute($preparedStatement){
            $result = $preparedStatement->execute();
            if (!$result) {
				die($sqlstring . mysqli_error($this->connection));
            }
        }
        // to find table in the database and return
        function findTable ($tableName, $primaryKey) {
            return new ActiveTable ($this, $tableName, $primaryKey);
            //"this" is the object who recieved the message
        }
        // to fetch and return data from choosed table by selectall
        function selectStarFrom ($tableName) {
            $stmt = $this->prepareStatement("SELECT * FROM $tableName");
            return $this->queryAndFetch($stmt);
        }
        // to fetch and return data from choosed table with a condition of $where
        function selectStarFromWhere($tableName, $where) {
            $stmt = $this->prepareStatement("SELECT * FROM $tableName WHERE $where");
            return $this->queryAndFetch($stmt);
        
        }
        function userQuery ($sql) {
            $stmt = $this->prepareStatement($sql);
            return $this->queryAndFetch($stmt);
        }
        // to fetch and return data from choosed table with a condition of primarykey equals to id value
        function selectStarFromID($tableName, $primaryKey, $idValue){
            $stmt = $this->prepareStatement("SELECT * FROM $tableName WHERE $primaryKey = ?");
            $stmt->bind_param("s", $idValue);
            return $this->queryAndFetch($stmt);
            // $tableName == 'employee'
            // $idValue == 1000
            // $primaryKey == 'noemp' 
            // SELECT * 
            // FROM Employees
            // WHERE noemp = 1001
        }
		
		function deleteFromWhere($tableName, $primaryKey, $idValue) {
            $stmt = $this->prepareStatement("DELETE FROM $tableName WHERE $primaryKey = ?");
            $stmt->bind_param("s", $idValue);
            return $this->execute($stmt);
		}
		
		function insertInto($tableName, $columnNames, $values) {
            $acc = [];
            $vars = [];
			foreach ($columnNames as $cname) {
                array_push ($acc, "`$cname`");
                array_push ($vars, " ? ");
			}
            $joinedNames = join (",",  $acc);
            $variables = join  (",",  $vars);
            $statement = $this->prepareStatement("INSERT INTO `$tableName`($joinedNames) VALUES ($variables)");
            $types = str_repeat('s', count($values));
            array_unshift($values, $types);
            @call_user_func_array(array($statement, 'bind_param'), $values);
            $this->execute($statement);
            return $this->connection->insert_id;
        }
		
		function updateWhere($tableName, $values, $columnNames, $primaryKey, $idValue) {
            $acc = [];
            $ref = [];
            
			for( $i = 0; $i < count($columnNames); $i++){
				$column = $columnNames[$i];
				$ref[] =  &$values[$i];
				array_push ($acc, "`$column`= ? ");
            }
            $ref[] = &$idValue;

            $setting = join (",", $acc);
            $statement = $this->prepareStatement("UPDATE $tableName SET $setting WHERE $primaryKey = ?");

            $types = str_repeat('s', count($ref));
            array_unshift($ref, $types);
            call_user_func_array(array($statement, 'bind_param'), $ref);
             
			$this->execute($statement);
			
        }
        
	}

?>























