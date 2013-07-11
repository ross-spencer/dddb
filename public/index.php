<?php 

	header("content-type: text/plain");
	#header("content-type: application/xml");

	$root = $_SERVER['DOCUMENT_ROOT'];

	include_once($root.'/dddb/private/app/php/classes/sparqllib/sparqllib.php');

	$endpoint = 'http://127.0.0.1/dddb/public/sparql/endpoint.php';
	$db = sparql_connect( $endpoint );

	if(!$db) 
	{
		print $db->errno() . ": " . $db->error(). "\n"; 
		exit; 
	}

	#$dddb_query = "select * where { ?s ?p ?o . }";
	#$fields = $dddb_array->field_array( $dddb_array );
	#var_dump($fields);
	#while( $row = $dddb_array->fetch_array( $dddb_array ) )
	#{
	#	foreach ( $fields as $field )
	#	{
	#		print $row[$field];
	#	}
	#}
	
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
	
	#print $_SERVER['REQUEST_URI'];
	
	if(sizeof($parts) == 2)
	{
		if (strtolower($parts[0]) == 'doc')
		{
			$subject_uri = "<http://localhost/id/".$parts[1].">";
			
			$dddb_query = "ask where { ".$subject_uri." ?p ?o . }";
			$db->outputfmt("plain");
			$dddb_ask = $db->query($dddb_query, True);
			
			if($dddb_ask == 'true')
			{
				$dddb_query = "describe ".$subject_uri;
				$db->outputfmt("xml");
				$dddb_ask = $db->query($dddb_query, True);
				print $dddb_ask;
			}
			else
			{
				print "return a 404";   # or xslt an empty xmlrdf document
			}
		}
	}
	else
	{
		print "return something else";
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
