<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

<h1>Enter your database identifiers</h1>
<form action="mariaDB_test.php" method="POST">
  <input type="text" name="username">
  <input type="text" name="userpass">
  <input type="text" name="userdb">
  <input type="submit">
</form>
  
<?php

  if(isset($_POST['userdb']) && isset($_POST['username']) && isset($_POST['userpass'])){

    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $userdb = $_POST['userdb'];

    try{
      $DB = new PDO('mysql:dbname=' . $userdb . ';host=localhost', $username, $userpass);

      $DB->exec('CREATE TABLE `tutu` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `hello` varchar(256) DEFAULT NULL,
        PRIMARY KEY (id)
      )');

      $DB->exec('INSERT INTO tutu (hello) VALUES ("He this insert works well !")');

      $stmt = $DB->query('SELECT * FROM tutu');

      echo "DB insertion OK";
      print_r($stmt->fetchAll(PDO::FETCH_ASSOC));


    } catch(PDOexeption $e) {
      print_r($e);
    }

  } else {
    echo "You didn't fill the fields correctly !";
  }

?>

</body>
</html>
