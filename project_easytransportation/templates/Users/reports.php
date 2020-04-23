<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
			<h3 class='text-center'>Report Here</h3>
<?=$this->Form->create($report, ['class' => 'form-disable']);?>
			<?php
echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control', 'label' => 'username*']);
echo $this->Form->control('email', ['class'     => 'form-control', 'label'     => 'email*']);

echo $this->Form->control('report_type', ['class' => 'form-control', 'label' => 'report type*']);
echo $this->Form->control('message', ['class'     => 'form-control', 'label'     => 'message*']);
?>

</div>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']);?>


<?=$this->Form->end();?>

<script>
	$('.form-disable').on('submit',function(){
var self=$(this),
button=self.find('input[type="submit"],button'),
submitValue=button.data('submit-value');
button.attr('disabled','disabled').val((submitValue) ? submitValue : 'Please wait...');
});
</script>
</body>
