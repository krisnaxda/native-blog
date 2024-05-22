<?php 
class Post {
    private $conn;
    private $table_name = "posts";
    private $tableadmin = "admin";

    public $id;
    public $admin_id;
    public $title;
    public $content;
    public $date;

    public $username;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (admin_id, title, content, date) VALUES (:admin_id, :title, :content, :date)";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->date = date('Y-m-d H:i:s');

        $stmt->bindParam(':admin_id', $this->admin_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':date', $this->date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete(){
        $query = "DELETE FROM posts WHERE id = :id AND admin_id = :admin_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':admin_id', $this->admin_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function showone(){
        $query = "SELECT * FROM $this->table_name WHERE id = :id AND admin_id = :admin_id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':admin_id', $this->admin_id, PDO::PARAM_INT);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($row) {
            $this->title = $row['title'];
            $this->content = $row['content'];
            return true;
        }

        return false;

    }

    public function show(){
        $query = "SELECT posts.id, posts.admin_id, posts.title, posts.content,posts.date, admin.username FROM $this->table_name INNER JOIN $this->tableadmin WHERE posts.id = :id AND posts.admin_id = admin.id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($row) {
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->date = $row['date'];
            $this->username = $row['username'];
            return true;
        }

        return false;

    }

    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content WHERE id = :id AND admin_id = :admin_id";
            $stmt = $this->conn->prepare($query);

            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->content = htmlspecialchars(strip_tags($this->content));

            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':admin_id', $this->admin_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return false;
        }
    }
}