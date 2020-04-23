<?php echo $this->Html->script('buttonvalidate.js');?>
<body>
<?php if (!empty($drivers)):?>
<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Assign driver</h1>
<?=$this->Form->create($service, ['class' => 'form-disable']);?>
<?php
echo $this->Form->control('truck_id', ['options'  => $trucks, 'class'  => 'form-control']);
echo $this->Form->control('driver_id', ['options' => $drivers, 'class' => 'form-control']);

echo $this->Form->control('status', ['type' => 'radio', 'options' => [['value' => '0', 'text' => 'initiated'], ['value' => '1', 'text' => 'on the way'], ['value' => '2', 'text' => 'Delivered']]]);

?>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
<?=$this->Form->end();?>
</body>
</html>
<?php endif;?>