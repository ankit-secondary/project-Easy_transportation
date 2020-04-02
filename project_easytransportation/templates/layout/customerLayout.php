<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<?php echo $this->Html->css('customerdash.css')?>
<?php echo $this->Html->script('customerdash.js')?>
<script>
                        $("#nav a").click(function(e){
    e.preventDefault();
    $(".toggle").hide();
    var toShow = $(this).attr('href');
    $(toShow).show();
});
                    </script>
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">

<?php echo $this->Html->image("logo.jpeg", [
		"alt" => "transport",
		'url' => ['controller' => 'Users', 'action' => 'home']
	]);?>
</div>
                <div class="navi">
                    <ul>
                        <li class="active"><a href="customerdash"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>

                        <li><a href="/users/userprofile"><i class=" glyphicon glyphicon-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">View Profile</span></a></li>

                         <li><a href="reports"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Report</span></a></li>

                        <li><a href="requests"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Add Request</span></a></li>

                         <li><a href="requestdetail"><i class="fa-fa-request" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Your Requests</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">


<li class="hidden-xs">
<?=$this->Html->link('LOGOUT', ['Controller' => 'Users', 'action' => 'logout'], ['class' => 'logout'])?>
</li>
                                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">3</span>
                                        </a>
                                    </li>

<?php
$profile_image = $user['profile_image'];
echo $this->Html->image("$profile_image", [
		"alt" => "user", 'url' => ['Controller' => 'Users', 'action' => 'userprofile']]);?> <b> <?php echo $user['yourname'];?><b>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div><?=$this->fetch('content')?>
                <?=$this->Flash->render()?>