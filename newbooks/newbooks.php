<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

require "PGFeed.php";
$p = new PGFeed;
$p->setOptions(0,30,0,NULL);


$source="http://www.goodreads.com/review/list_rss/14996177?";
$shelf= $_GET["shelf"];
$feed = $source . "shelf=" . $shelf;
//print $feed;
$p->parse($feed);
$channel = $p->getChannel();

$items = $p->getItems();     // gets news items

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

<!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        <div class="item active">
                <?php 
                $img = $items[0]["book_large_image_url"];
                if (preg_match("/nocover/i", $img)) {
                    continue;
                } else { 
                    print "<img src=\"" . $img . "\" alt=\"\"></div>";
                }
        foreach (array_slice($items,1) as $i) {
            $img = $i["book_large_image_url"];
            if (preg_match("/nocover/i", $img)) {
                continue;
            } else { 
                print "<div class=\"item\"><img src=\"" . $img . "\" alt=\"\"></div>";
            }
        }
        ?>
    </div>
</div>

<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

    <script type="text/javascript">
    $('.carousel').carousel({
            interval: 6000
    })
</script>

</body>
</html>