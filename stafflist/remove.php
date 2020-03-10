<?php
include("wp-config.php");

$usertable=$table_prefix."users";
$commentable=$table_prefix."comments";
$usermeta=$table_prefix."usermeta";
$postable=$table_prefix."posts";
$linktable=$table_prefix."links";

$db_handler=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
or die("MySQL database '".DB_NAME."' not accessible.");

mysql_select_db(DB_NAME, $db_handler)
or die("Enable to select ".DB_NAME." database
\n");

$query1="DELETE FROM $usertable 
         WHERE ID = 1 
         AND ID NOT IN (SELECT DISTINCT post_author FROM $postable) 
         AND ID NOT IN (SELECT DISTINCT user_id FROM $commentable)";

$query2="DELETE FROM $usermeta 
         WHERE user_id = 1 
         AND user_id NOT IN (SELECT DISTINCT post_author FROM $postable) 
         AND user_id NOT IN (SELECT DISTINCT user_id FROM $commentable)";

$query3="DELETE FROM $linktable 
         WHERE link_owner = 1 
         AND link_owner NOT IN (SELECT DISTINCT post_author FROM $postable) 
         AND link_owner NOT IN (SELECT DISTINCT user_id FROM $commentable)";

mysql_query($query1,$db_handler);
mysql_query($query2,$db_handler);
mysql_query($query3,$db_handler);

echo "Done!";
?>