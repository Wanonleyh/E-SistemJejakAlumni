<?php
    require_once("$location_index/config/connect.php");
    
    session_start();

    include("$location_index/backend/functions/system.php");
    include("$location_index/backend/functions/user.php");
    // include("$location_index/backend/models/alumni.php");
    include("$location_index/backend/models/admin.php");

    include "$location_index/backend/functions/csrf.php";
    $token = generateCSRFToken();

    $verify = verifySessionAdmin($token_name, $secret_key, $connect);
    $verify = json_decode($verify, true);

    try{
  
      if($verify['status'] != "success"){
          
        echo "<script>window.location.href = '../signin.php'</script>";
        alert_message("error", "User Not Logged In");
      }
  
      $admin_value = decryptUser($_SESSION[$token_name], $secret_key);
      $id_admin = $admin_value['id_user'];
  
      $admin_sql = $connect->prepare("SELECT * FROM admin WHERE id_admin = :id_admin");
      $admin_sql->execute([
          ":id_admin" => $id_admin
      ]);
      $admin = $admin_sql->fetch(PDO::FETCH_ASSOC);

    }

    catch(Exception $e){
      echo $e;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sistem Jejak Alumni</title>
    <link href="./src/img/favicon.ico" rel="icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./src/css/output.css"><!-- link css file from src folder -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@400;600;700&display=swap">

    <style>
        html{
            scroll-behavior: smooth;
          }
          
        body{
          min-height: 100vh;
        }
    </style>
</head>
