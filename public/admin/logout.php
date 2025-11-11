<?php
require __DIR__ . '/../../app/bootstrap.php';
admin_logout();
header('Location: /admin/login.php');
exit;
