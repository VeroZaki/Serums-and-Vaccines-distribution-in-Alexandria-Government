<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

  /*public function __contstruct(){
    parent:: __contstruct();
    $this->load->model('site_model');
  }*/

	public function index()
	{
    //$this->site_model->run_my_query();
    $this->Site_model->run_my_query();
		$this->load->view('include/header');
    $this->load->view('site/site_index');
    $this->load->view('include/footer');
	}

  public function pass_variable(){

    $info_array = array('organization_name' => "Velta", "author_name" => "vero" , "email" => "vero.zaki@yahoo.com" );
    $this->load->view('site/pass_var' , $info_array);
  }
  public function about()
	{
		$this->load->view('site/site_about');
	}

  public function contact_info()
  {
    echo"<h1>This is our contact page</h1>";
  }

  public function service($id = "" , $name ="")
  {
    echo"<h1>This is our service page</h1><p> service ID " . $id . "and service name" . $name;
  }

  function insert_data_into_table(){
    $data = array('username' => 'vero',  'password' => 'vero207168');
    $this->Site_model->insert_table_data($data);
  }
}
