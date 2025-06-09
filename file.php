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
    

    // print_r($arr);
    }
?>
