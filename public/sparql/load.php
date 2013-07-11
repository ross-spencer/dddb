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
		'store_name' => 'dddb_db',

		/* stop after 100 errors */
		'max_errors' => 100,
	);

	/* instantiation */
	$ep = ARC2::getStore($config);
	if (!$ep->isSetUp()) {
		$ep->setUp(); /* create MySQL tables */
	}

	$ep->reset();
	$ep->query('LOAD <http://127.0.0.1/dddb/public/sparql/disease-triples.nt>');

?>