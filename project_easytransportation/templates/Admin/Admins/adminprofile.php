<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?=__('Actions')?></h4>
<?=$this->Form->postLink(__('Delete account'), ['action'       => 'deleteuser', $user->id], ['confirm'       => __('Are you sure you want to delete # {0}?', $user->id), 'class'       => 'side-nav-item'])?>
            <?=$this->Html->link(__('Edit Profile'), ['action' => 'adminprofile#'], ['class' => 'side-nav-item'])?>
            <?php $role = ($user->role);

if ($role == 2) {

	echo $this->Html->link(__('Go to dash'), ['action' => 'admindash'], ['class' => 'side-nav-item']);}?>

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
if ($role == 2) {
	echo "Admin";}

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
           </div>
       </div>
   </div>