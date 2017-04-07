<?php
/**
 * Created by PhpStorm.
 * User: Rait
 * Date: 04.04.2017
 * Time: 17:48
 */

$x = 0;
// get how many feeds are displayed
if (!$_GET) {
    $numfeeds = 13;
} else {
    $numfeeds = $_GET["numfeeds"];
}

// feed information
$html = "";
$url = "https://flipboard.com/@raimoseero/feed-nii8kd0sz?rss";
for ($i = $x; $i < $numfeeds; $i++) {
    $portitem = "<div class='col-md-4 portfolio-item'>";
    if ($x <= 3) echo $portitem;

    $xml = simplexml_load_file($url);
    $xml->formatOutput = true;
    $image = $xml->channel->item[$i]->children('media', True)->content->attributes();

    if($image == false){
    $image = '        ';
    $image = trim($image);}
    if ($image !== '') 'images/banana.jpg';

    $title = $xml->channel->item[$i]->title;
    $link = $xml->channel->item[$i]->link;
    $guid = $xml->channel->item[$i]->guid;
    $pubDate = $xml->channel->item[$i]->pubDate;
    $author = $xml->channel->item[$i]->author;
    $category = $xml->channel->item[$i]->category;
    $description = $xml->channel->item[$i]->description;


    if (!$x++) echo $portitem;
    if ($x % 4 == 0) echo $portitem;
    $html .= html_entity_decode("
                <br>
                $portitem
                <div>
                    <p>
                    <p>$pubDate, $author</p>
                    <a href='$link'><H2>$title</H2></a></div> <br>
                     <a href='$link'>
                         <img class='img-responsive' src='$image' alt=''>
                     </a>
                    <p>$description</p>
                    </p>
                </div>
                </div>
                <br>");
    $x++;
    if ($x % 4 == 0) echo '</div>';
}
echo print_r($html);

?>