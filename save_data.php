<?php
$path   = $_POST['path'];	//データファイルの保存先 Data file storage location
$title  = $_POST['title'];	//タイトル Title
$id     = $_POST['id'];		//記事ID Article ID
$public = $_POST['public'];	//公開状態 Published state
$tag    = $_POST['tag'];	//タグ Tag
$cat    = $_POST['cat'];	//カテゴリ Category
$conte  = $_POST['conte'];	//記事 Article

//ディレクトリが存在しない場合、作成する
//Create directory if it does not exist
if (file_exists($path)) {
	mkdir($path, 0777);
}

//保存するデータ　Data to save
$data = $title."\n".$id."\n".$public."\n".$tag."\n".$cat."\n".$conte;

//保存 Save
file_put_contents($path.$id.".txt", $data);

?>