<html>
<head>
    <meta charset="UTF-8">
    <title>Risultati</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
echo "<h1>Risultati per:<br> " . $_GET["word"] . "</h1>"
?>
<img src="file/icons8-back-96.png" id="back" onclick="history.back()">
<div id="search">
<?php
$conn = new mysqli("localhost", "root", "root", "test_db");

if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT WORD, DEFINITION FROM Dizionario WHERE WORD LIKE '" . $_GET["word"] . "%' ORDER BY WORD";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if($result->num_rows > 9){
        for($i = 0; $i<10; $i++) {
            $row = $result->fetch_assoc();
            echo "<p><b>" . $row["WORD"]. ": </b>" . $row["DEFINITION"]. "</p>" . "<br>";
        }
    }
    else{
        while ($row = $result->fetch_assoc()){
            echo "<p><b>" . $row["WORD"]. ": </b>" . $row["DEFINITION"]. "</p>" . "<br>";
        }
    }
} else {
    echo "<h2 style='text-align: center'>No Results</h2>";
}
$conn->close();
?></div>
</body>
</html>