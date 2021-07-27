<?php

$word = $_POST["search"];

if ($word == "") {
    header("Location: http://localhost/bakeryManager/");
    die();
} else {
    header("Location: http://localhost/bakeryManager?search=" . $word);
    die();
}
