<?php

require('connectdb.php');
require('sqlBack.php');

$tweets = getAllTweets();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Archaeological Site and Museum Twitter Database</title>
    <style type="text/css">
        table{
            table-layout:fixed;
            width: 60%;
        }
        table tr th:nth-child(3){
            width: 100%;
        }
</style></head>
<body style="background-color:#d1fad2;">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


<h1>Tweets</h1>
<?php echo get_tweet_html($tweets); ?>



</body>
</html>




