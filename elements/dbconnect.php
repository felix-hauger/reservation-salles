<?php

$connect = new DbConnection('mysql', 'reservationsalles', 'localhost', 'root', '');

$pdo = $connect->pdo();