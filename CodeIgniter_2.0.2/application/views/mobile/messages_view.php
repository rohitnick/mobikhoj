<?php foreach(array_reverse($Message, true) as $row): ?>
<?php $mtype = $row['mtype']; 
	  if ( $mtype=='0' or $mtype=='3' or $mtype=='4' or $mtype=='5' or $mtype =='locked') 
	  { ?>
		<table <?php if($mtype == '3' or $mtype == '5') { ?> style="color:green" <?php } elseif ($mtype=='locked') { ?> style="color:red" <?php } ?>  class="message_question" width="90%" align="left" id="<?php echo $row['mid'] ?>" onclick="selectQuestion(<?php echo $row['mid'] ?>);">
			<tr>
				<td colspan="3" class="normal"><?php echo $row['message'] ?></td>
			</tr>
			<tr class="sub">
				<td width="170" >Time : <?php echo get_my_time($row['time']); ?></td>
				<td width="170">Number : <?php echo $row['unumber'] ?></td>
				<td width="120"> Type : <?php echo $mtype; ?></td>
				<td >by : <?php echo $row['moderator'] ?></td>
			</tr>
		</table>
<?php } else {?>
	<table class="message_answer" width="90%" align="right" onclick="selectAnswer('<?php echo $mtype ?>');">
		<tr>
			<td class="normal" colspan="3"><?php echo $row['message'] ?></td>
		</tr>
		<tr class="sub">
			<td width="170">Time : <?php echo get_my_time($row['time']); ?></td>
			<td width="170">Moderator : <?php echo $row['moderator'] ?></td>
			<td >Delivery : <?php echo $mtype ?></td>
		</tr>
	</table>

<?php } endforeach;?>