<div class="row">
<aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?=__('Actions')?></h4>
<?php if ($user['role'] == 1) {
	echo $this->Html->link(__('Requests'), ['action' => 'providerhasrequest'], ['class' => 'side-nav-item']);
}
?>

<?php if ($user['role'] == 0) {
	echo $this->Html->link(__('Requests'), ['action' => 'requestdetail'], ['class' => 'side-nav-item']);

}
?>
</div>
    </aside>
<div class="column-responsive column-80">
        <div class="categories view content">
<?php if ($user['role'] == 1):?>
<h2 style='color:red'>Contact for Confirmation</h2><br>

<?php foreach ($users as $Users) {
	$mobileno = $Users->mobileno;
	$email    = $Users->email;
	$name     = $Users->yourname;

}?>          <p>Name: <?=$name?></p><br>
            <p>Mobile no: <?=$mobileno?></p><br>
            <p>Email-id: <?=$email?></p><br>

<?php endif;?>
            <table>
                <tr>
                    <th><?=__('Request Id')?></th>
                    <td><?=h($request->id)?></td>
                </tr>

                <tr>
                    <th><?=__('pickup date')?></th>
                    <td><?=h($request->pickup_date)?></td>
                </tr>
                <tr>
                    <th><?=__('Truck Size')?></th>
                    <td>
<?php if ($request->truck_size == 0) {
	echo 'Small';
}

if ($request->truck_size == 1) {
	echo 'Medium';
}

if ($request->truck_size == 2) {
	echo 'Large';
}
?>

                    </td>
                </tr>
                <tr>
                    <th><?=__('Pickup location')?></th>
                    <td>
<?php foreach ($areas as $area) {
	if (($area->id) == ($request->pickup_location)) {
		echo $area->location;
	}
}
?>
                    </td>
                </tr>
                <tr>
                    <th><?=__('Drop location')?></th>
                    <td><?=h($request->drop_location)?></td>
                </tr>
                <tr>
                    <th><?=__('Weight')?></th>
                    <td><?=h($request->weight_in_ton)?></td>
                </tr>
                <tr>
                    <th><?=__('Fare')?></th>
                    <td><?=h($request->cost)?></td>
                </tr>

                <tr>
                    <th><?=__('Created')?></th>
                    <td><?=h($request->created)?></td>
                </tr>

<?php if ($user['role'] == 1):?>
<tr>
    <th><?=__('Action')?></th>
    <td>
<?=$this->Html->link(__('Proceed'), ['action'        => 'serviceassign', $request->id], ['class'        => 'btn btn-success btn-lg'])?>
<?=$this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'deleterequest', $request->id], ['class' => 'btn btn-success btn-lg'], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)])?>
<style type="text/css">
 .btn{
    margin-left: 30px;
    margin-right: 30px;
 }
</style>

<?php endif;?>
</td>
</tr>
            </table>
            </div>
    </div>
</div>
