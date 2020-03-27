<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?=__('Actions')?></h4>
<?=$this->Form->postLink(
	__('Delete'),
	['action'  => 'delete', $user->id],
	['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
)?>
            <?=$this->Html->link(__('Profile'), ['action' => 'userprofile'], ['class' => 'side-nav-item'])?>
</div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
<?=$this->Form->create($user, ['type' => 'file', 'class' => 'form-disable'])?>
            <fieldset>
                <legend><?=__('Edit Profile')?></legend>
<?php
echo $this->Form->control('yourname', ['label'     => 'yourname*']);
echo $this->Form->control('email', ['label'        => 'email*']);
echo $this->Form->control('mobileno', ['label'     => 'mobile*']);
echo $this->Form->control('profile_image', ['type' => 'file', 'accept' => '.jpeg']);
?>
</fieldset>
<?=$this->Form->control('Submit', ['type' => 'submit'])?>
            <?=$this->Form->end()?>
        </div>
    </div>
</div>
<script>
$('.form-disable').on('submit',function(){
var self=$(this),
button=self.find('input[type="submit"],button'),
submitValue=button.data('submit-value');
button.attr('disabled','disabled').val((submitValue) ? submitValue : 'Please wait...');
});
</script>