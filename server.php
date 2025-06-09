<?php

    include "./db.php";
    $conn=$db->connection();

    class Delete extends Database{
        
        function __construct(){
            $this->conn=$this->connection();
        }
        function delete($playerId){
            $stmt = $this->conn->prepare("DELETE FROM players WHERE player_id = ?");
            $stmt->execute([$playerId]);
        }
        function all(){
            $stmt=$this->conn->query("select * from players");    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    $object=new Delete();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['action']) && $_POST['action']=='delete'){
        // echo "1";
        if (isset($_POST['playerid'])) {
            $id = $_POST['playerid'];
            $object->delete($id);
            echo json_encode($object->all());
            exit;
    }
    // echo $arrdata;
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['action']) && $_POST['action']=='update'){
    
         if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $player_name = $_POST['player_name'];
        $age = $_POST['age'];
        $team_name = $_POST['team_name'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE players SET player_name=?, age=?, team_name=?, role=? WHERE player_id=?");
        $stmt->execute([$player_name, $age, $team_name, $role, $id]);

        $stmt = $conn->query("SELECT * FROM players");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }
}
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['action']) && $_POST['action']=='create'){
     if (isset($_POST['create'])) {
        $player_name = $_POST['player_name'];
        $age = $_POST['age'];
        $team_name = $_POST['team_name'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("INSERT INTO players (player_name, age, team_name, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$player_name, $age, $team_name, $role]);

        $stmt = $conn->query("SELECT * FROM players");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }
}   else{
        $stmt=$conn->prepare("select * from players");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
}
    
?>