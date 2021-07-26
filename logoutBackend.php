<?php
session_start();

unset($_SESSION['user']);

header("Location: http://localhost/bakeryManager/");
die();
