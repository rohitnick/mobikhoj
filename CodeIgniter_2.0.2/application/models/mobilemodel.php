<?php

class mobilemodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	function saveMessage($mobileNumber,$message,$mtype =0,$moderator =0)
	{
			$phpdate=now();
			$sql="insert into messages values(NULL,'$mobileNumber','$message','$mtype','$moderator',FROM_UNIXTIME($phpdate))";
			mysql_query($sql) or die("wrong"); 
	}
	function getQuestionsData($lim,$mtype)
	{
		$query= "select * from messages where mtype = ".$mtype." order by mid desc limit ".$lim.",10";
		$result=$this->db->query($query)->result_array();
		return $result;
	}
	function getNotiData()
	{
		$sql= "select mid from messages where mtype = '0' or mtype='3' or mtype='4' or mtype='locked' or mtype='5' order by mid desc limit 0,1";
		$row = $this->db->query($sql)->row_array();
		return $row['mid'];
	}
	function getMessagesData($lim,$num,$mod)
	{
		$query= "select * from messages where ((unumber = '".$num."') or (moderator = '".$mod."')) order by mid desc limit ".$lim.",10";
		$result=$this->db->query($query)->result_array();
		return $result;
	}
 	function changeQuestionStatus($mid,$mtype,$mod)
 	{
 		if($mtype=='locked')
 		{
	 		$sql= "select mtype from messages where mid=".$mid;
			$row = $this->db->query($sql)->row_array();
			if($row['mtype'] == 'locked')
				return 'locked';
 		}
 		$query="update messages set moderator='".$mod."',mtype='".$mtype."' where mid=".$mid;
       	$this->db->query($query);
 	}
	function saveDlr($sid,$dest,$stime,$dtime,$status)
	{
		$sql="insert into delivery values(NULL,'$sid','$dest','$stime','$dtime','$status')";
		mysql_query($sql) or die("wrong"); 
	}
	function getDeliveryReport($dlr)
	{
		$query= "select * from delivery where sid = '".$dlr."'";
		$result=$this->db->query($query)->row_array();
		return $result;
	}
}