@extends('layouts.default')
@section('content')

<div class="container">
   <div class="row mb-4 header-generic">
    <h3>Detalhes do Produto</h3>
   </div>
   
   <div class="row mb-4" style="margin-left: 50px; margin-top: 50px; margin-right: 50px">
   
	<div class="col-md-4 detail-grid-col">
		<div class="mb-4">
		<img id="capa" src="{{ asset('img/500x300.png') }}" alt="imagem do produto" class="img-fluid"/>
		
		</div>
		<div id="imagens" class="mb-4">
			
		
		
		</div>
	
	</div>
    <div class="col-md-8 detail-grid-col">
    <h3 id="descricao"></h3>
    <p>
    	<i class="fas fa-star text-warning"></i>
    	<i class="fas fa-star text-warning"></i>
    	<i class="fas fa-star text-warning"></i>
    	<i class="fas fa-star text-warning"></i>
    	<i class="far fa-star"></i>
    	(6) (Cód.<span id="id"></span>)
    
    </p>
    <p id="ficha"></p>
    
    <h1 id="preco"></h1>
    <p> 10x de <span id="cartao"></span> no cartão</p>
    <input type="hidden" id="idloja">
    <button type="button" id="bt-carrinho"  class="btn btn-danger btn-lg"> <i class="fas fa-cart-plus fa-fw"></i> <span id="botao">Comprar</span></button>    
    
    </div>
	  
	  

	  
  </div>
</div>
  
  <script type="text/javascript">
  
  


fetch("{{ Config::get('api.v1.url') }}/item/{!! Config::get('api.v1.token') !!}?id={{ $id }}").then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	      
	      
	     
	    	p = json[0];
	    	 console.log(json);

	    	

	  
	    	 
	    	 $("#id").html(p.produto.id);
	    	 $("#descricao").html(p.produto.descricao);
	    	 $("#preco").html("R$ " + (parseFloat(p.preco).toFixed(2)).replace(".",","));
	    	 $("#ficha").html(p.produto.ficha);
	    	 $("#cartao").html(p.preco/10);
		
	    	 //$("#capa").src("ImagensServlet?id=" + p[0].ID);
	    	 document.getElementById("capa").src= "{{ Config::get('api.v1.pics') }}/getbyitem/" + p.produto.id;

	    	 if(p.demanda > 0 ){
	    		 document.getElementById("bt-carrinho").onclick= function() { setsession( p.idloja); }
					
 			} else {
 				document.getElementById("bt-carrinho").className="btn btn-secondary";
 				 $("#botao").html("Esgotado");

 			}
	    	 

	    	 fetch("{{ Config::get('api.v1.url') }}/pics/{!! Config::get('api.v1.token') !!}?id=" + p.produto.id).then(function(response) {
	    		
	    		  var contentType = response.headers.get("content-type");
	    		  if(contentType && contentType.indexOf("application/json") !== -1) {
	    		    return response.json().then(function(json) {
	    		      // process your JSON further
	    		    	//console.log(json);
	    		    	orderAddRow(json)
	    		    });
	    		  } else {
	    		    console.log("Oops, we haven't got JSON!");
	    		  }
	    		});
	    	 
	    });
	  } else {
	    console.log("Oops, we haven't got JSON!");
	  }
	});
	
	
	

	
	function orderAddRow($data) {
	    $.each($data,function(index,value) {
	
	            
	            var row = "<a href=\"#\" onclick=\"javascript:loadimg('" + value.id +  "')\"><img src=\"{{ Config::get('api.v1.pics') }}/getbyname/" + value.imagem +  "\" alt=\"imagem do produto\" class=\"img-thumbnail\" style=\"width: 120px;height: auto\"/></a>";
	            
	        		$('#imagens').append(row);
	          
	    });
	}
	
	function loadimg(id){
	
		if(id != null) {
		 document.getElementById("capa").src= "{{ Config::get('api.v1.pics') }}/getbyid/" + id;
		}
	}

</script>

 @endsection 
