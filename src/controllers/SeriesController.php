<?php
    require_once('../../models/Series.php');


    function listSeries() {
        $model = new Serie ();
        $serieList = $model->getAll();

        return $serieList;
    }

    function getSerie($serieId) {
        return Serie::getItem($serieId);
    }

    function storeSerie($serieTitle, $platform, $director, $actor, $audio, $subtitle) {
        return Serie::store($serieTitle, $platform, $director, $actor, $audio, $subtitle);
    }

    function updateSerie($serieId, $serieTitle, $platform, $director, $actor, $audio, $subtitle) {
        return Serie::update($serieId, $serieTitle, $platform, $director, $actor, $audio, $subtitle);
    }

    function deleteSerie($serieId) {
        return Serie::delete($serieId);
    }


?>






  