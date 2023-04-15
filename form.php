<?php 
function upload(){
	if(!isset($_FILES['avatar'])){
		$GLOBALS['message']='请选择上传的文件';
		return;
	}
	$avatar=$_FILES['avatar'];
	if($avatar['error']!==0){
		$GLOBALS['message']='上传失败';
		return;
	}

	$source=$avatar['tmp_name'];
	$target='./uploads/'.$avatar['name'];

	$moved=move_uploaded_file($source, $target);
	if(!$moved){
		$GLOBALS['message']='服务器端移动文件失败';
		return;
	}
	$GLOBALS['message']='文件上传成功';
}

if($_SERVER['REQUEST_METHOD']==='POST'){
	upload();
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>文件上传</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="avatar">
		<button>上传</button>
		<?php if (isset($message)): ?>
			<p style="color: red;"><?php echo $message; ?></p>			
		<?php endif ?>
	</form>
</body>
</html>