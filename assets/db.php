<?php

require_once 'config.php';

//Connect to MySQL database with the data stated above.
$dbLink = mysqli_connect($db_host, $db_user, $db_password, $db_database) or die('Error');

/**
 *
 * Function which executes a given query via the database
 *
 * @param $dbLink
 * @param $query
 * @return bool|mysqli_result|string
 */
function queryToDatabase($dbLink, $query)
{
	//If query is correct, result is true
	if ($result = mysqli_query($dbLink, $query)) {
		//Result of query returned
		return $result;
	} else {
		//Error message when mysqli_query == false
		return $error = mysqli_error($dbLink) . ' QUERY: ' . $query;
	}
}

/**
 *
 * Function which returns the data from database and puts it in an array
 *
 * @param $result
 * @param int $config
 * @return array
 */
function resultToArray($result, $config = 0)
{
	//Create array
	$resultQuery = [];
	//Loop through every row and fetch the result
	while ($row = mysqli_fetch_assoc($result)) {
		//Add row to array
		$resultQuery[] = $row;
	}
	//Return array so we can use it.
	return $resultQuery;
}

/**
 *
 * ??
 *
 * @param $data
 * @param $dbLink
 * @return string
 */
function dataFilter($data, $dbLink)
{
	// remove whitespaces from begining and end
	$data = trim($data);

	// apply stripslashes to pevent double escape if magic_quotes_gpc is enabled
	if(get_magic_quotes_gpc())
	{
		$data = stripslashes($data);
	}
	// connection is required before using this function
	$data = mysqli_real_escape_string($dbLink, $data);
	return $data;
}