<?php

class Action extends CI_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->model("action_model");
  }

  public function get_all_data(){
    $data = $this->action_model->select_all_data();
    //echo "<pre>";
    //print_r($data);
  }
  public function get_all_data_employees(){
    $data = $this->action_model->select_all_data_employees();
  }

  public function print_select(){
    $data=$this->action_model->print_select_data();
  }


  public function update_data(){
    if($this->action_model->update_table_data()){
      echo "updated";
    }
  }
}


 ?>
