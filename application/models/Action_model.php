<?php
/**
 *
 */
class Action_model extends CI_Model
{

  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
  }


  public function select_all_data(){
    // it selsct all data from tables
    //$this->repeat();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $this->db->select("*");
    $this->db->from("admin");
    $this->db->where(array('username' => $username , 'password' => $password ));
    $query=$this->db->get();
    $result = $query->result();
    $num=count($result);

    if($num == 1){
    $_SESSION['username'] = $username;
    //$this->session->set_userdata('some_name', 'some_value');
    $this->session->set_userdata('username', $username);
    redirect("http://localhost/CI3/index.php/project/login");
  }
  else{
    redirect("http://localhost/CI3/");
  }
    //return $result = $query->result();
  }

  function print_in_all(){
    $name = $this->session->userdata('username');
    $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query->result_array() as $row){
       $Name = $row['name'];
       $email = $row['email'];
       $did = $row['DID'];

    }
    $_SESSION['DID'] = $did;
    //$this->session->set_userdata('some_name', 'some_value');
    $this->session->set_userdata('DID', $did);
    $arrayName = array('name' => $Name, 'district_email' => $email , 'district_did' => $did ) ;
    return $arrayName;
  }

  function print_in_all_Employee(){
    $name = $this->session->userdata('userusername');
    $query = $this->db->query("SELECT * FROM employee , district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query->result_array() as $row){
       $dis_name = $row['name'];
       $dis_email = $row['email'];
       $dis_did = $row['DID'];
       $employee_name = $row['userusername'];
    }

    $_SESSION['DID'] = $dis_did;
    //$this->session->set_userdata('some_name', 'some_value');
    $this->session->set_userdata('DID', $dis_did);
    $arrayName = array('name' => $dis_name, 'district_email' => $dis_email , 'district_did' => $dis_did ) ;
    return $arrayName;
  }


  function select_all_data_employees(){
    //  $this->repeat();
      $username_employee = $_POST['username'];
      $password_employee = $_POST['password'];
      $this->db->select("*");
      $this->db->from("Employee");
      $this->db->where(array('userusername' => $username_employee , 'userpassword' => $password_employee ));
      $query=$this->db->get();
      $result = $query->result();
      $num=count($result);
      //echo $num;
      if($num == 1){
      //$_SESSION['username'] = $username;
      //$this->session->set_userdata('some_name', 'some_value');
      $this->session->set_userdata('userusername', $username_employee);
      redirect("http://localhost/CI3/index.php/project/User_Login");
    }
    else{
      echo"no";
      redirect("http://localhost/CI3/index.php/project/Login_User");
    }
  }

   function User_Login_Check(){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee , district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $dis_name = $row['name'];
        $dis_email = $row['email'];
        $dis_did = $row['DID'];
        $employee_name = $row['userusername'];

     }
     $this->repeat_Employee();
     $this->get_expired_Employee();
     $count = $this->db->query("SELECT PID FROM district, patient WHERE district.DID = patient.DID AND district.DID = '$dis_did'");
     //echo $this->db->count_all_results();
     //$query=$this->db->get();
     $countOrder = $this->db->query("SELECT RID FROM reservation_from_district WHERE rTo = '$dis_did' AND Done = 0");

     $dispHosp =$this->db->query("SELECT hospital.name, hospital.location FROM hospital WHERE hospital.DID = '$dis_did'");


     $dispItem = $this->db->query("SELECT serums_vaccines_items.name, serums_vaccines_items.lot_num FROM district_item , serums_vaccines_items
        WHERE district_item.DID = '$dis_did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0 ");

   //  $dispDistricts = $this->db->query("SELECT name, location FROM district WHERE district.DID = '$id'");
     $dispDistricts = $this->db->query("SELECT name, location FROM district WHERE district.DID = '$dis_did'");

     $dispEmployees = $this->db->query("SELECT employee.EID,employee.name,employee.userusername,
                               employee.phone_num,employee.email FROM employee WHERE employee.DID='$dis_did'");

     $c2 = $countOrder->num_rows();
     $c = $count->num_rows();

     $arrayName = array('ditrict_name' => $dis_name, 'district_email' => $dis_email , 'district_did' => $dis_did , 'employee_name' => $name , 'count' => $c , 'Disp_Hospital' => $dispHosp , 'Disp_Items' => $dispItem ,'Count_Order' => $c2, 'Disp_Districts' => $dispDistricts ) ;
     return $arrayName;

   }

   function print_select_data(){
      $name = $this->session->userdata('username');
      $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
      foreach ($query->result_array() as $row){
         $x = $row['name'];
      }
      return $x;
   }

    function print_data(){
      $name = $this->session->userdata('username');
      $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
      foreach ($query->result_array() as $row){
         $id = $row['DID'];
      }
      $this->repeat();
      $this->get_expired();
      $count = $this->db->query("SELECT PID FROM district, patient WHERE district.DID = patient.DID AND district.DID = '$id'");
      //echo $this->db->count_all_results();
      //$query=$this->db->get();
      $countOrder = $this->db->query("SELECT RID FROM reservation_from_district WHERE rTo = $id AND Done = 0 AND Deleted = 0");

      $dispHosp =$this->db->query("SELECT hospital.name, hospital.location FROM hospital WHERE hospital.DID = '$id'");


      $dispItem = $this->db->query("SELECT serums_vaccines_items.name, serums_vaccines_items.lot_num FROM district_item , serums_vaccines_items
         WHERE district_item.DID = '$id' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0 ");

    //  $dispDistricts = $this->db->query("SELECT name, location FROM district WHERE district.DID = '$id'");
      $dispDistricts = $this->db->query("SELECT name, location FROM district");

      $dispEmployees = $this->db->query("SELECT employee.EID,employee.name,employee.userusername,
                                employee.phone_num,employee.email FROM employee WHERE employee.DID='$id'");

      $c2 = $countOrder->num_rows();
      $c = $count->num_rows();

      $arrayName = array('countOrder' => $c2, 'count' => $c , 'Display_Hospital' => $dispHosp , 'Display_Hospital_Item' => $dispItem , 'District' => $dispDistricts , 'Display_Employees' => $dispEmployees);
      return $arrayName;
      //count($records)    , 'Disp_Name' => $disp_name , 'Disp_Location' => $disp_location
    }

   public function Data(){

       $name = $this->session->userdata('username');
       $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
       foreach ($query->result_array() as $row){
          $name = $row['name'];
          $email = $row['email'];
          $did = $row['DID'];
       }
       $this->repeat();
       $this->get_expired();
       $dispReports = $this->db->query("SELECT medical_report.MRID, patient.Name, medical_report.dr_name,
                                          prescription.presc_med FROM medical_report,patient, prescription WHERE patient.DID = '$did' AND
                                          patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID");

      $dispEmployees = $this->db->query("SELECT employee.EID,employee.name,employee.userusername,
                                            employee.phone_num,employee.email FROM employee WHERE employee.DID='$did'");

      $dispHosp = $this->db->query("SELECT hospital.name, hospital.location FROM hospital WHERE hospital.DID ='$did'");

      $dispItems = $this->db->query("SELECT serums_vaccines_items.name, serums_vaccines_items.lot_num, district_item.item_code,
                                             serums_vaccines_items.prod_date, serums_vaccines_items.exp_date FROM district_item , serums_vaccines_items
                                             WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0");

       $Found = 1;

       $array = array('Name' => $name , 'Email' => $email , 'DID' => $did , 'reports' => $dispReports , 'employee' => $dispEmployees , 'Display_Hospital' =>  $dispHosp , 'Display_Items' => $dispItems , 'Found' => $Found);
       return $array;

   }



   public function Data_Employee(){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
          $name = $row['name'];
          $email = $row['email'];
          $did = $row['DID'];
       }
       $this->repeat_Employee();
       $this->get_expired_Employee();
       $dispReports = $this->db->query("SELECT medical_report.MRID, patient.Name, medical_report.dr_name,
                                          prescription.presc_med FROM medical_report,patient, prescription WHERE patient.DID = '$did' AND
                                          patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID");

      $dispEmployees = $this->db->query("SELECT employee.EID,employee.name,employee.userusername,
                                            employee.phone_num,employee.email FROM employee WHERE employee.DID='$did'");

      $dispHosp = $this->db->query("SELECT hospital.name, hospital.location FROM hospital WHERE hospital.DID ='$did'");

      $dispItems = $this->db->query("SELECT serums_vaccines_items.name, serums_vaccines_items.lot_num, district_item.item_code,
                                             serums_vaccines_items.prod_date, serums_vaccines_items.exp_date FROM district_item , serums_vaccines_items
                                             WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0");

       $Found = 1;

       $array = array('Name' => $name , 'Email' => $email , 'DID' => $did , 'reports' => $dispReports , 'employee' => $dispEmployees , 'Display_Hospital' =>  $dispHosp , 'Display_Items' => $dispItems , 'Found' => $Found);
       return $array;
   }


   public function Reservation(){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $this->repeat();
     $Found = 1;
     $dispReserves = $this->db->query("SELECT reservation_from_district.res_date, reservation_from_district.PID, serums_vaccines_items.name, patient.Name , reservation_from_district.rFrom,
                                               reservation_from_district.rTo , reservation_from_district.Box_Code ,reservation_from_district.RID FROM reservation_from_district, serums_vaccines_items , patient  WHERE  (reservation_from_district.rTo = '$did')
                                               AND reservation_from_district.rFrom != reservation_from_district.rTo AND serums_vaccines_items.Box_Code = reservation_from_district.Box_Code
                                               AND patient.PID = reservation_from_district.PID AND reservation_from_district.Done = 0 AND reservation_from_district.Deleted = 0");

     $array = array('Name' => $name , 'Email' => $email , 'DID' => $did , 'Reserve' => $dispReserves , 'Found' => $Found );
     return $array;
   }

   public function Reservation_Employee(){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $this->repeat_Employee();
     $Found = 1;
     $dispReserves = $this->db->query("SELECT reservation_from_district.res_date, reservation_from_district.PID, serums_vaccines_items.name, patient.Name , reservation_from_district.rFrom,
                                               reservation_from_district.rTo , reservation_from_district.Box_Code ,reservation_from_district.RID FROM reservation_from_district, serums_vaccines_items , patient  WHERE  (reservation_from_district.rTo = '$did')
                                               AND reservation_from_district.rFrom != reservation_from_district.rTo AND serums_vaccines_items.Box_Code = reservation_from_district.Box_Code
                                               AND patient.PID = reservation_from_district.PID AND reservation_from_district.Done = 0 AND reservation_from_district.Deleted = 0");

     $array = array('Name' => $name , 'Email' => $email , 'DID' => $did , 'Reserve' => $dispReserves , 'Found' => $Found );
     return $array;
   }

  public function show_print(){
    $name = $this->session->userdata('username');
    $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query->result_array() as $row){
       $name = $row['name'];
       $email = $row['email'];
       $did = $row['DID'];
    }
    $array = array('Name' => $name , 'Email' => $email , 'DID' => $did );
    return $array;
  }

   public function District_Items(){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $this->repeat();
     $dispItems = $this->db->query("SELECT serums_vaccines_items.name, district_item.IID ,serums_vaccines_items.lot_num, district_item.item_code,
                                            serums_vaccines_items.prod_date, serums_vaccines_items.exp_date , serums_vaccines_items.Production_Company
                                            FROM district_item , serums_vaccines_items
                                            WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0 AND district_item.expired = 0");
     return $dispItems;
   }

   function Add_District_Items(){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $this->repeat();
     $Add = $this->db->query("INSERT INTO district_item (IID, item_code, lot_num , DID) VALUES ('John', 'Doe', '$did')");
   }


   function Delete_Item_Database($user){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }

    $this->db->query("DELETE FROM district_item WHERE DID='$did' AND district_item.IID = '$user'");
    redirect("http://localhost/CI3/index.php/project/Add_S_V");
   }

   function Refill_Item_Database($user){
     $name = $this->session->userdata('username');
     $format = "%Y-%m-%d";
     $date = mdate($format);

     $query_N = $this->db->query("SELECT district.name , district.DID , district.email , district.password FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query_N->result_array() as $row){
        $did = $row['DID'];
        $mail = $row['email'];
        $pass = $row['password'];
        $Name = $row['name'];
     }
      $query = $this->db->query("SELECT  district_item.item_code , serums_vaccines_items.name , serums_vaccines_items.prod_date , serums_vaccines_items.exp_date ,
        serums_vaccines_items.Production_Company , serums_vaccines_items.lot_num FROM district , district_item , serums_vaccines_items WHERE district.DID = '$did' AND district.DID = district_item.DID AND district_item.item_code = '$user'
          AND district_item.item_code = serums_vaccines_items.Box_Code ");
      foreach ($query->result_array() as $row){
         $Box_Code = $row['item_code'];
         $N_ame = $row['name'] ;
         $Lotnum = $row['lot_num'] ;
         $prodate = $row['prod_date'] ;
         $expdate = $row['exp_date'] ;
         $procompany = $row['Production_Company'] ;
}
             $config = array(
                   'protocol' => 'smtp',
                   'smtp_host' => 'ssl://smtp.gmail.com',
                   'smtp_port' => 465,
                   'smtp_user' => $mail,
                   'smtp_pass' => $pass,
                   'mailtype' => 'html',
                   'charset' => 'iso-8859-1'
         );
         $this->email->initialize($config);
         $this->email->set_mailtype("html");
         $this->email->set_newline("\r\n");

         //Email content

      //   $htmlContent = '<h1>Sending email about Refilling quantity for an item before the time</h1>';
         //$htmlContent .= "<p>This email has sent via District </p> <br>";
         //$htmlContent .= "<p>We are ordering a refill for Item $user  </p>";
         $htmlContent = " <html>
                            <head>
                              <title>Refilling Quantity</title>
                            </head>
                            <body>
                              <p>Hello Main Inventory,</p>
                              <p>We are writing for requestig a refilling order for this item: </p>
                              <br>
                           <table>
                            <thead>
                              <tr>
                                 <th>name</th>
                                 <th>lot number</th>
                                 <th>item code</th>
                                 <th>production date</th>
                                 <th>expirtation date</th>
                                 <th>Production Company</th>
                               </tr>
                              </thead>
                               <tbody>
                              <tr>

                                   <td> $N_ame </td>
                                   <td>$Lotnum</td>
                                   <td>$user</td>
                                   <td>$prodate</td>
                                   <td>$expdate</td>
                                   <td>$procompany</td>
                              </tr>
                          </tbody>
                          </table>
                          </body>
                        </html>";

         $this->email->to('Main.Inventory.Alexandria@gmail.com');
         $this->email->from($mail , 'Refill Mail');
         $this->email->subject('Refill Mail');
         $this->email->message($htmlContent);

         //Send email
         $this->email->send();
   }

   function Add_Select_db(){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district,serums_vaccines_items WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
        $box_code = $row['Box_Code'];
     }
     $this->repeat();
     $check = 1;
     $array = array('query' => $query , 'check' => $check );
     return $array;
   }

   function Add_db(){
     //echo "hi";
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }
     $day = date("d");
     $box = $_POST['itemcode'];
     $quantity = $_POST['quantity'];
     $c = 6;
     $query = $this->db->query("SELECT * FROM district_item  WHERE district_item.DID = '$did' ");
     foreach ($query->result_array() as $row){
        $code = $row['item_code'];
        $refill = $row['quantity_refill'];
       if($box == $code){
          $c = 0;
          break;
        }
        else if($box == ""){
          $c = 2;
          break;
        }
     }
     if($c == 0){
       return 0;
     }
     else if($c == 2){
       return 2;
     }
     else if($c == 3){
       $query = $this->db->query("UPDATE district_item SET quantity = '$quantity' WHERE item_code = '$box'AND DID = '$did' ");
       $query_1 = $this->db->query("UPDATE district_item SET quantity_refill = 1 WHERE item_code = '$box'AND DID = '$did' ");
     }
     else{
       $query = $this->db->query("INSERT INTO district_item (item_code , quantity , DID)
            VALUES('$box', '$quantity' ,'$did')");
            return 6;
      // redirect("http://localhost/CI3/index.php/project/Add_S_V");
     }
   }

   function Patient_db(){

     $search = $_POST['search'];

     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $this->repeat();
     $dispReports = $this->db->query("SELECT patient.Name, patient.address , patient.SSN , patient.PID , patient.birthdate ,patient.PID , patient.phone1 , patient.phone2
                                         FROM patient WHERE patient.DID = '$did' AND patient.name LIKE '$search%' ");
     $k = $dispReports->num_rows();
     $disp = $this->db->query("SELECT medical_report.MRID, medical_report.MRdate , medical_report.diagnosis , medical_report.report , medical_report.dr_name,
                                     prescription.presc_med FROM ((patient INNER JOIN medical_report ON patient.PID=medical_report.PID)
                                     INNER JOIN prescription ON  medical_report.MRID=prescription.MRID)
                                     WHERE patient.DID = '$did' AND patient.Name LIKE '$search%' ;");


                                     $choose=$this->db->query("SELECT prescription.presc_med, district_item.item_code ,district_item.quantity , serums_vaccines_items.exp_date FROM serums_vaccines_items , district_item ,  medical_report , patient , prescription WHERE patient.DID = '$did' AND patient.name LIKE '$search%' AND
                                                                                                      patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID
                                                                                                      AND prescription.presc_med like serums_vaccines_items.name AND district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0 ");
    $c = substr_count($search , ' ');
    if ($c < 3 && $k != 0){
      $k = 2;
    }

     $array = array('patient' => $dispReports , 'Reports' => $disp , 'choose' => $choose , 'Found' => $k);
     return $array;
   }

   function Patient_db_emp(){
     $search = $_POST['search'];
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     $dispReports = $this->db->query("SELECT patient.Name, patient.address , patient.SSN , patient.PID , patient.birthdate ,patient.PID , patient.phone1 , patient.phone2
                                         FROM patient WHERE patient.DID = '$did' AND patient.name LIKE '$search%' ");
     $k = $dispReports->num_rows();
     $disp = $this->db->query("SELECT medical_report.MRID, medical_report.MRdate , medical_report.diagnosis , medical_report.report , medical_report.dr_name,
                                     prescription.presc_med FROM ((patient INNER JOIN medical_report ON patient.PID=medical_report.PID)
                                     INNER JOIN prescription ON  medical_report.MRID=prescription.MRID)
                                     WHERE patient.DID = '$did' AND patient.Name LIKE '$search%' ;");


    $choose=$this->db->query("SELECT prescription.presc_med, district_item.item_code ,district_item.quantity , serums_vaccines_items.exp_date FROM serums_vaccines_items , district_item ,  medical_report , patient , prescription WHERE patient.DID = '$did' AND patient.name LIKE '$search%' AND
                                                patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID
                                                AND prescription.presc_med like serums_vaccines_items.name AND district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0 ");
    $c = substr_count($search , ' ');
    if ($c < 3 && $k != 0){
      $k = 2;
    }

     $array = array('patient' => $dispReports , 'Reports' => $disp , 'choose' => $choose , 'Found' => $k);
     return $array;

   }


   function Med_db($user){
     //$search = $_POST['search'];
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     list($Med, $MID) = explode(" ", $user);
     $this->session->set_userdata('MRID', $MID);
     $choose=$this->db->query("SELECT prescription.presc_med, district_item.item_code ,district_item.quantity , serums_vaccines_items.exp_date FROM serums_vaccines_items , district_item ,  medical_report , patient , prescription WHERE patient.DID = '$did' AND district_item.DID = '$did' AND
                                                                      patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID
                                                                      AND prescription.presc_med like '$Med%' AND serums_vaccines_items.name  LIKE prescription.presc_med AND district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0 AND district_item.expired = 0");
     $Quota_Over = $this->db->query("SELECT quota_quantity FROM medical_report WHERE MRID = '$MID'");
     foreach ($Quota_Over->result_array() as $row){
        $Quota = $row['quota_quantity'];
     }
     $array = array('choose' => $choose , 'Found' => $Quota);
     return $array;
   }

   function Med_db_Employee($user){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $name = $row['name'];
        $email = $row['email'];
        $did = $row['DID'];
     }
     list($Med, $MID) = explode(" ", $user);
     $this->session->set_userdata('MRID', $MID);

     $choose=$this->db->query("SELECT prescription.presc_med, district_item.item_code ,district_item.quantity , serums_vaccines_items.exp_date FROM serums_vaccines_items , district_item ,  medical_report , patient , prescription WHERE patient.DID = '$did'  AND district_item.DID = '$did' AND
                                                                      patient.PID=medical_report.PID AND medical_report.MRID=prescription.MRID
                                                                      AND prescription.presc_med like '$Med%' AND serums_vaccines_items.name  LIKE prescription.presc_med AND district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0 ");
     return $choose;
   }

   function Decrement($user){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }
      $pid = $this->session->userdata('patient');
      $MRID = $this->session->userdata('MRID');

      $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$pid' AND quota_quantity > 0 AND item_code ='$user' AND DID = '$did'");
      //$Add = $this->db->query("INSERT INTO New (Name , data1 , date2) VALUES ('$MRID' , '$quota' , '$result')");
      $choose=$this->db->query("UPDATE district_item , medical_report SET quantity = quantity -1 WHERE item_code ='$user' AND quantity > 0 AND medical_report.PID = '$pid' AND medical_report.MRID = '$MRID' AND medical_report.quota_quantity != 0 AND district_item.DID = '$did'");
      return;
   }

   function Decrement_Employee($user){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }
     $pid = $this->session->userdata('patient');
     $MRID = $this->session->userdata('MRID');
     $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$pid' AND quota_quantity > 0 AND item_code ='$user' AND DID = '$did'");
     //$Add = $this->db->query("INSERT INTO New (Name , data1 , date2) VALUES ('$MRID' , '$quota' , '$result')");
     //$choose=$this->db->query("UPDATE district_item , medical_report SET quantity = quantity -1 WHERE item_code ='$user' AND district_item.DID = '$did' AND quantity > 0 AND medical_report.PID = '$pid' AND medical_report.MRID = '$MRID' AND medical_report.quota_quantity != 0");
   }

   function Show_After_Decrement($user){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }

     $show=$this->db->query("SELECT district_item.quantity , serums_vaccines_items.name ,district_item.item_code FROM district_item , serums_vaccines_items
       WHERE district_item.item_code = '$user' AND district_item.DID = '$did' AND  district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0");

      return $show;
   }


   function Show_After_Decrement_Employee($user){
     $name = $this->session->userdata('userusername');
     $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }
     $show=$this->db->query("SELECT district_item.quantity , serums_vaccines_items.name ,district_item.item_code FROM district_item , serums_vaccines_items
       WHERE district_item.item_code = '$user' AND  district_item.item_code = serums_vaccines_items.Box_Code AND district_item.deleted = 0 ");
     return $show;
   }

   function Add_Employee_Database(){
     $name = $this->session->userdata('username');
     $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query->result_array() as $row){
        $did = $row['DID'];
     }
           $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $SSN = $_POST['SSN'];
            $Address = $_POST['Address'];
            $Position = $_POST['Position'];
            $Phone = $_POST['Phone'];
            $Username = $_POST['Username'];
            $Graduation = $_POST['Graduation'];
            $password_1 = $_POST['password_1'];
            $password_2 = $_POST['password_2'];
            $Employment = $_POST['Employment'];
            $Birthdate = $_POST['Birthdate'];
            $query = $this->db->query("INSERT INTO employee (SSN , DID , emp_date, position , address , phone_num , name , grad_date , birthdate , userusername , userpassword ,email)
                   VALUES('$SSN', '$did', '$Employment' ,'$Position', '$Address', '$Phone', '$Name' ,  '$Graduation', '$Birthdate', '$Username' , '$password_1' , '$Email')");

     //if (isset($_POST['reg_user'])) {
  // receive all input values from the form


      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      /*if (empty($username)) { array_push($errors, "Username is required"); }
      if (empty($email)) { array_push($errors, "Email is required"); }
      if (empty($password_1)) { array_push($errors, "Password is required"); }
      if ($password_1 != $password_2) {
    	array_push($errors, "The two passwords do not match");
      }

      // first check the database to make sure
      // a user does not already exist with the same username and/or email
      $user_check_query = $this->db->query("SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1");
      //$result = $this->db->query($user_check_query);
      $result = $user_check_query->result();
      //$user = mysqli_fetch_assoc($result);

      //if ($result) { // if user exists
      //  if ($result['username'] === $username) {
        //array_push($errors, "Username already exists");
    //  }


        //if ($result['email'] === $email) {
      //  array_push($errors, "email already exists");
      //  }
      //}

      // Finally, register user if there are no errors in the form

      if (count($errors) == 0) {
      	$password = md5($password_1);//encrypt the password before saving in the database
*/


      	//mysqli_query($db, $query);
      //}
    //}
    //return $errors;
}




public function getDist(){
   $name = $this->session->userdata('username');
   $query = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
   foreach ($query->result_array() as $row){
      $name = $row['name'];
      $email = $row['email'];
      $did = $row['DID'];
   }
   $dispReserves = $this->db->query("SELECT reservation_from_district.res_date, reservation_from_district.PID, serums_vaccines_items.name, patient.name , reservation_from_district.rFrom,
                                             reservation_from_district.rTo FROM reservation_from_district, serums_vaccines_items , patient WHERE  (reservation_from_district.rFrom = '$did') AND reservation_from_district.rFrom != reservation_from_district.rTo AND serums_vaccines_items.Box_Code = reservation_from_district.Box_Code AND patient.PID = reservation_from_district.PID");

   return $dispReserves;
 }

 public function getDistr($district){
   $name = $this->session->userdata('username');
   $dispItems = $this->db->query("SELECT serums_vaccines_items.name, district_item.IID ,serums_vaccines_items.lot_num, district_item.item_code,
                                        serums_vaccines_items.prod_date, serums_vaccines_items.exp_date , serums_vaccines_items.Production_Company FROM district, district_item , serums_vaccines_items WHERE district_item.DID = '1' AND serums_vaccines_items.Box_Code = district_item.item_code ");
  //$this->db->select('serums_vaccines_items.name', 'district_item.IID' ,'serums_vaccines_items.lot_num', 'district_item.item_code',
    //                  'serums_vaccines_items.prod_date', 'serums_vaccines_items.exp_date' , 'serums_vaccines_items.Production_Company');
  //$this->db->from( 'district_item' , 'serums_vaccines_items');
  //$this->db->join('district_item' , 'district_item.item_code = serums_vaccines_items.Box_Code');
  //$this->db->where(['district_item.DID' => $district , 'serums_vaccines_items.Box_Code' => 'district_item.item_code']);

  // $query = $this->db->get();
  // return $query->result();
   return $dispItems;
 }

  function Find_Dis(){
    $search = $_POST['search'];
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $name = $row['name'];
       $email = $row['email'];
       $did = $row['DID'];
    }
    $this->repeat();
    $query = $this->db->query("SELECT * FROM district WHERE name != '$name' AND name = '$search District'");
    $k = $query->num_rows();

    if($k == 0){
      $array = array('Found' => $k);
      return $array;
    }
    else{
        foreach ($query->result_array() as $row){
           $did = $row['DID'];
        }

        $dispItems = $this->db->query("SELECT serums_vaccines_items.name, district_item.IID ,serums_vaccines_items.lot_num, district_item.item_code,
                                               serums_vaccines_items.prod_date, serums_vaccines_items.exp_date , serums_vaccines_items.Production_Company , district_item.DID
                                               FROM district_item , serums_vaccines_items
                                               WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0");
        $array = array('Items' => $dispItems , 'Found' => $k);
        return $array;
      }
  }

  function Find_Dis_Employee(){
    $search = $_POST['search'];
    $name = $this->session->userdata('userusername');
    $query = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query->result_array() as $row){
       $name = $row['name'];
       $email = $row['email'];
       $did = $row['DID'];
    }
    $this->repeat_Employee();
    $query = $this->db->query("SELECT * FROM district WHERE name != '$name' AND name = '$search District'");
    $k = $query->num_rows();

    if($k == 0){
      $array = array('Found' => $k);
      return $array;
    }
    else{
        foreach ($query->result_array() as $row){
           $did = $row['DID'];
        }

        $dispItems = $this->db->query("SELECT serums_vaccines_items.name, district_item.IID ,serums_vaccines_items.lot_num, district_item.item_code,
                                               serums_vaccines_items.prod_date, serums_vaccines_items.exp_date , serums_vaccines_items.Production_Company , district_item.DID
                                               FROM district_item , serums_vaccines_items
                                               WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code AND district_item.deleted = 0");
        $array = array('Items' => $dispItems , 'Found' => $k);
        return $array;
      }
  }


  function Reserve_Database($Name){
    $MR_code = $_POST['code'];
    $MR_code_enc = md5($MR_code);
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
    }
    $this->repeat();
    $query_check = $this->db->query("SELECT * FROM patient,district WHERE patient.Name = '$Name' AND patient.DID = district.DID AND district.DID = '$did'");

    if($query_check->num_rows() == 0){
      redirect("http://localhost/CI3/index.php/project/again");
    }
    else{

    $array = $this->session->userdata('array');
    $format = "%Y-%m-%d";
    $date = mdate($format);
    list($code, $id) = explode(" ", $array);

    $select = $this->db->query("SELECT PID FROM patient Where name = '$Name' AND DID = '$did'");
    foreach ($select->result_array() as $row){
       $PID = $row['PID'];
    }
    $pick = $this->db->query("SELECT district_item.quantity FROM district , district_item Where district.DID = '$id' AND district.DID = district_item.DID AND district_item.item_code = '$code'");
    foreach ($pick->result_array() as $row){
       $quantity = $row['quantity'];
    }


    $get_Code = $this->db->query("SELECT medical_report.MR_Code FROM  medical_report Where medical_report.MR_code = '$MR_code_enc'");
    $cc = $get_Code->num_rows();
    if($quantity < 10 ){
      redirect("http://localhost/CI3/index.php/project/again_Quantity");
    }
    else if($cc == 0){
        redirect("http://localhost/CI3/index.php/project/again_MR_Code");
    }
    else{
      $choose=$this->db->query("UPDATE district_item SET quantity = quantity -1 WHERE item_code ='$code' AND district_item.DID = '$id' AND quantity > 0");
      $Add = $this->db->query("INSERT INTO reservation_from_district (rFrom, rTo , res_date , Box_Code , PID , quantity) VALUES ('$did', '$id', '$date' , '$code' , '$PID' , 1)");
      redirect("http://localhost/CI3/index.php/project/Reservation");
    }
  }
  }

  function Reserve_Database_Employee($Name){
    $MR_code = $_POST['code'];
    $MR_code_enc = md5($MR_code);
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee , district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
    }

    $this->repeat_Employee();
    $query_check = $this->db->query("SELECT * FROM patient,district WHERE patient.Name = '$Name' AND patient.DID = district.DID AND district.DID = '$did'");

    if($query_check->num_rows() == 0){
      redirect("http://localhost/CI3/index.php/project/again_Employee");
    }
    else{

    $array = $this->session->userdata('array');
    $format = "%Y-%m-%d";
    $date = mdate($format);
    list($code, $id) = explode(" ", $array);

    $select = $this->db->query("SELECT PID FROM patient Where name = '$Name' AND DID = '$did'");
    foreach ($select->result_array() as $row){
       $PID = $row['PID'];
    }
    $pick = $this->db->query("SELECT district_item.quantity FROM district , district_item Where district.DID = '$id' AND district.DID = district_item.DID AND district_item.item_code = '$code'");
    foreach ($pick->result_array() as $row){
       $quantity = $row['quantity'];
    }


    $get_Code = $this->db->query("SELECT medical_report.MR_Code FROM  medical_report Where medical_report.MR_code = '$MR_code_enc'");
    $cc = $get_Code->num_rows();
    if($quantity < 10 ){
      redirect("http://localhost/CI3/index.php/project/again_Quantity_Employee");
    }
    else if($cc == 0){
        redirect("http://localhost/CI3/index.php/project/again_MR_Code_Employee");
    }
    else{
      $choose=$this->db->query("UPDATE district_item SET quantity = quantity -1 WHERE item_code ='$code' AND district_item.DID = '$id' AND quantity > 0");
      $Add = $this->db->query("INSERT INTO reservation_from_district (rFrom, rTo , res_date , Box_Code , PID , quantity) VALUES ('$did', '$id', '$date' , '$code' , '$PID' , 1)");
      redirect("http://localhost/CI3/index.php/project/Reservation_Employee");
    }
  }
  }

//$this->say($c)
 function sdf(){
   $new = md5(7);
   $Add = $this->db->query("UPDATE medical_report SET MR_Code = '$new' WHERE MRID = 7 ");
 }

  function repeat(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $send = $row['Send'];
    }
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $pick = $this->db->query("SELECT * FROM district_item , serums_vaccines_items , district  Where district.DID = '$did' AND district.DID = district_item.DID
      AND district_item.item_code = serums_vaccines_items.Box_Code  ");
    foreach ($pick->result_array() as $row){
       $exp = $row['exp_date'];
       $box_code = $row['Box_Code'];
       $warning = $row['warning'];
       $expired = $row['expired'];
       $deleted = $row['deleted'];
       $date1=date_create($exp);
       $date2=date_create($date);
       $diff=date_diff($date2,$date1);
       $Max = $diff->format("%R%a");

       $pick_date = $this->db->query("SELECT * FROM notification Where DID = '$did' AND item_code = '$box_code' ");
       foreach ($pick_date->result_array() as $row){
          $Update_Date = $row['Update_Date'];
          if($warning == 1 && $Max > 0 && $expired != 1 && $deleted != 1 && $Update_Date != $date2){
            $this->db->query("UPDATE notification SET Left_Days = '$Max' WHERE item_code ='$box_code' AND DID = $did");
          }
        }
       //echo $Max , $box_code;
       if($Max <= 30 && $warning == 0){
         $choose=$this->db->query("UPDATE district_item SET warning = 1 WHERE item_code ='$box_code' AND DID = $did AND warning = 0");
         $Add = $this->db->query("INSERT INTO notification (DID, item_code ,Update_Date , Left_Days) VALUES ('$did', '$box_code' , '$date' , '$Max')");
       }
       if($warning == 1 && $Max <= 0 && $expired != 1 && $deleted != 1){
         $this->db->query("UPDATE notification SET Left_Days = '$Max' WHERE item_code ='$box_code' AND DID = $did");
         $this->db->query("UPDATE notification SET Update_Date = '$date' WHERE item_code ='$box_code' AND DID = $did");
         $choose=$this->db->query("UPDATE district_item SET expired = 1 WHERE item_code ='$box_code' AND DID = $did AND warning = 1");
       }

    }

    $time = date("h:i a");
    $date_day = date("d");
    // $date_day == 1 && $time == '11:00 am'
    if($send == 0){
      $this->send_mail();
      $this->db->query("UPDATE district SET Send = 1 WHERE DID = $did ");
    }
    if($date_day == 29){
       $this->db->query("UPDATE district SET Send = 0 WHERE DID = $did ");
       $this->db->query("UPDATE district_item SET quantity_refill = 0 WHERE DID = $did ");
    }
  }


  function repeat_Employee(){
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $send = $row['Send'];
    }
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $pick = $this->db->query("SELECT * FROM district_item , serums_vaccines_items , district  Where district.DID = '$did' AND district.DID = district_item.DID AND district_item.item_code = serums_vaccines_items.Box_Code  ");
    foreach ($pick->result_array() as $row){
       $exp = $row['exp_date'];
       $box_code = $row['Box_Code'];
       $warning = $row['warning'];
       $expired = $row['expired'];
       $deleted = $row['deleted'];
       $date1=date_create($exp);
       $date2=date_create($date);
       $diff=date_diff($date2,$date1);
       $Max = $diff->format("%R%a");

       $pick_date = $this->db->query("SELECT * FROM notification Where DID = '$did' AND item_code = '$box_code' ");
       foreach ($pick_date->result_array() as $row){
          $Update_Date = $row['Update_Date'];
          if($warning == 1 && $Max > 0 && $expired != 1 && $deleted != 1 && $Update_Date != $date2){
            $this->db->query("UPDATE notification SET Left_Days = '$Max' WHERE item_code ='$box_code' AND DID = $did");
          }
        }

       if($Max <= 30 && $warning == 0){
         $choose=$this->db->query("UPDATE district_item SET warning = 1 WHERE item_code ='$box_code' AND DID = $did AND warning = 0");
         $Add = $this->db->query("INSERT INTO notification (DID, item_code ,Update_Date , Left_Days) VALUES ('$did', '$box_code' , '$date' , '$Max')");
       }
       else if($warning == 1 && $Max <= 0 && $expired != 1 && $deleted != 1){
         $this->db->query("UPDATE notification SET Left_Days = '$Max' WHERE item_code ='$box_code' AND DID = $did");
         $this->db->query("UPDATE notification SET Update_Date = '$date' WHERE item_code ='$box_code' AND DID = $did");
         $choose=$this->db->query("UPDATE district_item SET expired = 1 WHERE item_code ='$box_code' AND DID = $did AND warning = 1");
       }

    }

    $time = date("h:i a");
    $date_day = date("d");
    // $date_day == 1 && $time == '11:00 am'
    if($send == 0){
      $this->send_mail();
      $this->db->query("UPDATE district SET Send = 1 WHERE DID = $did ");
    }
    if($date_day == 29){
       $this->db->query("UPDATE district SET Send = 0 WHERE DID = $did ");
    }
  }


  public function repeat_again(){

  }

  public function send_mail() {
    $name = $this->session->userdata('username');
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $query_N = $this->db->query("SELECT district.name , district.DID , district.email , district.password FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $mail = $row['email'];
       $pass = $row['password'];
       $Name = $row['name'];
    }
            $config = array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_port' => 465,
                  'smtp_user' => $mail,
                  'smtp_pass' => $pass,
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '<h1>Sending email about the monthly quota</h1>';
        $htmlContent .= "<p>This email has sent via District </p> <br>";
        $htmlContent .= "<p>We are remembering you that today is the begining of the month so please be ready to send the monthly quota today.</p>";

        $this->email->to('Main.Inventory.Alexandria@gmail.com');
        $this->email->from($mail , 'Monthly Quota');
        $this->email->subject('Monthly Quota');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();
}




  public function Notification(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
    }
    $noti = $this->db->query("SELECT * FROM notification , district  WHERE district.DID = '$did' AND notification.DID = district.DID AND  notification.Left_Days > 0 ");
    $num = $noti->num_rows();
    $array = array('num' => $num , 'noti' => $noti);
    return $array;
  }

  public function Notification_Employee(){
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
    }
    $noti = $this->db->query("SELECT * FROM notification , district  WHERE district.DID = '$did' AND notification.DID = district.DID AND  notification.Left_Days > 0 ");
    $num = $noti->num_rows();
    $array = array('num' => $num , 'noti' => $noti);
    return $array;
  }



  public function Email(){
    $To = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $name = $this->session->userdata('username');
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $query_N = $this->db->query("SELECT district.name , district.DID , district.email , district.password FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $mail = $row['email'];
       $pass = $row['password'];
       $Name = $row['name'];
    }
            $config = array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_port' => 465,
                  'smtp_user' => $mail,
                  'smtp_pass' => $pass,
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($To);
        $this->email->from($mail);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send email
        $this->email->send();
  }

  public function Email_Employee(){
    $To = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $name = $this->session->userdata('userusername');

    $format = "%Y-%m-%d";
    $date = mdate($format);
    $query_N = $this->db->query("SELECT district.name , district.DID , district.email , district.password FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $mail = $row['email'];
       $pass = $row['password'];
       $Name = $row['name'];
    }
            $config = array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://smtp.gmail.com',
                  'smtp_port' => 465,
                  'smtp_user' => $mail,
                  'smtp_pass' => $pass,
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($To);
        $this->email->from($mail);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send email
        $this->email->send();
  }



  public function update_table_data(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
       $pass = $row['password'];
    }
    $data = array('username' => $name, 'password' => $pass );
    $this->db->where('id',$did);
    $this->db->update("admin",$data );
    return TRUE;
  }

  public function getstandards(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
    }
     $query=$this->db->query("SELECT * FROM patient WHERE patient.DID = '$did'");
     if ($query->num_rows()>0){
       return $query->result();
     }
   }

   public function gethospital(){
     $name = $this->session->userdata('username');
     $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query_N->result_array() as $row){
        $did = $row['DID'];
     }
     $query=$this->db->query("SELECT * FROM hospital WHERE hospital.DID = '$did'");
     if ($query->num_rows()>0){
       return $query->result();
     }
   }
   public function getitem(){
     $name = $this->session->userdata('username');
     $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
     foreach ($query_N->result_array() as $row){
        $did = $row['DID'];
     }

     $query=$this->db->query("SELECT * FROM serums_vaccines_items , district_item WHERE district_item.DID = '$did' AND serums_vaccines_items.Box_Code = district_item.item_code");
     if ($query->num_rows()>0){
       return $query->result();
     }
   }
   public function getdistrict(){
     $query=$this->db->get('district');
     if ($query->num_rows()>0){
       return $query->result();
     }
    }

     public function insert_data($data){
     $this->db->insert("district_reservation",$data);
     redirect("http://localhost/CI3/index.php/project/dis_res_form");
    }
    public function insert_data2($data){
    $this->db->insert("reservation_from_hospital",$data);
    redirect("http://localhost/CI3/index.php/project/res_hos_form");
    }

    function save_rfh($data){
      $query=$this->db->INSERT('reservation_from_hospital',$data);
      return $query;
    }



  function get_message(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin WHERE username = '$name'");
    foreach ($query_N->result_array() as $row){
       $id = $row['ID'];
    }
    $query = $this->db->query("SELECT * FROM chat_message WHERE to_user_id = '$id' AND status = 0");
    //foreach ($query->result_array() as $row){
      // $did = $row['ID'];
    //}
    $count = $query->num_rows();
    $array = array('query' => $query , 'count' => $count );
    return $array;
  }

  function get_message_Employee(){
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee , district WHERE userusername = '$name' AND employee.DID = district.DID");
    foreach ($query_N->result_array() as $row){
       $id = $row['EID'];
    }
    $query = $this->db->query("SELECT * FROM chat_message_Employee WHERE to_user_id = '$id' AND status = 0");
    $count = $query->num_rows();
    $array = array('query' => $query , 'count' => $count );
    return $array;
  }


    //retrive spicific district from db
    public function Get_Admin_DID()
    {
      $name = $this->session->userdata('username');
      $query = $this->db->query("SELECT DID FROM admin WHERE username = '$name'  ");
     return $query->result_array()[0]['DID'];
    }

    public function Get_Distric_Last_check_data()
    {
      $DID = $this->Get_Admin_DID();
      $query = $this->db->query("SELECT last_Check_Date FROM district WHERE DID = '$DID'  ");
      return $query->result_array()[0]['last_Check_Date'];
    }

    public function Get_number_of_patient()
    {
      $DID = $this->Get_Admin_DID();
      $query = $this->db->query("SELECT current_Number_Of_Patients FROM district WHERE DID = '$DID'  ");
      return $query->result_array()[0]['current_Number_Of_Patients'];
    }

    //retrive spicific district from db
    public function Get_spicific_District()
    {
      $DID = $this->Get_Admin_DID();
      //data is retrive from this query
      $query = $this->db->get_where('district', array('DID' => $DID));
      return $query->result();
    }


    public function Get_numbers_of_death()
    {

        $DID = $this->Get_Admin_DID();
        $last_check_date = $this->Get_Distric_Last_check_data();
       //this query retrives persons dies after last_check_date and from same distric
        $query = $this->db->get_where('Death', array('Deathdate >' => $last_check_date,'DID' => $DID ));
       //return number of persons dies after last_check_date and from same distric
       return $query->num_rows();

    }

    public function Get_numbers_of_birth()
    {
        $DID = $this->Get_Admin_DID();
        $last_check_date = $this->Get_Distric_Last_check_data();

        //this query retrives babies born after last_check_date and from same distric
        $query = $this->db->get_where('patient', array('birthdate >' => $last_check_date,'DID' => $DID ));
        //return number of babies born after last_check_date and from same distric
        return $query->num_rows();

    }

    public function get_chenage_number_of_patient()
    {
      $District = $this->action_model->Get_spicific_District();
      $District[0]->death_Rate;
      $old_number_of_patient      = $District[0]->old_Number_Of_Patients;
      $current_Number_Of_Patients = $District[0]->current_Number_Of_Patients;
      return $current_Number_Of_Patients - $old_number_of_patient;
    }

    public function update_Birth_Death_rate($current_number_of_patient)
    {

      $DID = $this->Get_Admin_DID();
      $last_check_date = $this->Get_Distric_Last_check_data();
      $old_number_of_patient = $this->Get_number_of_patient();
      //Get number of birth
      $number_of_birth = $this->Get_numbers_of_birth();
      //Get number of death
      $number_of_death = $this->Get_numbers_of_death();

      //fields will update their values
      $data = array(
      'last_Check_Date' => date("Y-m-d"),
      'current_Number_Of_Patients' => $current_number_of_patient,
      'old_Number_Of_Patients' => $old_number_of_patient,
      'death_Rate' => $number_of_death,
      'birth_Rate' => $number_of_birth,
      'Change_In_Number_of_Patients'=> $this->get_chenage_number_of_patient()
      );
      //db will update using this query
      $this->db->update('district',$data,array('DID' => $DID));
    }



   public function Get_Birth_Death_rate()
   {

      $data['birth_Rate'] = 0;
      $data['death_Rate'] = 0;
      $District = $this->action_model->Get_spicific_District();

      $data['birth_Rate']                 = $District[0]->birth_Rate;
      $data['death_Rate']                 = $District[0]->death_Rate;
      $data['last_Check_Date']            = $this->Get_Distric_Last_check_data();
      $data['Number_Of_Patients']         = $District[0]->current_Number_Of_Patients;
      $data['Change_Number_Of_Patients']  = $this->get_chenage_number_of_patient();
      $data['old_Number_Of_Patients']     = $District[0]->old_Number_Of_Patients;
      return $data;
   }



   function get_expired(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
      $name = $row['name'];
      $email = $row['email'];
      $did = $row['DID'];
    }
    $format = "%Y-%m-%d";
    $date = mdate($format);
    $pick = $this->db->query("SELECT * FROM district_item , serums_vaccines_items , district  Where district.DID = '$did' AND district.DID = district_item.DID AND district_item.item_code = serums_vaccines_items.Box_Code");
    foreach ($pick->result_array() as $row){
       $exp = $row['exp_date'];
       $box_code = $row['Box_Code'];
       $warning = $row['warning'];
       $quantity = $row['quantity'];
       $deleted = $row['deleted'];
       $expired = $row['expired'];

       if($warning == 1 && $expired == 1 && $deleted != 1){
             $this->db->query("INSERT INTO expired_items (DID ,item_code , quantity) VALUES ('$did', '$box_code' , '$quantity')");
             $this->db->query("UPDATE district_item SET deleted = 1 WHERE DID='$did' AND item_code='$box_code'");
       }
     }
  }

  function get_expired_Employee(){
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee , district WHERE userusername = '$name' AND employee.DID = district.DID");
   foreach ($query_N->result_array() as $row){
     $name = $row['name'];
     $email = $row['email'];
     $did = $row['DID'];
   }
   $format = "%Y-%m-%d";
   $date = mdate($format);
   $pick = $this->db->query("SELECT * FROM district_item , serums_vaccines_items , district  Where district.DID = '$did' AND district.DID = district_item.DID AND district_item.item_code = serums_vaccines_items.Box_Code");
   foreach ($pick->result_array() as $row){
      $exp = $row['exp_date'];
      $box_code = $row['Box_Code'];
      $warning = $row['warning'];
      $quantity = $row['quantity'];
      $deleted = $row['deleted'];
      $expired = $row['expired'];

      if($warning == 1 && $expired == 1 && $deleted != 1){
            $this->db->query("INSERT INTO expired_items (DID ,item_code , quantity) VALUES ('$did', '$box_code' , '$quantity')");
            $this->db->query("UPDATE district_item SET deleted = 1 WHERE DID='$did' AND item_code='$box_code'");
      }
    }
  }
  public function show_expired(){
    $name = $this->session->userdata('username');
    $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
     }
    $pick = $this->db->query("SELECT * FROM expired_items, serums_vaccines_items , district_item
      Where expired_items.DID = '$did'  AND expired_items.DID = district_item.DID AND expired_items.item_code = serums_vaccines_items.Box_Code AND serums_vaccines_items.Box_Code = district_item.item_code");

    $Quantity_Zero = $this->db->query("SELECT * FROM district_item , serums_vaccines_items
                               Where district_item.DID = $did AND district_item.quantity = '0' AND district_item.item_code = serums_vaccines_items.Box_Code");

    $array = array('pick' => $pick , 'zero' => $Quantity_Zero);
    return $array;

  }

  public function show_expired_Employee(){
    $name = $this->session->userdata('userusername');
    $query_N = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
    foreach ($query_N->result_array() as $row){
       $did = $row['DID'];
     }
    $pick = $this->db->query("SELECT * FROM expired_items, serums_vaccines_items
      Where expired_items.DID = $did AND expired_items.item_code = serums_vaccines_items.Box_Code");

    $Quantity_Zero = $this->db->query("SELECT * FROM district_item , serums_vaccines_items
                               Where district_item.DID = $did AND district_item.quantity = '0' AND district_item.item_code = serums_vaccines_items.Box_Code");

    $array = array('pick' => $pick , 'zero' => $Quantity_Zero);
    return $array;

  }

public function get_Reserve_Anothor_District($user){
  //echo $user;
  $name = $this->session->userdata('username');
  $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
  foreach ($query_N->result_array() as $row){
     $did = $row['DID'];
   }
   list($PID, $Med_Name , $code , $RID) = explode(" ", $user);
   //$this->session->set_userdata('MRID', $MID);
   $sel = $this->db->query("SELECT * FROM medical_report , prescription WHERE prescription.presc_med = '$Med_Name' ");
   foreach ($sel->result_array() as $row){
      $MRID = $row['MRID'];
      $collect = $this->db->query("SELECT * FROM medical_report WHERE MRID = '$MRID' ");
      foreach ($collect->result_array() as $row){
         $quota_quantity = $row['quota_quantity'];
         if($quota_quantity != 0){
           $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$PID' AND quota_quantity > 0 AND item_code ='$code' AND DID = '$did'");
           $choose=$this->db->query("UPDATE district_item , medical_report SET quantity = quantity -1 WHERE item_code ='$code' AND quantity > 0 AND district_item.DID = '$did' AND medical_report.PID = '$PID' AND medical_report.MRID = '$MRID' AND medical_report.quota_quantity != 0");
           $done = $this->db->query("UPDATE reservation_from_district SET Done = 1 WHERE RID = '$RID' AND Box_Code = '$code' AND PID = '$PID'");
           $flag = 1;
           break;
         }
         else{
           $flag = 0;
         }
      }
      if($flag == 1){
        $Found =1;
        break;
      }
      else if($flag == 0){
        $done = $this->db->query("UPDATE reservation_from_district SET Deleted = 1 WHERE RID = '$RID' AND Box_Code = '$code' AND PID = '$PID'");
        $Found = 3;
      }
    }

    return $Found;
  // $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$pid' AND quota_quantity > 0 AND item_code ='$user' AND DID = '$did'");
   //$Add = $this->db->query("INSERT INTO New (Name , data1 , date2) VALUES ('$MRID' , '$quota' , '$result')");
}

public function get_Reserve_Anothor_District_Employee($user){
  //echo $user;
  $name = $this->session->userdata('username');
  $name = $this->session->userdata('userusername');
  $query_N = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
  foreach ($query_N->result_array() as $row){
     $did = $row['DID'];
   }
   list($PID, $Med_Name , $code , $RID) = explode(" ", $user);
   //$this->session->set_userdata('MRID', $MID);
   $sel = $this->db->query("SELECT * FROM medical_report , prescription WHERE prescription.presc_med = '$Med_Name' ");
   foreach ($sel->result_array() as $row){
      $MRID = $row['MRID'];
      $collect = $this->db->query("SELECT * FROM medical_report WHERE MRID = '$MRID' ");
      foreach ($collect->result_array() as $row){
         $quota_quantity = $row['quota_quantity'];
         if($quota_quantity != 0){
           $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$PID' AND quota_quantity > 0 AND item_code ='$code' AND DID = '$did'");
           $choose=$this->db->query("UPDATE district_item , medical_report SET quantity = quantity -1 WHERE item_code ='$code' AND quantity > 0 AND district_item.DID = '$did' AND medical_report.PID = '$PID' AND medical_report.MRID = '$MRID' AND medical_report.quota_quantity != 0");
           $done = $this->db->query("UPDATE reservation_from_district SET Done = 1 WHERE RID = '$RID' AND Box_Code = '$code' AND PID = '$PID'");
           $flag = 1;
           break;
         }
         else{
           $flag = 0;
         }
      }
      if($flag == 1){
        $Found = 1;
        break;
      }
      else if($flag == 0){
          $done = $this->db->query("UPDATE reservation_from_district SET Deleted = 1 WHERE RID = '$RID' AND Box_Code = '$code' AND PID = '$PID'");
          $Found = 3;
        }
    }

    return $Found;
  // $up = $this->db->query("UPDATE medical_report , district_item SET quota_quantity = quota_quantity - 1 WHERE MRID = '$MRID' AND medical_report.PID = '$pid' AND quota_quantity > 0 AND item_code ='$user' AND DID = '$did'");
   //$Add = $this->db->query("INSERT INTO New (Name , data1 , date2) VALUES ('$MRID' , '$quota' , '$result')");
}

public function Filter_item(){
  $select = $_POST['select_option'];
  $name = $this->session->userdata('username');
  $query_N = $this->db->query("SELECT * FROM admin,district WHERE username = '$name' AND admin.DID = district.DID ");
  foreach ($query_N->result_array() as $row){
     $did = $row['DID'];
   }
   if($select == "Empty"){ //zero
      return 1;
   }
   else if($select == "Expired"){ //$pick
       return 2;
   }

}
public function Filter_item_Employee(){
  $select = $_POST['select_option'];
  $name = $this->session->userdata('userusername');
  $query_N = $this->db->query("SELECT * FROM employee,district WHERE userusername = '$name' AND employee.DID = district.DID ");
  foreach ($query_N->result_array() as $row){
     $did = $row['DID'];
   }
   if($select == "Empty"){ //zero
      return 1;
   }
   else if($select == "Expired"){ //$pick
       return 2;
   }

}

public function show_rate(){
  $name = $this->session->userdata('username');
  $query_N = $this->db->query("SELECT name , COUNT(*) FROM reservation_from_district , district WHERE Done = 1 AND DID = rTo GROUP BY rTo ");
  return $query_N;
}




}

 ?>
