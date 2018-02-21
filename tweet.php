<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php 
/**
 * Twitter API SEARCH
 * Selim Hallaç
 * selimhallac@gmail.com
 */
if (isset ($_POST['search']))
{
	$theValue = $_POST['keyword'];

$a=$theValue;
echo $a;}
include "twitteroauth/twitteroauth.php";

$consumer_key = "mfee5uWA21J4Bug0lFjIHDVul";
$consumer_secret = "Zz5qmoh7DUotWXEpB7BfjVLvKGqwkvDyJRo0FWPHkpuOAlIY0L";
$access_token = "964596711002816512-1MWJLafLWN5wA1H9tJLvcQudiGMiCm8";
$access_token_secret = "36nbWmO6Lk07I0eQD8aVFzLg0pNl9SaSXlPdA7MyCpObf";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=$theValue&result_type=recent&count=20');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>
</head>
<body>
<?php foreach ($tweets->statuses as $key => $tweet) { ?>
    Tweet : <img src="<?=$tweet->user->profile_image_url;?>" /><?=$tweet->text; ?><br>
<?php } ?>

<form action="tweet.php" method="post">
    <label> search :</label> <input type="text" name="keyword">
    <input type="submit" name="search" value="Search">
    </form>
    <?php print_r($tweets);?>

  

</body>
</html>

</body>
</html>