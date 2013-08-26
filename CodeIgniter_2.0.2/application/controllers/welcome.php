<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct()
       {
            parent::__construct();
            $this->load->model('welcomemodel');	
            $this->load->helper('cookie');
       }
	public function index()
	{		
			$this->load->view('welcome_view');
	}
	
	public function login()
	{
		$email=trim($_POST['logEmail']);
		$password=sha1($_POST['logPassword']);
		$remember =$_POST['logRemember'];

		$result=$this->welcomemodel->checkLogin($email,$password);
		if(!$result)
			echo "error";
		else
		{
			$this->session->set_userdata('moderator',$email);
			if($remember)
			{
				$cookie = array('name'=>'modkhoj','value'=>$email,'expire'=>'432000');
				$this->input->set_cookie($cookie);
			}
			echo "../mobile/panel";
		}		
	}
	public function signup()
	{
		$email=trim($_POST['logEmail']);
		$password=sha1($_POST['logPassword']);
		$name =$_POST['logName'];
		$code =$_POST['logCode'];
		if($code == "myidea")
		{
			$result=$this->welcomemodel->signUp($email,$password,$name);
		}
	}
public function logout()
	{
		$this->session->sess_destroy();
		delete_cookie("modwiki");
		header( 'Location: ../mobile' ) ;
	}
}

