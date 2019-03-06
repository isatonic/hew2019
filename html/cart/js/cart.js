function submit_delete(){
	if(window.confirm('カートから削除します。\nよろしいですか？')){
		var target = document.getElementById("form201");
		target.method = "post";
		target.submit();
	}
}

function submit_itemsGO(){
		var target = document.getElementById("form301");
		target.method = "post";
		target.submit();
	
}