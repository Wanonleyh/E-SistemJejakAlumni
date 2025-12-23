<?php 
    session_start();

    include '../config/connect.php';
    include '../backend/functions/system.php';
    include '../backend/functions/csrf.php';
    include '../backend/functions/user.php';

    checkCSRFToken();
    
    //@ Tambah program
    if(isset($_POST['tambah_program'])){

        if(
            isset($_POST['nama_program']) &&
            isset($_POST['nama_kj_program']) &&
            isset($_POST['nama_kp_program']) &&
            isset($_POST['notel_kj_program']) &&
            isset($_POST['notel_kp_program'])
        ){

            // validate dan dapatkan program info
            $nama_program = validateInput($_POST['nama_program']);
            $nama_kj_program = validateInput($_POST['nama_kj_program']);
            $nama_kp_program = validateInput($_POST['nama_kp_program']);
            $notel_kj_program = validateInput($_POST['notel_kj_program']);
            $notel_kp_program = validateInput($_POST['notel_kp_program']);

            // check program in database
            $check_program_sql = $connect->prepare("SELECT * FROM program WHERE nama_program = :nama_program");
            $check_program_sql->execute([':nama_program' => $nama_program]);
            
            if(!($check_program_sql->rowCount() > 0)){

                // hasilkan program
                $tambah_program_sql = $connect->prepare("
                    INSERT INTO program(id_program, nama_program, bil_alumni_program, nama_kj_program, nama_kp_program, notel_kj_program, notel_kp_program, last_updated_program, created_date_program, status_program) 
                    VALUES 
                    (NULL, :nama_program , 0 , :nama_kj_program , :nama_kp_program , :notel_kj_program , :notel_kp_program , :last_updated_program , :created_date_program , 1)
                ");
                
                $tambah_program_sql->execute([
                    ':nama_program' => $nama_program,
                    ':nama_kj_program' => $nama_kj_program,
                    ':nama_kp_program' => $nama_kp_program,
                    ':notel_kj_program' => $notel_kj_program,
                    ':notel_kp_program' => $notel_kp_program,
                    ':last_updated_program' => date("Y-m-d"),
                    ':created_date_program' => date("Y-m-d"),
                ]);

                // set user session
                $id_program = $connect->lastInsertId();

                // redirect user
                log_activity_message("../log/user_activity_log", "Program berjaya dihasilkan");
                alert_message("success", "Program berjaya dihasilkan");               
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            }
            else{
                // error telah ada dalam database
                log_activity_message("../log/user_activity_log", "Program telah berdaftar");
                alert_message("error", "Program telah dihasilkan");               
                header("Location: " . $_SERVER["HTTP_REFERER"]);
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

    else if(isset($_POST['kemaskini_program'])){

        if(
            isset($_POST['id_program']) &&
            isset($_POST['nama_program']) &&
            isset($_POST['nama_kj_program']) &&
            isset($_POST['nama_kp_program']) &&
            isset($_POST['notel_kj_program']) &&
            isset($_POST['notel_kp_program'])
        ){
            
            $id_program = validateInput($_POST['id_program']);
            $nama_program = validateInput($_POST['nama_program']);
            $nama_kj_program = validateInput($_POST['nama_kj_program']);
            $nama_kp_program = validateInput($_POST['nama_kp_program']);
            $notel_kj_program = validateInput($_POST['notel_kj_program']);
            $notel_kp_program = validateInput($_POST['notel_kp_program']);

            // Check if program name already exists (excluding current program)
            $check_program_sql = $connect->prepare("SELECT * FROM program WHERE nama_program = :nama_program AND id_program != :id_program");
            $check_program_sql->execute([
                ':nama_program' => $nama_program,
                ':id_program' => $id_program
            ]);
            
            if(!($check_program_sql->rowCount() > 0)){

                $kemaskini_program_sql = $connect->prepare("
                    UPDATE program SET 
                    nama_program = :nama_program,
                    nama_kj_program = :nama_kj_program,
                    nama_kp_program = :nama_kp_program,
                    notel_kj_program = :notel_kj_program,
                    notel_kp_program = :notel_kp_program,
                    last_updated_program = :last_updated_program
                    WHERE id_program = :id_program
                ");

                $kemaskini_program_sql->execute([
                    ':nama_program' => $nama_program,
                    ':nama_kj_program' => $nama_kj_program,
                    ':nama_kp_program' => $nama_kp_program,
                    ':notel_kj_program' => $notel_kj_program,
                    ':notel_kp_program' => $notel_kp_program,
                    ':last_updated_program' => date("Y-m-d"),
                    ':id_program' => $id_program
                ]);

                log_activity_message("../log/user_activity_log", "Berjaya kemaskini program");
                alert_message("success", "Berjaya kemaskini program");
                header("Location:../admin/manage_course.php");
                exit;

            }
            else{
                alert_message("error", "Nama program sudah wujud");
                log_activity_message("../log/user_activity_log", "Nama program sudah wujud");
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

    else{
        // error tak ada token
        // log_activity_message("../log/user_activity_log", "Salah Function");
        // alert_message("error", "Salah function");
        header("Location:../");
        exit;
    }
?>