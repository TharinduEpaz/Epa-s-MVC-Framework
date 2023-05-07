<?php

    class Admins extends Controller{
        private $adminModel;

        public function __construct(){
          if(isset($_SESSION['attempt'])){
            unset($_SESSION['otp_email']);
            unset($_SESSION['phone']);
            unset($_SESSION['attempt']);
            unset($_SESSION['time']);
        }
            if(!isLoggedIn()){
                session_destroy();
                redirect('users/login');
            }
            if($_SESSION['user_type'] != 'admin'){
                redirect($_SESSION['user_type'].'s/index');
            }

            //Session timeout
            if(isset($_SESSION['session_time'])){
                if(time() - $_SESSION['session_time'] > 60*30){
                    // flash('session_expired', 'Your session has expired', 'alert alert-danger');
                    redirect('users/logout');
                }else{
                    $_SESSION['session_time'] = time();
                }
            }

            $this->adminModel=$this->model('Admin');
        }

        public function index(){

            $this->view('admins/index');
        }

        public function profiletest(){

                $details = $this->adminModel->getadminDetails($_SESSION['user_id']);
        
                $data = [
                    'details' => $details
                ];
                
              
                $this->view('admins/profiletest',$data);
        


        }



        public function editProfile($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
              $data = [
                'id' => $id,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'email' => $_SESSION['user_email'],
                'address1' => trim($_POST['address1']),
                'address2' => trim($_POST['address2']),
                'user_id' => $_SESSION['user_id'],
                'first_name_err' => '',
                'second_name_err' => '',
                'address1_err' => '',
                'address2_err' => '',
              ];
      
              //validate data
              if(empty($data['first_name'])){
                $data['first_name_err'] = 'Please Enter First Name';
              }
              if(empty($data['second_name'])){
                $data['second_name_err'] = 'Please Enter Second Name';
              }
              if(empty($data['address1'])){
                $data['address1_err'] = 'Please Enter Address Line 1';
              }
              if(empty($data['address2'])){
                $data['address2_err'] = 'Please Enter Address Line 2';
              }
      
      
              if( empty($data['first_name_err']) && empty($data['second_name_err']) && empty($data['address1_err']) && empty($data['address1_err'] ) ){
                //validated
                if($this->adminModel->updateProfile($data)){
                  $_SESSION['user_name'] = $data['first_name'];
                  redirect('admins/profiletest');
                }
                else{
                  die('Something went wrong');
                }
      
              }
              else{
                //Load with errors
                $this->view('admins/editProfile',$data);
              }
            }
            else{
              $details = $this->adminModel->getadminDetails($id);
      
              if($details->user_id != $_SESSION['user_id']){
                redirect('users/login');
              }
      
              $data = [
                'id' => $id,
                'first_name' => $details->first_name,
                'second_name' => $details->second_name,
                'address1' => $details->address1,
                'email' => $details->email,
                'address2' => $details->address2,
                'phone_number' => $details->phone_number
              ];
      
              $this->view('admins/editProfile',$data);
            }
          }



        public function manageuser(){


            $this->view('admins/manageuser');
        }
        


        public function addadmin(){

            $this->view('admins/addadmin');
        }


        public function getProfile($id)
    { 
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $details = $this->adminModel->getadminDetails($id);

      if ($details->user_id != $_SESSION['user_id']) {
        redirect('users/login');
      }

      $data =[
        'id' => $id,
        'user' => $details
      ];
      $this->view('admins/profiletest',$data);
    }


        public function setDetails()
    {
        


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           
            if (isset($_POST['first_name'])&& $_POST['first_name'] != '') {

                $first_name = $_POST['first_name'];
            }

           if(isset($_POST['second_name'])&& $_POST['second_name'] != '') {

                $second_name = $_POST['second_name'];
            }

            if(isset($_POST['email'])&& $_POST['email'] != '') {

                $email = $_POST['email'];
            }

            if(isset($_POST['address1'])&& $_POST['address1'] != '') {

                $address1 = $_POST['address1'];
            }

            if(isset($_POST['address2'])&& $_POST['address2'] != '') {

                $address2 = $_POST['address2'];
            }

            if(isset($_POST['mobile'])&& $_POST['mobile'] != '') {

                $mobile = $_POST['mobile'];
            }

            if(isset($_POST['password'])&& $_POST['password'] != '') {

                
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            }
           
        

        $details = array($first_name, $second_name, $email, $address1,$address2,$mobile,$password,);

        /*$this->adminmodel->setDetails($details,$_SESSION['user_id']); */
        $this->adminModel->setDetails($details);


        redirect('admins/profile/');
        
    }



        
    }


    }
?>