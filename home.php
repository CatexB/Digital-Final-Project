<?php

require('connectdb.php');
require('sqlBack.php');

$tweets = getAllTweets();
$usernames = getUniqueUsers();

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
    else if(!empty($_POST['action']) && ($_POST['action']=='Filter')) {
        $account_to_search = "";
        $begindate = null;
        $enddate = null;
        $tag_to_search = "";
        if(isset($_REQUEST['account_to_search'])) {
            $account_to_search = $_REQUEST['account_to_search'];
        }
        if(isset($_REQUEST['begindate'])) {
            $begindate = $_REQUEST['begindate'];
        }
        if(isset($_REQUEST['enddate'])) {
            $enddate = $_REQUEST['enddate'];
        }
        if(isset($_REQUEST['tag_to_search'])) {
            $tag_to_search = $_REQUEST['tag_to_search'];
        }
        $tweets = filterTweets($account_to_search, $begindate, $enddate, $tag_to_search);
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
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="account_to_search">Find Tweet by account:</label>
    <select name="account_to_search" id="account_to_search">
        <option value=""></option>
        <?php
        $lines = "";
        foreach($usernames as $user) {
            $lines .= sprintf("<option value=%s>%s</option>", $user[0], $user[0]);
        }
        echo $lines;?>
    </select>
    <label for="begindate">Begin Date:</label>
    <input type="date" id="begindate" name="begindate">
    <label for="enddate">End Date:</label>
    <input type="date" id="enddate" name="enddate">
    <label for="tag_to_search">Find Tweet by tag:</label>
    <input type="text" value="" name="tag_to_search" title="search for tweets by tag" />
    <input type="submit" value="Filter" name="action" class="btn btn-primary" />
</form>
<form method="post">
    <input type="submit" value="Export tweets to CSV" name="action" class="btn btn-primary" title="Export all tweets to csv" />
</form>
<?php echo get_tweet_html($tweets); ?>

</body>
</html>




