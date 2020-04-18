<?php
include __DIR__ . '/../src/route.php';
include __DIR__ . '/../src/whoami.php';
include __DIR__ . '/../src/s.php';
include __DIR__ . '/../src/boards.php';

use sailboats\route; // https://github.com/steampixel/simplePHPRouter
use sailboats\whoami;
use sailboats\sharedBoard;
use sailboats\boards; // https://github.com/cyberland-digital/cyberland-protocol/blob/master/protocol.md

route::add('/', function() {
  echo 'index but who am i?';
});

route::add('/boards', function() {
  $obj = new boards();
  $obj->get();
});

route::add('/whoami', function() {
  $obj = new whoami();
  $obj->get();
});

route::add('/s', function() {
  $sb = new sharedBoard();
  $sb->get($_GET['replyTo'], $_GET['num']);
});

route::add('/s', function() {
  $obj = new sharedBoard();
  $obj->post($_POST['replyTo'], $_POST['content']);
}, 'post');

route::pathNotFound(function() {
  header('HTTP/1.1 404 Not Found', TRUE, 404);
});

route::methodNotAllowed(function() {
  header('HTTP/1.1 405 Method Not Allowed', TRUE, 405);
});

route::run('/');
