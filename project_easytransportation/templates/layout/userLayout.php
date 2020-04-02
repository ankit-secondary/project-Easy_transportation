<?php echo $this->Html->css('homepage.css')?>
<html>
<head>
    <title>Easytransportation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<meta charset="utf-8">
  <title></title>
<body>
<div class="navbar">
  <a href="/users/home">HOME</a>
  <a href="#about">ABOUT</a>
  <a href="#contact">CONTACT</a>
  <a href="/users/login">LOGIN</a>
  <a href="/users/register">REGISTER</a>
</div>

<div class="main">


<div id="demo" class="carousel slide" data-ride="carousel">
<?=$this->fetch('content')?>
<?=$this->Flash->render()?>

