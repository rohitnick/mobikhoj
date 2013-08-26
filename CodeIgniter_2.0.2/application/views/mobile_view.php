<title>WikiKhoj - Home</title>

<style type="text/css">
#header_login_box
{
	font-size:16px;	background-color:#fff;	color:#222;
	border-radius:0px 0px 10px 10px;
	padding:10px; width: 210px;
}
#header_login_box .input_text:focus
{
	border:1px solid #888;	
	box-shadow:0px 0px 3px rgba(60,90,110,0.5);
}


</style>

<center>

<div id="divcontainer"  align="left" >
	<div id="content" >
	    <table id="contentTable" >
		<tr >
	    	<td valign="top" width="650" class="right_section">
	         	
			</td>
			<td valign="top" align="center" width="250" class="right_section">
	         	<div id="header_login_box">
	         		<span class="info" id="loginErrorInfo" style="color:#900;display:none;">Invalid Email Address</span></center>
	        			<table style=" border:#CCCCCC">
	        			<tr>
                            <td colspan="2">
                            <input class="input_text" type="text" id="loginEmail" name="loginEmail"/><label class="input_label" >Email Id</label>
                            </td>
	                    </tr>
                        <tr>
			                <td colspan="2">
                            <input class="input_text" type="password" id="loginPassword" name="loginPassword"/><label class="input_label" >Password</label>
                            </td>
			            </tr>
			            <tr><td></td>
			                <td  align="left">
                            	<input type="checkbox" id="loginRemember"  name="loginRemember"/>
                            	<label for="loginRemember" style="font-size: 12px">Remember Me </label>                               
                            </td>
			            </tr>
		                <tr><td></td>
			                <td>
			                <button onclick="login()" class="button_me" style="float:right;margin-top:-20px;">Login</button>
			                </td>
			            </tr>
			            </table>
			   </div>
			   </td>
			
		</tr>
		</table>		
    </div>
</div>
</center>

<script>

function login()
{
	var email=$("#loginEmail").attr('value');
	var password=$("#loginPassword").attr('value');
	var remember=$("#loginRemember").attr('checked');
	 $("#loginErrorInfo").hide();
	 $.post('/welcome/login',{'logEmail':email,'logPassword':password,'logRemember':remember},function(response){	
		if(response=="error")
		{
			showInfoMsg("#loginErrorInfo","Email and Password do not match");	
		}					
		else 
			window.location=response;
	});
}


</script>