$(document).ready(function(){
	/* Autoload User-Interface divs */
	$("div.ui").each(function uisetup(i,elem){
		$('#'+elem.id.replace(/\//g, '\\/')).load(
			$(location).attr('href').replace(/\/*$/, '/')+elem.id,
			function(){
				$("div.ui", 'div#'+this.id).each(uisetup);
			}
		);
		/* Internal links */
		$("a.ui").each(function(){
			var url=$(this).attr('href');
			var target=$(this).attr('target');
			if(url.substring(0,1)=='#'){
				this.href=$(location).attr('href').replace(/\/*$/, '/')+url.substring(1);
			};
			if(target!==undefined){
				$(this).click(function(e){
					$('#'+this.target).load(this.href);
					e.preventDefault();
				});
			};
		});
	});

});

