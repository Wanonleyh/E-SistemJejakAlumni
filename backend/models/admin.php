<?php

function verifySessionAdmin($token_name, $secret_key, $connect){

    $type_user = "admin";

    if(isset($_SESSION[$token_name]) || isset($_COOKIE[$token_name])){
        
        // set user session based on cookie
        if(!isset($_SESSION[$token_name])){
            $_SESSION[$token_name] = $_COOKIE[$token_name];
        }

        // decrypt user token
        $user_value_hash = $_SESSION[$token_name];
        $user_value = decryptUser($user_value_hash, $secret_key);
        
        // get user value 
        $id_user = validateInput($user_value['id_user']);
        $password_user = validateInput($user_value['password_user']);
        $type_user_value = validateInput($user_value['type']);

        // identify user type
        if($type_user_value != $type_user){
            return encodeObj("400", "Not Correct Value", "error");
        }
        
        // based on db
        $user_sql = $connect->prepare("SELECT * FROM admin WHERE id_admin = ?");
        $user_sql->execute([$id_user]);
        $user = $user_sql->fetch(PDO::FETCH_ASSOC);

        // Check if user exists before accessing array elements
        if($user === false) {
            return encodeObj("400", "User not found", "error");
        }

        if($user['status_admin'] != 0){
            if($user['password_admin'] != NULL){
    
                if(password_verify($password_user, $user['password_admin'])){
        
                    $status = encodeObj("200", "Loggin Success", "success");
                    
                    $user_value = [
                        "id_admin" => $user['id_admin'], // Fixed: should be id_alumni, not id_user
                        "nama_admin" => $user['nama_admin'], // Fixed: should be nama_alumni
                        "password_user" => $password_user // Use the original password from session
                    ];
                    
                    $user_value = json_encode($user_value);
                    return addJson($status, $user_value);
        
                }
                else{
                    return encodeObj("400", "Password not correct", "error");
                }
            }
            else{
                return encodeObj("400", "Password not set", "error");
            }
        }
        else{
            // User status is not 1
            return encodeObj("400", "User account is inactive", "error");
        }
    }
    else{
        return encodeObj("400", "Pengguna belum Log Masuk", "error");
    }
}

?>