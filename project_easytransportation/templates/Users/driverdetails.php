
<?php if (!empty($driverdetail)):?>
<div id='nav'>
        <h3><?=__(' Your Drivers')?>

        <table border='2'>
            <thead>
                <tr>
                    <th><?=$this->Paginator->sort('id')?></th>
                    <th><?=$this->Paginator->sort('provider id')?></th>
                    <th><?=$this->Paginator->sort('name')?></th>
                    <th><?=$this->Paginator->sort('mobileno')?></th>
                    <th><?=$this->Paginator->sort('state')?></th>
                    <th><?=$this->Paginator->sort('city')?></th>
                    <th><?=$this->Paginator->sort('truck_no')?></th>
                    <th><?=$this->Paginator->sort('profile image')?></th>
                    <th><?=$this->Paginator->sort('created')?></th>
                    <th><?=$this->Paginator->sort('modified')?></th>

                    <th class="actions"><?=__('Actions')?></th>

                </tr>
            </thead>
            <tbody>

<?php foreach ($driverdetail as $driver):?>
                <tr>
                    <td><?=$this->Number->format($driver->id)?></td>
                    <td><?=$this->Number->format($driver->provider_id)?></td>
                    <td><?=($driver->name)?></td>
                    <td><?=$driver->mobileno?></td>
                    <td><?=($driver->state)?></td>
                    <td><?=($driver->city)?></td>
                    <td><?=($driver->truck_no)?></td>
                    <td><?=$this->Html->image($driver->profile_image, ['height' => '50', 'width' => '60'])?></td>
                    <td><?=($driver->created)?></td>
                    <td><?=($driver->modified)?></td>
<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $driver->id])?>

<?=$this->Form->postLink(__('Cancel'), ['action' => 'Cancelrequest', $driver->id], ['confirm' => __('Are you sure you want to cancel # {0}?', $driver->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                </div>
<?php endif;?>

<?php if (empty($driverdetail)):?>

     <h2>Hello <?php $name = $user['yourname'];
echo $name;?>, you have not added your driver details yet </h2>
<?php endif;?>

            <div class="line"></div>



            <div class="line"></div>


            <div class="line"></div>


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