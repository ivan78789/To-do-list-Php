<?php

require_once __DIR__ . '/router.php';


get('/', 'views/index.php');

get('/create', 'include/create.php');
post('/create', 'include/create.php');


get('/delete', 'include/delete.php');
post('/delete', 'include/delete.php');

get('/update', 'include/update.php');
post('/update', 'include/update.php');



any('/404', 'views/404.php');