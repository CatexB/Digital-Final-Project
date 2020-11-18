<?php

require('connectdb.php');
require('sqlBack.php');

$tweets = getAllTweets();
?>

<!DOCTYPE html>
<html>
<head><style type="text/css">
        body {
            font: 20px;
            background-image: url('https://img.freepik.com/free-photo/blue-square-tiled-texture-background_53876-63563.jpg?size=626&ext=jpg');

        }
    </style></head>
<body>
<h1>Tweets</h1>
<?php echo get_tweet_html($tweets); ?>

</body>
</html>


