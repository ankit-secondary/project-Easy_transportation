<?php if (!empty($providers)):?>
<div id='userdetails'>
		<table class='table-responsive'>
			<thead>
				<tr>
					<th>Company name</th>
					<th>status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php foreach ($providers as $provider):?>
<tr>
					<td><?=($provider->companyname)?></td>
	                <td>
<?php foreach ($users as $userprovider) {
	if (($provider->user_provider_id) == ($userprovider->id)) {
		if ($userprovider->status == 1) {
			$status = '<span class="label label-success">online</span>';
			echo $status;
		}
		if ($userprovider->status == 0) {
			$status = '<span class="label label-danger">offline</span>';
			echo $status;

		}

	}
}
?>
	                </td>
	                <td><button type='button' class='btn btn-info btn-xs start_chat' data-toproviderid=<?=$provider->id?>, data-tocompanyname=<?=$provider->companyname?>>start chat</button></td>
				</tr>
<?php endforeach;?>
</tbody>
		</table>
	</div>
<?php endif;?>
<script>
	$(document).ready(function()
	{
		function make_chat_dialog_box(to_provider_id,to_company_name)
		{
           var modal_content ='<div id="user_dialog_'+to_provider_id+'"class="user_dialog" title="you have chatted with'+to_user_name+'">';
           modal_content+='div style="height:400px; border:1px solid #ccc;overflow-y:scroll;margin-bottom:24px; padding:16px;" class="chat_history_'+to_provider_id+'">';
           modal_content+='</div>';
           modal_content+='<div class="form-group">';
           modal_content+='<textarea name="chat_message_'+to_provider_id+'id="chat_message_'+to_provider_id+'"class="form-control"></textarea>';
           modal_content+='</div><div class="form-group" align="right">';

		}
	});
	</script>
<?php if (empty($providers)) {
	echo 'No providers available';
}
?>
