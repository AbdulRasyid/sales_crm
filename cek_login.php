<?php
include "koneksi.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = $_POST['username'];
$pass     = $_POST['password'];


// pastikan username dan password adalah berupa huruf atau angka.
/*if (!ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{*/
	/* KONEKSI KE LDAP */
   // $ldapbind = ldap_bind($ldap,"uid=$username,ou=Users,dc=dnsdcm,dc=dutacemerlang,dc=co,dc=id",$pass) or die ('Password atau username yang anda masukkan salah !!! :p ');    
        
    $login=mysql_query("SELECT id_users, username, nama_lengkap, 	email, no_telp,  divisi, level,
                    	         sublevel, blokir, id_session, id_parent, kantor 
                        FROM   ms_users 
                        WHERE username='$username' AND blokir='N'");
    $ketemu=mysql_num_rows($login);
    $r=mysql_fetch_array($login);
    
    // Apabila username dan password ditemukan
     if ($ketemu > 0)
	 
   //if ($ketemu > 0 AND $ldapbind == TRUE)
    {
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
    
    
      mysql_query("UPDATE ms_users SET id_session='$sid_baru$pass' WHERE username='$username'");
	    
       if (empty($_SESSION['nama_lengkap']) OR empty($_SESSION['nama_lengkap']) ) {
              header('location:registrasi.php?username='.$_SESSION[username].'');

          } elseif ($_SESSION['divisi'] == 'hino' OR $_SESSION['divisi'] == 'hino3'){
              header('location:hino/dashboard.php?module=data_customer');

          } elseif ($_SESSION['divisi'] == 'manager') {
           header('location:hoyu/dashboard.php?module=data_customer');

          } elseif ($_SESSION['divisi'] == 'suzuki') {
           header('location:suzuki/dashboard.php?module=data_customer');
         } 
    }
    else
    {
      header ("location:index.php?error=1"); 
    }
/*}*/
?>