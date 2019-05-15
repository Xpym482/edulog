<?php

    include('../config.php');
    include('../../util/dateTime.php');

    class Database {

        // Database variables
        private $db = null;

        public function __construct() {

            // init SQLite3
            $this->db = new SQLite3($edulog_root . 'database.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        }

        public function query($args) {
            $this->db->exec('BEGIN');
            $this->db->query($args);
            $this->db->exec('COMMIT');
        }

        private function close()
    	{
    		$this->db->close();
    	}


        // Executes queries that create tables and create activities.
        // Use with caution.
        public function reset_structure() {

            $this->setup_tables();
            $this->setup_activities();

        }

        private function setup_tables() {
            // setup structure
            $this->query('CREATE TABLE IF NOT EXISTS "users" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "email" TEXT NOT NULL,
                "password" TEXT NOT NULL,
                "locale" TEXT NOT NULL,
                "created_at" DATETIME,
                "deleted_at" DATETIME
            )');
            //
            $this->query('CREATE TABLE IF NOT EXISTS "activities" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "type" TEXT NOT NULL,
                "slug" TEXT NOT NULL,
                "name_et" TEXT NOT NULL,
                "name_en" TEXT NOT NULL,
                "created_at" DATETIME,
                "deleted_at" DATETIME
            )');

            $this->query('CREATE TABLE IF NOT EXISTS "lessons" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "user" INTEGER NOT NULL,
                "started_at" DATETIME,
                "ended_at" DATETIME
            )');

            // activity references table.activities' id
            $this->query('CREATE TABLE IF NOT EXISTS "logs" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "lesson" INTEGER NOT NULL,
                "activity" INTEGER NOT NULL,
                "started_at" DATETIME NOT NULL,
                "ended_at" DATETIME
            )');
        }

        private function setup_activities() {

            // get activities from data
            require(dirname(__DIR__) . '/db/activities.php');

            // prepare queries
            $this->db->exec('BEGIN');

            // loop default activities and add to db
            foreach ($activities as $type => $array) {

                foreach ($array as $value) {

                    $statement = $this->db->prepare('INSERT INTO "activities" (
                        "type", "name_et", "name_en", "created_at", "slug"
                    ) VALUES (:type, :name_et, :name_en, :created_at, :slug)');

                    $statement->bindValue(':type', $type);
                    $statement->bindValue(':slug', $value['slug']);
                    $statement->bindValue(':name_et', $value['et']);
                    $statement->bindValue(':name_en', $value['en']);
                    $statement->bindValue(':created_at', dateUTC('Y-m-d H:i:s'));
                    $statement->execute();
                }

            }

            // commit queries
            $this->db->exec('COMMIT');

        }





    }


?>
