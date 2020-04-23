
<?php if (!empty($driverdetail)):?>
<div class='table-responsive'>
        <h3><?=__(' Your Drivers')?>

        <table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th><?='id'?></th>
                    <th><?='provider id'?></th>
                    <th><?='name'?></th>
                    <th><?='mobileno'?></th>
                    <th><?='state'?></th>
                    <th><?='city'?></th>
                    <th><?='truck no'?></th>
                    <th><?='profile image'?></th>
                    <th><?='created'?></th>
                    <th><?='modified'?></th>

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
                     <td><?php echo $this->Html->image($driver->profile_image, ['height' => '30'])?></td>
                    <td><?=($driver->created)?></td>
                    <td><?=($driver->modified)?></td>
<td>
<?=$this->Html->link(__('Delete'), ['action' => 'deletedriver', $driver->id], ['class' => 'btn btn-danger btn-lg'])?>

<?=$this->Html->link(__('Edit'), ['action' => 'editdriver', $driver->id], ['class' => 'btn btn-success btn-lg'])?>
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