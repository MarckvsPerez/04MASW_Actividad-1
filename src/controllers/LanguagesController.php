<?php
require_once('../../models/Languages.php');


function listLanguages()
{
    $model = new Language();
    $languageList = $model->getAll();

    return $languageList;
}

function getLanguage($id)
{
    return Language::getItem($id);
}


function createLanguage($name, $iso_code)
{
    $model = new Language();
    return $model->create($name, $iso_code);
}

function updateLanguage($idLanguage, $name, $iso_code)
{
    $model = new Language();
    return $model->update($idLanguage, $name, $iso_code);
}

function deleteLanguage($id)
{
    $deleteResult = Language::delete($id);

    if ($deleteResult === 'has_series') {
        return 'has_series';
    }

    return $deleteResult;
}
