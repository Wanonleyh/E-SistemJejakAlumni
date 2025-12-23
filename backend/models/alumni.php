<?php

function checkAlumni(?string $email_user, ?int $id_user, $connect){
    if ($id_user === null && $email_user === null) {
        throw new InvalidArgumentException('Either ID or email must be provided');
    }

    // Build the query and parameters based on what parameters are provided
    if ($id_user !== null && $email_user !== null) {
        $sql = "SELECT * FROM alumni WHERE id_alumni = :id AND email_alumni = :email";
        $params = [':id' => $id_user, ':email' => $email_user];
    } elseif ($id_user !== null) {
        $sql = "SELECT * FROM alumni WHERE id_alumni = :id";
        $params = [':id' => $id_user];
    } else {
        $sql = "SELECT * FROM alumni WHERE email_alumni = :email";
        $params = [':email' => $email_user];
    }
    
    // Prepare and execute the query
    $stmt = $connect->prepare($sql);
    $stmt->execute($params);
    
    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return [
        'exists' => $user !== false,
        'user' => $user ?: null,
    ];
}
function verifySessionAlumni($token_name, $secret_key, $connect){

    $type_user = "alumni";

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
        $user_sql = $connect->prepare("SELECT * FROM alumni WHERE id_alumni = ?");
        $user_sql->execute([$id_user]);
        $user = $user_sql->fetch(PDO::FETCH_ASSOC);

        // Check if user exists before accessing array elements
        if($user === false) {
            return encodeObj("400", "User not found", "error");
        }

        if($user['status_alumni'] != 0){

            if($user['password_alumni'] != NULL && $user['status_alumni'] == 1){
    
                if(password_verify($password_user, $user['password_alumni'])){
        
                    $status = encodeObj("200", "Loggin Success", "success");
                    
                    $user_value = [
                        "id_alumni" => $user['id_alumni'], 
                        "email_alumni" => $user['email_alumni'], 
                        "nama_alumni" => $user['nama_alumni'], 
                        "password_alumni" => $password_user 
                    ];
                    
                    $user_value = json_encode($user_value);
                    return addJson($status, $user_value);
        
                }
                else{
                    return encodeObj("400", "Password not correct", "error");
                }
            }
            else{
                // Handle case where hash_password_user is NULL
                $status = encodeObj("200", "Loggin Success", "success");
                
                $user_value = [
                    "id_alumni" => $user['id_alumni'],
                    "email_alumni" => $user['email_alumni'],
                    "nama_alumni" => $user['nama_alumni'],
                    "password_alumni" => 'Email'
                ];
                
                $user_value = json_encode($user_value);
                return addJson($status, $user_value);
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

function createAlumni($name_alumni, $email_alumni, $password_alumni, $type, $confirm_password_alumni, $connect){

    try{

        $name_alumni = validateInput($name_alumni);
        $email_alumni = validateInput($email_alumni);
        $password_user = validateInput($password_alumni);
        $confirm_password_alumni = validateInput($confirm_password_alumni);

        $user = checkAlumni($email_alumni, NULL, $connect);

        // check if user exit
        if($user['exists'] != null){
            return encodeObj("400", "User Exits", "error");
            exit;
        }

        // check if password confirm correct
        if($password_alumni != $confirm_password_alumni){
            return encodeObj("400", "Confirm password not identical", "error");
            exit;
        }

        // hash password user
        $password_alumni_hashed = password_hash($password_alumni, PASSWORD_DEFAULT);

        $create_user_sql = $connect->prepare("
            INSERT INTO alumni(id_alumni, nama_alumni, pfp_alumni, ic_alumni, email_alumni, no_tel_alumni, alamat_alumni, jantina_alumni, id_program , password_alumni, created_date_alumni, status_alumni) 
            VALUES 
            (NULL, :nama_alumni, NULL , NULL , :email_alumni, NULL , NULL , NULL , NULL , :password_alumni_hashed, :created_date_alumni, :type_alumni)
        ");

        $create_user_sql->execute([
            ":email_alumni" => $email_alumni,
            ":nama_alumni" => $name_alumni,
            ":password_alumni_hashed" => $password_alumni_hashed,
            ":created_date_alumni" =>  date("Y-m-d"),
            ":type_alumni" => $type,
        ]);

        $id_alumni = $connect->lastInsertId();
    
        $status = encodeObj("200", "Sign up success", "success");
        $user = [
    
            "id_alumni" => $id_alumni,
            "email_alumni" => $email_alumni,
            "name_alumni" => $name_alumni,
            "password_alumni" => $password_alumni
        ];
    
        $user = json_encode($user);
        return addJson($status, $user);
    }

    catch(PDOException $e){
        return encodeObj("400", "Error Create User: $e", "error");
        exit;
    }

}


?>