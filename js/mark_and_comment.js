function enterMark(self, id) {
	par = $(self).parent();
	par.html("" + 
		// "<text>Оцените</text>" +
		"<div id=\"rating\">" +
			// "<input type=\"hidden\" name=\"vote-id\" value=\"1\">" +
		"</div>");
	$('#rating').rating({
		row_id: id,
        fx: 'half',
        image: 'images/stars.png',
        loader: 'images/ajax-loader.gif',
        url: 'lib/ajax.php',
        callback: function(responce){
        	console.log(responce);
            this.vote_success.fadeOut(2000);
        }
    });
}

function enterComment(id) {
	alert("enterComment\nid=" + id);
}

function deleteOrder(id) {
	alert("deleteOrder\nid=" + id);
	//alert($('#grid-basic').bootgrid().data('.rs.jquery.bootgrid'));
	//alert(but);
	//alert(but.parentElement.nodeName);
	//alert(JSON.stringify($('#grid-basic').bootgrid().data('.rs.jquery.bootgrid')));
	//document.getElementById("bb1").hide();
	//alert();
}

function confirmOrder(id) {
	alert("confirmOrder\nid=" + id);
}