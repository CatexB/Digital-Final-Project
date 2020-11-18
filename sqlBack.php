<?php


function getAllTweets()
{
    global $db;
    $query = "SELECT * FROM tweets_final";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); //returns an array of rows
    $statement->closeCursor();
    return $results;
}

function get_tweet_html($tweets)
{
    $res = '<table style ="width:100%" border="1">';
    $res .= '<col style="width:10%">';
    $res .= '<col style="width:15%">';
    $res .= '<col style="width:40%">';
    $res .= '<col style="width:7%">';
    $res .= '<col style="width:7%">';
    $res .= '<col style="width:16%">';
    $res .= '<col style="width:25%">';

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

?>