function setsession(id){
	
	
	
	
	
	fetch("{{ Config::get('api.v1.url') }}/loja?token={!! Config::get('api.v1.token') !!}&idloja={{ $id }}").then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	      
	      
	     if(id != 0) {
				
				document.cookie = json;
				//window.location.href = "carrinho.jsp";
	    	}
	     	
	     	
	     	console.log(document.cookie)
	    	

  			$('#carrinhoqtd').empty();
			$('#carrinhoqtd').append(json.conta);
			
			$('#carrinhopreco').empty();
			$('#carrinhopreco').append("R$ " + json.valor);
	    	
			
	    	 
	    });
	  } else {
	    console.log("Oops, we haven't got JSON!");
	  }
	});
		
	
	}
		

setsession(0)