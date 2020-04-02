<?php if(! empty($truckdetail)):;?>
  <div id='trucks'>
        <table border='1'>
            <thead>
                <tr>
                    <th><?=$this->Paginator->sort('id')?></th>
                    <th><?=$this->Paginator->sort('truck ')?></th>
                    <th><?=$this->Paginator->sort('provider_id')?></th>
                    <th><?=$this->Paginator->sort('capacity')?></th>
                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>

<?php foreach ($truckdetail as $truck):?>
                <tr>
                    <td><?=$this->Number->format($truck->id)?></td>
                    <td><?=($truck->trucks)?></td>
<?php foreach ($provider as $providers):?>
                     <td><?=$providers['companyname'];?></td>
<?php endforeach;?>
                    <td><?=($truck->capacity_in_ton)?></td>

<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $truck->id])?>

<?=$this->Form->postLink(__('Cancel'), ['action' => 'Cancelrequest', $truck->id], ['confirm' => __('Are you sure you want to cancel # {0}?', $truck->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                 </div>
           <?php endif;?>                            <?php if(empty($truckdetail)){
                                echo "you have not added truck yet";
                            }
                            
                            ?>

                                </div>
                            </div>
                        </div>
                    </div>