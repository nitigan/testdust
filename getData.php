<?php
    #$conn = new mysqli("localhost", "wivach", "BananaLavender14", "pm_data");
    $conn = new mysqli("10.100.2.66","root","MYKqoe97122","pm_data");
    $stmt = "SELECT * FROM pmdata ORDER BY id DESC LIMIT 20";
    $result = $conn->query($stmt);
    $resultArray = array();
    while ($row = $result->fetch_array()) {
        $resultArray[] = $row;
    }
    echo json_encode($resultArray);


?>