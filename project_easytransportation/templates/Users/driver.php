<body>
<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Add driver details</h1>
<?=$this->Form->create($driver, ['type' => 'file', 'class' => 'form-disable']);?>
			<?php
echo $this->Form->control('provider_id', ['options' => $providers, 'class' => 'form-control', 'label' => 'company name*']);
echo $this->Form->control('name', ['class'          => 'form-control', 'label'          => ' Driver name*']);
echo $this->Form->control('mobileno', ['class'      => 'form-control', 'label'      => 'mobile no*']);
echo $this->Form->control('state', ['class'         => 'form-control', 'label'         => 'state*']);
echo $this->Form->control('city', ['class'          => 'form-control', 'label'          => 'city*']);
echo $this->Form->control('truck_no', ['class'      => 'form-control', 'label'      => 'truck_no*']);

echo $this->Form->control('adhar_image', ['type' => 'file', 'accept' => '.jpeg', 'class' => 'form-control', 'label' => ' Upload adhar*']);

echo $this->Form->control('dl_image', ['type' => 'file', 'accept' => '.jpeg', 'class' => 'form-control', 'label' => 'Upload driving license*']);

echo $this->Form->control('pan_image', ['type' => 'file', 'accept' => '.jpeg', 'class' => 'form-control', 'label' => 'Upload pan card*']);

echo $this->Form->control('profile_image', ['type' => 'file', 'accept' => '.jpeg', 'class' => 'form-control', 'label' => 'Upload profile image*']);
?>

<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']);?>
</div>
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
