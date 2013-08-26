<?php foreach($Question as $row): ?>
<table class="message_question" width="100%" cellspacing="5" onclick="showPopUp('<?php echo $row['unumber'] ?>')">
	<tr>
		<td colspan="3" align="left">
		<span class="normal"><?php echo $row['message'] ?></span>
		</td>
	</tr>
	<tr class="sub">
        <td width="25%"><span >Time : <?php echo get_my_time($row['time']); ?></span></td>
        <td width="40%"><span >Number : <?php echo $row['unumber'] ?></span></td>
        <td><span ><?php if($row['moderator']) { echo "Moderator : ".$row['moderator']; }  ?></span></td>
	</tr>
</table>
<?php endforeach;?>