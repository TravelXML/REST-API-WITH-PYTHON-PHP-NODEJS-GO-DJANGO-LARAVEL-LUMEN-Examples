<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('http://localhost/bookstore/');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'Auth' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcl9uYW1lIjoic2FwYW4iLCJlbWFpbCI6ImN0b2F0dHJhdmVsdGVjaEBnbWFpbC5jb20ifQ.YuuHvX8IdNFugj0_1xiEbZ9f54PAnaExO9Xv_rjB4Rg'
));
$request->setBody('{
  "author_name":"test",
  "title":"Indian Politics",
  "isbn":"1861972717",
  "release_date":"",
  "action":"create_book"}');
try {
  $response = $request->send();
  echo '<br/>INPUT :'. $request->getBody();

  echo'<br/><br/> OUTPUT Header :'.implode(" | ",$response->getHeader());


  if ($response->getStatus() == 200) {
      echo '<br/>HTTP status: ' . $response->getStatus();
      
      echo '<br/><br/>OUTPUT :'.$output = $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}?>