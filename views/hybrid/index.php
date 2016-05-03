<?php
/**
 * @var yii\web\View $this
 */
$this->title = yii::t('hybrid', 'title');
use yii\helpers\Url;
?>

<script type="text/javascript" language="javascript">

	function reinitIframe() {
		var iframe = document.getElementById("iframepage");
		var container = document.getElementById("right_container");
		try{
			var bHeight = 0;// iframe.contentWindow.document.body.scrollHeight;
			var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
			var height = Math.max(bHeight, dHeight);
			iframe.height = height;
			container.style.height = height + "px";
		} catch (ex){}
	}

	var timer1 = window.setInterval("reinitIframe()", 500); //定时开始

	function reinitIframeEND(){
		reinitIframe();

		var loading = document.getElementById("loading");
		loading.style.display = "none";
		window.clearInterval(timer1);

		var title = $('#iframepage').contents().attr('title');
		$('.breadcrumb .active').html(title);
		
		var home = $('#iframepage').contents().find('body').data('home');
                $('.breadcrumb .active').prev().find('a').attr('href', home);
	}

    jQuery(function($) {
		function reloadIframe() {
			var hash = location.hash;
			var url = hash.replace( /^#/, '' );
			if (!url) url = "about:blank";
			$("#iframepage").attr("src", url);
			$('.loading').show();

			reinitIframeEND();
		}

		$(window).on('popstate', reloadIframe);

		reloadIframe();
    });
</script>

<div id="right_container" style="margin:-8px 0 0 -20px;">
			<div class="loading" id="loading">加载中...</div>
			<iframe id="iframepage" style="height: 100%; width: 100%;display:;" data-id="default" frameborder="0" scrolling="auto"  onload="reinitIframeEND();"></iframe>
</div>
