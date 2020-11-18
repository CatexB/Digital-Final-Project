<?php

session_start();

// Check if the user is already logged in, if not, then redirect them to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
//    header("location: /login.php");
//    exit;
//}

require('connectdb.php');
//require ('sqlBack.php');
//
//$recipes = getAllRecipes();
//
//
//
//$cookbooks = getAllCookbooks();
//if($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $user_to_search = "";
//    $filter = "";
//    $ingredient = "";
//    if(isset($_REQUEST['user_to_search'])) {
//        $user_to_search = $_REQUEST['user_to_search'];
//    }
//    if(isset($_REQUEST['ingredient_to_search'])) {
//        $ingredient = $_REQUEST['ingredient_to_search'];
//    }
//    $recipes = filterRecipes($user_to_search, $ingredient);
//
//}
?>

<!DOCTYPE html>
<html>
<?php //echo get_head_and_navbar_html(); ?>
<head><style type="text/css">
body {
 font: 20px; 

}
</style></head>
<body>
<div class="container">
<!---->
<!--    <h1>Hi, <b>--><?php //echo htmlspecialchars($_SESSION["username"]); ?><!--</b>. Isn't this nifty?</h1>-->
<!--    <h1>Recipes</h1>-->
<!--    <form action="--><?php //$_SERVER['PHP_SELF'] ?><!--" method="post">-->
<!--        <label for="user_to_search">Find Recipe by User:</label>-->
<!--        <input type="text" value="" name="user_to_search" title="search for recipes by user" />-->
<!--        <label for="ingredient_to_search">Find Recipe by Ingredient:</label>-->
<!--        <input type="text" value="" name="ingredient_to_search" title="search for recipes by user" />-->
<!--        <input type="submit" value="Filter" name="action" class="btn btn-primary" />-->
<!---->
<!--    </form>-->
<!--    --><?php //echo get_recipe_html($recipes); ?>



<h1>Hello!</h1>


</div>
</body>
</html>

