<style>
  .title{
    padding-bottom:0px;
    margin-bottom: 0px;
  }
    .carousel-inner-img{
      width:100%;
      height:100%;
    }
  </style>
  <meta charset="utf-8">
  <title></title>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active"  href="/users/home" style ="color:black ;">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/users/about" style ="color:black;">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" style ="color:black;">6203009772</a> </li>
    <li class="nav-item">
      <a class="nav-link" href="/users/policy" style ="color:black;">POLICY</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/users/login" style ="color:black;">LOGIN</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/users/register" style ="color:black;">REGISTER</a>
    </li>
  </ul>
</nav>
<div style='background-color: skyblue;'>
<center><h1 class='title' style="color:red; "><b>WELCOME TO EASYTRANSPORTATION</b></h1></center>
</div>
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
<?=$this->Html->image('trucks.jpg', ['alt' => 'top trucks', 'width' => '1350px', 'height' => '500'])?>
</div>
    <div class="carousel-item">
<?=$this->Html->image('background.jpg', ['alt' => ' delivieries', 'width' => '1350px', 'height' => '500'])?>
</div>
    <div class="carousel-item">
<?=$this->Html->image('cities.jpg', ['alt' => 'covers all india', 'width' => '1350px', 'height' => '500'])?>
</div>
 </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div >
  <h3 style="color:blue;"><b> Some of our satisfied customers</b></h3>
</div>
<div>
<?=$this->html->image('cus1.JPG', ['height' => '100', 'width' => '80'])?>
</div>
</body>