<?php
require_once('../../models/Directors.php');

function listDirectors()
{
    return Directors::getAll();
}

function getDirector($id)
{
    return Directors::getItem($id);
}

function storeDirector($name, $surname, $birthday, $nationality)
{
    return Directors::store($name, $surname, $birthday, $nationality);
}

function updateDirector($id, $name, $surname, $birthday, $nationality)
{
    return Directors::update($id, $name, $surname, $birthday, $nationality);
}

function deleteDirector($id)
{
    return Directors::delete($id);
}
