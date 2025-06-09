<?php 
include 'db.php'; 
$conn = $db->connection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Player Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4 text-center">🏏 Player Manager</h2>

    <?php
    $editMode = false;
    $player_name = $age = $team_name = $role = "";

    $crl = curl_init();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['update'])) {
            $_POST['action'] = 'update';
            $_POST['playerid'] = $_POST['id'];
        } elseif (isset($_POST['delete'])) {
            $_POST['action'] = 'delete';
            $_POST['playerid'] = $_POST['id'];
        } else {
            $_POST['action'] = 'create';
        }

        $url = "http://localhost/object/server.php";
        $temp = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $_POST
        );
        
        curl_setopt_array($crl, $temp);
        $response = curl_exec($crl);
        $arra=json_decode($response,true);
        // print_r($arra);
    } 
    else{
        $url = "http://localhost/object/server.php";
        curl_setopt_array($crl,array(
                CURLOPT_URL=>$url,
                CURLOPT_RETURNTRANSFER=>true
        ));
        $response=curl_exec($crl);
        $arra=json_decode($response,true);
    }  
    if (isset($_GET['edit'])) {
        $editMode = true;
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM players WHERE player_id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $player_name = $row['player_name'];
            $age = $row['age'];
            $team_name = $row['team_name'];
            $role = $row['role'];
        }
    }
    ?>

    <form method="POST" class="mb-4">
        <input type="hidden" name="id" value="<?= $editMode ? htmlspecialchars($id) : '' ?>">
        <div class="mb-3">
            <input type="text" name="player_name" value="<?= htmlspecialchars($player_name) ?>" placeholder="Player Name" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" placeholder="Age" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="team_name" value="<?= htmlspecialchars($team_name) ?>" placeholder="Team Name" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="role" value="<?= htmlspecialchars($role) ?>" placeholder="Role (e.g. Batsman)" class="form-control" required>
        </div>
        <button type="submit" name="<?= $editMode ? 'update' : 'create' ?>" class="btn btn-success">
            <?= $editMode ? 'Update Player' : 'Add Player' ?>
        </button>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Team</th>
                <th>Role</th>   
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // $stmt = $conn->query("SELECT * FROM players");
        // while ($arra) {
        if(!empty($arra) && is_array($arra)){
            foreach($arra as $row){
        
            echo "<tr>
                <td>" . htmlspecialchars($row['player_id']) . "</td>
                <td>" . htmlspecialchars($row['player_name']) . "</td>
                <td>" . htmlspecialchars($row['age']) . "</td>
                <td>" . htmlspecialchars($row['team_name']) . "</td>
                <td>" . htmlspecialchars($row['role']) . "</td>
                <td>
                    <a href='?edit=" . $row['player_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row['player_id'] . "'>
                        <button type='submit' name='delete' class='btn btn-sm btn-danger' onclick='return confirm(\"Delete this player?\")'>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>";
        }
    }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
