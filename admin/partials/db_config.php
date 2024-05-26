<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "cms";

$con = mysqli_connect($server,$username,$password,$db);

if(!$con){
  die("cannot connect to database.". mysqli_connect_error());
}


function filteration($data){
   foreach ($data as $key => $value) {
    $value = trim($value);
    $value= stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    $data[$key] =$value;
   }
   return $data;
}

function selectAll($table){
  $con = $GLOBALS['con'];
  $res = mysqli_query($con, "SELECT * FROM `$table`");
  if (!$res) {
      die("Error in SELECT query: " . mysqli_error($con));
  }
  return $res;
}


function select($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }
    else{
      die("Query Can not be Executed- SELECT");
    }
  }
  else{
    die("Query Can not be Prepared- SELECT");
  }
}

function update($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }
    else{
      die("Query Can not be Executed- UPDATE");
    }
  }
  else{
    die("Query Can not be Prepared- UPDATE");
  }
}

function insert($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }
    else{
      die("Query Can not be Executed- INSERT");
    }
  }
  else{
    die("Query Can not be Prepared- INSERT");
  }
}

function delete($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }
    else{
      die("Query Can not be Executed- DELETE");
    }
  }
  else{
    die("Query Can not be Prepared- DELETE");
  }
}

?>