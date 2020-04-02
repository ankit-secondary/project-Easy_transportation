<?php if (!empty($providers)):;?>
    <div id='providers'>
                <div class="table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th><?=$this->paginator->sort('Id')?></th>
                            <th><?=$this->paginator->sort('user id')?></th>
                            <th><?=$this->paginator->sort('country')?></th>
                            <th><?=$this->paginator->sort('State')?></th>
                            <th><?=$this->paginator->sort('city')?></th>
                            <th><?=$this->paginator->sort('Nearby/area')?></th>
                            <th><?=$this->paginator->sort('Company name')?></th>
                            <th><?=$this->paginator->sort('adhar card')?></th>
                            <th><?=$this->paginator->sort('pan card')?></th>
                            <th><?=$this->paginator->sort('created')?></th>
                            <th><?=$this->paginator->sort('Modified')?></th>
                            <th class="actions"><?=__('Actions')?></th>

                        </tr>
                        </thead>
            <tbody>
<?php foreach ($providers as $provider):?>
                        <tr>
                            <td><?=$this->Number->format($provider->id)?></td>
                            <td><?=$this->Number->format($provider->user_provider_id)?></td>
                            <td><?=($provider->country)?></td>
                            <td><?=($provider->state)?></td>
                            <td><?=($provider->city)?></td>
                            <td><?=($provider->nearby)?></td>
                            <td><?=($provider->companyname)?></td>
                            <td><?=$this->Html->image($provider->adhar_image)?></td>
                            <td><?=$this->Html->image($provider->pan_image)?></td>
                            <td><?=($provider->created)?></td>
                            <td><?=($provider->modified)?></td>

<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $provider->id])?>

<?=$this->Form->postLink(__('delete'), ['action' => 'Cancelrequest', $provider->id], ['confirm' => __('Are you sure you want to delete # {0}?', $provider->id)])?>
</td>
                        </tr>
<?php endforeach;?>
</tbody>
</table>
                </div>

                        <div class="paginator">
        <ul class="pagination">
<?=$this->Paginator->first('<< '.__('first'))?>
            <?=$this->Paginator->prev('< '.__('previous'))?>
            <?=$this->Paginator->numbers()?>
            <?=$this->Paginator->next(__('next').' >')?>
            <?=$this->Paginator->last(__('last').' >>')?>
        </ul>
        <p><?=$this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total'))?></p>
    </div>

<?php endif;?>
</div>
