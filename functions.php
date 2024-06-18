<?php

require_once './database.php';

class Note {

    private $db;

    public function __construct()
    {
        $this->db = Database::getInctance();
    }

    public function index() {
    
        $sql = 'SELECT * FROM  notes';
    
        $stmt = $this->db->query($sql);
    
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $notes;
    }

    public function getNote($id) {

        $sql = "SELECT * FROM notes WHERE id = :id";

        $stmt = $this->db->query($sql, ['id' => $id]);

        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        return $note;
    }
    
    public function createNote($title, $content) {
    
        $sql = "INSERT INTO notes (title, content) VALUES (:title, :content)";

        $params = [

            'title' => $title,

            'content' => $content,
        ];

        $this->db->query($sql, $params); 
    }
    
    public function updateNote($id, $title, $content) {

        $sql = 'UPDATE notes SET title = :title, content = :content WHERE id = :id';

        $params = [

            'id' => $id,

            'title' => $title,

            'content' => $content,
        ];

        $this->db->query($sql, $params);
    }
    
    public function deleteNote($id) {

            $sql = 'DELETE FROM notes WHERE id = :id';

            $params = [

                'id' => $id,
            ];

            $this->db->query($sql, $params);
        }
}