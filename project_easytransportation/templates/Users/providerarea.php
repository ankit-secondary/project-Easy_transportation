<?php echo $this->Html->script('buttonvalidate.js');?>
<body>

	<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Add Area</h1>
<?=$this->Form->create($area, ['class' => 'form-disable']);?>
<?php

echo $this->Form->control('user_provider_id', ['options'   => $users, 'class'   => 'form-control']);
echo $this->Form->control('location', ['class'          => 'form-control']);

?>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
<?=$this->Form->end();?>

</body>
</html>