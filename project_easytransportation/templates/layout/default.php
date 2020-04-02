    <?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

?>
<!DOCTYPE html>
<html>
<head>
<?=$this->Html->charset()?>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Easytransportation
</title>
<?=$this->Html->meta('icon')?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?=$this->Html->css('milligram.min.css')?>
    <?=$this->Html->css('cake.css')?>

<?=$this->fetch('meta')?>
    <?=$this->fetch('css')?>
    <?=$this->fetch('script')?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span></span></a>
        </div>
        <div class="top-nav-links">
            <a target="_blank" href="https://book.cakephp.org/4/"></a>
            <a target="_blank" href="https://api.cakephp.org/4/"></a>
        </div>
    </nav>
    <main class="main">
        <div class="container">
<?=$this->Flash->render()?>
            <?=$this->fetch('content')?>
</div>
    </main>
    <footer>
    </footer>
</body>
</html>
