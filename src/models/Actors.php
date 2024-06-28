<?php
class Actors
{
    private $id;
    private $name;
    private $birthday;
    private $surname;
    private $nationality;

    public function __construct($id = null, $name = null, $birthday = null, $surname = null, $nationality = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->surname = $surname;
        $this->nationality = $nationality;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getNationality()
    {
        return $this->nationality;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    private static function initConnectionDb()
    {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = '';
        $db_db = 'actividad_1';

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

        if ($mysqli->connect_error) {
            die('Error: ' . $mysqli->connect_error);
        }

        return $mysqli;
    }

    public static function getAll()
    {
        $mysqli = self::initConnectionDb();
        $query = $mysqli->query("SELECT * FROM actors");

        $listActors = [];
        while ($item = $query->fetch_assoc()) {
            $listActors[] = new self($item['id'], $item['name'], $item['birthdate'], $item['surname'], $item['nationality']);
        }

        $mysqli->close();
        return $listActors;
    }

    public static function getItem($id)
    {
        $mysqli = self::initConnectionDb();
        $query = $mysqli->query("SELECT * FROM actors WHERE id = $id");

        $actor = null;
        if ($item = $query->fetch_assoc()) {
            $actor = new self($item['id'], $item['name'], $item['birthdate'], $item['surname'], $item['nationality']);
        }

        $mysqli->close();
        return $actor;
    }

    public static function store($name, $surname, $birthday, $nationality)
    {
        $mysqli = self::initConnectionDb();
        $query = $mysqli->prepare("INSERT INTO actors (name, surname, birthdate, nationality) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $name, $surname, $birthday, $nationality);

        $result = $query->execute();

        $query->close();
        $mysqli->close();

        return $result;
    }

    public static function update($id, $name, $surname, $birthday, $nationality)
    {
        $mysqli = self::initConnectionDb();
        $query = $mysqli->prepare("UPDATE actors SET name = ?, surname = ?, birthdate = ?, nationality = ? WHERE id = ?");
        $query->bind_param("ssssi", $name, $surname, $birthday, $nationality, $id);

        $result = $query->execute();

        $query->close();
        $mysqli->close();

        return $result;
    }

    public static function hasSeries($id)
    {
        $mysqli = Actors::initConnectionDb();

        $query = $mysqli->query("SELECT COUNT(*) as series_count FROM series WHERE id_actor = $id");
        $result = $query->fetch_assoc();
        $mysqli->close();

        return $result['series_count'] > 0;
    }

    public static function delete($id)
    {
        $mysqli = self::initConnectionDb();

        if (self::hasSeries($id)) {
            return 'has_series';
        }

        $actorDeleted = false;

        if ($query = $mysqli->query("DELETE FROM actors WHERE id = $id")) {
            $platformDeleted = true;
        }

        $mysqli->close();

        return $platformDeleted;
    }
}
