<?php
/*
	英文はグーグル翻訳で翻訳されました。
	English text translated by 	Google Translate.
*/

$parent_dir = "./data/";	//アップロード先(親ディレクトリ)
$media_dir = "images/";	//アップロード先(メディア用ディレクトリ)
$upload_dir = $parent_dir.$media_dir;	//メディアのアップロード先
$filename = random();

//メディアアップロード先の親ディレクトリが存在しない場合、
//If the parent directory of the media upload destination does not exist,
//親ディレクトリの作成
//Create parent directory
if (!file_exists($parent_dir)) {
	mkdir($parent_dir, 0777);
}

//メディアアップロード先のディレクトリが存在しない場合、
//If the directory to upload media to does not exist,
//メディアアップロード用ディレクトリの作成
//Create a directory for media upload
if (!file_exists($upload_dir)) {
	mkdir($upload_dir, 0777);
}

//ファイルのアップロード
//Upload files
if(isset($_FILES["upload_file"])) {
	//ファイルの仮名を取得
	//get the pseudonym of the file
	$fname_tmp = $_FILES["upload_file"]["tmp_name"];

	//ファイルの拡張子を取得
	//Get file extension
	$type = exif_imagetype($fname_tmp);

	//ファイルの拡張子
	//File extension
	$ex = "";
	
	//ファイルの拡張子を判別
	//Determine file extension
	switch($type){
		case IMAGETYPE_GIF:
			$ex = ".gif";
			break;
		case IMAGETYPE_JPEG:
			$ex = ".jpg";
			break;
		case IMAGETYPE_PNG:
			$ex = ".png";
			break;
	}

	//ファイルを移動
	//Move file
	if(is_uploaded_file($fname_tmp)) {
		move_uploaded_file($fname_tmp, $upload_dir.$filename.$ex);
		echo $upload_dir.$filename.$ex.":";
	}
}

function random($length = 25) {
	return array_reduce(range(1, $length), function($p){ return $p.str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz')[0]; });
}

?>