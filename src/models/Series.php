<?php
class Serie
{
    private $id;
    private $title;
    private $platform;
    private $director;
    private $actor;
    private $audio;
    private $subtitle;

    public function __construct($idSerie = null, $titleSerie = null, $platformSerie = null, $directorSerie = null, $actorSerie = null, $audioSerie = null, $subtitleSerie = null)
    {
        if ($idSerie != null) {
            $this->id = $idSerie;
        }
        if ($titleSerie != null) {
            $this->title = $titleSerie;
        }
        if ($platformSerie != null) {
            $this->platform = $platformSerie;
        }
        if ($directorSerie != null) {
            $this->director = $directorSerie;
        }
        if ($actorSerie != null) {
            $this->actor = $actorSerie;
        }
        if ($audioSerie != null) {
            $this->audio = $audioSerie;
        }
        if ($subtitleSerie != null) {
            $this->subtitle = $subtitleSerie;
        }
    }



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getPlatform()
    {
        return $this->platform;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }


    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;
    }


    public function getActor()
    {
        return $this->actor;
    }

    public function setActor($actor)
    {
        $this->actor = $actor;
    }


    public function getAudio()
    {
        return $this->audio;
    }

    public function setAudio($audio)
    {
        $this->audio = $audio;
    }


    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }


    private static function initConnectionDb()
    {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = '';
        $db_db = 'actividad_1';

        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db
        );

        if ($mysqli->connect_error) {
            die('Error: ' .
                $mysqli->connect_error);
        }

        return $mysqli;
    }

    public function getAll()
    {
        $mysqli = $this->initConnectionDb();

        $query = $mysqli->query("SELECT * FROM series");

        $listSeries = [];
        foreach ($query as $item) {
            $itemObject = new Serie($item['id'], $item['title'], $item['id_platform'], $item['id_director'], $item['id_actor'], $item['audio'], $item['subtitle']);
            array_push($listSeries, $itemObject);
        }

        $mysqli->close();

        return $listSeries;
    }

    public static function getItem($serieId)
    {
        $mysqli = Serie::initConnectionDb();

        $query = $mysqli->query("SELECT * FROM series WHERE id = $serieId");

        $serieObject = null;
        foreach ($query as $item) {
            $serieObject = new Serie($item['id'], $item['title'], $item['id_platform'], $item['id_director'], $item['id_actor'], $item['audio'], $item['subtitle']);
        }

        $mysqli->close();

        return $serieObject;
    }

    public static function store($serieTitle, $platform, $director, $actor, $audio, $subtitle)
    {
        $mysqli = Serie::initConnectionDb();

        $stmt = $mysqli->prepare("INSERT INTO series (title, id_platform, id_director, id_actor, audio, subtitle) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $serieTitle, $platform, $director, $actor, $audio, $subtitle);

        $serieCreated = false;
        if ($stmt->execute()) {
            $serieCreated = true;
        }

        $stmt->close();
        $mysqli->close();

        return $serieCreated;
    }


    public static function update($serieId, $serieTitle)
    {
        $mysqli = Serie::initConnectionDb();

        $serieUpdated = false;
        if ($mysqli->query("UPDATE series set title = '$serieTitle' where id = $serieId")) {
            $serieUpdated = true;
        }

        $mysqli->close();

        return $serieUpdated;
    }


    public static function delete($serieId)
    {
        $mysqli = Serie::initConnectionDb();

        $serieDeleted = false;

        if ($query = $mysqli->query("DELETE FROM series WHERE id = $serieId")) {
            $serieDeleted = true;
        }

        $mysqli->close();

        return $serieDeleted;
    }
}
