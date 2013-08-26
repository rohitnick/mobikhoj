
<style type="text/css">
#popup
{
 width:950px;
 position:fixed;
 background-color:#FFF;
 display:none;
 z-index:12;
 top:30px;
}
#popup_close
{
	position: absolute;
	right: 5px;
	top: 0px;
	cursor:pointer;
}
#popupBody
{
	max-height:450px;
	overflow:scroll;
	padding:5px; 
}
</style>

<div id="popup">
        <div id="popupHead" style="background-color:#333; color:#eee;">
            <b id="popup_close" onclick="hideBack()">close X</b>
            <b id="showId"></b>
        </div>
        <div id="popupBody">
        	<table><tr>
            	<td valign="bottom" width="700" class="right_section" align="center">
            		<div id="seeMoreMessages" style="text-align: center;background: #8BAD68;">
                 			<a class="normal" style="color:#333" id="moreMessagesButton">See More Queries</a>
               		</div>
	            	<div id="messagesDiv">
	            		
	            	</div>
            	</td>
                <td valign="bottom" align="center" width="230" class="right_section">
                	<div id="numberInfo">
                		Location : <b id="loc"></b><br/>
                		Network : <b id="network"></b>
                	</div><br/>
                	<button class="button_me"  onclick="changeType('locked');" >Lock </button>
	                <button class="button_me"  onclick="changeType('3');" >Answered </button><br/>
	                <button class="button_me"  onclick="changeType('5');" >Spam </button>
	                <button class="button_me"  onclick="refresh();" >Refresh </button>
	                <button class="button_me"  onclick="changeType('4');" >Waiting to register</button>
                </td>
            </tr></table>
        </div>
        <div class="right_section" style="margin:5px;">
        	<table width="100%"><tr>
        		<td width="85%"><textarea class="text_me" id="answerBox" name="answerBox" onkeyup="countChar()" style="width:100%; height:70px;"></textarea></td>
        		<td style="padding-left:8px;" valign="top">
        			<button id="sendAnswer" class="button_me" onclick="sendAnswer();" >Send Answer </button><br/>
        			&nbsp;&nbsp;Count : <b id="charCount"></b>
        		</td>
        	</tr></table>
        </div>
</div>

<script type="text/javascript">
$mid = 0;
$(document).ready(function() 
{
	$limMsg = 0;
	$('#moreMessagesButton').click(function(){ $limMsg=$limMsg+10; userMessages($limMsg,$unumber,''); });
});
function getLocation()
{
	$num = $unumber.substr(2,4);
	$('#numberInfo').html('<img alt="Loading.." src="/static/images/loading.gif">');
	$.get('/mobile/getlocation',{'num':$num},function(response){
		var obj = jQuery.parseJSON(response);
		$('#numberInfo').html('Location : <b>'+obj.ln+'</b> <br/> Network : <b>'+obj.pn+'</b>'); 
	});
}
function selectQuestion($val)
{
	if($mid !=0)
		$("#"+$mid).css("border-color","#fff");
	$mid = $val;
	$("#"+$mid).css("border-color","#000");
}
function selectAnswer($mtype)
{
	$.get('/mobile/getdelivery',{'dlr':$mtype},function(response){
		alert(response);
	});
}
function countChar()
{
	var charLength = $('#answerBox').val().length;
	// Displays count
	$('#charCount').html(charLength);
	// Alerts when 250 characters is reached
	if(charLength > 798)
	alert("You may only have up to 799 characters.");
}
function sendAnswer()
{
	$("#sendAnswer").css({'display':'none'});
	$answer = $('#answerBox').attr('value');
	if($mid == 0 || $answer.length == 0 || $answer.indexOf("'") != -1)
	{
		alert("Select a question to answer it AND Remove single quote ' from the answer.");
		$("#sendAnswer").css({'display':'block'});
	}
	else
	{
		$.post('/mobile/saveAnswer',{'mid':$mid,'unumber':$unumber,'answer':$answer},function(response){
			refresh();
			$('#answerBox').val("");
			$("#sendAnswer").css({'display':'block'});
		});
	}
}
function refresh()
{
	userMessages(0,$unumber,'');
}

function userMessages($limit,$num,$mod)
{
	$limMsg = $limit;
	if($limit == 0)
		$('#messagesDiv').html('<img alt="Loading.." src="/static/images/loading.gif">');
	$.get('/mobile/getMessages',{'lim':$limit,'num':$num,'mod':$mod},function(response){
		if($limit == 0)
			$('#messagesDiv').html(response);
	 	else
			$('#messagesDiv').prepend(response);
	});
	$("#popupBody").animate({scrollTop:"500px"},1000);
}
function changeType($type)
{
	if($mid == 0)
		alert("Select a question first !!");
	else
	{
		$.get('/mobile/changetype',{'mid':$mid,'mtype':$type},function(response){
			if(response == "locked")
				alert("The Question is already locked");
			refresh();
		});
	}
}

</script>