<!DOCTYPE html>
<html>
<head>
	<title>NOGLE EDITER</title>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300&display=swap" rel="stylesheet">
	<link href="./css/style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="./js/main.js" type="text/javascript" async defer></script>
</head>
<body>
	<!-- ライセンス LICENCE -->
	<!-- (テキストエディタ参考 TEXTEDITER REFERENCE) https://codepen.io/Shokeen/pen/pgryyN?editors=1010 -->
	<!-- (アイコン ICON) https://icon-icons.com/ja/pack/Font-Awesome-Icons/936 -->

	<!-- ヘッダ HEADER -->
	<div style="position: relative;width: 100%;min-width: 700px;max-width: 900px;height: 100px;margin: 0 auto;margin-bottom: 20px;">
		<div id="nogle-editer">
			<div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);text-align: center;">
				NOGLE<br>EDITER
			</div>
		</div>

		<div style="float: left;position: relative;width: 70%;top: 50%;transform: translate(0%, -50%);color: #999;text-align: left;font-size: 15px;">
			* このエディタはGoogle Chromeで使用することを推奨します。<br>
			* This editor is recommended for use with Google Chrome.
		</div>
	</div>

	<!-- ページデータ PAGE DATA -->
	<div id="page_data">
		<!-- 記事タイトル Article title -->
		<div style="margin-bottom: 10px;">
			<b>新規記事を作成 Create new article</b>
		</div>
		
		<input type="text" placeholder="タイトル TITLE" id="page_title" class="input center" style="font-size: 19px;">
		
		<div style="height: 20px;"></div>
		
		<!-- 記事ID Article ID -->
		<b>記事ID ArticleID</b>&emsp;
		<input type="text" placeholder="ex) nogle-editer-blog" id="article_id" class="input" style="width: 300px;">
		<div style="width: 70%;color: #999;text-align: left;font-size: 15px;">
			* このIDは記事ページへのURLとして使用します。<br>
			* Use this ID as the URL to the article page.
		</div>
	</div>

	<!-- コントロールパネル CONTROL PANEL -->
	<div id="control">
		<div id="control-text">
			<!-- 見出し HEADING -->
			<a href="#control" class="h" data-cmd="h2">
				<h2 style="display: inline-block;">
					大見出し <span style="color: #AAA;"><small>(H2)</small></span>
				</h2>
			</a>
			<a href="#control" class="h" data-cmd="h3">
				<h3 style="display: inline-block;">
					中見出し <span style="color: #AAA;"><small>(H3)</small></span>
				</h3>
			</a>
			<a href="#control" class="h" data-cmd="h4">
				<h4 style="display: inline-block;">
					小見出し <span style="color: #AAA;"><small>(H4)</span>
				</h4>
			</a>
			<a href="#control" class="h" data-cmd="p">
				<p style="display: inline-block;margin: 0;padding: 0;">
					段落 <span style="color: #AAA;"><small>(P)</small></span>
				</p>
			</a>

			<div></div>

			<!-- その他の編集 Other edits -->
			<a href="#control" class="clist" data-cmd="bold"><b>B</b></a>
			<a href="#control" class="clist" data-cmd="italic"><i>I</i></a>
			<a href="#control" class="clist" data-cmd="underline"><u>U</u></a>
			<a href="#control" class="clist" data-cmd="strikeThrough"><s>S</s></a>

			<a href="#control" class="clist" data-cmd="justifyLeft">right</a>
			<a href="#control" class="clist" data-cmd="justifyCenter">center</a>
			<a href="#control" class="clist" data-cmd="justifyRight">left</a>
			<a href="#control" class="clist" data-cmd="justifyFull">full</a>

			<a href="#control" class="clist" data-cmd="indent">in</a>
			<a href="#control" class="clist" data-cmd="outdent">out</a>

			<a href="#control" class="clist" data-cmd="insertUnorderedList">list</a>
			<a href="#control" class="clist" data-cmd="insertOrderedList">list-num</a>

			<a href="#control" class="clist" data-cmd="createlink">link</a>
			<a href="#control" class="clist" data-cmd="unlink">un-link</a>
			<a href="#control" class="clist" data-cmd="insertimage">image</a>
			<a href="#control" class="clist" data-cmd="superscript">up</a>
			<a href="#control" class="clist" data-cmd="subscript">down</a>
		</div>

		<div style="position: absolute;top: 0;right: 5px;padding: 5px;font-size: 10px;" class="button" id="no_fix">
			コントロールパネルを固定する<br>
			Fix the control panel
		</div>
	</div>

	<!-- コントロールボックス CONTROL BOX -->
	<div id="control_box"></div>

	<!-- 記事作成メインコンテンツ MAIN CONTENTS -->
	<div id="main_contents">
		<!-- 編集エリア EDIT AREA -->
		<div id="editarea" contenteditable><span id="first_text" style="color: #AAA;">文章を入力 Enter text</span></div>

		<!-- 画像選択 IMAGE SELECT -->
		<div id="image_list">
			<div style="text-align: center;">
				<b>画像選択<br>Image selection</b>
				<div style="height: 10px;"></div>
				<div id="image_list_in"></div>
			</div>


		</div>
	</div>

	<!-- メタデータ META DATA -->
	<div id="meta_data">
		<div id="tag_input">
			<div style="position: relative;width: 700px;left: 50%;transform: translate(-50%, 0%);">
				<!-- タグ入力 TAG INPUT -->
				<span style="display: inline-block;width: 200px;text-align: center;">
					タグ Tags
				</span>
				
				<input type="text" id="tag" class="input" style="width: 400px;" placeholder="ex) tag,blog,press">
				
				<div style="height: 20px;"></div>

				<!-- カテゴリ入力 CATEGORY INPUT -->
				<span style="display: inline-block;width: 200px;text-align: center;">
					カテゴリー Category
				</span>

				<input type="text" id="cat" class="input" style="width: 400px;" placeholder="ex) programming">
			</div>
		</div>
		
		<!-- 公開状態 Published state -->
		<div id="public_input" style="text-align: center;margin-top: 40px;">
			<input type="checkbox" name="public" id="public">
			<label for="public">記事を公開する Publish article</label>
		</div>

		<div style="text-align: center;">
			<!-- エラー Error text -->
			<div id="error"></div>
			
			<!-- 保存状態 Save state -->
			<div id="save_text" style="text-align: center;"></div>
			
			<!-- 保存ボタン Save button -->
			<span id="save" class="button" style="padding: 20px 50px;"><b>保存する Save</b></span>
		</div>
	</div>

	<div style="height: 100px;"></div>

	<!-- 画像アップロード IMAGE UPLOAD -->
	<div id="image_select">
		<!-- 背景 Background -->
		<div id="image_select_bg"></div>

		<!-- 内容 Contents -->
		<div id="image_select_in">
			<form id="upload_img_form" method="post" enctype="multipart/form-data">
				<!-- 入力ファイル Input file -->
				<input type="file" name="upload_file" id="upload_img" style="display: none;">
				<label for="upload_img" id="upload_img_label">ファイルを選択 Select files</label>
				
				<div style="height: 20px;"></div>

				<!-- アップロードボタン Upload button -->
				<a class="button" id="upload_img_button">
					アップロード Upload
				</a>
			</form>
		</div>
	</div>
</body>
</html>
