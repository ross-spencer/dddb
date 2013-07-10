<?php

/* ARC2 static class inclusion */ 
include_once("arc/ARC2.php");


/* MySQL and endpoint configuration */ 
$config = array(
  /* db */
  'db_host' => 'localhost', /* optional, default is localhost */
  'db_name' => 'arc_db',
  'db_user' => 'root',
  'db_pwd' => 'root',

  /* store name */
  'store_name' => 'arc_tests',

  /* endpoint */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe',  
    'dump' /* dump is a special command for streaming SPOG export */
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_read_key' => '', /* optional */
  'endpoint_max_limit' => 250, /* optional */
);

/* instantiation */
$ep = ARC2::getStoreEndpoint($config);

if (!$ep->isSetUp()) {
  $ep->setUp(); /* create MySQL tables */
}

/* request handling */
$ep->go();



?>