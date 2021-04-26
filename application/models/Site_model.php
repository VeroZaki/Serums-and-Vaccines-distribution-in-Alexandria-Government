<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class site_model extends CI_Model
{

  function run_my_query()
  {
    echo "This message from model";
  }

  function insert_table_data($data){
    echo $this->db->insert("admin" , $data);
  //  $this->db->query();
  }

  function check_login(){
    $this->db->query();
  }
}



 ?>
