
<!DOCTYPE html>
<html>
<body>

<?php
require ('connection.php');
	$test = sanitize_input("p\qople\\");
	$sql = 'SELECT * FROM `house` WHERE `user`="' . $test . '";';
	echo($sql);

	function sanitize_input($data, $trim = TRUE){
        global $conn;
        if($trim === TRUE){
            $data = trim($data);
        }
        $data = htmlentities($data, ENT_QUOTES);
        $data = $conn->real_escape_string($data);
        return $data;
    }

?>

</body>
</html>
