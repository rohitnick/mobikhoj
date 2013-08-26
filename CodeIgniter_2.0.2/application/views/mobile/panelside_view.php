
        <button id="allAnswers" class="button_me" style="width:200px;">Sent Answers</button>
        <br/><br/>
        <button id="allQuestions" class="button_me" style="width:200px;">All Questions</button>
        <button id="answeredQuestions" class="button_me" style="width:200px;">Answered</button>
        <button id="unansweredQuestions" class="button_me" style="width:200px;">Unanswered</button>
        <button id="waitingQuestions" class="button_me" style="width:200px;">Awaiting start</button>
        <button id="spamQuestions" class="button_me" style="width:200px; display:none;">Spam is Disabled</button>
        <br/><br/>
<table width="200">
    <tr align="left">
    	<td>
        <input id="numberText" class="input_text" style=" width:200px" /><span class="input_label" style="margin-left:-200px;">Mobile Number</span><br/>
        <button class="button_me" style="float:right" onclick="messagesNum();">Get List</button>
        </td>
    </tr>
    <tr align="left">    
    	<td>
        <input id="modText" class="input_text" style="width:200px;"  /><span class="input_label" style="margin-left:-200px;">Moderator</span><br/>
        <button class="button_me" style="float:right" onclick="messagesMod();">Get List</button>
        </td>
    </tr>
</table>

<script type="text/javascript">
function messagesNum()
{
	$num = $("#numberText").attr('value');
	showBack();
	$('#showId').html("Mobile Number : "+$num);
	userMessages(0,$num,'');
}
function messagesMod()
{
	$mod = $("#modText").attr('value');
	showBack();
	$('#showId').html("Moderator : "+$mod);
	userMessages(0,0,$mod);
}

</script>