<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cron_model extends CI_Model
{

  function run_my_query()
  {
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $format = 'DATE_ATOM';
    $time = time();

    $t = standard_date($format, $time);
    $Add = $this->db->query("INSERT INTO my_date VALUES ('$date' , '$t') ");
  }

}



 ?>
