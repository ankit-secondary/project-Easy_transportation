<?php if (!empty($providersrequest)):?>
  <div class='table-responsive'>
        <table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th><?='id'?></th>
                    <th><?='pickup date'?></th>
                    <th><?='user customer'?></th>
                    <th><?='truck size'?></th>
                    <th><?='pickup'?></th>
                    <th><?='drop'?></th>
                    <th><?='weight'?></th>
                    <th><?='Fare'?></th>
                    <th><?='status'?></th>
                    <th><?='created'?></th>
                    <th><?='modified'?></th>
                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>

<?php foreach ($providersrequest as $request):?>
                <tr>
                    <td><?=$this->Number->format($request->id)?></td>
                    <td><?=($request->pickup_date)?></td>
                    <td>
<?php foreach ($users as $user):?>
                        <?php if (($request->user_customer_id) == ($user->id)):?>
                        <?php $customer = ($user->email);
echo $customer;?>
                        <?php endif;?>
                            <?php endforeach;?>
</td>
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

                            <td>
<?php foreach ($areas as $area):?>
                        <?php if (($request->pickup_location) == ($area->id)):?>
                        <?php $areaname = ($area->location);
echo $areaname;?>
                        <?php endif;?>
                            <?php endforeach;?>
</td>
                    <td>
<?=($request->drop_location)?>
                    </td>
                    <td><?=($request->weight_in_ton)?></td>
                    <td><?=($request->cost)?></td>
                    <td>
<?php if ($request->status == 0) {
	$status = '<span class="badge badge-danger">Pending</span>';
	echo $status;
} else {
	$status = '<span class="badge badge-success">Responded</span>';
	echo $status;
}?>
                    </td>
                    <td><?=($request->created)?></td>
                    <td><?=($request->modified)?></td>
<td>
<?=$this->Html->link(__('View'), ['controller' => 'users', 'action' => 'viewrequest', $request->id], ['class' => 'btn btn-success btn-lg'])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
</div>
<?php endif;?>
<?php if (empty($providersrequest)):?>
   <h1><?php echo 'No one has requested you for delivery';?></h1>

<?php endif;?>
</div>
                            </div>
                        </div>
                    </div>
