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
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?> - <?= \Cake\Core\Configure::read('PoolName', 'GRC Pool'); ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('main.css'); ?>
    <?= $this->Html->script('https://code.jquery.com/jquery-3.2.1.slim.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'); ?>
    <?= $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/"><?= \Cake\Core\Configure::read('PoolName', 'GRC Pool'); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php if (isset($user)): ?>
                    <?= $this->html->link($user['email'], '/users'); ?>&nbsp;
                    <?php if ($user['admin']): ?>
                    <?= $this->Html->link('Pool admin', '/admin', ['class' => 'btn btn-danger']); ?>&nbsp;
                    <?php endif; ?>
                    <?= $this->Html->link('Log out', '/users/logout', ['class' => 'btn btn-primary']); ?>
                <?php else: ?>
                    <?= $this->Html->link('Log in', '/users/login', ['class' => 'btn btn-primary']); ?>&nbsp;<?= $this->Html->link('Register', '/users/add', ['class' => 'btn btn-primary']); ?>
                <?php endif; ?>
            </form>
        </div>
    </nav>

    <div class="container" id="content">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

        <footer>
            <p>&copy; 2017</p>
        </footer>
    </div> <!-- /container -->
</body>
</html>
