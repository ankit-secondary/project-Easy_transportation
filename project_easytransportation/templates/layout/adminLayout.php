<html>
<head>
    <title>Easytransportation</title>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
                    <a href="adminprofile"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> View Profile</span></a>
                </li>
                <li class='sidecontent'>
                    <a href="users"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> Users</a>
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

                            <li class="nav-item active">
<?=$this->Html->link('Requests', ['Controller' => 'Admins', 'action' => 'requests'], ['class' => 'logout'])?>
</li>

                            <li class="nav-item active">
<?=$this->Html->link('Providers', ['Controller' => 'Admins', 'action' => 'providers'], ['class' => 'logout'])?>
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
<?=$this->fetch('content')?>
<?=$this->Flash->render()?>

