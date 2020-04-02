<?php echo $this->Html->script('buttonvalidate.js');?>
<body>

	<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Add trucks</h1>
<?=$this->Form->create($truck, ['class' => 'form-disable']);?>
<?php

echo $this->Form->control('provider_id', ['options'   => $providers, 'class'   => 'form-control']);
echo $this->Form->control('trucks', ['class'          => 'form-control']);
echo $this->Form->control('capacity_in_ton', ['class' => 'form-control']);

?>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
<?=$this->Form->end();?>

</body>
</html>