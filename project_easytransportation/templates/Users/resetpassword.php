<?php echo $this->Html->script('buttonvalidate.js');?>
<body>

	<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Reset password</h1>
<?php echo $this->Form->create();?>
<?php

echo $this->Form->control('password', ['class' => 'form-control']);
?>
<?php echo $this->Form->button('Reset password', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
<?php echo $this->Form->end();?>
</div>
</body>
</html>