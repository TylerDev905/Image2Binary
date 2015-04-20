<?PHP

$img = $_GET['file'];
$size = $_GET['size'];
binary_pic($img, $size);

function binary_pic($img , $size){
$path = pathinfo($img); 
	if($path['extension'] == "jpg"){
		$img = ImageCreateFromJpeg($img);
	}
	else if($path['extension'] == "png"){
		$img = ImageCreateFromPng($img);
	}
	else if($path['extension'] == "gif"){
		$img = ImageCreateFromGif($img);
	}
	else{
		exit('<div style="text-align:center;">Error: Wrong image format</br>Allowed Formats:jpg,gif and png</div>');
	}
$width = imagesx($img);
$height = imagesy($img);

$str = '';
	for($y = 0; $y < $height; $y++){
		for($x = 0; $x < $width; $x++){
			$rgb = imagecolorat($img, $x, $y);
			$a = ($rgb >> 32) & 0xFF;
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$x_html = $x * $size; 
			$y_html = $y * $size;
			$str .= '<span style ="position:absolute;left:'.$x_html.'px;top:'.$y_html.'px;font-size:'.$size.'px;color:rgba('.$r.",".$g.",".$b.",".$a.')">'.rand(0,1).'</span>';
		}
	}
echo $str;	
}
?>