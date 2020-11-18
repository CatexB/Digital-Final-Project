<?php
    require('connectdb.php');
    require ('sqlBack.php');
    $username = $_POST['username'];
    $which = $_POST['which'];

    switch ($which) {
        case 1:
            $recipes = getUserRecipes($username);
            break;
        case 2:
            $recipes = getFavoritedRecipes($username);
            break;
        case 0:
            $recipes = getAllRecipes();
    }

    $fp = fopen('php://output', 'wb');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=recipes.csv');
    fputcsv($fp, array('Name','Servings','Description','Cuisine','Instructions','Prep Time','Cook Time'));
    foreach($recipes as $row)
    {
        fputcsv($fp, array($row['name'],$row['serving_size'],$row['description'],$row['cuisine'],$row['instructions'],$row['prep_time'],$row['cook_time']));
    }
    fclose($fp);
?>