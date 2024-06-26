<?php
require_once('../../models/Platform.php');


function listPlatforms()
{
    $model = new Platform();
    $platformList = $model->getAll();

    return $platformList;
}

function getPlatform($platformId)
{
    return Platform::getItem($platformId);
}

function storePlatform($platformName)
{
    return Platform::store($platformName);
}

function updatePlatform($platformId, $platformName)
{
    return Platform::update($platformId, $platformName);
}


function deletePlatform($platformId)
{
    $deleteResult = Platform::delete($platformId);

    if ($deleteResult === 'has_series') {
        return 'has_series';
    }

    return $deleteResult;
}
