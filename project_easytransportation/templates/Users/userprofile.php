
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?=__('Actions')?></h4>
<?=$this->Form->postLink(__('Delete account'), ['action'       => 'deleteuser', $user->id], ['confirm'       => __('Are you sure you want to delete # {0}?', $user->id), 'class'       => 'side-nav-item'])?>
            <?=$this->Html->link(__('Edit Profile'), ['action' => 'edituser'], ['class' => 'side-nav-item'])?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories view content">
            <h3><?=$this->html->image($user->profile_image, ['height' => '90'])?></h3>
            <table>
                <tr>
                    <th><?=__('yourname')?></th>
                    <td><?=h($user->yourname)?></td>
                </tr>
                <tr>
                    <th><?=__('username')?></th>
                    <td><?=h($user->username)?></td>
                </tr>
                <tr>
                    <th><?=__('email')?></th>
                    <td><?=h($user->email)?></td>
                </tr>
                <tr>
                    <th><?=__('mobileno')?></th>
                    <td><?=($user->mobileno)?></td>
                </tr>
                <tr>
                    <th><?=__('Role')?></th>
                    <td><?php $role = ($user->role);
if ($role == 0) {
	echo "Customer";}
if ($role == 1) {
	echo "Provider";
}
?></td>
                </tr>
                <tr>
                    <th><?=__('Created')?></th>
                    <td><?=h($user->created)?></td>
                </tr>
                <tr>
                    <th><?=__('Modified')?></th>
                    <td><?=h($user->modified)?></td>
                </tr>
            </table>
            <div class="related">

<?php
$role = $user['role'];
if ($role == 0):
if (!empty($requestdetail)):?>
    <h4><?=__('Your Requests')?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?=__('id')?></th>
                            <th><?=__('pickup_date')?></th>
                            <th><?=__('User_id')?></th>
                            <th><?=__('pickup_location')?></th>
                            <th><?=__('drop_location')?></th>
                            <th><?=__('weight')?></th>
                            <th><?=__('created')?></th>
                            <th><?=__('modified')?></th>
                            <th class="actions"><?=__('Actions')?></th>
                        </tr>
<?php foreach ($requestdetail as $requests):?>
                        <tr>
                            <td><?=h($requests->id)?></td>
                            <th><?=h($requests->pickup_date)?></th>
                            <td><?=h($requests->user_customer_id)?></td>
                            <td><?=h($requests->pickup_location)?></td>
                            <td><?=h($requests->drop_location)?></td>
                            <td><?=h($requests->weight)?></td>
                            <td><?=h($requests->created)?></td>
                            <td><?=h($requests->modified)?></td>
                            <td class="actions">
<?=$this->Html->link(__('view'), ['controller'                                       => 'Users', 'action'                                       => 'viewrequest', $requests->id])?>
                                <?=$this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $requests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requests->id)])?>
</td>
                        </tr>
<?php endforeach;?>
</table>
                </div>
<?php endif;?>
<?php endif;?>
</div>
<?php $role = $user['role'];

if ($role == 1):?>
            <div class="related">
                <h4><?=__('your details')?></h4>
<?php
if (!empty($providerdetail)):;?>

                <div class="table-responsive">
                    <table border='1'>
                        <tr>
                            <th><?=__('Id')?></th>
                            <th><?=__('user id')?></th>
                            <th><?=__('country')?></th>
                            <th><?=__('State')?></th>
                            <th><?=__('city')?></th>
                            <th><?=__('Nearby/area')?></th>
                            <th><?=__('Company name')?></th>
                            <th><?=__('adhar card')?></th>
                            <th><?=__('pan card')?></th>
                            <th><?=__('created')?></th>
                            <th><?=__('Modified')?></th>

                        </tr>
<?php foreach ($providerdetail as $providers):?>
                        <tr>
                            <td><?=h($providers->id)?></td>
                            <td><?=h($providers->user_provider_id)?></td>
                            <td><?=h($providers->country)?></td>
                            <td><?=h($providers->state)?></td>
                            <td><?=h($providers->city)?></td>
                            <td><?=h($providers->nearby)?></td>
                            <td><?=h($providers->companyname)?></td>
                            <td><?=$this->html->image($providers->adhar_image,['height'=>'60'])?></td>
                            <td><?=$this->html->image($providers->pan_image,['height'=>'60'])?></td>
                            <td><?=h($providers->created)?></td>
                            <td><?=h($providers->modified)?></td>

</td>
                        </tr>
<?php endforeach;?>
</table>
                </div>
<?php endif;?>
<?php if(empty($providerdetail)):;?>

<?php echo 'please Add your details'.'<br><br>';
echo $this->Html->link(__('Add detail'), ['action' => 'providers'],['class'=>'logout']);
?>

<?php endif;?>
<?php endif;?>
</div>
        </div>
    </div>
</div>
