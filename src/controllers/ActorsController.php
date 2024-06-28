<?php
require_once('../../models/Actors.php');

function listActors()
{
    return Actors::getAll();
}

function getActor($actorId)
{
    return Actors::getItem($actorId);
}

function storeActor($name, $surname, $birthday, $nationality)
{
    return Actors::store($name, $surname, $birthday, $nationality);
}

function updateActor($id, $name, $surname, $birthday, $nationality)
{
    return Actors::update($id, $name, $surname, $birthday, $nationality);
}

function deleteActor($id)
{
    $deleteResult = Actors::delete($id);

    if ($deleteResult === 'has_series') {
        return 'has_series';
    }

    return $deleteResult;
}
