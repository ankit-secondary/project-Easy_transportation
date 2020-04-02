<body>
<?php echo $this->Html->css('login')?>
<div class='container'>
	<div class='row '>
		<div class="col-md-3"></div>
		<div class='col-md-5'>
		<h1 class='text-center'>EASY TRASPORTATION</h1>
			<h3 class='text-center'>LOGIN HERE</h3>
<?=$this->Form->create();?>
			<?php
echo $this->Form->control('username', ['class' => 'form-control', 'label' => 'username*']);
echo $this->Form->control('password', ['class' => 'form-control', 'label' => 'password*']);
?>
<?=$this->Form->control('Remember me', ['type'   => 'checkbox', 'class'   => 'text-center']);?>
<?=$this->Form->button('Login', ['class'         => 'btn btn-danger btn-lg']);?>
<?=$this->html->link('Forgot password', ['class' => 'alert-link']);?>
<?php echo $this->Html->link('Register',
	array('action' => 'register'),
	array(
		'bootstrap-type' => 'primary',
		'class'          => 'btn btn-lg btn-primary btn-block',
		// transform link to a button
		'rule' => 'button',
	)
);?>
</div>
<div class="col-md-4"></div>
</div>
</div>
<?=$this->Form->end();?>
</body>

