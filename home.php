<?php

require('connectdb.php');
require('sqlBack.php');

$tweets = getAllTweets();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['action']) && ($_POST['action']=='Export tweets to CSV')) {
        $fp = fopen('php://output', 'wb');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=tweets.csv');
        fputcsv($fp, array('Twitter Account','Date Tweeted','Tweet Text','Retweet Count','Favorite Count','Hashtags','URLS'));
        foreach($tweets as $row)
        {
            fputcsv($fp, array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]));
        }
        fclose($fp);
    }

}
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
<h5>Filters</h5>
<form method="post">
    <input type="submit" value="Export tweets to CSV" name="action" class="btn btn-primary" title="Export all tweets to csv" />
</form>
<?php echo get_tweet_html($tweets); ?>

</body>
</html>




