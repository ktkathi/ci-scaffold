<?php

$table_fields = array( "nome", "alias", "estado_id" );
$fields = '';
foreach($table_fields as $field)
	$fields .= "\tvar \$$field;\n";
	
$fill = '';
foreach($table_fields as $field)
	$fill .= "\t\t\$this->$field = \$this->input->post(\"$field\");\n";
	
$validate = '';
foreach($table_fields as $field)
	$validate .= "\t\tif(\$this->$field=='') return false;\n";


$model_path = APPPATH . "models\\$model.php";
$model_template = "<\?php
class ModelCidade extends Model{
	/*
		Model Fields	
	*/
$fields

	/*
		Default Constructor
	*/
	function __construct(){
		parent::Model();
	}

	function _validate(){
$validate		
		return true;
	}
	
	function save(){
		\$this->_fillFields();
		
		if(\$this->_validate()){
			return \$this->db->insert('cidade',\$this);
		}
		return false;
	}
	
	function edit(\$id){
		\$this->_fillFields();	
		
		if(\$this->_validate()){
			\$this->db->update('cidade',\$this,\$id);
		}
		return false;
	}
	
	function _fillFields(){
$fill
	}
	
	function delete(\$id){
		return \$this->db->delete('cidade',\$id);
	}
	
	function all(){
		return \$this->db->get('cidade')->result();
	}
	
	function getBy(\$where){
		return \$this->db->get_where('cidade', \$where);
	}
}

";