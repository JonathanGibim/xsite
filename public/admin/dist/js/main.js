function marcarTodos(cod_item){
	if ( $("#marca-todos-"+cod_item).prop('checked') ){
		$(".marca-todos-"+cod_item).prop("checked", true);
	}else{
		$(".marca-todos-"+cod_item).prop("checked", false);
	}
}