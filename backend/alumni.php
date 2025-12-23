<?php 
    session_start();

    include '../config/connect.php';
    include '../backend/functions/system.php';
    include '../backend/functions/csrf.php';
    include '../backend/functions/user.php';

    checkCSRFToken();
    
    //@ Daftar alumni
    if(isset($_POST['daftar_alumni'])){

        if(
            isset($_POST['email_alumni']) &&
            isset($_POST['nama_alumni']) &&
            isset($_POST['password_alumni']) &&
            isset($_POST['password_alumni_confirm']) 
        ){

            // validate dan dapatkan user info
            $nama_alumni = validateInput($_POST['nama_alumni']);
            $email_alumni = validateInput($_POST['email_alumni']);
            $password_alumni = validateInput($_POST['password_alumni']);
            $password_alumni_hash = password_hash($password_alumni, PASSWORD_DEFAULT);
            $created_date_alumni = date("Y-m-d");
            
            // check user in database
            $check_user_sql = $connect->prepare("SELECT * FROM alumni WHERE email_alumni = :email");
            $check_user_sql->execute([':email' => $email_alumni]);
            
            if(!($check_user_sql->rowCount() > 0)){

                // hasilkan user
                $daftar_alumni_sql = $connect->prepare("
                    INSERT INTO alumni 
                    (nama_alumni, email_alumni, password_alumni, created_date_alumni, status_alumni) 
                    VALUES 
                    (:nama, :email, :password, :created_date, 1)
                ");
                
                $daftar_alumni_sql->execute([
                    ':nama' => $nama_alumni,
                    ':email' => $email_alumni,
                    ':password' => $password_alumni_hash,
                    ':created_date' => $created_date_alumni
                ]);

                // set user session
                $id_alumni = $connect->lastInsertId();

                setUser($id_alumni, $password_alumni, "alumni", $token_name, $secret_key, $connect);

                // redirect user
                log_activity_message("../log/user_activity_log", "User berjaya dihasilkan");
                alert_message("success", "Alumni telah berdaftar");               
                header("Location:../alumni/info.php");
                exit;
            }
            else{
                // error telah ada dalam database
                log_activity_message("../log/user_activity_log", "User telah berdaftar");
                alert_message("error", "Alumni telah berdaftar");               
                header("Location:../signin.php");
                exit;
            }

        }
        else{
            // error tak lengkap data
            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location:../");
            exit;
        }
    }

    //@ Log in alumni
    else if(isset($_POST['login_alumni'])){

        if(
            isset($_POST['email_alumni']) &&
            isset($_POST['password_alumni'])
        ){

            $email_alumni = validateInput($_POST['email_alumni']);
            $password_alumni = validateInput($_POST['password_alumni']);

            $check_alumni_sql = $connect->prepare("SELECT * FROM alumni WHERE email_alumni = :email");
            $check_alumni_sql->execute([':email' => $email_alumni]);
            
            // check adakah user ada dalam database
            if($check_alumni_sql->rowCount() > 0){

                $check_alumni = $check_alumni_sql->fetch(PDO::FETCH_ASSOC);

                // pastikan password betul
                if(password_verify($password_alumni, $check_alumni['password_alumni'])){

                    setUser($check_alumni['id_alumni'], $password_alumni, "alumni", $token_name, $secret_key, $connect);

                    log_activity_message("../log/user_activity_log", "Berjaya Log Masuk");
                    alert_message("success", "Berjaya Log Masuk");
                    header("Location:../alumni/");
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

        }
        else{

            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location:../");
            exit;
        }
    }

    //@ Kemaskini alumni
    else if(isset($_POST['kemaskini_alumni'])){

        if(
            isset($_POST['id_alumni']) &&
            isset($_POST['nama_alumni']) &&
            isset($_POST['ic_alumni']) &&
            isset($_POST['jantina_alumni']) &&
            isset($_POST['no_tel_alumni']) &&
            isset($_POST['email_alumni']) &&
            isset($_POST['id_program']) &&
            isset($_POST['kohort_alumni']) &&
            isset($_POST['alamat_alumni']) &&
            isset($_POST['status_alumni']) &&
            isset($_POST['kursus_semasa_alumni']) &&
            isset($_POST['pekerjaan_semasa_alumni']) &&
            isset($_POST['tarikh_mula_belajar_alumni']) &&
            isset($_POST['tarikh_tamat_belajar_alumni']) &&
            isset($_POST['gaji_pendapatan_alumni']) &&
            isset($_POST['alamat_belajar_alumni']) &&
            isset($_POST['alamat_bekerja_alumni']) &&
            isset($_POST['last_updated_alumni'])
        ){
            
            $id_alumni = validateInput($_POST['id_alumni']);
            $nama_alumni = validateInput($_POST['nama_alumni']);
            $ic_alumni = validateInput($_POST['ic_alumni']);
            $jantina_alumni = validateInput($_POST['jantina_alumni']);
            $no_tel_alumni = validateInput($_POST['no_tel_alumni']);
            $email_alumni = validateInput($_POST['email_alumni']);
            $id_program = validateInput($_POST['id_program']);
            $kohort_alumni = validateInput($_POST['kohort_alumni']);
            $alamat_alumni = validateInput($_POST['alamat_alumni']);
            $status_alumni = validateInput($_POST['status_alumni']);
            $kursus_semasa_alumni = validateInput($_POST['kursus_semasa_alumni']);
            $pekerjaan_semasa_alumni = validateInput($_POST['pekerjaan_semasa_alumni']);
            $tarikh_mula_belajar_alumni = validateInput($_POST['tarikh_mula_belajar_alumni']);
            $tarikh_tamat_belajar_alumni = validateInput($_POST['tarikh_tamat_belajar_alumni']);
            $gaji_pendapatan_alumni = validateInput($_POST['gaji_pendapatan_alumni']);
            $alamat_belajar_alumni = validateInput($_POST['alamat_belajar_alumni']);
            $alamat_bekerja_alumni = validateInput($_POST['alamat_bekerja_alumni']);
            $last_updated_alumni = date("Y-m-d");

            if($id_program != 0){
                // Update alumni table
                $kemaskini_alumni_sql = $connect->prepare("
                    UPDATE alumni SET 
                    nama_alumni = :nama_alumni,
                    ic_alumni = :ic_alumni,
                    email_alumni = :email_alumni,
                    jantina_alumni = :jantina_alumni,
                    no_tel_alumni = :no_tel_alumni,
                    alamat_alumni = :alamat_alumni,
                    id_program = :id_program
                    WHERE id_alumni = :id_alumni
                ");

                $kemaskini_alumni_sql->execute([
                    ':nama_alumni' => $nama_alumni,
                    ':ic_alumni' => $ic_alumni,
                    ':email_alumni' => $email_alumni,
                    ':jantina_alumni' => $jantina_alumni,
                    ':no_tel_alumni' => $no_tel_alumni,
                    ':alamat_alumni' => $alamat_alumni,
                    ':id_program' => $id_program,
                    ':id_alumni' => $id_alumni
                ]);

                // Check if info_alumni record exists
                $check_info_alumni_sql = $connect->prepare("SELECT * FROM info_alumni WHERE id_alumni = :id_alumni");
                $check_info_alumni_sql->execute([':id_alumni' => $id_alumni]);
                
                if($check_info_alumni_sql->rowCount() > 0) {
                    // Update existing info_alumni record
                    $update_info_alumni_sql = $connect->prepare("
                        UPDATE info_alumni SET 
                        kohort_alumni = :kohort_alumni,
                        alamat_belajar_alumni = :alamat_belajar_alumni,
                        alamat_bekerja_alumni = :alamat_bekerja_alumni,
                        kursus_semasa_alumni = :kursus_semasa_alumni,
                        pekerjaan_semasa_alumni = :pekerjaan_semasa_alumni,
                        tarikh_mula_belajar_alumni = :tarikh_mula_belajar_alumni,
                        tarikh_tamat_belajar_alumni = :tarikh_tamat_belajar_alumni,
                        gaji_pendapatan_alumni = :gaji_pendapatan_alumni,
                        last_updated_alumni = :last_updated_alumni,
                        status_alumni = :status_alumni
                        WHERE id_alumni = :id_alumni
                    ");
                    
                    try{
                        // $connect->beginTransaction();
                        $update_info_alumni_sql->execute([
                            ':kohort_alumni' => $kohort_alumni,
                            ':alamat_belajar_alumni' => $alamat_belajar_alumni,
                            ':alamat_bekerja_alumni' => $alamat_bekerja_alumni,
                            ':kursus_semasa_alumni' => $kursus_semasa_alumni,
                            ':pekerjaan_semasa_alumni' => $pekerjaan_semasa_alumni,
                            ':tarikh_mula_belajar_alumni' => $tarikh_mula_belajar_alumni,
                            ':tarikh_tamat_belajar_alumni' => $tarikh_tamat_belajar_alumni,
                            ':gaji_pendapatan_alumni' => $gaji_pendapatan_alumni,
                            ':last_updated_alumni' => $last_updated_alumni,
                            ':status_alumni' => $status_alumni,
                            ':id_alumni' => $id_alumni
                        ]);
                    } catch (Exception $e) {
                        // Handle the exception if needed
                        error_log("Transaction start failed: " . $e->getMessage());
                    }

                } else {
                    // Insert new info_alumni record
                    $insert_info_alumni_sql = $connect->prepare("
                        INSERT INTO info_alumni 
                        (id_alumni, kohort_alumni, alamat_belajar_alumni, alamat_bekerja_alumni, 
                         kursus_semasa_alumni, pekerjaan_semasa_alumni, tarikh_mula_belajar_alumni, 
                         tarikh_tamat_belajar_alumni, gaji_pendapatan_alumni, last_updated_alumni, status_alumni) 
                        VALUES 
                        (:id_alumni, :kohort_alumni, :alamat_belajar_alumni, :alamat_bekerja_alumni, 
                         :kursus_semasa_alumni, :pekerjaan_semasa_alumni, :tarikh_mula_belajar_alumni, 
                         :tarikh_tamat_belajar_alumni, :gaji_pendapatan_alumni, :last_updated_alumni, :status_alumni)
                    ");
                    
                    $insert_info_alumni_sql->execute([
                        ':id_alumni' => $id_alumni,
                        ':kohort_alumni' => $kohort_alumni,
                        ':alamat_belajar_alumni' => $alamat_belajar_alumni,
                        ':alamat_bekerja_alumni' => $alamat_bekerja_alumni,
                        ':kursus_semasa_alumni' => $kursus_semasa_alumni,
                        ':pekerjaan_semasa_alumni' => $pekerjaan_semasa_alumni,
                        ':tarikh_mula_belajar_alumni' => $tarikh_mula_belajar_alumni,
                        ':tarikh_tamat_belajar_alumni' => $tarikh_tamat_belajar_alumni,
                        ':gaji_pendapatan_alumni' => $gaji_pendapatan_alumni,
                        ':last_updated_alumni' => $last_updated_alumni,
                        ':status_alumni' => $status_alumni
                    ]);
                }

                log_activity_message("../log/user_activity_log", "Berjaya kemaskini pelajar");
                alert_message("success", "Berjaya kemaskini pelajar ");
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;

            }
            else{
                alert_message("error", "Sila pilih jenis kursus");
                log_activity_message("../log/user_activity_log", "Sila pilih jenis kursus");
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            }

        }
        else{
            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }

    }

    else if(isset($_POST['delete_alumni'])){
        if(
            isset($_POST['id_alumni'])
        ){

            $id_alumni = validateInput($_POST['id_alumni']);

            // padam alumni
            $delete_alumni_sql = $connect->prepare("UPDATE alumni SET status_alumni = 0 WHERE id_alumni = :id_alumni");
            $delete_alumni_sql->execute([':id_alumni' => $id_alumni]);

            log_activity_message("../log/user_activity_log", "Berjaya padam pelajar");
            alert_message("success", "Berjaya padam pelajar ");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;

        }
        else{
            log_activity_message("../log/user_activity_log", "Data tidak lengkap");
            alert_message("error", "Data tidak lengkap");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }

    }

    // signout
    else if(isset($_POST['signout_alumni'])){

        // Unset all of the session variables.
        $_SESSION = array();
    
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!

        session_destroy();
        setcookie($token_name, 2, time() - 3600 , "/");
        log_activity_message("../log/user_activity_log", "Berjaya Log Keluar");
        alert_message("success", "Berjaya Log Keluar");
        header("Location:../");
        exit;

    }
    else{
        // error tak ada token
        // log_activity_message("../log/user_activity_log", "Salah Function");
        // alert_message("error", "Salah function");
        header("Location:../");
        exit;
    }
?>