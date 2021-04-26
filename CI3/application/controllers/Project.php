<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function __contstruct(){
    parent:: __contstruct();
    $this->load->helper('url');
  }


	public function index()
	{
    //$this->site_model->run_my_query();
    $this->load->view('project/Logged/Landing');
	}

  public function Login_Admin(){
      $this->load->view('project/Login/AdminLoginpage');
  }

  public function Login_User(){
    $this->load->view('project/UserLogin/UserLoginpage');
  }

  public function login(){
    $this->load->view('project/Logged/home_view');
    $data['data'] = $this->action_model->print_select_data();
    $data2 = $this->action_model->print_data();
    $countOrder['order'] = element('countOrder', $data2);
    $count['c'] = element('count', $data2);
    $Disp_Hosp['Disp_Hosp'] = element('Display_Hospital',$data2);
    $Disp_Item['Disp_Item'] = element('Display_Hospital_Item', $data2);
    $Disp_Emp['Disp_Emp'] = element('Display_Employees' , $data2);
    $Disp['District'] = element('District' , $data2);
    $sum = $data + $countOrder + $count + $Disp_Hosp + $Disp_Item + $Disp + $Disp_Emp;
    $this->load->view('project/Logged/home_content', $sum);
  }

  public function User_Login(){
      $data = $this->action_model->User_Login_Check();
      $Dist_name['District_Name'] = element('ditrict_name', $data);
      $Dist_email['District_Email'] = element('district_email' , $data);
      $Dist_did['District_DID'] = element('district_did' , $data);
      $countOrder['order'] = element('Count_Order', $data);
      $count['c'] = element('count', $data);
      $employee_name['employee_name'] = element('employee_name', $data);
      $Disp_Hos['Disp_Hospital'] = element('Disp_Hospital' , $data);
      $Disp_Item['Disp_Item'] = element('Disp_Items', $data);
      $Disp_Dis['Disp_Dis'] = element('Disp_Districts' , $data);
      $total = $Dist_name + $Dist_email + $Dist_did + $countOrder + $count  +  $employee_name + $Disp_Hos + $Disp_Item + $Disp_Dis;
      $this->load->view('project/UserLogin/Logged/home' , $total);
  }

  public function District_Data(){
    $data = $this->action_model->Data();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Found['Found'] = element('Found' , $data);
    $Report['reports'] = element('reports' , $data);
    $Employee['employee'] = element('employee' , $data);
    $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
    $Items['Disp_Item'] = element('Display_Items' , $data);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $noti + $num + $query + $count;
    $this->load->view('project/Logged/districtData' , $total);
  }


  public function District_Data_Employee(){
    $data = $this->action_model->Data_Employee();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Report['reports'] = element('reports' , $data);
    $Found['Found'] = element('Found' , $data);
    $Employee['employee'] = element('employee' , $data);
    $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
    $Items['Disp_Item'] = element('Display_Items' , $data);
    $note = $this->action_model->Notification_Employee();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message_Employee();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $noti + $num + $query + $count;
    $this->load->view('project/UserLogin/Logged/districtData_Employee' , $total);
  }

  public function D_Inventory(){
    //$data = $this->action_model->District_Inventory();
    $data = $this->action_model->Data();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Items['Disp_Item'] = element('Display_Items' , $data);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Items + $noti + $num + $query + $count;
    $this->load->view('project/Logged/districtInventory' , $total);
  }

  public function D_Inventory_Employee(){
    //$data = $this->action_model->District_Inventory();
    $data = $this->action_model->Data_Employee();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Items['Disp_Item'] = element('Display_Items' , $data);
    $note = $this->action_model->Notification_Employee();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message_Employee();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Items + $noti + $num + $query + $count;
    $this->load->view('project/UserLogin/Logged/districtInventory_employee' , $total);
  }

  public function Reservation(){
    $data = $this->action_model->Reservation();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Reserve['Reserve'] = element('Reserve' , $data);
    $Found['Found'] = element('Found' , $data);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count ;
    $this->load->view('project/Logged/reservations' , $total);
  }


  public function Reservation_Employee(){
    $data = $this->action_model->Reservation_Employee();
    $name['name'] = element('Name' , $data);
    $email['email'] = element('Email' , $data);
    $did['did'] = element('DID' , $data);
    $Reserve['Reserve'] = element('Reserve' , $data);
    $Found['Found'] = element('Found' , $data);
    $note = $this->action_model->Notification_Employee();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message_Employee();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count ;
    $this->load->view('project/UserLogin/Logged/reservations_employee' , $total);
  }


  public function Patient(){
    $data = $this->action_model->Patient_db();
    //$array = array('patient' => $dispReports , 'Reports' => $disp);
    $patient['patient'] = element('patient' , $data);
    $report['report'] = element('Reports' , $data);
    $choose['choose'] = element('choose' , $data);
    $Found['Found'] = element('Found' , $data);
    $total = $patient + $report + $choose ;
    if($Found['Found'] == 0){
      $data = $this->action_model->Data();
      $name['name'] = element('Name' , $data);
      $email['email'] = element('Email' , $data);
      $did['did'] = element('DID' , $data);
      $Report['reports'] = element('reports' , $data);
      $Employee['employee'] = element('employee' , $data);
      $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
      $Items['Disp_Item'] = element('Display_Items' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $query + $count + $noti + $num ;
      $this->load->view('project/Logged/districtData' , $total);

    }
    else if($Found['Found'] == 2){
      $data = $this->action_model->Data();
      $name['name'] = element('Name' , $data);
      $email['email'] = element('Email' , $data);
      $did['did'] = element('DID' , $data);
      $Report['reports'] = element('reports' , $data);
      $Employee['employee'] = element('employee' , $data);
      $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
      $Items['Disp_Item'] = element('Display_Items' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $query + $count + $noti + $num ;
      $this->load->view('project/Logged/districtData' , $total);

    }

    else{
       $this->load->view('project/Logged/Patient' , $total);
   }
  }

  function Patient_Employee(){
    $data = $this->action_model->Patient_db_emp();
    //$array = array('patient' => $dispReports , 'Reports' => $disp);
    $patient['patient'] = element('patient' , $data);
    $report['report'] = element('Reports' , $data);
    $choose['choose'] = element('choose' , $data);
    $Found['Found'] = element('Found' , $data);
    $total = $patient + $report + $choose ;
    if($Found['Found'] == 0){
      $data = $this->action_model->Data_Employee();
      $name['name'] = element('Name' , $data);
      $email['email'] = element('Email' , $data);
      $did['did'] = element('DID' , $data);
      $Report['reports'] = element('reports' , $data);
      $Employee['employee'] = element('employee' , $data);
      $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
      $Items['Disp_Item'] = element('Display_Items' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $query + $count + $noti + $num ;
      $this->load->view('project/UserLogin/Logged/districtData_Employee' , $total);
    }
    else if($Found['Found'] == 2){
      $data = $this->action_model->Data_Employee();
      $name['name'] = element('Name' , $data);
      $email['email'] = element('Email' , $data);
      $did['did'] = element('DID' , $data);
      $Report['reports'] = element('reports' , $data);
      $Employee['employee'] = element('employee' , $data);
      $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
      $Items['Disp_Item'] = element('Display_Items' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $total = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $query + $count + $noti + $num ;
      $this->load->view('project/UserLogin/Logged/districtData_Employee' , $total);

    }
    else{

       $this->load->view('project/UserLogin/Logged/Patient_Employee' , $total);
   }
  }


  public function Decrement(){
    $user = $this->input->get('user');
    $data = $this->action_model->Decrement($user);
    $this->cont_Dec();
  }
  public function cont_Dec(){
    $user = $this->input->get('user');
    $show['show'] = $this->action_model->Show_After_Decrement($user);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $d = $this->action_model->show_print();
    $name['name'] = element('Name' , $d);
    $did['did'] = element('DID' , $d);
    $email['email'] = element('Email' , $d);
    $total = $show + $noti + $num + $query + $count + $name + $did + $email;
    $this->load->view('project/Logged/Show_Quantity' , $total);
  }


  public function Decrement_Employee(){
    $user = $this->input->get('user');
    $data = $this->action_model->Decrement_Employee($user);
    $show['show'] = $this->action_model->Show_After_Decrement_Employee($user);
    $this->load->view('project/UserLogin/Logged/Show_Quantity_Employee' , $show);
  }


  public function Med_db(){
    $user = $this->input->get('user');
    //list($Med, $MID) = explode(" ", $user);
    $data = $this->action_model->Med_db($user);
    $choose['choose'] = element('choose' , $data);
    $Found['Found'] = element('Found' , $data);
    $data = $this->action_model->print_in_all();
    $name['name'] = element('name' , $data);
    $email['email'] = element('district_email' , $data);
    $total = $choose + $Found + $name + $email;
    if($Found['Found'] == 0){
      $data = $this->action_model->Data();
      $name['name'] = element('Name' , $data);
      $email['email'] = element('Email' , $data);
      $did['did'] = element('DID' , $data);
      $Report['reports'] = element('reports' , $data);
      $Employee['employee'] = element('employee' , $data);
      $Hospital['Disp_Hosp'] = element('Display_Hospital' , $data);
      $Items['Disp_Item'] = element('Display_Items' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $Found['Found'] = 3;
      $sum = $name + $email + $did + $Report + $Employee + $Hospital + $Items + $Found + $query + $count + $noti + $num ;
      $this->load->view('project/Logged/districtData' , $sum);

    }
    else{
      $this->load->view('project/Logged/Med', $total);
    }


  }

  public function Med_db_Employee(){
    $user = $this->input->get('user');
    $data['choose'] = $this->action_model->Med_db_Employee($user);
    $this->load->view('project/UserLogin/Logged/Med_Employee', $data);
  }

  public function Add_S_V(){
    $data['print'] = $this->action_model->show_rate();
    $data['Disp_Item'] = $this->action_model->District_Items();
    $this->Check_Death_Birth_Rate();
    $data['B_D_rate']  = $this->action_model->Get_Birth_Death_rate();
    $this->load->view('project/Logged/Serums_Vacciens' , $data);
  }



  public function Check_Death_Birth_Rate(){
    $current_date = date_create(date("Y-m-d"));
    $interval = 15;
    $District = $this->action_model->Get_spicific_District();
      //create date object
      $last_check_date = date_create($District[0]->last_Check_Date);
      //calculate differance between last_check_date and current date
      $time_difference = date_diff($last_check_date,$current_date);

      //convet from date object to string
      $last_check_date = $District[0]->last_Check_Date;
      if (( $time_difference->format("%a") == $interval ) || ( $time_difference->format("%a") > $interval ))
      {

        //Get number of birth
        $number_of_birth = $this->action_model->Get_numbers_of_birth();

        //Get number of death
        $number_of_death = $this->action_model->Get_numbers_of_death();

        //check death and brith rate if it not equal zero

          $total_number_of_patient = $District[0]->current_Number_Of_Patients + $number_of_birth - $number_of_death;
          $this->action_model->update_Birth_Death_rate($total_number_of_patient);
         }


  }


  public function Add_Item(){
    $Value = $this->action_model->Add_Select_db();
    $query['data'] = element('query', $Value);
    $check['check'] = element('check' , $Value);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $d = $this->action_model->show_print();
    $name['name'] = element('Name' , $d);
    $did['did'] = element('DID' , $d);
    $email['email'] = element('Email' , $d);
    $sum = $query + $check + $noti + $num + $query + $count + $name + $did + $email;
    $this->load->view('project/Logged/Add_serums_and_vacciens' , $sum);
  }


  public function Add_Item_Database(){
    $data['Disp_Item'] = $this->action_model->Add_District_Items();
  }

  public function Add_db(){
    $ch['check'] = $this->action_model->Add_db();
    $this->data['message'] = 'This Element is already exists';
    $Value = $this->action_model->Add_Select_db();
    $query['data'] = element('query', $Value);
    $check['check'] = element('check' , $Value);
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $d = $this->action_model->show_print();
    $name['name'] = element('Name' , $d);
    $did['did'] = element('DID' , $d);
    $email['email'] = element('Email' , $d);
    $sum = $this->data + $query + $ch + $noti + $num + $query + $count + $name + $did + $email;
    $this->load->view('project/Logged/Add_serums_and_vacciens' , $sum);
  }

  public function check_Rule(){
    $this->form_validation->set_message('check_Rule', 'This Element is already exists');
  }

  public function Delete_Item(){
     $user = $this->input->get('user');
     $this->action_model->Delete_Item_Database($user);

  }

public function Refill_Item(){
   $user = $this->input->get('user');
   $this->action_model->Refill_Item_Database($user);
   $this->getExpired();
}
  public function In_all(){
    $data = $this->action_model->print_in_all();
    $name['name'] = element('name' , $data);
    $email['email'] = element('district_email' , $data);
    $total = $name + $email;
  }

  public function Add_employee(){
    $note = $this->action_model->Notification();
    $noti['noti'] = element('noti' , $note);
    $num['num'] = element('num' , $note);
    $data = $this->action_model->print_in_all();
    $name['name'] = element('name' , $data);
    $email['email'] = element('district_email' , $data);
    $message = $this->action_model->get_message();
    $query['query'] = element('query' , $message);
    $count['count'] = element('count' , $message);
    $total = $noti + $num + $name + $email + $query + $count;
    $this->load->view('project/Logged/Add_Employee' , $total);
  }

  public function Add_employee_db(){
    $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

    $this->form_validation->set_rules('Name', 'Name', 'required|callback_username_check');
    $this->form_validation->set_rules('Username', 'Username', 'required');
    $this->form_validation->set_rules('Address', 'Address', 'required');
    $this->form_validation->set_rules('password_1', 'Password', 'required');
    $this->form_validation->set_rules('password_2', 'Password Confirmation', 'required|matches[password_1]');
    $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('SSN', 'SSN', 'required|exact_length[11]|numeric');
    $this->form_validation->set_rules('Phone', 'Phone', 'required|numeric');
    $this->form_validation->set_rules('Birthdate', 'Birthdate', 'required|callback_date_check');
    $this->form_validation->set_rules('Employment', 'Employment', 'required|callback_date_check_emp');
    $this->form_validation->set_rules('Graduation', 'Graduation', 'required|callback_grad_check');


    if ($this->form_validation->run() == FALSE){
        $note = $this->action_model->Notification();
        $noti['noti'] = element('noti' , $note);
        $num['num'] = element('num' , $note);
        $data = $this->action_model->print_in_all();
        $name['name'] = element('name' , $data);
        $email['email'] = element('district_email' , $data);
        $message = $this->action_model->get_message();
        $query['query'] = element('query' , $message);
        $count['count'] = element('count' , $message);
        $total = $noti + $num + $name + $email + $query + $count;
        $this->load->view('project/Logged/Add_Employee' , $total);
  }
  else{
    $data['Disp_Item'] = $this->action_model->Add_Employee_Database();
    $this->Add_employee();
  }
  }

  public function username_check($str)
	{
    $c = substr_count($str , ' ');
    if($str == ""){
        $this->form_validation->set_message('username_check', 'The name field is required.');
    }
		else if ($c < 3)
		{
			$this->form_validation->set_message('username_check', 'The name must be a full name');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}


  public function grad_check($str)
  {
      $format = "%Y-%m-%d";
      $date = mdate($format);
      $date1=date_create($str);
      $date2=date_create($date);
      $diff=date_diff($date1,$date2);
      $Max = $diff->format("%R%a");
      $final = floor($Max/(365));
      $date = $this->date_check($str);

      if($str == ""){
        $this->form_validation->set_message('date_check','The Graduation date field is required.');
      }
      else if($final < 1 ||$final >= 60){
          $this->form_validation->set_message('grad_check','Too young to graduate');
          return FALSE;
      }
      else{
        return TRUE;
      }
  }

  function date_check($str){
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $date1=date_create($str);
    $date2=date_create($date);
    $diff=date_diff($date1,$date2);
    $Max = $diff->format("%R%a");
    $final = floor($Max/(365));
    //$Add = $this->db->query("INSERT INTO New (Name , date1 , date2) VALUES ('$Fina' , '$date' , '$str')");
    if($str == ""){
      $this->form_validation->set_message('date_check','The Birthdate field is required.');
      return FALSE;
    }
    else if(21 >= $final || $final >= 60){
      $this->form_validation->set_message('date_check', 'This date is invalid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
  }


  function date_check_emp($str){
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $date1=date_create($str);
    $date2=date_create($date);
    $diff=date_diff($date1,$date2);
    $Max = $diff->format("%R%a");
    $final = floor($Max/(365));

    if($str == ""){
      $this->form_validation->set_message('date_check','The Employment date field is required.');
    }
    else if($final < 0 || $final >= 60){
      $this->form_validation->set_message('date_check', 'This date is invalid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }

    public function Res_Dis(){
        $getDistricts = $this->action_model->Find_Dis();
        $Found['Found'] = element('Found' , $getDistricts);
        if($Found['Found'] == 0){
          $data = $this->action_model->Reservation();
          $name['name'] = element('Name' , $data);
          $email['email'] = element('Email' , $data);
          $did['did'] = element('DID' , $data);
          $Reserve['Reserve'] = element('Reserve' , $data);
          $note = $this->action_model->Notification();
          $noti['noti'] = element('noti' , $note);
          $num['num'] = element('num' , $note);
          $message = $this->action_model->get_message();
          $query['query'] = element('query' , $message);
          $count['count'] = element('count' , $message);
          $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count;
          $this->load->view('project/Logged/reservations' , $total);
        }
        else{
          $Items['Items'] = element('Items' , $getDistricts);
          $sum = $Items ;
          $this->load->view( 'project/Logged/Add_Reservation' , $sum);
        }
    }

    public function Res_Dis_Employee(){
        $getDistricts = $this->action_model->Find_Dis_Employee();
        $Found['Found'] = element('Found' , $getDistricts);
        if($Found['Found'] == 0){
          $data = $this->action_model->Reservation_Employee();
          $name['name'] = element('Name' , $data);
          $email['email'] = element('Email' , $data);
          $did['did'] = element('DID' , $data);
          $Reserve['Reserve'] = element('Reserve' , $data);
          $note = $this->action_model->Notification_Employee();
          $noti['noti'] = element('noti' , $note);
          $num['num'] = element('num' , $note);
          $message = $this->action_model->get_message_Employee();
          $query['query'] = element('query' , $message);
          $count['count'] = element('count' , $message);
          $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count;
          $this->load->view('project/UserLogin/Logged/reservations_employee' , $total);
        }
        else{
          $Items['Items'] = element('Items' , $getDistricts);
          $sum = $Items ;
          $this->load->view( 'project/UserLogin/Logged/Add_Reservation_Employee' , $sum);
        }
    }


    public function repeat(){
      $getstandards = $this->action_model->repeat();
    }



    public function res_hos_form(){

    $this->load->model('Action_model');
    $getstandards=$this->Action_model->getstandards();
    $gethospital=$this->Action_model->gethospital();
    $getitem=$this->Action_model->getitem();
    $note = $this->action_model->Notification();
    $noti = element('noti' , $note);
    $num = element('num' , $note);
    $data = $this->action_model->print_in_all();
    $name = element('name' , $data);
    $email = element('district_email' , $data);
    $message = $this->action_model->get_message();
    $query = element('query' , $message);
    $count = element('count' , $message);
    //$total = $noti + $num + $name + $email + $query + $count;

    $this->load->view('project/Logged/res_hos_form',['getstandards'=>$getstandards,'gethospital'=>$gethospital,'getitem'=>$getitem , 'noti'=> $noti , 'num'=>$num , 'name' => $name
                                            ,  'email'=>$email , 'query'=> $query , 'count'=>$count]);
  }

  public function getrecords(){

  $this->load->model('Action_model');
  $data=array(
    "PID"=>$this->input->post("PID"),
    "HID"=>$this->input->post("HID"),
    "Box_Code"=>$this->input->post("Box_Code"),
    "date"=>$this->input->post("date")
  );

  $this->Action_model->insert_data2($data);
  }

  //district to hospital reservation(Omnia)
    public function dis_res_form(){

    $this->load->model('Action_model');
    $getdistrict=$this->Action_model->getdistrict();

    $getitem=$this->Action_model->getitem();
    $note = $this->action_model->Notification();
    $noti = element('noti' , $note);
    $num = element('num' , $note);
    $data = $this->action_model->print_in_all();
    $name = element('name' , $data);
    $email = element('district_email' , $data);
    $message = $this->action_model->get_message();
    $query = element('query' , $message);
    $count = element('count' , $message);
    //$total = $noti + $num + $name + $email + $query + $count;

    $this->load->view('project/Logged/dis_res_form',['getdistrict'=>$getdistrict,'getitem'=>$getitem , 'noti'=> $noti , 'num'=>$num , 'name' => $name
                                            ,  'email'=>$email , 'query'=> $query , 'count'=>$count]);
    }


    public function getrecords2(){
    $this->load->model('Action_model');
    $data=array(
      "DID"=>$this->input->post("DID"),
      "Box_Code"=>$this->input->post("Box_Code"),
      "quantity"=>$this->input->post("quantity")
    );

    $this->Action_model->insert_data($data);
    //echo 'ok';
    }

    //rfh database update
   public function update_rfh()
    {
      $save=array(
        'PID'=>$this->input->post('PID'),
        'HID'=>$this->input->post('HID'),
        'itemcode'=>$this->input->post('itemcode'),
        'date'=>$this->input->post('date')
      );
      $this->Action_model->save_rfh($save);
    }


    public function reserve_Item(){
      $user = $this->input->get('user');
      $this->session->set_userdata('array',$user);
      $check['check'] = 0;
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check;
      $this->load->view('project/Logged/Patient_Name',$total);
      //$Name = $_POST['Name'];
      //$array = $user ;
      //$this->action_model->Reserve_Database($array);
    }

    public function reserve_Item_Employee(){
      $user = $this->input->get('user');
      $this->session->set_userdata('array',$user);
      $check['check'] = 0;
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all_Employee();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check;
      $this->load->view('project/UserLogin/Logged/Patient_Name_Employee',$total);
      //$Name = $_POST['Name'];
      //$array = $user ;
      //$this->action_model->Reserve_Database($array);
    }

    public function again(){
      $check['check'] = 1;
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check;
      $this->load->view('project/Logged/Patient_Name',$total);
    }

    public function again_Employee(){
      $check['check'] = 1;
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all_Employee();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check;
      $this->load->view('project/UserLogin/Logged/Patient_Name_Employee',$total);
    }
    public function reserve_all(){
      $Name = $_POST['Name'];

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $this->form_validation->set_rules('Name', 'Name', 'required|callback_username_check');
      $this->form_validation->set_rules('code', 'code', 'required');

      if ($this->form_validation->run() == FALSE){
        $user = $this->input->get('user');
        $this->session->set_userdata('array',$user);
        $check['check'] = 0;
        $note = $this->action_model->Notification();
        $noti['noti'] = element('noti' , $note);
        $num['num'] = element('num' , $note);
        $data = $this->action_model->print_in_all();
        $name['name'] = element('name' , $data);
        $email['email'] = element('district_email' , $data);
        $message = $this->action_model->get_message();
        $query['query'] = element('query' , $message);
        $count['count'] = element('count' , $message);
        $total = $noti + $num + $name + $email + $query + $count + $check;
        $this->load->view('project/Logged/Patient_Name',$total);
    }
    else{
    $this->action_model->Reserve_Database($Name);
    }

    }
    public function reserve_all_Employee(){
      $Name = $_POST['Name'];
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $this->form_validation->set_rules('Name', 'Name', 'required|callback_username_check');
      $this->form_validation->set_rules('code', 'code', 'required');

      if ($this->form_validation->run() == FALSE){
        $user = $this->input->get('user');
        $this->session->set_userdata('array',$user);
        $check['check'] = 0;
        $note = $this->action_model->Notification_Employee();
        $noti['noti'] = element('noti' , $note);
        $num['num'] = element('num' , $note);
        $data = $this->action_model->print_in_all_Employee();
        $name['name'] = element('name' , $data);
        $email['email'] = element('district_email' , $data);
        $message = $this->action_model->get_message_Employee();
        $query['query'] = element('query' , $message);
        $count['count'] = element('count' , $message);
        $total = $noti + $num + $name + $email + $query + $count + $check;
        $this->load->view('project/UserLogin/Logged/Patient_Name_Employee',$total);
    }
    else{
      $this->action_model->Reserve_Database_Employee($Name);
    }

    }

    public function again_Quantity(){
      $check['check'] = 2;
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check ;
      $this->load->view('project/Logged/Patient_Name',$total);
    }

    public function again_Quantity_Employee(){
      $check['check'] = 2;
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all_Employee();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check ;
      $this->load->view('project/UserLogin/Logged/Patient_Name_Employee',$total);
    }

    public function again_MR_Code(){
      $check['check'] = 3;
      $note = $this->action_model->Notification();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check ;
      $this->load->view('project/Logged/Patient_Name',$total);
    }

    public function again_MR_Code_Employee(){
      $check['check'] = 3;
      $note = $this->action_model->Notification_Employee();
      $noti['noti'] = element('noti' , $note);
      $num['num'] = element('num' , $note);
      $data = $this->action_model->print_in_all_Employee();
      $name['name'] = element('name' , $data);
      $email['email'] = element('district_email' , $data);
      $message = $this->action_model->get_message_Employee();
      $query['query'] = element('query' , $message);
      $count['count'] = element('count' , $message);
      $total = $noti + $num + $name + $email + $query + $count + $check ;
      $this->load->view('project/UserLogin/Logged/Patient_Name_Employee',$total);
    }


    public function Add_Reservation(){

     $this->load->model('action_model');
     $getDistricts['getDistricts'] = $this->action_model->getDist();
     $this->load->view( 'project/Logged/Add_Reservation' , $getDistricts);
    //$name['name'] = element('Name' , $data);
    //$email['email'] = element('Email' , $data);
    //$did['did'] = element('DID' , $data);
  }

  public function getDist(){
    $this->load->model('action_model');
    $district = $this->input->post('DistrictID');
    //$getDistricts = $this->action_model->getDist();
    $record = $this->action_model->getDistr($district);
    //echo '<pre>';
    //print_r($record);
    //echo '</pre>';
    //end();
    $this->load->view( 'project/Logged/Add_Reservation_Table' , ['getDistricts' => $getDistricts , 'record' => $record] );
  }

  public function run(){
  $this->cron_model->run_my_query();
  }

  public function email(){
    $this->action_model->send_mail();
  }

  public function ContactFrom(){
    $this->load->view('project/Logged/Email');
  }
  public function ContactFrom_Employee(){
    $this->load->view('project/UserLogin/Logged/Email_Employee');
  }
  public function SendEmail(){
    $this->action_model->Email();
    $this->login();
  }
  public function SendEmail_Employee(){
    $this->action_model->Email_Employee();
    $this->User_Login();
  }
  public function chat(){
    $this->load->view('project/chat/login');
  }
  public function chat_check(){
  redirect("http://localhost/chat/login.php");
    //$this->action_model->login_chat();
  }
  public function chat_check_Employee(){
  redirect("http://localhost/chat_Employee/login.php");
    //$this->action_model->login_chat();
  }


  public function getExpired(){
      $data = $this->action_model->show_expired();
      $pick['pick'] = element('pick', $data);
      $zero['zero'] = element('zero' , $data);
      $choose['choose'] = 0;
      $total = $pick + $zero + $choose;
      $this->load->view( 'project/Logged/ExpiredItems', $total);
    }
    public function getExpired_Employee(){
        $data = $this->action_model->show_expired_Employee();
        $pick['pick'] = element('pick', $data);
        $zero['zero'] = element('zero' , $data);
        $choose['choose'] = 0;
        $total = $pick + $zero + $choose;
        $this->load->view( 'project/UserLogin/Logged/ExpiredItems_Employee', $total);
      }

 public function Map(){
   $this->load->view( 'project/Logged/Map');
 }

 public function open_mail(){
   $user = $this->input->get('user');
   if($user == "West District"){
     redirect("https://mail.google.com/mail/u/1/#inbox");
   }
   else if($user == "North District"){
     redirect("https://mail.google.com/mail/u/4/?ogbl#inbox");
   }
   //redirect("https://mail.google.com/mail/u/1/#inbox");
 }

 public function Reserve_Anothor_District(){
    $user = $this->input->get('user');
     $data['Found'] = $this->action_model->get_Reserve_Anothor_District($user);
     if($data['Found'] == 3){
       $data = $this->action_model->Reservation();
       $name['name'] = element('Name' , $data);
       $email['email'] = element('Email' , $data);
       $did['did'] = element('DID' , $data);
       $Reserve['Reserve'] = element('Reserve' , $data);
       $Found['Found'] = 3;
       $note = $this->action_model->Notification();
       $noti['noti'] = element('noti' , $note);
       $num['num'] = element('num' , $note);
       $message = $this->action_model->get_message();
       $query['query'] = element('query' , $message);
       $count['count'] = element('count' , $message);
       $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count ;
       $this->load->view('project/Logged/reservations' , $total);
     }
     else{
     $this->Reservation();
   }
 }

 public function Reserve_Anothor_District_Employee(){
    $user = $this->input->get('user');
     $data['data'] = $this->action_model->get_Reserve_Anothor_District_Employee($user);
     if($data['Found'] == 3){
       $data = $this->action_model->Reservation_Employee();
       $name['name'] = element('Name' , $data);
       $email['email'] = element('Email' , $data);
       $did['did'] = element('DID' , $data);
       $Reserve['Reserve'] = element('Reserve' , $data);
       $Found['Found'] = 3;
       $note = $this->action_model->Notification_Employee();
       $noti['noti'] = element('noti' , $note);
       $num['num'] = element('num' , $note);
       $message = $this->action_model->get_message_Employee();
       $query['query'] = element('query' , $message);
       $count['count'] = element('count' , $message);
       $total = $name + $email + $did + $Reserve + $Found + $noti + $num + $query + $count ;
       $this->load->view('project/Logged/reservations' , $total);
     }
     else{
       $this->Reservation_Employee();
     }
 }

 public function Filter(){
  $choose['choose'] = $this->action_model->Filter_item();
  $data = $this->action_model->show_expired();
  $pick['pick'] = element('pick', $data);
  $zero['zero'] = element('zero' , $data);
  $total = $pick + $zero + $choose;
  $this->load->view( 'project/Logged/ExpiredItems', $total);
 }
 public function Filter_Employee(){
  $choose['choose'] = $this->action_model->Filter_item_Employee();
  $data = $this->action_model->show_expired_Employee();
  $pick['pick'] = element('pick', $data);
  $zero['zero'] = element('zero' , $data);
  $total = $pick + $zero + $choose;
  $this->load->view( 'project/UserLogin/Logged/ExpiredItems_Employee', $total);
 }

function sdf(){
  $ch = $this->action_model->sdf();
}

function Setting_Page(){
  $this->load->view( 'project/Logged/Settings');
}
  }
