<title>Mobikhoj - Khoji</title>

<center>

<div id="divcontainer"  align="left" >
	<?php $this->load->view('mobile/popup_view'); ?>
	<div id="content" >
	    <table id="contentTable" >
		<tr >
	    	<td valign="top" width="680" class="right_section" align="center">
	       		<div id="questionsDiv">
					<!-- The Questions comes here from getQuestion() function -->
                </div>  	
                <div id="seeMoreQuestions" style="text-align: center;background: #8BAD68;">
                 	<a class="normal" style="color:#333" id="moreQuestionsButton">See More Queries</a>
               	</div>
               	<img alt="Loading.." id="load" style="display:none;" src="/static/images/loading_flat.gif">
			</td>
			<td valign="top" align="center" width="220" class="right_section">
					 <?php $this->load->view('mobile/panelside_view'); ?>
            </td>
		</tr>
        </table>
    </div>
    <br/>
    <div class="right_section" style="min-height:200px;">
    	<table><tr><td valign="top">
	    		<button class="button_me"  id="prevOptinButton" >Previous</button><br/>
	    		<button class="button_me"  id="setPrevDay" >Prev day</button>
		    </td><td width="600" align="center">
		    <div id="optinDiv">
				<!-- The Optin list comes here from getOptin() function -->
			</div>
		    </td><td valign="top">
		    	<button class="button_me"  id="nextOptinButton" >Next</button>
		    	<button class="button_me"  onclick="getOptin();" >Refresh </button><br/>
		    	<button class="button_me"  id="setNextDay" >Next day</button>
		    </td></tr>
	    </table>
    </div>
</div>
<span id=dummyspan></span>
</center>


<script type="text/javascript">
$lim = 0;
$fmid = 0;
$mtype = 0;
$unumber = 0;
$date = new Date();
$month = $date.getMonth()+1;
$day = $date.getDate();
$set = 0;
$(document).ready(function() 
{	
	$first = 0;
	setInterval('getNotification()',10000);
	getOptin();
	$('#nextOptinButton').click(function(){$set=$set+8; getOptin();  });
	$('#prevOptinButton').click(function(){$set=$set-8; getOptin();  });
	$('#setPrevDay').click(function(){$day=$day-1; $set=0; getOptin();  });
	$('#setNextDay').click(function(){$day=$day+1; $set=0; getOptin();  });
	
	userQuestions($lim,"'0' or mtype='locked' group by unumber");	
	$('#moreQuestionsButton').click(function(){ $lim=$lim+10; userQuestions($lim,$mtype); });
	$('#allAnswers').click(function(){ userQuestions(0,"1 or (mtype !='0' and mtype !='3' and mtype !='4' and mtype !='5' and mtype !='locked')"); });
	$('#allQuestions').click(function(){ userQuestions(0,"'0' or mtype='3' or mtype='4' or mtype='locked'"); });
	$('#answeredQuestions').click(function(){ userQuestions(0,3); });
	$('#unansweredQuestions').click(function(){ userQuestions(0,"'0' or mtype='locked'"); });
	$('#waitingQuestions').click(function(){ userQuestions(0,4); });
	$('#spamQuestions').click(function(){ userQuestions(0,5);});
});

function getNotification()
{
	$.get('getNoti',{},function(response){
		if(response != $fmid & $first ==1)
		{
			document.getElementById("dummyspan").innerHTML= "<embed src='/static/sound.wav' hidden=true autostart=true loop=false>";
			alert("New Question Received");
		}
		$fmid = response;
		$first =1;
	});
}
function userQuestions($limit,$messagetype)
{
	$lim = $limit;
	$mtype = $messagetype;
	z = document.getElementById('moreQuestionsButton');
	$('#load').fadeIn(100);
	$('#seeMoreQuestions').fadeIn(3000);
	z.innerHTML = "See More Queries";
	$.get('/mobile/getQuestions',{'lim':$limit,'mtype':$mtype},function(response){
		if(response!="")
		{
			if($limit == 0)
				$('#questionsDiv').html(response);
		 	else
				$('#questionsDiv').append(response);
		}
		else
		{
			z.innerHTML="Sorry No More Messages";
			$('#seeMoreQuestions').fadeOut(3000);
		}
	});
	$('#load').fadeOut(100);
}

function showPopUp($num)
{
	showBack();
	$('#showId').html("Mobile Number : "+$num);
	userMessages(0,$num,'');
	$unumber = $num;
	getLocation();
}				   	
function getOptin()
{
	$('#optinDiv').html('<img alt="Loading.." src="/static/images/loading.gif">');
	$sdate = $day+"/"+$month+"/"+"2012";
	$.post('/mobile/getoptin',{'sdate':$sdate,'lim':$set},function(response){
			$('#optinDiv').html(response);
	});
}
function showBack()
{
	$("#popup_bg").fadeIn(300);
	$("#popup").delay(300).fadeIn(300);
}
function hideBack()
{
	$("#popup").fadeOut(300);
	$("#popup_bg").delay(300).fadeOut(300);
}

</script>
