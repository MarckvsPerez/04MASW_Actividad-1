<?php
    class Platform {
        private $id;
        private $name;

        public function __construct($idPlatform = null, $namePlatform = null)
        {
            if ($idPlatform != null) {
                $this->id = $idPlatform;
            }
            if ($namePlatform != null) {
                $this->name = $namePlatform;
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


        public function setName($name) {
            $this->name=$name;
        }

        private static function initConnectionDb() {
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

            $query = $mysqli->query("SELECT * FROM platforms");
            
            $listPlatforms = [];
            foreach($query as $item) {
                $itemObject = new Platform($item['id'], $item['name']);
                array_push($listPlatforms, $itemObject);
            }

            $mysqli->close();

            return $listPlatforms;
        }

        public static function getItem($platformId) {
            $mysqli = Platform::initConnectionDb();

            $query = $mysqli->query("SELECT * FROM platforms WHERE id = $platformId");

            $platformObject = null;
            foreach($query as $item) {
                $platformObject = new Platform($item['id'], $item['name']);
            }            

            $mysqli->close();

            return $platformObject;
        }

        public static function store($platformName) {
            $mysqli = Platform::initConnectionDb();

            $platformCreated = false;
            if($query = $mysqli->query("INSERT INTO platforms (name) VALUE ('$platformName')")) {
                $platformCreated = true;
            }

            $mysqli->close();

            return $platformCreated;

        }


        public static function update($platformId, $platformName) {
            $mysqli = Platform::initConnectionDb();

            $platformUpdated = false;
            if($mysqli->query("UPDATE platforms set name = '$platformName' where id = $platformId")) {
                $platformUpdated = true;
            }            

            $mysqli->close();

            return $platformUpdated;

        }


        public static function delete($platformId) {
            $mysqli = Platform::initConnectionDb();

            $platformDeleted = false;

            if ($query = $mysqli->query("DELETE FROM platforms WHERE id = $platformId")) {
                $platformDeleted = true;
            }   

            $mysqli->close();

            return $platformDeleted;
        }

}
?>