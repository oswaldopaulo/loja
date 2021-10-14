fetch("{{ Config::get('api.v1.url') }}/loja/{!! Config::get('api.v1.token') !!}").then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	    
	    	orderAddRow(json)
	    });
	  } else {
	    console.log("Oops, we haven't got JSON!");
	  }
	});
	
	

	function orderAddRow($data) {
	    $.each($data,function(index,value) {
	     
	    			if(value.demanda > 0 ){
						btn = "<button type=\"button\" id=\"bt-carrinho\" onclick=\"setsession(" +  value.idloja + ")\" class=\"btn btn-danger\"> <i class=\"fas fa-cart-plus fa-fw\"></i> Comprar </button>";
	    			} else {
	    				btn = "<button type=\"button\" id=\"bt-carrinho\"  class=\"btn btn-secondary\"> <i class=\"fas fa-cart-plus fa-fw\"></i> Esgotado </button>";

	    			}

					var fpreco = parseFloat(value.preco);
				
					      
			var row = "<div class=\"col-md-3 themed-grid-col text-left\">"	
    						 + "<div class=\"card\">"

    						 +"<a href=\"{{ url('details') }}/" + value.idloja + "?produto="+  value.produto.id + "\">"
    						 +	"<img src=\"{{ Config::get('api.v1.pics') }}/getbyitem/" +  value.produto.id + "\" alt=\"figura produto\" width=100% height=auto/></a>"
      						
    						 + "<div class=\"card-body\">"
    						 +   "<h5 class=\"card-title\"><a href=\"{{ url('details') }}/" + value.idloja + "?produto="+  value.produto.id + "\">" + value.produto.descricao + "</a></h5>"
    						 
    					
    						 +  "<h2> R$ " +  (fpreco.toFixed(2)).replace(".",",") +  "</h2>"
    						 +   btn
    						 + "</div>"
    						+ "</div>"
						+ "</div>";
	   
  	            
	        		$('#produtos').append(row);
  	          
	    });
	}