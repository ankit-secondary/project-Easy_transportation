<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<?php echo $this->Html->css('admindash.css')?>
<?php echo $this->Html->script('admindash.js')?>

               <script>
                        $("#nav a").click(function(e){
    e.preventDefault();
    $(".toggle").hide();
    var toShow = $(this).attr('href');
    $(toShow).show();
});
                    </script>

</head>

<body>


    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4><?php
$profile_image = $user['profile_image'];
echo $this->Html->image("$profile_image", ['height' => '150', 'width' => '150',
		"alt"                                             => "user", 'url'                                             => ['Controller'                                             => 'Users', 'action'                                             => 'userprofile']]);?></h4>
		           <h5 style='color:black;'><b><?php $name = $user['yourname'];
echo $name;?></h5></b>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="admindash" ><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Home</span></a>
                </li>
                <li class='sidecontent'>
                    <a href="Admins/adminprofile"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> View Profile</span></a>
                </li>
                <li class='sidecontent'>
                    <a href="#users"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> Users</a>
                </li>
                <li class='sidecontent'>
                    <a href="reports"><i class='fa fa-' aria-hidden='true'></i><span class='hidden-xs hidden-sm'> Reports</span></a>
                </li>

            </ul>

        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
<?=$this->Html->link('LOGOUT', ['Controller' => 'Admins', 'action' => 'logout'], ['class' => 'logout'])?>
</li>
                            <li class="nav-item">
                               <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </li>
                            <li class='nav-item'>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">3</span>
                                        </a>
                                    </li>
                            <li class='nav-item'>
                            	<a href='home' class='icon-info'><i class='fa fa-truck' aria-hidden='true'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1>Welcome Ankit !!</h1><br>
             <p>What would u like to do</p>
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