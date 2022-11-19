<?php
// error_reporting(E_ALL);
// ini_set("display_errors","On");

require_once '../Models/Database.php';
require_once '../Models/Event.php';

$db = new Database();

if(isset($_GET['fetch'])){
    $db = $db->connect();
    $FetchEvents = Event::getEvents($db);
    echo $FetchEvents;
}

if(isset($_POST['insert'])){
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $event = new Event($title,$start,$end,$db);
    $event->addEvent();
}
elseif(isset($_POST['update'])){
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];

    $event = new Event($title,$start,$end,$db);
    $event->updateEvent($id);
}
elseif(isset($_POST['delete'])){
    $id = $_POST['id'];
    $db = $db->connect();
    Event::deleteEvent($db,$id);
}

 ?>
