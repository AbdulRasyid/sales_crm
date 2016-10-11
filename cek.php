<?php

include "koneksi.php";

if(isset($_POST['username']) && isset($_POST['password'])){

    $adServer = "ldap://192.168.254.200";
  
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'dutacemerlang' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

     //tambahan
     $query = "SELECT id_users, username, nama_lengkap,   email, no_telp,  divisi, level,
                               sublevel, blokir, id_session, id_parent, kantor 
                        FROM   ms_users 
                        WHERE username='$username' AND blokir='N'";
    $login=mysql_query($query);
    $ketemu=mysql_num_rows($login);
    $r=mysql_fetch_array($login);
   
    if ($bind) {
         
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=DUTACEMERLANG,dc=CO,dc=ID",$filter);
        ldap_sort($ldap,$result,"sn");
        
        
        echo $query . $r[username];
         if ($ketemu > 0) {
            session_start();
          include "timeout.php";
        
      $_SESSION[username]     = $r[username];
      $_SESSION[password]     = $r[password];
      $_SESSION[nama_lengkap] = $r[nama_lengkap];
      $_SESSION[divisi]       = $r[divisi];
      $_SESSION[level]        = $r[level];
      $_SESSION[sublevel]     = $r[sublevel];
      $_SESSION[id]           = $r[id_users];
      $_SESSION[id_parent]    = $r[id_parent];
          
          // session timeout
          $_SESSION[login] = 1;
          timer();
        
          $sid_lama = session_id();
          session_regenerate_id();
          $sid_baru = session_id();
        
        
          mysql_query("UPDATE ms_users SET id_session='$sid_baru' WHERE username='$username'");
          
      if ($_SESSION['divisi'] == 'hino'){
        header('location:hino/dashboard.php?module=dashboard');

      } elseif ($_SESSION['divisi'] == 'suzuki'){
        header('location:suzuki/dashboard.php?module=dashboard');
    
      }
        
    } else {
           session_start();
           // echo "create user di ms_users lalu menuju kehalaman edit user (menentukan posisi user)";
           mysql_query("INSERT INTO ms_users (username, email) 
            VALUES ('$username','$username@dutacemerlang.co.id')");
         
          $_SESSION[username]     = $r[username];
          header('location:registrasi.php?username='.$_SESSION[username].'');
          
          }
          
        $info = ldap_get_entries($ldap, $result);
        
        /* for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        */
        @ldap_close($ldap);
    } else {
        header ("location:index.php?notif=1"); 
    }

}


?>