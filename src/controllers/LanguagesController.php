<?php
    require_once('../../models/Languages.php');


    function listLanguages() {
        $model = new Language ();
        $languageList = $model->getAll();

        return $languageList;
    }

    function getLanguageData($idLanguage) {
        $model = new Language();
        return $model->getById($idLanguage);
    }

    
    function createLanguage($name, $iso_code) {
        $model = new Language();
        return $model->create($name, $iso_code);
    }

    function updateLanguage($idLanguage, $name, $iso_code) {
        $model = new Language();
        return $model->update($idLanguage, $name, $iso_code);
    }

    function deleteLanguage($idLanguage) {
        $model = new Language();
        return $model->delete($idLanguage);
    }
?>






  