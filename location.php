<?php

require('connectdb.php');
require('sqlBack.php');


if (isset($_GET['location'])) {
    $id = $_GET['location'];
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
        <a class="navbar-brand" href="home.php">Digital</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="/home.php">Home</a></li>
    </ul>
</div>
<body>
<?php echo get_location_html($location); ?>

</body>
</html>
