<?php
class Actors
{
    private $idActors;
    private $nameActors;
    private $birthdayActor;
    private $surnameActor;
    private $nationalityActor;

    public function __construct($idActors = null, $nameActors = null, $birthdayActor = null, $surnameActor = null, $nationalityActor = null)
    {
        $this->idActors = $idActors;
        $this->nameActors = $nameActors;
        $this->birthdayActor = $birthdayActor;
        $this->surnameActor = $surnameActor;
        $this->nationalityActor = $nationalityActor;
    }



    public function getIdActors() { return $this->idActors; }
    public function getNameActors() { return $this->nameActors; }
    public function getBirthdayActor() { return $this->birthdayActor; }
    public function getSurnameActor() { return $this->surnameActor; }
    public function getNationalityActor() { return $this->nationalityActor; }


    public function setIdActors($idActors)
    {
        $this->idActors = $idActors;
    }

    public function setName($nameActors)
    {
        $this->nameActors = $nameActors;
    }

    public function setSurName($surnameActor)
    {
        $this->surnameActor = $surnameActor;
    }

    public function setBirthdayActor($birthdayActor)
    {
        $this->birthdayActor = $birthdayActor;
    }


    public function setNationalityActor($nationalityActor)
    {
        $this->nationalityActor = $nationalityActor;
    }


    public static function initConnectionDb()
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
        $mysqli = self::initConnectionDb();
        $query = $mysqli->query("SELECT * FROM actors");

        $listActors = [];
        foreach ($query as $item) {
            $actor = new Actors($item['id'], $item['name'], $item['birthdate'], $item['surname'], $item['nationality']);
            array_push($listActors, $actor);
        }

        $mysqli->close();
        return $listActors;
    }



    public static function getItem($idActors)
    {
        $mysqli = self::initConnectionDb();
    
        $query = $mysqli->query("SELECT * FROM actors WHERE id = $idActors");
    
        $actorsObject = null;
        foreach ($query as $item) {
            $actorsObject = new Actors($item['id'], $item['name'], $item['birthdate'], $item['surname'], $item['nationality']);
        }
    
        $mysqli->close();
    
        return $actorsObject;
    }

    public static function storeActors($nameActors, $surnameActor, $birthdayActor, $nationalityActor)
    {
        $mysqli = self::initConnectionDb();
    
        $actorsCreated = false;
    
        $query = $mysqli->prepare("INSERT INTO actors (name, surname, birthdate, nationality) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $nameActors, $surnameActor, $birthdayActor, $nationalityActor);
    
        if ($query->execute()) {
            $actorsCreated = true;
        }
    
        $query->close();
        $mysqli->close();
    
        return $actorsCreated;
    }


    public static function update($platformId, $platformName)
    {
        $mysqli = Platform::initConnectionDb();

        $platformUpdated = false;
        if ($mysqli->query("UPDATE platforms set name = '$platformName' where id = $platformId")) {
            $platformUpdated = true;
        }

        $mysqli->close();

        return $platformUpdated;
    }


    public static function delete($platformId)
    {
        $mysqli = Platform::initConnectionDb();

        $platformDeleted = false;

        if ($query = $mysqli->query("DELETE FROM platforms WHERE id = $platformId")) {
            $platformDeleted = true;
        }

        $mysqli->close();

        return $platformDeleted;
    }
}
