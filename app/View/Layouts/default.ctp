
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->
    <title>Starter Template for Bootstrap</title>
	<?= $this->Html->css('bootstrap'); ?>
	<?= $this->Html->css('bootstrap-theme'); ?>
	<?= $this->fetch('css'); ?>
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?= $this->fetch('title'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
			<li><?= $this->Form->create('searches', array(
				'url' => '/search'
				)); ?>
				<?= $this->Form->input('keywords'); ?>
			<?= $this->Form->end('Search'); ?></li>
			<?php if(AuthComponent::user()): ?>
			<li><?= $this->Html->link('logout', array('controller' => 'users', 'action' => 'logout')) ?></li>
			<?php else: ?>
			<li><?= $this->Html->link('subscribe', array('controller' => 'users', 'action' => 'subscribe')) ?></li>
			<li><?= $this->Html->link('login', array('controller' => 'users', 'action' => 'login')) ?></li>
			<?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
	<div class="row">
		<div class="span8"><?= $this->fetch('content'); ?></div>
		<div class="span4"><?= $this->fetch('sidebar'); ?></div>
    </div>
	</div>

    <?= $this->Html->script("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"); ?>
	<?= $this->Html->script("bootstrap"); ?>
	<?= $this->fetch('script'); ?>
  </body>
</html>
