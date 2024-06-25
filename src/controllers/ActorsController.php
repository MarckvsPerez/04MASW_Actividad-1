<?php
    require_once('../../models/Actors.php');


    function listActors() {
        $model = new Actors ();
        $listActors = $model->getAll();

        return $listActors;
    }

    function getPlatform($platformId) {
        return Platform::getItem($platformId);
    }

    function storeActors($nameActors, $surnameActor, $birthdayActor, $nationalityActor) {
        return Actors::storeActors($nameActors, $surnameActor, $birthdayActor, $nationalityActor);
    }

    function updatePlatform($platformId, $platformName) {
        return Platform::update($platformId, $platformName);
    }

    function deletePlatform($platformId) {
        return Platform::delete($platformId);
    }



?>