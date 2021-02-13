<?php

class ActiveRow {
    private $table; 
    public $data;

    public function __construct ($table, $data) {
      $this->table = $table;
      $this->data = $data;  
    }
    public function __set($propertyName, $value){//write
        $this->data[$propertyName] = $value;
    }
    public function __get($propertyName){//read
        return $this->data[$propertyName];
    }
    public function columnNames () {
        return array_keys ($this->data);
    }
	public function getId () {
		$pk = $this->table->primaryKey;
		return $this->$pk;
	}
	public function hasId () {
		$pk = $this->table->primaryKey;
		return isset ($this->data[$pk]);
	}
	
	public function setId ($value) {
		$pk = $this->table->primaryKey;
		$this->$pk = $value;
	}

	public function delete () {
		$this->table->deleteRow($this->getId());
	}
	public function insert () {
		$this->table->insertRow($this);
	}
	public function update () {
		$this->table->updateRow($this);
	}
	public function values () {
		return array_values($this->data);
	}
	
}

?> 