<?php 

    session_start();

    include '../config/connect.php';
    include '../backend/functions/system.php';
    include '../backend/functions/csrf.php';
    include '../backend/functions/user.php';

    checkCSRFToken();
    
    //@ Daftar admin
    if(isset($_POST['tambah_admin'])){

        if(
            isset($_POST['nama_admin']) &&
            isset($_POST['password_admin']) &&
            isset($_POST['password_admin_confirm']) 
        ){

            // validate dan dapatkan user info
            $nama_admin = validateInput($_POST['nama_admin']);
            $password_admin = validateInput($_POST['password_admin']);
            $password_admin_confirm = validateInput($_POST['password_admin_confirm']);

            $password_admin_hash = password_hash($password_admin, PASSWORD_DEFAULT);
            $created_date_admin = date("Y-m-d");
            
            if($password_admin == $password_admin_confirm){

                try {
                    // check user in database using PDO
                    $check_user_sql = $connect->prepare("SELECT * FROM admin WHERE nama_admin = :nama_admin");
                    $check_user_sql->execute([':nama_admin' => $nama_admin]);
                    
                    if(!($check_user_sql->rowCount() > 0)){
        
                        // hasilkan user using PDO
                        $daftar_admin_sql = $connect->prepare("INSERT INTO admin (nama_admin, password_admin, created_date_admin, status_admin) VALUES (:nama_admin, :password_admin, :created_date_admin, 1)");
                        $daftar_admin_sql->execute([
                            ':nama_admin' => $nama_admin,
                            ':password_admin' => $password_admin_hash,
                            ':created_date_admin' => $created_date_admin
                        ]);
        
                        // set user session
                        $id_admin = $connect->lastInsertId();

                        setUser($id_admin, $password_admin, "admin", $token_name, $secret_key, $connect);
        
                        // redirect user
                        log_activity_message("../log/user_activity_log", "User berjaya dihasilkan");
                        alert_message("success", "Admin telah berdaftar");               
                        header("Location:../admin/manage_admin.php");
                        exit;
                    }
                    else{
                        // error telah ada dalam database
                        log_activity_message("../log/user_activity_log", "User telah berdaftar");
                        alert_message("error", "Admin telah berdaftar");               
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                        exit;
                    }
                } catch (PDOException $e) {
                    log_activity_message("../log/user_activity_log", "Database error: " . $e->getMessage());
                    alert_message("error", "Database error occurred");
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit;
                }
            }
            else{
                // error password tidak sepadan
                log_activity_message("../log/user_activity_log", "Katalaluan tidak sepadan");
                alert_message("error", "Katalaluan tidak sepadan");               
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            }

        }
        else{
            // error tak lengkap data
            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }
    }

    //@ Log in admin
    else if(isset($_POST['signin_admin'])){

        if(
            isset($_POST['nama_admin']) &&
            isset($_POST['password_admin'])
        ){

            $nama_admin = validateInput($_POST['nama_admin']);
            $password_admin = validateInput($_POST['password_admin']);

            try {
                $check_admin_sql = $connect->prepare("SELECT * FROM admin WHERE nama_admin = :nama_admin");
                $check_admin_sql->execute([':nama_admin' => $nama_admin]);
                
                // check adakah user ada dalam database
                if($check_admin_sql->rowCount() > 0){

                    $check_admin = $check_admin_sql->fetch(PDO::FETCH_ASSOC);

                    // pastikan password betul
                    if(password_verify($password_admin, $check_admin['password_admin'])){

                        setUser($check_admin['id_admin'], $password_admin, "admin", $token_name, $secret_key, $connect);

                        log_activity_message("../log/user_activity_log", "Berjaya Log Masuk");
                        alert_message("success", "Berjaya Log Masuk");
                        header("Location:../admin/");
                        exit;

                    }
                    else{

                        log_activity_message("../log/user_activity_log", "Katalaluan Tidak Sepadan");
                        alert_message("error", "Katalaluan Tidak Sepadan");
                        header("Location:../signin.php");
                        exit;
                    }
                }
                else{

                    log_activity_message("../log/user_activity_log", "Pengguna tidak sah");
                    alert_message("error", "Pengguna tidak sah");
                    header("Location:../signin.php");
                    exit;
                }
            } catch (PDOException $e) {
                log_activity_message("../log/user_activity_log", "Database error: " . $e->getMessage());
                alert_message("error", "Database error occurred");
                header("Location:../signin.php");
                exit;
            }

        }
        else{

            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location:../signin.php");
            exit;
        }
    }

    //@ Kemaskini admin (commented out in original, keeping structure for reference)
     else if(isset($_POST['kemaskini_admin'])){

        if(
            isset($_POST['id_admin']) &&
            isset($_POST['nama_admin']) &&
            isset($_POST['status_admin'])
        ){
            
            $id_admin = validateInput($_POST['id_admin']);
            $nama_admin = validateInput($_POST['nama_admin']);
            $status_admin = validateInput($_POST['status_admin']);
            $password_admin = isset($_POST['password_admin']) ? validateInput($_POST['password_admin']) : '';
            
            // Check if admin name already exists (excluding current admin)
            $check_admin_sql = $connect->prepare("SELECT * FROM admin WHERE nama_admin = :nama_admin AND id_admin != :id");
            $check_admin_sql->execute([
                ':nama_admin' => $nama_admin,
                ':id' => $id_admin
            ]);
            
            if($check_admin_sql->rowCount() > 0) {
                alert_message("error", "Nama admin sudah wujud");
                log_activity_message("../log/user_activity_log", "Nama admin sudah wujud: " . $nama_admin);
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            }

        // Prepare base query
        if(!empty($password_admin)) {
            // Update with new password
            $password_admin_hash = password_hash($password_admin, PASSWORD_DEFAULT);
            $kemaskini_admin_sql = $connect->prepare("
                UPDATE admin SET 
                nama_admin = :nama_admin,
                password_admin = :password_admin,
                status_admin = :status_admin
                WHERE id_admin = :id_admin
            ");
            
            $kemaskini_admin_sql->execute([
                ':nama_admin' => $nama_admin,
                ':password_admin' => $password_admin_hash,
                ':status_admin' => $status_admin,
                ':id_admin' => $id_admin
            ]);
        } else {
            // Update without changing password
            $kemaskini_admin_sql = $connect->prepare("
                UPDATE admin SET 
                nama_admin = :nama_admin,
                status_admin = :status_admin
                WHERE id_admin = :id_admin
            ");
            
            $kemaskini_admin_sql->execute([
                ':nama_admin' => $nama_admin,
                ':status_admin' => $status_admin,
                ':id_admin' => $id_admin
            ]);
        }

        log_activity_message("../log/user_activity_log", "Berjaya kemaskini admin: " . $nama_admin);
        alert_message("success", "Berjaya kemaskini admin");
        header("Location: ../admin/manage_admin.php");
        exit;

    }
    else{
        log_activity_message("../log/user_activity_log", "Data tidak lengkap untuk kemaskini admin");
        alert_message("error", "Data tidak lengkap");
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }
}

    else if(isset($_POST['signout_admin'])){

        session_destroy();
        setcookie($token_name, 2, time() - 3600 , "/");
        header("location:../");
        exit;
    }
    else{
        // error tak ada token
        log_activity_message("../log/user_activity_log", "Salah Function");
        alert_message("error", "Salah function");
        header("Location:../");
        exit;
    }

?>