<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller 
{
	public function __construct()
       {
            parent::__construct();
            $this->load->model('mobilemodel');
            $this->load->helper('date');
       }
	public function index()
	{
		$this->load->view('header_view');
		$this->load->view('mobile_view');
	}
	public function getQuestions()
	{
		$lim=$_GET['lim'];
		$mtype=$_GET['mtype'];
		$Question=$this->mobilemodel->getQuestionsData($lim,$mtype);
		$QuestionHtml=$this->load->view('mobile/questions_view',array('Question'=>$Question),true);
		echo $QuestionHtml;
	}
	public function getNoti()
	{
		echo $this->mobilemodel->getNotiData();
	}
	public function getMessages()
	{
		$lim=$_GET['lim'];
		$num=$_GET['num'];
		$mod=$_GET['mod'];
		$Message=$this->mobilemodel->getMessagesData($lim,$num,$mod);
		$MessageHtml=$this->load->view('mobile/messages_view',array('Message'=>$Message),true);
		echo $MessageHtml;
	}
	public function save()
	{	
		$mobileNumber =  $_REQUEST['send'];
		$dest = $_REQUEST['dest'];
		$message = $_REQUEST['msg'];
		$stime = $_REQUEST['stime'];
		if( $mobileNumber == '' || $message == '' || $dest == '' || $stime == '')
		{
			echo "SMS should contain SenderID , Destination , Message and Time";
		}
		else {
			$this->mobilemodel->saveMessage($mobileNumber,$message);
			$this->load->view('mobile/save_view');
			/*
				$to = "rohitagarwal.2k6@gmail.com";
	            $subject = "New Question";
	            $from = "contact@mobikhoj.com";
	            $headers = "From:" .$from. "\r\n";
			    $headers .= 'Bcc: icircles.in@gmail.com,rahul29march@gmail.com,alokmaurya913@gmail.com'. "\r\n";
	            mail($to,$subject,$message,$headers);
            */
			echo "success";
		}
	}
	public function welcomedlr()
	{
		$sid = $_REQUEST['sid'];
		$dest = $_REQUEST['dest'];
		$stime = $_REQUEST['stime'];
		$dtime = $_REQUEST['dtime'];
		$status = $_REQUEST['status'];
		
		$this->mobilemodel->saveDlr($sid,$dest,$stime,$dtime,$status);
		echo "success";
	}
	public function msgdlr()
	{
		$sid = $_REQUEST['sid'];
		$dest = $_REQUEST['dest'];
		$stime = $_REQUEST['stime'];
		$dtime = $_REQUEST['dtime'];
		$status = $_REQUEST['status'];
		
		$this->mobilemodel->saveDlr($sid,$dest,$stime,$dtime,$status);
		echo "success";
	}
	public function saveAnswer()
	{
		$mid = $_REQUEST['mid'];
		$mobileNumber =  $_REQUEST['unumber'];
		$answer = $_REQUEST['answer'];
		$mod =$this->session->userdata('moderator');
		$mtype =3;
		
		if($answer=="w" or $answer=="W") {
			$uname = "rohitagl";
			$pass = "t)0Xx!8U";
			$answer = "Your question is being answered. Kindly send START to 8800233477, so that we can send back the answer on your number. MobiKhoj - Happy To Help. :)";
			$mid = 10;
		}
		elseif ($answer=="w2" or $answer=="W2")
		{
			$uname = "rohitagl";
			$pass = "t)0Xx!8U";
			$answer = "Your question has been answered but we cannot send you answer till we receive your START msg as per TRAI regulations, kindly send START on 8800233477.";
			$mid = 10;
		}
		else	{
			$uname = "rahulaga";
			$pass = "india123";
		}
		$postdata = http_build_query(array('uname' => $uname,'pass' => $pass,'send' => 'MobiKj','dest' => $mobileNumber,'msg' => $answer));
		$opts = array('http' => array(
		    	'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    ));
		$context  = stream_context_create($opts);
		//$result = file_get_contents('http://110.234.113.234/SendSMS/sendmsg.php', false, $context);
		$result = 12354;
		$this->mobilemodel->saveMessage($mobileNumber,$answer,$result,$mod);
		$this->mobilemodel->changeQuestionStatus($mid,$mtype,$mod);
		echo $result;
	}
	public function getoptin()
	{
		$fdate = $_REQUEST['sdate'];
		$lim = $_REQUEST['lim'];
		$optin= "918800233477";
		$tdate= "25/10/2012";
		$postdata = http_build_query(array('fdate' => $fdate,'Result_Set' => $lim,'optin' => $optin,'tdate' => $tdate));
		$opts = array('http' => array(
		    	'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    ));
		$context  = stream_context_create($opts);
		$result = file_get_contents('http://110.234.113.234/lounge/GlobalOne/getwhite_list.php', false, $context);
		echo $result;
	}
	public function getlocation()
	{
		$num = $_GET['num'];
		$url = "http://www.techdreams.org/Services/GetMobileInfov3.php?inputText=".$num;
		$result = file_get_contents($url);
		echo $result;
	}
	public function panel()
	{
		if($this->session->userdata('moderator'))
		{
			$this->load->view('mobile/header1_view');
			$this->load->view('mobile/panel_view');
		}
		else{
			header( 'Location: ../mobile' ) ;
		}
	}
	public function getdelivery()
	{
		$dlr = $_REQUEST['dlr'];
		$report = $this->mobilemodel->getDeliveryReport($dlr);
		if($report) {
		$reporthtml =  "Schedule : ".$report['stime']."\nReached : ".$report['dtime']."\nStatus : ".$report['status'];
		echo $reporthtml;
		} else echo "No delivery Report";
	}
	public function changetype()
	{
		$mid = $_REQUEST['mid'];
		$mtype =  $_REQUEST['mtype'];
		$mod =$this->session->userdata('moderator');
		echo $this->mobilemodel->changeQuestionStatus($mid,$mtype,$mod);
	}
}

