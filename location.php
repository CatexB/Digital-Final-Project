<?php

session_start();

// Check if the user is already logged in, if not, then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("location: /login.php");
    exit;
}

require_once('connectdb.php');
require_once('sqlBack.php');

$session_username = htmlspecialchars($_SESSION["username"]);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cookbook_info = get_cookbook_information($id);
} else {
    echo "Something horrible has happened!";
}
$recipes = find_cookbook_recipes($id);
global $db;
$query = "SELECT * FROM Cookbook WHERE cookbook_id = :id";
$statement = $db->prepare($query);
$statement->bindValue(":id", $id);
$statement->execute();
$results = $statement->fetch();
$statement->closeCursor();

$cookbook_name = $results['name'];
$cookbook_style = $results['cooking_style'];
$cookbook_username = $results['username'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['action']) && ($_POST['action'] == 'Delete')) {
        echo($_POST['cookbook_to_delete']);
        delete_cookbook($_POST['cookbook_to_delete']);
    }
}

?>

<!DOCTYPE html>
<html>
<?php echo get_head_and_navbar_html(); ?>
<head><style type="text/css">
body {
    font: 20px sans-serif;
background-image: url('https://img.freepik.com/free-photo/blue-square-tiled-texture-background_53876-63563.jpg?size=626&ext=jpg');
}
</style></head>
<body>
<div class="container">

    <h1>Recipes in Cookbook</h1>
    <?php echo get_recipe_html_cookbook($recipes); ?>
<!--    --><?php
//    if($cookbook_username === $session_username) {
//    }
//    ?>

</body>

</div>

</body>
</html>
