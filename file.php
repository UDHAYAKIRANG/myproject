<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="csv" accept=".csv">
        <br>
        <label for="">submit</label>
        <input type="submit" name="submit">
    </form>
</body>
</html>
<?php
    include "./db.php";
    $conn=$db->connection();
    
    if(isset($_POST['submit'])){
        
    $file=$_FILES['csv']['tmp_name'];
    $arr=fopen($file,'r');
 
    $data=[];
    while(($row=fgetcsv($arr))!==false){
        $playername=$row[0];
        $Age=$row[1];
        $TeamName=$row[2];
        $Role=$row[3];
        $data[]=[
            'playername'=>$playername,
            'Age'=>$Age,
            'Teamname'=>$TeamName,
            'Role'=>$Role
        ];
    }
    

    // print_r($data);
    foreach ($data as $data1) {
        $stmt = $conn->prepare("INSERT INTO players(player_name, age, team_name, role) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $data1['playername']);
        $stmt->bindParam(2, $data1['Age']);
        $stmt->bindParam(3, $data1['Teamname']);
        $stmt->bindParam(4, $data1['Role']);
        $stmt->execute();
    }
}
    $stmt=$conn->query("select * from players");
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1">
    <?php 
        foreach($data as $data1){
            echo "<tr>";
            foreach($data1 as $data2){
    ?>
        <td>
                <?php echo $data2; ?>
        </td>

    <?php } echo "</tr>"; } ?>
</table>