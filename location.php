<?php

require('connectdb.php');
require('sqlBack.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Something horrible has happened!";
}
$location = getLocation($id);
?>

<!DOCTYPE html>
<html>
<head><style type="text/css">
body {
    font: 20px sans-serif;
}
</style></head>
<div class="container-fluid">
    <div class="navbar-header">
        <a href="/home.php">Home</a>
    </div>
</div>
<body>
<?php echo get_location_html($location); ?>

</body>
</html>
