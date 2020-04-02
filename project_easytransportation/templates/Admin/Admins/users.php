
<?php if (!empty($users)):?>
            	 <div class='table-responsive'>




        <h3><?=__('users')?></h3>


        <table border='1'>
            <thead>
                <tr>
                    <th><?=$this->Paginator->sort('id')?></th>
                    <th><?=$this->Paginator->sort('name')?></th>
                    <th><?=$this->Paginator->sort('user name')?></th>
                     <th><?=$this->Paginator->sort('email')?></th>
                    <th><?=$this->Paginator->sort('mobile no')?></th>
                    <th><?=$this->Paginator->sort('profile pic')?></th>
                    <th><?=$this->Paginator->sort('role')?></th>
                    <th><?=$this->Paginator->sort('created')?></th>
                    <th><?=$this->Paginator->sort('modified')?></th>

                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>


<?php foreach ($users as $allusers):?>
                <tr>
                    <td><?=$this->Number->format($allusers->id)?></td>
                    <td><?=($allusers->yourname)?></td>
                    <td><?=($allusers->username)?></td>
                    <td><?=($allusers->email)?></td>
                    <td><?=($allusers->mobileno)?></td>
                    <td><?=$this->Html->image($allusers->profile_image, ['height' => '60'])?></td>
                    <td><?=($allusers->role)?></td>
                    <td><?=($allusers->created)?></td>
                    <td><?=($allusers->modified)?></td>
<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $user->id])?>

<?=$this->Html->link(__('Edit'), ['action' => 'edit', $user->id])?>

<?=$this->Form->postLink(__('delete'), ['action' => 'Cancelrequest', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                </div>
            </div>
<?php endif;?>

<?php if (empty($users)):?>
<h2>No one has registered yet </h2>
<?php endif;?>
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
</div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>