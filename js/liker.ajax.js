jQuery(document).ready(function(){
	jQuery('body').on('click','.idev-post-like',function(event)
		{
			event.preventDefault();
			liker=jQuery(this);
			post_id=liker.data("post_id");
			liker.html('');
			jQuery.ajax({
				type:"post",url:ajax_var.url,
				data:"action=idev-post-like&nonce="+ajax_var.nonce+"&idev_post_like=&post_id="+post_id,
				success:function(count){
					if(count.indexOf("count")!==-1){
						var lecount=count.replace("count","");
						if(lecount==="0"){
							lecount="0";
						}
						liker.prop('title','Like');
						liker.removeClass("liked");
						liker.html('<i class="far fa-thumbs-up"></i>')
					}else{
						liker.prop('title','liked');
						liker.addClass("liked");
						liker.html('<i class="far fa-thumbs-up"></i>')
					}
				}
			})
		}
)});