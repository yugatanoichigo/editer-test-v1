$(function() {
	//コントロールパネルの固定フラグ Fixed flag on control panel
	var ctr_fix_flg = 0;

	//画像リストの取得 Get image list
	setTimeout(function() { image_list(); }, 500);

	/* ################ 編集要素のアイコン Edit element icon ################### */
	$('.clist').each(function(i, e) {
		var cmd = $(e).data('cmd');

		if (cmd != 'h2' && cmd != 'h3' && cmd != 'h4' && cmd != 'h5' && cmd != 'p') {
			$(e).css({'background-image':'url(./images/'+cmd+'.png)'});
		}

		$(e).text('');
	});

	/* ################ 編集エリアクリック時 When editing area is clicked ################### */
	$('#editarea').on('click', function() {
		if ($('#first_text').length) {
			$('#first_text').remove();
		}
	});
	
	/* ################ 編集要素 Edit element ################### */
	$('.clist, .h').on('click', function(e) {
		var cmd = $(this).data('cmd');

		if (cmd == 'h2' || cmd == 'h3' || cmd == 'h4' || cmd == 'h5' || cmd == 'p') {
			document.execCommand('formatBlock', false, cmd);
		} else if (cmd == 'forecolor' || cmd == 'backcolor') {
			document.execCommand(cmd, false, $(this).data('value'));
		} else if (cmd == 'createlink') {
			var url = prompt('URLを入力してください Enter the link here:', 'https://');

			document.execCommand(cmd, false, url);
		} else if (cmd == 'insertimage') {
			$('#image_select').fadeIn(500);
		} else {
			document.execCommand(cmd, false, null);
		}
	});

	//画像のアップロード Upload image
	$('#upload_img_button').on('click', function() { file_upload(); });

	/* ################ 画像の挿入 Insert image ################### */
	$(document).on('click', '.image_lists', function() {
		var src = $(this).find('img').attr('src');
		document.execCommand('insertimage', false, src);
	});

	/* ################ コントロールパネルの固定 Fixing the control panel ################### */
	//コントロールパネルのTOPを取得 Get control panel top
	var ctr_top = $('#control').offset().top;
	var ctr_flg = 0;

	$(window).scroll(function() {
		var sc = $(this).scrollTop();

		if (ctr_fix_flg) {
			//コントロールパネルを固定する Fix the control panel
			if (sc >= ctr_top) {
				if (ctr_flg == 0) {
					ctr_flg = 1;

					$('#control').css({'position':'fixed', 'top':'0px'});
					$('#control_box').show();
					$('#control_box').css({'height':($('#control').height()+60)+'px'});
				}

			//コントロールパネルの固定を解除する Does not fix the control panel
			} else {
				if (ctr_flg == 1) {
					ctr_flg = 0;

					$('#control').css({'position':'relative', 'top':'0px'});
					$('#control_box').hide();
				}
			}
		}
	});

	/* ################ コントロールパネルを固定しない Do not fix the control panel ################### */
	$('#no_fix').on('click', function() {
		$('#control').css({'position':'relative', 'top':'0px'});
		$('#control_box').hide();

		//固定フラグを変更 Change fixed flag
		if (ctr_fix_flg == 0) {
			ctr_fix_flg = 1;

			$(this).html('コントロールパネルを固定しない<br>Do not fix the control panel');
		} else {
			ctr_fix_flg = 0;

			$(this).html('コントロールパネルを固定する<br>Fix the control panel');
		}
	});

	/* ################ 保存する Saving data ################### */
	$('#save').on('click', function() { save(); });
});

/* #############################################################
 * ファイルのアップロード Upload files
 * ############################################################# */
function file_upload() {
	var formdata = new FormData($('#upload_img_form').get(0));

	$.ajax({
		url: './file_upload.php',
		type: 'POST',
		data: formdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'html'
	}).done(function(data, textStatus, jqXHR){
		console.log(data);

		$('#image_select').fadeOut(500);

		//画像リストの表示・更新 Show / Update of image list
		setTimeout(function() { image_list(); }, 500);

	}).fail(function(jqXHR, textStatus, errorThrown){
		alert('file_upload::fail');
	});
}

/* #############################################################
 * 画像リストの表示・更新 Show / Update of image list
 * ############################################################# */
function image_list() {
	//画像のパス Image path
	var image_path = './data/images/';

	//現在表示している画像要素を削除 Delete the currently displayed image element
	$('.image_lists').remove();

	//画像リストの取得 Get image list
	$.ajax({
		url: 'get_file_list.php',
		type: 'POST',
		data: {'path': image_path}
	}).done(function(data) {
		image_names = data.split('##');

		for(i = 0; i < image_names.length - 1; i++) {
			//画像を追加 Add image
			$('#image_list_in').append('<a href="#control" class="image_lists"><img src="' + image_path + image_names[i] + '" class="image_lists"></a>');
		}
	}).fail(function() {
		alert('get_file_list::fail');
	});
}

/* #############################################################
 * 保存 Saving data
 * ############################################################# */
function save() {
	//データファイルを保存するパス Path to save data file
	var save_file_path = './data/';

	var title  = $('#page_title').val();		//タイトル Title
	var id     = $('#article_id').val();		//記事ID Article ID
	var public = $('#public').prop('checked');	//公開状態 Published state
	var tag    = $('#tag').val();				//タグ Tag
	var cat    = $('#cat').val();				//カテゴリ Category
	var conte  = $('#editarea').html();			//記事 Article

	//コンソールに出力 Output to console
	console.log('## ↓ ↓SAVE↓ ↓ ##')
	console.log('title:'+title);
	console.log('id:'+id);
	console.log('public:'+public);
	console.log('tag:'+tag);
	console.log('cat:'+cat);
	console.log('conte:'+conte);
	console.log('## ↑ ↑SAVE↑ ↑ ##')

	if (id != '') {
		//データの保存 Saving data
		$.ajax({
			url: 'save_data.php',
			type: 'POST',
			data: {
				'path':save_file_path,
				'title':title,
				'id':id,
				'public':public,
				'tag':tag,
				'cat':cat,
				'conte':conte
			}
		}).done(function(data) {
			console.log(data);

			$('#save_text').show();
			$('#save_text').html('保存しました<br>Saved');
			$('#error').hide();

			setTimeout(function() {
				$('#save_text').fadeOut(500);
			}, 3000);
		}).fail(function() {
			alert("save::fail");
		});
	} else {
		//エラーの表示 Displaying errors
		$('#error').show();
		$('#error').html('記事IDを入力してください!!<br>Please enter the article ID!!');
	}
}
