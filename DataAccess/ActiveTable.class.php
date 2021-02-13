<?php
include ("ActiveRow.class.php");

class ActiveTable {
    private $database;
    private $name;
    public $primaryKey;

    public function __construct($database, $name, $primaryKey) {
        $this->database = $database;
        $this->name = $name;
        $this->primaryKey = $primaryKey;
    }
   
	public function newRow () {
		return $this->CreateActiveRowFrom([]);
	}
    public function query($sql) {
         // create an empty array
         $arrayOfActiveRows = [];
         // select all data from the specified condition
         $dataArray = $this->database->userQuery($sql);
         // foreach data found in this array, we creat active row and store in variable $activeRow and 
         // we push into this 
         foreach ($dataArray as $data) {
             $activeRow = $this->CreateActiveRowFrom($data);
             array_push($arrayOfActiveRows, $activeRow);
         }
         return $arrayOfActiveRows;

    }
    // find employee by id
    public function findById($primaryKeyValue){
        //Select* From employers Where $this->primaryKey(noemp)=$primaryKeyValue(1000)
        $array = $this->findWhere($this->primaryKey. "=$primaryKeyValue");
        if (count($array) != 1 ) die ("The ID $primaryKeyValue is not valid");
        return $array[0];
    }

    // find any data with any condition set    
    public function findWhere($condition){
        // create an empty array
        $arrayOfActiveRows = [];
        // select all data from the specified condition
        $dataArray = $this->database->selectStarFromWhere($this->name, $condition);
        // foreach data found in this array, we creat active row and store in variable $activeRow and 
        // we push into this 
        foreach ($dataArray as $data) {
            $activeRow = $this->CreateActiveRowFrom($data);
            array_push($arrayOfActiveRows, $activeRow);
        }
        return $arrayOfActiveRows;
    }

    public function findAll(){
        $arrayOfActiveRows = [];
        $dataArray = $this->database->selectStarFrom($this->name);
        foreach ($dataArray as $data) {
            $activeRow = $this->CreateActiveRowFrom($data);
            array_push($arrayOfActiveRows, $activeRow);
        }
        return $arrayOfActiveRows;
    }

    private function CreateActiveRowFrom ($data) {
        return new ActiveRow ($this, $data) ;
    }

	public function deleteRow ($rowId) {
		$this->database->deleteFromWhere($this->name, $this->primaryKey, $rowId);
	}
	public function insertRow ($row) {
        $generatedId = $this->database->insertInto($this->name, $row->columnNames(), $row->values());
        if (!$row->hasId() && !empty($generatedId)) {
            $row->setId($generatedId);
        }
 	}
	public function updateRow ($row) {
        $rowId = $row->getId();
		$this->database->updateWhere($this->name, $row->values(), $row->columnNames(), $this->primaryKey, $rowId);
    }
    function createCombo ($name, $size, $displayValue, $selectedId=null) {
        $combo = "<select name = '$name' size='$size'> 
        <option value = 'null'>-Select-</option>";
        foreach($this->findAll() as $property){
            $id = $property->getId ();
            $propertyName = $property->$displayValue;
            $selected = ($selectedId==$id)?"selected='selected'":"";             
            $combo = $combo . "<option $selected value = '$id'>$propertyName</option>";
        }
        $combo = $combo . "</select>";

        return $combo;
    }

}


?>