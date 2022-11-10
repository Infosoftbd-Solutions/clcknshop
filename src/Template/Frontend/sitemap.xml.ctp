<?php
//create your XML document, using the namespaces
$urlset = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" /><!--?xml version="1.0" encoding="UTF-8"?-->');

//iterate over your sites pages or whatever you like

foreach ($urls as $item):

    //add the page URL to the XML urlset
    $url = $urlset->addChild('url');
    $url->addChild('loc', $item->URL );
    $url->addChild('lastmod', $item->LASTMOD );
    $url->addChild('changefreq', 'daily');  //weekly etc.
    $url->addChild('priority', '1.0');

    //add an image
    if ( isset($item->IMAGE) ):
        $image = $url->addChild('image:image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
        $image->addChild('image:loc',$item->IMAGE->URL, 'http://www.google.com/schemas/sitemap-image/1.1');
        $image->addChild('image:caption',$item->IMAGE->ALT_OR_TITLE , 'http://www.google.com/schemas/sitemap-image/1.1');
    endif;

endforeach;

//add whitespaces to xml output (optional, of course)
$dom = new DomDocument();
$dom->loadXML($urlset->asXML());
$dom->formatOutput = true;
//output xml

echo $dom->saveXML();

?>
