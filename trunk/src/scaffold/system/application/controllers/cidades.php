<?php
/**
* CRUD Controller for Cidades
**/
class Cidades extends Controller{
	/**
	* Default Constructor
	**/
	public function __construct(){
		parent::__construct();
		$this->load->model('modelcidade', '', true);
        $this->load->helper(array('form', 'url'));
	}
	/**
	* Create new Cidade
	**/
	public function create(){
        $object = $this->modelcidade;
		$this->save($object);
	}
	/**
	* Edit Cidade
	**/
	public function edit($id){
        $this->save(($_POST) ? $this->modelcidade : $this->modelcidade->getById($id));
	}
	/**
	* Delete Cidade
	**/
	public function delete($id){
        $response = null;
        if($_POST && isset($_POST["agree"]) && $_POST["agree"] == "Yes"){
		    $response = $this->modelcidade->delete($id);
            redirect("cidades");
            return;
        } else {
            if($_POST){
                redirect("cidades");
                return;
            }
            $object = $this->modelcidade->getById($id);
        }
		$this->load->view('cidades/delete', array(
            'response' => $response, 
            'object' => $object,
            "title" => "Cidade",
			"heading" => "Delete",
            )
        );
	}
	/**
	* List objects of Cidade
	**/
	public function index(){
		$data = array(
			"objects" => $this->modelcidade->all(),
			"title" => "Cidade",
			"heading" => "List",
		);
		$this->load->view('cidades/list', $data);
	}
	/**
    * Save object
    **/
    private function save($object){
		if($_POST){
            $object->populate();
            if($object->validate()){
                $object->save();
                redirect("cidades");
                return;
            }
		}
        $this->load->view('cidades/save', array(
            "title" => "Cidade",
			"heading" => ($object->id) ? "Edit" : "New",
            "object" => $object
            )
        );
    }

}
