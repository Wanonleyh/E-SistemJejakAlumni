<?php 
    session_start();
    include '../config/connect.php';
    include '../backend/functions/system.php';
    include '../backend/functions/csrf.php';
    include '../backend/functions/user.php';
    include '../backend/functions/google-login.php';
    include '../backend/models/alumni.php';
    
    require __DIR__ . "/../vendor/autoload.php";

    if(empty($_GET['code'])){
        header("Location:../");
    }

    try{
        // echo $clientId . $clientSecret . $redirectUri;
        $client = initializeGoogleClient($clientId, $clientSecret, $redirectUri);
        
        $token = getAccessToken($client);
        
        $oauth = new Google\Service\Oauth2($client);
        $userinfo = $oauth->userinfo->get();

        $pwd_gsso = $secret_key . $userinfo->email;

        if (empty($userinfo->email)) {
            header("Location:../");
            return;
        }

        $userInfo = checkAlumni($userinfo->email, NULL, $connect);

        if($userInfo['exists'] == true){
            
            // login user
            var_dump($userInfo);
            setUser($userInfo['user']['id_alumni'], $pwd_gsso , "alumni", $token_name, $secret_key, $connect);
            log_activity_message("../log/user_activity_log", "Login Success");
            header("Location:../alumni/");
        }
        else{
            // signup new user
            $user = createAlumni($userinfo->givenName, $userinfo->email, $pwd_gsso, 2, $pwd_gsso, $connect);
            $user = json_decode($user, true);

            var_dump($user);

            if($user['id'] == 200){

                // login newuser
                setUser($user['id_alumni'], $pwd_gsso, "alumni", $token_name, $secret_key, $connect);
                log_activity_message("../log/user_activity_log", "Login Success");
                header("Location:../alumni/");
            }
            else{
                redirectWithAlert("../", "error", "Login Error: " . $user['message']);
            }
        }
    }
    catch(Exception $e){
        redirectWithAlert("../", "error", "Login Error: " . $e->getMessage());
    }