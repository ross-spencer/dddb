<?php 

	$root = $_SERVER['DOCUMENT_ROOT'];

	include_once($root.'/dddb/private/app/php/classes/sparqllib/sparqllib.php');

	$endpoint = 'http://127.0.0.1/public/sparql/endpoint.php';
	$db = sparql_connect( $endpoint );

	if(!$db) 
	{
		print $db->errno() . ": " . $db->error(). "\n"; 
		exit; 
	}

	#$dddb_query = "select * where { ?s ?p ?o . }";
	$dddb_query = "ask where { <http://localhost/id/Ebolavirus> ?p ?o . }";

	$dddb_array = $db->query($dddb_query);

	var_dump($dddb_array);
	
	print "ggg";
	
	$fields = $dddb_array->field_array( $dddb_array );
	
	var_dump($fields);
	
	
	while( $row = $dddb_array->fetch_array( $dddb_array ) )
	{
		foreach ( $fields as $field )
		{
			print $row[$field];
		}
	}
	
	
	#		foreach( $fields as $field )
	#		{
	#			print $field;
	#		}

	$page_type_arr = array(
		"doc",		# document about the non-info resource
		"id",			# uri (id) for the non-info resource
	);

	// return an array of the request_uri parts
	// following '/' after .info e.g. /doc/ross-spencer
	function get_slug($delimeter, $request_uri)
	{
		return array_values(array_filter(explode($delimeter, $request_uri)));
	}

	$parts = get_slug('/', $_SERVER['REQUEST_URI']);		# Stick REQUEST_URI into init() for class?
	
	print $_SERVER['REQUEST_URI'];
	
	if(sizeof($parts) == 2)
	{
		if (strtolower($parts[0]) == 'doc')
		{
			# attempt to find in endpoint
			
		}
	}
	else
	{
		print "hhh";
	}


	//print "here";

	/*if(file_exists("http://127.0.0.1/sigdev/index.htm"))
	{
		print "yo";
		//header($_SERVER["SCRIPT_URL"]);
		//header("http://127.0.0.1/sigdev/index.htm", TRUE, 301);
		header("location: http://127.0.0.1/sigdev/index.htm?redirected=1");
		
	}
	else
	{
		print $_SERVER["SCRIPT_URL"]; 
		print "<br>Everything is going xxx through index.php - how can this work...?";
	}*/


//phpinfo(); 


?>
