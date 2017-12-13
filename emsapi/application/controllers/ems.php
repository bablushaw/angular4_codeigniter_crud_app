<?php
defined('BASEPATH') or exit('no direct script acess allowed');

class ems extends CI_Controller{
    public function __construct()
	{
		parent::__construct();

		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

	}
    public function index(){
        echo "welcome to ems";
    }
    public function insert(){
        
        $data = json_decode(file_get_contents("php://input"));
        $this->load->database();
        $sql = "INSERT INTO employees (name, position, department, salary) 
        VALUES ('$data->name', '$data->position', '$data->department', '$data->salary')";
        $query = $this->db->query($sql);
        if($query){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    public function select(){
        
        $sql = "SELECT * FROM employees ORDER BY _id DESC";
        $this->load->database();
        $query = $this->db->query($sql);
        $data=Array();
        $data = $query->result_array();
        if($data)
        {
        echo json_encode($data);
        $this->db->close();
        }
        else{
            echo 0;
        }
            
        
    }
    public function selectone(){
        
        $user_id=$this->uri->segment(3);        
        $sql = "SELECT * FROM employees WHERE _id = $user_id";
        
        $this->load->database();
        $query = $this->db->query($sql);
        $data = Array();
         $data=$query->result_array();
        if(isset($data)){
            echo json_encode($data);
        }
        else{
            echo "0 results";
        }
        
    }
    public function update(){
        
        $data = json_decode(file_get_contents("php://input"));

        $sql = "UPDATE employees SET
        name ='$data->name',  position ='$data->position',
        department ='$data->department',salary ='$data->salary'
        WHERE _id = $data->_id ";
        $this->load->database();
        $query = $this->db->query($sql);
        if($query){
            echo 1;
        }
        else{
            echo 0;
        }
       
    }
    public function delete(){
        
        $user_id=$this->uri->segment(3);
        $this->load->database();
        $sql = "DELETE FROM employees WHERE _id = $user_id ";
        $query = $this->db->query($sql);
        if(!$query){
            echo 0;
        }
       
    }
}

?>