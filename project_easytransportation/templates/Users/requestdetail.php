
<?php if (!empty($requestdetail)):?>
  <div id='requests'>
        <table class='table-responsive-md'>
            <thead>
                <tr>
                    <th><?=('id')?></th>
                    <th><?=('pickup date')?></th>
                    <th><?=('your Email')?></th>
                    <th><?=('truck size')?></th>
                    <th><?=('pickup location')?></th>
                    <th><?=('drop   location')?></th>
                    <th><?=('weight')?></th>
                     <th><?=('Fare')?></th>
                      <th><?=('status')?></th>
                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>
<?php foreach ($requestdetail as $request):?>
                <tr>
                    <td><?=$this->Number->format($request->id)?></td>
                    <td><?=($request->pickup_date)?></td>
                    <td><?=$user['username'];?></td>
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
                     <td><?php foreach ($area as $areas):?>
                         <?php if (($request->pickup_location) == ($areas->id)):?>
                         <?php $location = ($areas->location);
echo $location;?>

<?php endif;?>
                       <?php endforeach;?></td>
                    <td><?=($request->drop_location)?>
                    </td>
                    <td><?=($request->weight_in_ton)?></td>
                    <td>
<?=($request->cost)?>
</td>
                    <td>
<?php if ($request->status == 0) {

	$status = '<span class="label label-danger">Pending</span>';
	echo $status;
} else {

	$status = '<span class="label label-success">Assigned</span>';
	echo $status;
}
?>
</td>
<td>
<?=$this->Html->link(__('View '), ['action' => 'viewrequest', $request->id], ['class' => 'btn btn-warning btn-md'])?>

<?=$this->Form->postLink(__('Delete'), ['action' => 'deleterequest', $request->id], ['class' => 'btn btn-danger btn-sm'], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                                </div>
<?php endif;?>
                           <h2> <?php if (empty($requestdetail)) {
	echo 'Your have not requested yet';
}
?>
</h2>
                            </div>
                            </div>
                        </div>
                    </div>