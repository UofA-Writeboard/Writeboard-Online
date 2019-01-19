<?php

$done = false;
require_once(__DIR__."/php/inter.php");

if(isset($_FILES['userfile']) && move_uploaded_file($_FILES['userfile']['tmp_name'], __DIR__."/php/temp/in.svg"))
{
	shell_exec("python \"".__DIR__."/php/svg2gcode/svg2gcode.py\" \"".__DIR__."/php/temp/in.svg\"");
	\Writeboard\post_gcode(file_get_contents(__DIR__."/php/temp/gcode_output/in.gcode"));
	$done = true;
}

if(!$done){
?>
<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
<?php
}else{
?>
<br/><b>donezo</b>
<?php
}
?>