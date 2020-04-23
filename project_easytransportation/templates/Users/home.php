<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#h" data-slide-to="0" class="active"></li>
    <li data-target="#h" data-slide-to="1"></li>
    <li data-target="#h" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
<?=$this->Html->image('nat1.jpg')?>
<div class="carousel-caption">
        <h2>Easy Transportation</h2>
        <p>We Give you the best service</p>
      </div>
    </div>
    <div class="carousel-item">
<?=$this->Html->image('nat.jpg')?>
<div class="carousel-caption">
        <h2 style='color:black;'>Best in the World</h2>
       <b><p  style='color:black;'>Do whatever you want!</p></b>
      </div>
    </div>
    <div class="carousel-item">
<?=$this->Html->image('nat2.jpg')?>
<div class="carousel-caption">
        <h3>Stay connected</h3>
        <p>We will never let you go</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#h" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#h" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<section class='my-5' id='about'>
<div class='py-4'>
<h1 class='text-center'>About us</h1>
  </div>
  <div class='container-fluid'>
  <div class='row'>
    <div class='col-lg-6 col-md-6 col-12'>
<?=$this->Html->image('aboutimg.jpeg', ['class' => 'img-fluid aboutimg'])?>
</div>
    <div class='col-lg-6 col-md-6 col-12'>
      <h4>We are the Best</h4>
      <p class='py-3'>To say the Internet is best partner now a days will be good thought because you can do a lot of work through it staying at your home. we provide you a servie in which you do not need to go outside for booking for your important and luxrious goods and there is no need to worry about for security. we have india's best service provider for this
      So do not think to much Register now and take your service</p>
      <a href='#' class='btn btn-success btn-lg'>Know More</a>
    </div>
  </div>
</div>
</section>
<section class='my-5' id='providers'>
  <div class='py-4'>
    <h1 class='text-center'>Our Providers</h1>
  </div>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-lg-4 col-lg-4 col-12'>
        <div class="card" style="width:400px">
<?php echo $this->Html->image('com2.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">Poorvanchal Transportation</h4>
    <p class="card-text">we are working with easy transportation since 3 years and you will feel like home here and so much oportunity to earn money</p>
    <a href="#" class="btn btn-primary">See Profile</a>
  </div>
</div>
  </div>

          <div class="card" style="width:400px">
<?php echo $this->Html->image('com3.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">Jost Group</h4>
    <p class="card-text">we are very new to the transportation world and Easy transportation helped a lot to get our achievements.</p>
    <a href="#" class="btn btn-primary">See Profile</a>
  </div>
</div>

          <div class="card" style="width:400px">
<?php echo $this->Html->image('com4.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">Lakshya Trasnportation</h4>
    <p class="card-text">Getting services and giving services to the customers.Best logic for buisness developement.</p>
    <a href="#" class="btn btn-primary">See Profile</a>
  </div>
</div>

  </div>
</div>
  </div>
  </section>

  <section class='my-5'>
  <div class='py-4'>
    <h1 class='text-center'>Our Customers</h1>
  </div>
  <div class='container-fluid'>
    <div class='row'>
      <div class="col-lg-4 col-lg-4 col-12">
                  <div class="card" style="width:400px">
<?php echo $this->Html->image('girl1.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">Komal saxena</h4>
    <p class="card-text">Trust is everything in the buisness world and i got a lot here . It is great working with you</p>

  </div>
</div>
</div>
          <div class="card" style="width:400px">
<?php echo $this->Html->image('boy1.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">jackson despert</h4>
    <p class="card-text">I am getting services through easy transportation since 6 months and I think it is the best.</p>

  </div>
</div>

          <div class="card" style="width:400px">
<?php echo $this->Html->image('girl4.jpg', ['class' => 'card-img-top', 'alt' => 'card-image'])?>
<div class="card-body">
    <h4 class="card-title">sara pery</h4>
    <p class="card-text">It is the only site i can trust more. very secure and safe</p>

  </div>
</div>
</div>
</div>
</section>
<section>
  <section class='my-5' id='contact'>
  <div class='py-4'>
    <h1 class='text-center'>Contact Us</h1>
  </div>
    <div class=' w-50 m-auto ' style='background-color: #eee;'>
<?=$this->Form->create($contact, ['class' => 'form-disable']);?>
<?php
echo $this->Form->control('name', ['class'    => 'form-control']);
echo $this->Form->control('email', ['class'   => 'form-control']);
echo $this->Form->control('mobile', ['class'  => 'form-control']);
echo $this->Form->control('message', ['class' => 'form-control']);
?>
<?=$this->Form->button('submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg']);?>
<?=$this->Form->end();?>
</div>
</section>
<div class='footer'>
<footer class='p-2 bg-dark'>
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-instagram"></a>
 </footer>
</div>
<!--<script>
    $('document').ready(function(){
         $('#search').keyup(function(){
            var searchkey = $(this).val();
            searchTags( searchkey );
         });

        function searchTags( keyword ){
        var data = keyword;
        $.ajax({
                    method: 'get',
                    url : "<?php //echo $this->Url->build(['controller' => 'users', 'action' => 'search']);?>",
                    data: {keyword:data},

                    success: function( response )
                    {
                       $( '.table-content' ).html(response);
                    }
                });
        };
    });
</script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
