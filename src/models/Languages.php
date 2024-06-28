<?php
class Language
{
    private $id;
    private $name;
    private $isoCode;

    public function __construct($idLanguage = null, $nameLanguage = null, $isoCodeLanguage = null)
    {
        if ($idLanguage != null) {
            $this->id = $idLanguage;
        }
        if ($nameLanguage != null) {
            $this->name = $nameLanguage;
        }
        if ($isoCodeLanguage != null) {
            $this->isoCode = $isoCodeLanguage;
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


    public function getName()
    {
        return $this->name;
    }

    public function getIso()
    {
        return $this->isoCode;
    }


    public function setName($name)
    {
        $this->name = $name;
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

        $mysqli = self::initConnectionDb();
        $query = $mysqli->query("SELECT * FROM languages");

        $listLanguages = [];
        while ($item = $query->fetch_assoc()) {
            $listLanguages[] = new self($item['id'], $item['name'], $item['iso_code']);
        }

        $mysqli->close();
        return $listLanguages;
    }

    public static function getItem($id)
    {
        $mysqli = Language::initConnectionDb();

        $query = $mysqli->query("SELECT * FROM languages WHERE id = $id");

        $languageObject = null;
        foreach ($query as $item) {
            $languageObject = new Language($item['id'], $item['name'], $item['iso_code']);
        }

        $mysqli->close();

        return $languageObject;
    }

    public function create($name, $iso_code)
    {
        $mysqli = $this->initConnectionDb();

        $stmt = $mysqli->prepare("INSERT INTO languages (name, iso_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $iso_code);

        $result = $stmt->execute();

        $stmt->close();
        $mysqli->close();

        return $result;
    }

    public static function hasSeries($id)
    {
        $mysqli = self::initConnectionDb();

        $stmt = $mysqli->prepare("SELECT COUNT(*) as series_count FROM series WHERE audio = ? OR subtitle = ?");
        $stmt->bind_param("ii", $id, $id);

        $stmt->execute();

        $stmt->bind_result($series_count);
        $stmt->fetch();

        $stmt->close();
        $mysqli->close();

        return $series_count > 0;
    }

    public static function delete($idLanguage)
    {
        $mysqli = Language::initConnectionDb();

        if (self::hasSeries($idLanguage)) {
            return 'has_series';
        }

        $platformDeleted = false;

        if ($query = $mysqli->query("DELETE FROM languages WHERE id = $idLanguage")) {
            $platformDeleted = true;
        }

        $mysqli->close();

        return $platformDeleted;
    }

    public function update($idLanguage, $name, $iso_code)
    {
        $mysqli = $this->initConnectionDb();

        $stmt = $mysqli->prepare("UPDATE languages SET name = ?, iso_code = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $iso_code, $idLanguage);

        $result = $stmt->execute();

        $stmt->close();
        $mysqli->close();

        return $result;
    }
}
