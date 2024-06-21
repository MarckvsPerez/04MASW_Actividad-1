<?php
    class Language {
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



        public function getId() {
            return $this->id;
        }


        public function setId($id) {
            $this->id=$id;
        }


        public function getName() {
            return $this->name;
        }

        public function getIso() {
            return $this->isoCode;
        }


        public function setName($name) {
            $this->name=$name;
        }

        function initConnectionDb() {
            $db_host = 'localhost';
            $db_user = 'root';
            $db_password = '';
            $db_db = 'actividad_1';

            $mysqli = @new mysqli (
                $db_host,
                $db_user,
                $db_password,
                $db_db
            );

            if ($mysqli->connect_error) {
                die('Error: '.
                $mysqli->connect_error);
            }

            return $mysqli;
        }

        public function getAll() {
            $mysqli = $this-> initConnectionDb();

            $query = $mysqli->query("SELECT * FROM languages");
            
            $listLanguages = [];
            foreach($query as $item) {
                $itemObject = new Language($item['id'], $item['name'],$item['iso_code']);
                array_push($listLanguages, $itemObject);
            }

            $mysqli->close();

            return $listLanguages;
        }

        public function getById($idLanguage) {
            $mysqli = $this->initConnectionDb();
        
            $stmt = $mysqli->prepare("SELECT * FROM languages WHERE id = ?");
            $stmt->bind_param("i", $idLanguage);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
        
            $language = new Language($result['id'], $result['name'], $result['iso_code']);
        
            $stmt->close();
            $mysqli->close();
        
            return $language;
        }
        
        public function create($name, $iso_code) {
            $mysqli = $this->initConnectionDb();
        
            $stmt = $mysqli->prepare("INSERT INTO languages (name, iso_code) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $iso_code);
        
            $result = $stmt->execute();
        
            $stmt->close();
            $mysqli->close();
        
            return $result;
        }

        public function delete($idLanguage) {
            $mysqli = $this->initConnectionDb();
        
            $stmt = $mysqli->prepare("DELETE FROM languages WHERE id = ?");
            $stmt->bind_param("i", $idLanguage);
        
            $result = $stmt->execute();
        
            $stmt->close();
            $mysqli->close();
        
            return $result;
        }

        public function update($idLanguage, $name, $iso_code) {
            $mysqli = $this->initConnectionDb();
        
            $stmt = $mysqli->prepare("UPDATE languages SET name = ?, iso_code = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $iso_code, $idLanguage);
        
            $result = $stmt->execute();
        
            $stmt->close();
            $mysqli->close();
        
            return $result;
        }
}
?>