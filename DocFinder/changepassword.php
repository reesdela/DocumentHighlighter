<html>
<body bgcolor = "#FFFFFF">
	
      <div align = "center"> 
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
                   <label>New Password  :</label><input type = "text" name = "newpass" class = "box"/><br /><br />
                  <label>Confirm  :</label><input type = "text" name = "confirm" class = "box"/><br /><br />
                  <input type = "submit" value = "Save"/><br />
               </form>
<?php
if( isset($_POST['newpass']) && isset($_POST['confirm']) )
{
    //be sure to validate and clean your variables
    $val1 = $_POST['newpass'];
    $val2 = $_POST['confirm'];

if($val1 == $val2)
{
    echo "Password changed.";
}
else
{
    echo "Passwords do not Match!";
}
}
?>
                
 </div>
				
         </div>
			
      </div>

   </body>
    
</html>
