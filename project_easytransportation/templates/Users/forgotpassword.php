<?php echo $this->Html->script('buttonvalidate.js');?>
<body>

	<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Forgot Password</h1>
<?php echo $this->Form->create()?>
<?php

echo $this->Form->control('email', ['class' => 'form-control']);
?>
<br>
<?=$this->Form->button('Get password', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']);?>
<?php echo $this->Form->end();?>
</div>
</body>
</html>