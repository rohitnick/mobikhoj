<?php

class welcomemodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	function checkLogin($email,$password)
	{
		$sql = "select * from login where password='".$password."' and email= '".$email."' ";
		$result=$this->db->query($sql)->row_array();
		return $result;
	}
	function signUp($email, $password, $name)
	{
			$query="insert into login values(NULL,'$email','$password','$name',CURRENT_TIMESTAMP)";
			$this->db->query($query);
	}
}