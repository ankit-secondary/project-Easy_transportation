<body>
<?php	echo $this->Html->css('providers')?>
<div class='rounded mb-2 w-10 0 h-10 p-4 ' style='background-color: #eee;'>
    <h1 style ='color:red;'>complete your details</h1>
<?=$this->Form->create($provider, ['type' => 'file']);?>
<?php
echo $this->Form->control('user_provider_id', ['options' => $users, 'class' => 'form-control']);
echo $this->Form->control('country', ['class'            => 'form-control']);
echo $this->Form->control('state', ['class'              => 'form-control']);
echo $this->Form->control('city', ['class'               => 'form-control']);
echo $this->Form->control('nearby', ['class'             => 'form-control']);
echo $this->Form->control('company_name', ['class'       => 'form-control']);
echo $this->Form->control('adhar_image', ['type'         => 'file', 'accept'         => '.jpeg']);
echo $this->Form->control('pan_image', ['type'           => 'file', 'accept'           => '.jpeg']);
?>
<?=$this->Form->button('submit', ['class' => 'btn btn-success btn-lg']);?>

<?=$this->Form->end();?>
</body>
