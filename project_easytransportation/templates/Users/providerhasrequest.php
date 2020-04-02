
<?php foreach ($trucks as $truck):?>
<?php endforeach;?>
  <div id='requests'>
        <table border='1'>
            <thead>
                <tr>
                    <th><?=$this->Paginator->sort('id')?></th>
                    <th><?=$this->Paginator->sort('pickup_date')?></th>
                    <th><?=$this->Paginator->sort('user_customer_id')?></th>
                    <th><?=$this->Paginator->sort('truck')?></th>
                    <th><?=$this->Paginator->sort('pickup_location')?></th>
                    <th><?=$this->Paginator->sort('drop_location')?></th>
                    <th><?=$this->Paginator->sort('weight')?></th>
                    <th><?=$this->Paginator->sort('created')?></th>
                    <th><?=$this->Paginator->sort('modified')?></th>
                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>
<?php foreach ($requestdetail as $request):?>
                <tr>
                    <td><?=$this->Number->format($request->id)?></td>
                    <td><?=($request->pickup_date)?></td>
                    <td><?=($request->user_customer_id);?></td>
                     <td><?=$request->truck_id;?></td>
                    <td><?=($request->pickup_location)?></td>
                    <td><?=($request->drop_location)?></td>
                    <td><?=($request->weight)?></td>
                    <td><?=($request->created)?></td>
                    <td><?=($request->modified)?></td>
<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $request->id])?>

<?=$this->Form->postLink(__('Cancel'), ['action' => 'Cancelrequest', $request->id], ['confirm' => __('Are you sure you want to cancel # {0}?', $request->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>