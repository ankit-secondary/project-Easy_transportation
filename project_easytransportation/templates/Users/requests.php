<body>

	<div class='rounded mb-2 w-05 0 h-70 p-4 ' style='background-color: #eee;'>
    <h1 style='color:red;'>Request here</h1>
<?=$this->Form->create($request, ['class' => 'form-disable']);?>
<?php
echo $this->Form->control('pickup_date', ['class'        => 'form-control', 'placeholder'        => 'YYY:MM:DD']);
echo $this->Form->control('user_customer_id', ['options' => $users, 'class' => 'form-control']);
echo $this->Form->control('pickup_location', ['options'  => $areas, 'class'  => 'form-control']);
echo $this->Form->control('drop_location', ['class'      => 'form-control']);
echo $this->Form->control('weight_in_ton', ['class'      => 'form-control']);
echo $this->Form->control('truck_size', ['type'          => 'radio', 'options'          => [['value'          => '0', 'text'          => 'small'], ['value'          => '1', 'text'          => 'medium'], ['value'          => '2', 'text'          => 'large']]]);
?>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
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
</html>