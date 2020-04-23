 <?php if ($user['role'] == 0):?>
  <?php if (!empty($customerservice)):?>
        <table class='table  table-hover'>
            <thead>
                <tr>
                    <th><?=('id')?></th>
                    <th><?=('Request Id')?></th>
                    <th><?=('Company name')?></th>
                    <th><?=('Driver Name')?></th>
                    <th><?=('Driver Number')?></th>
                    <th><?=('Truck No.')?></th>
                    <th><?=('Approx time')?></th>
                    <th><?=('Fare')?></th>
                     <th><?=('status')?></th>
                     <th><?=__('Actions')?></th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($customerservice as $service):?>
                <tr>
                    <td><?=$this->Number->format($service->id)?></td>
                    <td><?=($service->request_id)?></td>
                    <td>
<?php foreach ($providers as $provider) {
	if (($provider->id) == ($service->provider_id)) {
		echo $companyname = $provider->companyname;
	}
}
?>
</td>
<?php foreach ($driverdetails as $drivers):?>
<td>
<?php echo $drivers->name;?>
</td>
<td>
<?php echo $drivers->mobileno;?>
</td>

<td>
<?php echo $drivers->truck_no;?>
</td>
<?php endforeach;?>


<td><?=$service->approx_time?></td>
<td><?=($service->money_to_pay)?>
</td>
  <td>
<?php if (($service->service_status) == 0) {

	$status = '<span class="label label-warning">Initialised</span>';
	echo $status;
}

if (($service->service_status) == 1) {
	$status = '<span class="label label-info">On the way</span>';
	echo $status;
}

if (($service->service_status) == 2) {

	$status = '<span class="label label-success">Delivered</span>';
	echo $status;
}

?>
</td>
    <td>
<?=$this->Html->link(__('View'), ['action' => 'viewservice', $service->id], ['class' => 'btn btn-success btn-sm'])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                                </div>
<?php endif;?>
                           <h2> <?php if (empty($customerservice)) {
	echo 'Your have no delivery service';
}
?>
</h2>

<?php endif;?>

<?php if ($user['role'] == 1):?>
  <?php if (!empty($providerservice)):?>
        <table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th><?=('id')?></th>
                    <th><?=('Request Id')?></th>
                    <th><?=('Company name')?></th>
                    <th><?=('Driver Name')?></th>
                    <th><?=('Driver Number')?></th>
                    <th><?=('Truck No.')?></th>
                    <th><?=('Approx time')?></th>
                    <th><?=('Fare')?></th>
                     <th><?=('status')?></th>
                     <th><?=__('Actions')?></th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($providerservice as $service):?>
                <tr>
                    <td><?=$this->Number->format($service->id)?></td>
                    <td><?=($service->request_id)?></td>
                    <td>
<?php foreach ($providers as $provider) {
	if (($provider->id) == ($service->provider_id)) {
		echo $companyname = $provider->companyname;
	}
}
?>
</td>
                     <td>
<?php foreach ($driverdetail as $drivers):?>
  <?php echo ($drivers->name)?>
</td>

<td>
<?php echo ($drivers->mobileno)?>
</td>
<td>
<?php echo ($drivers->truck_no)?>
<?php endforeach;?>
</td>
                     <td><?=$service->approx_time?></td>
                    <td><?=($service->money_to_pay)?>
</td>
                    <td>
<?php if (($service->service_status) == 0) {
	$status = '<span class="badge badge-warning">Initialised</span>';
	echo $status;
}

if (($service->service_status) == 1) {
	$status = '<span class="badge badge-info">On the way</span>';
	echo $status;
}

if (($service->service_status) == 2) {
	$status = '<span class="badge badge-success">Delivered</span>';
	echo $status;
}

?>
</td>
    <td>
<?=$this->Html->link(__('View'), ['action' => 'viewservice', $service->id], ['class' => 'btn btn-success btn-lg'])?>

<?=$this->Html->link(__('Edit'), ['action' => 'editservice', $service->id], ['class' => 'btn btn-success btn-lg'])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                                </div>
<?php endif;?>

                           <h2> <?php if (empty($providerservice)):?>
	<?php echo 'Your have not proceed for delivery service yet';?>
</h2>
<?php endif;?>
<?php endif?>

                            </div>
                            </div>
                        </div>
                    </div>