<?php

/*
  title : recursive method
  created by : affandi@dutacemerlang.co.id
  created date : 13 okt 2012
  modified date : 19 sept 2014
  */
  
function hierarki($parent,$build)
{
     global $db;    
     
     $query = "SELECT id_users, username FROM ms_users 
               WHERE id_parent = $parent AND blokir = 'N'            
               ORDER BY id_users";
     $users = mysql_query($query, $db) or die(mysql_error());
             
     if (mysql_num_rows($users) > 0)
     {
       
             if($parent<1)
                $build .= ""; // parent ul left padding != sub ul padding
             else
                $build .= "";
         
             while ($row = mysql_fetch_assoc($users))
             {
                 $build .= ",'" . $row['username'] ."'";
                 $build = hierarki($row['id_users'],$build);
                 $build .= "";            
             }
         $build .= "";
     }
     return $build;
 }

  
function hierarki_all($parent,$build)
{
     global $db;    
     
     $query = "SELECT id_users, username FROM ms_users 
               WHERE id_parent = $parent            
               ORDER BY id_users";
     $users = mysql_query($query, $db) or die(mysql_error());
             
     if (mysql_num_rows($users) > 0)
     {
       
             if($parent<1)
                $build .= ""; // parent ul left padding != sub ul padding
             else
                $build .= "";
         
             while ($row = mysql_fetch_assoc($users))
             {
                 $build .= ",'" . $row['username'] ."'";
                 $build = hierarki_all($row['id_users'],$build);
                 $build .= "";            
             }
         $build .= "";
     }
     return $build;
 }

 ?>
 