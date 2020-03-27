<body>
<?php echo $this->Html->css('report')?>
<ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active"  href="/users/home" style ="color:black ;">Home</a>
    </li>
<div class='container'>
	<div class='row '>
		<div class="col-md-3"></div>
		<div class='col-md-5'>
		<h1 class='text-center'>EASY TRASPORTATION</h1>
			<h3 class='text-center'>Report HERE</h3>
<?=$this->Form->create($report, ['class' => 'form-disable']);?>
			<?php
echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control', 'label' => 'username*']);
echo $this->Form->control('email', ['class'     => 'form-control', 'label'     => 'email*']);

echo $this->Form->control('report_type', ['class' => 'form-control', 'label' => 'report type*']);
echo $this->Form->control('message', ['class'     => 'form-control', 'label'     => 'message*']);
?>

<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']);?>
</div>
<div class="col-md-4"></div>
</div>
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
