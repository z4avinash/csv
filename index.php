<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV file</title>
</head>

<body>
    <h1 style="text-align:center">Data fetched</h1>
    <hr>


    <br><br><br>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully" . "<br><br>";
    $sql = "SELECT * FROM world.city";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        $index = 0;

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=test.csv");
        //open file into output buffer
        $fp = fopen('php://output', 'w');

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $index += 1;
            $dataLine = $index . "," . $row["CountryCode"] . "," . $row["District"] . "," . $row["Population"];
            $subData = array($dataLine);
            array_push($data, $subData);
        }

        foreach ($data as $row) {
            fputcsv($fp, $row);
        }
        //cleaning the buffer once we're done with the task
        ob_end_clean();
    } else {
        echo "0 results";
    }

    $conn->close();



    ?>



</body>

</html>