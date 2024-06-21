<?php
    require_once('../../models/Platform.php');


    function listPlatforms() {
        $model = new Platform ();
        $platformList = $model->getAll();

        return $platformList;
    }

    function storePlatform($platformName) {
        return Platform::store($platformName);
    }


?>






  