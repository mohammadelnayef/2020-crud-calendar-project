<?php

class Event{
    private $title;
    private $start;
    private $end;
    private $conn;

    public function __construct($title,$start,$end,$db){
        $this->conn = $db->connect();
        $this->title = $title;
        $this->start = $start;
        $this->end = $end;
    }

    public static function getEvents($pdo){
        $sql = "SELECT * FROM events ORDER BY id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach($result as $row){
            $data[] = [
                    "id" => $row->id,
                    "title" => $row->title,
                    "start" => $row->start_event,
                    "end" => $row->end_event
            ];
        }
        return json_encode($data);
    }

    public function addEvent(){
        $sql = "INSERT INTO events (title,start_event,end_event) VALUES (:title,:start_event,:end_event)";
        $stmt = $this->conn->prepare($sql);
        $newEvent = [
            "title" => $this->title,
            "start_event" => $this->start,
            "end_event" => $this->end,
        ];
        $stmt->execute($newEvent);
    }

    public function updateEvent($id){
        $sql= "UPDATE events SET title=:title,start_event=:start_event,end_event=:end_event WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $updateEvent = [
            'title' => $this->title,
            'start_event' => $this->start,
            'end_event' => $this->end,
            'id' => $id
        ];
        $stmt->execute($updateEvent);
    }

    public static function deleteEvent($pdo,$id){
        $sql = "DELETE FROM events WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);
    }
}

 ?>
