<?php
class Directors
{
    private $id;
    private $name;
    private $surname;
    private $birthday;
    private $nationality;

    public function __construct($id = null, $name = null, $surname = null, $birthday = null, $nationality = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->nationality = $nationality;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getNationality()
    {
        return $this->nationality;
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

        $query = $mysqli->query("SELECT * FROM directors");

        $directorsList = [];
        while ($item = $query->fetch_assoc()) {
            $directorsList[] = new self($item['id'], $item['name'], $item['surname'], $item['birthdate'], $item['nationality']);
        }

        $mysqli->close();

        return $directorsList;
    }

    public static function getItem($id)
    {
        $mysqli = self::initConnectionDb();

        $query = $mysqli->query("SELECT * FROM directors WHERE id = $id");

        $director = null;
        if ($item = $query->fetch_assoc()) {
            $director = new self($item['id'], $item['name'], $item['surname'], $item['birthdate'], $item['nationality']);
        }

        $mysqli->close();

        return $director;
    }

    public static function store($name, $surname, $birthday, $nationality)
    {
        $mysqli = self::initConnectionDb();

        $query = $mysqli->prepare("INSERT INTO directors (name, surname, birthdate, nationality) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $name, $surname, $birthday, $nationality);

        $result = $query->execute();

        $query->close();
        $mysqli->close();

        return $result;
    }

    public static function update($id, $name, $surname, $birthday, $nationality)
    {
        $mysqli = self::initConnectionDb();

        $query = $mysqli->prepare("UPDATE directors SET name = ?, surname = ?, birthdate = ?, nationality = ? WHERE id = ?");
        $query->bind_param("ssssi", $name, $surname, $birthday, $nationality, $id);

        $result = $query->execute();

        $query->close();
        $mysqli->close();

        return $result;
    }

    public static function hasSeries($id)
    {
        $mysqli = Directors::initConnectionDb();

        $query = $mysqli->query("SELECT COUNT(*) as series_count FROM series WHERE id_director = $id");
        $result = $query->fetch_assoc();
        $mysqli->close();

        return $result['series_count'] > 0;
    }

    public static function delete($id)
    {
        $mysqli = Directors::initConnectionDb();

        if (self::hasSeries($id)) {
            return 'has_series';
        }

        $directorDeleted = false;

        if ($query = $mysqli->query("DELETE FROM platforms WHERE id = $id")) {
            $directorDeleted = true;
        }

        $mysqli->close();

        return $directorDeleted;
    }
}
