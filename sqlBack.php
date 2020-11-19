<?php


function getAllTweets()
{
    global $db;
    $query = "SELECT * FROM tweets_v2";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); //returns an array of rows
    $statement->closeCursor();
    return $results;
}

function getUniqueUsers()
{
    global $db;
    $query = "SELECT twitter_acct FROM locations";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); //returns an array of rows
    $statement->closeCursor();
    return $results;
}

function getLocation($location)
{
    global $db;
    $query = "SELECT * FROM locations WHERE twitter_acct=:location";
    $statement = $db->prepare($query);
    $statement->bindValue(":location", $location);
    $statement->execute();
    $results = $statement->fetchAll(); //returns an array of rows
    $statement->closeCursor();
    return $results;
}

function filterTweets($account_to_search, $begindate, $enddate, $tag_to_search) {
    if($account_to_search == "" && $begindate == null && $enddate == null && $tag_to_search == "") {
        return getAllTweets();
    }
    global $db;
    $queries = array();
    $query = "SELECT * FROM tweets_v2 WHERE ";
    if($account_to_search != "") {
        array_push($queries," twitter_acct=:account_to_search");
    }
    if($begindate != null) {
        array_push($queries," date >= :begin");
    }
    if($enddate != null) {
        array_push($queries," date <= :end");
    }
    if ($tag_to_search != ""){
        array_push($queries,(" tags LIKE ").("'%").$tag_to_search.("%'"));
    }
    $i = 0;
    foreach($queries as $q) {
        if($i == 0) {
            $query .= $q;
            $i = 1;
        }
        else {
            $query .= " AND ";
            $query .= $q;
        }
    }
    $statement = $db->prepare($query);
    if($account_to_search != "") {
        $statement->bindValue(":account_to_search", $account_to_search);
    }
    if($begindate != null) {
        $statement->bindValue(":begin", $begindate);
    }
    if($enddate != null) {
        $statement->bindValue(":end", $enddate);
    }

    $statement->execute();
    $results = $statement->fetchAll(); //returns an array of rows
    $statement->closeCursor();
    return $results;
}


function get_tweet_html($tweets)
{
    $res = '<table style ="width:100%" border="1">';
    $res .= '<col style="width:10%">';
    $res .= '<col style="width:7%">';
    $res .= '<col style="width:40%">';
    $res .= '<col style="width:7%">';
    $res .= '<col style="width:7%">';
    $res .= '<col style="width:10%">';
    $res .= '<col style="width:35%">';

    if (empty($tweets)) {
        return "<h1>No Tweets to display!</h1>";
    } else {
            $res .= "<tr>";
            $res .= "<td><h5>Location</h5></td>";
            $res .= "<td><h5>Date Tweeted</h5></td>";
            $res .= "<td><h5>Text of Tweet</h5></td>";
            $res .= "<td><h5>No. Retweets</h5></td>";
            $res .= "<td><h5>No. Favorites</h5></td>";
            $res .= "<td><h5>Hashtags</h5></td>";
            $res .= "<td><h5>Links</h5></td>";
        $res .= "</tr>";
        foreach ($tweets as $item) {
            $res .= "<tr>";
            $res .= sprintf("<td><a href=/location.php/?id=%s>%s</a></td>", $item[0],$item[0]);
            $res .= sprintf("<td>%s</a></td>", $item[1]);
            $res .= sprintf("<td>%s</a></td>", $item[2]);
            $res .= sprintf("<td>%s</a></td>", $item[3]);
            $res .= sprintf("<td>%s</a></td>", $item[4]);
            $res .= sprintf("<td>%s</a></td>", $item[5]);
            $res .= sprintf("<td>%s</a></td>", $item[6]);
            $res .= "</tr>";
        }
    }
    $res .= '</table>';
    return $res;
}

function get_location_html($location)
{

    $res = "";
    $res .= sprintf("<h1>%s</h1>", $location[1]);
    $res .= sprintf("<li>%s</li>", $location[2]);
    $res .= sprintf("<li>%s</li>", $location[3]);
    $res .= sprintf("<li>%s</li>", $location[4]);
    return $res;
}

?>
