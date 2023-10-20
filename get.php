<?php
    define("DB_HOST", $_ENV["DATABASE_SERVICE_NAME"]);
    define("DB_USERNAME", $_ENV["DATABASE_USER"]);
    define("DB_PASSWORD", $_ENV["DATABASE_PASSWORD"]);
    define("DB_DATABASE_NAME", $_ENV["DATABASE_NAME"]);

    $link = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
    if ($link->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    #$link = @mysqli_connect($_ENV["DATABASE_SERVICE_NAME"],$_ENV["DATABASE_USER"],$_ENV["DATABASE_PASSWORD"],$_ENV["DATABASE_NAME"]);
    #if (!$link) {
    #    http_response_code (500);
    #    error_log ("Error: unable to connect to database\n");
	#die();
    #}

    $query = "SELECT count(*) FROM quote";
    echo $query;
    $result = $link->query($query);
    if (!$result) {
        http_response_code (500);
        error_log ("SQL error: " . mysqli_error($link) . "\n");
	die();
    }

    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);

    $id = rand(1,$row[0]);

    $query = "SELECT msg FROM quote WHERE id = " . $id;
    $result = $link->query($query);
    if (!$result) {
        http_response_code (500);
        error_log ("SQL error: " . mysqli_error($link) . "\n");
	die();
    }

    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);

    print $row[0] . "\n";
    
    mysqli_close($link);
?>