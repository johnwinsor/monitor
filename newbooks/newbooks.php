<?php 

// ini_set('display_errors','On');
// error_reporting(E_ALL);

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
    <!-- <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet"> -->
    <style>
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  margin: 0px;
  height: 800px;
}

.carousel {
height: 800px;
position: relative;
margin-bottom: 0;
padding-bottom: 0;
}

.carousel-inner {
overflow: hidden;
position: relative;
margin: 0px auto;
}

/* 778 + 22 = 800 */
.item img {
min-height: 778px;
margin: 0px auto;
padding:10px;
border:1px solid black;
background:white;
-ms-interpolation-mode: bicubic;
}

.carousel {
  position: relative;
  line-height: 1;
}
.carousel-inner {
  overflow: hidden;
  width: 100%;
  position: relative;
}
.carousel .item {
  display: none;
  position: relative;
  -webkit-transition: 0.6s ease-in-out left;
  -moz-transition: 0.6s ease-in-out left;
  -o-transition: 0.6s ease-in-out left;
  transition: 0.6s ease-in-out left;
}
.carousel .item > img {
  display: block;
  line-height: 1;
}
.carousel .active,
.carousel .next,
.carousel .prev {
  display: block;
}
.carousel .active {
  left: 0;
}
.carousel .next,
.carousel .prev {
  position: absolute;
  top: 0;
  width: 100%;
}
.carousel .next {
  left: 100%;
}
.carousel .prev {
  left: -100%;
}
.carousel .next.left,
.carousel .prev.right {
  left: 0;
}
.carousel .active.left {
  left: -100%;
}
.carousel .active.right {
  left: 100%;
}


    </style>



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