
<?php if (($fares)):?>
    <div class='table-responsive'>
<table class='table table-dark table-hover'>
    <thead>
        <tr>
            <th class='p-2 bg-primary' scope="col"><?='Pickup'?></th>
            <th class='p-2 bg-info'scope="col"><?='Drop'?></th>
            <th class='p-2 bg-warning' scope="col"><?='Truck'?></th>
            <th class='p-2 bg-danger'  scope="col"><?='Approx time'?></th>
            <th  class='p-2 bg-success' scope="col"><?='Fare'?></th>

        </tr>
    </thead>
    <tbody>
<?php foreach ($fares as $fare):?>
<tr>

            <td>
<?php foreach ($area as $areas) {
	if ($areas->id == $fare->pickupat) {
		$pickup = $areas->location;
		echo $pickup;
	}
}?>
                 </td>

            <td><?=h($fare->dropto)?></td>
            <td>
<?php foreach ($truck as $trucks) {
	if ($trucks->id == $fare->truck_id) {
		echo $trucks->trucks;
	}
}
?>
            </td>
            <td><?=h($fare->approx_time)?></td>
            <td><?=h($fare->fare)?></td>

        </tr>
<?php endforeach;?>
</tbody>
</table>
</div>
<?php endif;?>

