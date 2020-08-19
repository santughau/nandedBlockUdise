<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pgi');

function connect()
{
  $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($connect)) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");

  return $connect;
}

$con = connect();

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);



  // Sanitize.
  $id = mysqli_real_escape_string($con, trim($request->id));
    
}

$download ;
$sql = "SELECT * FROM schoollist WHERE id = '$id' ";

if($result = mysqli_query($con,$sql))
{
 
   $row = mysqli_fetch_assoc($result);
   
      $download['id'] = $row['id']; 
      $download['sname'] = $row['sname']; 
      $download['udise'] = $row['udise']; 
      $download['taluka'] = $row['taluka']; 
      $download['taluka'] = $row['taluka']; 
      $download['block'] = $row['block']; 
        
  echo json_encode($download);
}
else
{
  http_response_code(404);
}