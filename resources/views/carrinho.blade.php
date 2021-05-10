@extends('layouts.default')
@section('content')
<div class="container">
  <div class="row mb-4" style="margin-left: 20px; margin-top: 50px; margin-right: 20px">
    <h3><i class="fas fa-cart-plus fa-fw"></i> Meu Carrinho</h3>
   </div>
   <form role="form" action="{{ url('checkout') }}" class="form" method="post">
   {{ csrf_field() }}
   <div class="row mb-4" style="margin-left: 20px; margin-top: 50px; margin-right: 20px">
   
	
	<div class="col-md-8 detail-grid-col">
		<div class="col-md-12">
			<div class="row mb-4" style="border-bottom: 1px solid;" >
			     <div class="col-md-5">
			    	 Produto
			     </div>
			      <div class="col-md-3">
			    	 Qtd
			     </div>
			       <div class="col-md-1">
			    	 X
			     </div>
			      <div class="col-md-2">
			    	 Preço
			     </div>
			  </div>
	     </div>
	     
	     <div class="col-md-12" id="produtos">
		
			  
	     </div>
	</div>
    <div class="col-md-4 detail-grid-col" style="background-color: Gainsboro;">
    
    
    
    <h3>Endereço de Entrega</h3>
    <div class="row mb-4" style="margin: 2px;margin-top: 10px ;border-bottom: 1px solid;" >
    	
    	
	     <div class="col-md-2">
	    	 <label for="cep">Cep</label> 
	     </div>
	     
	     
	      <div class="col-md-10" style="text-align: right;">
	    	 <div class="input-group"> 
    	    	 <input type="text" id="cep" name="cep" class="form-control" size="8" placeholder="Digite o CEP"> 
    	    	  <div class="input-group-append">
    	    	  	<button type="button" class="btn btn-primary" onclick="getcep(cep.value)">Calcular</button>
    	    	  </div>
	    	  </div>
	     </div>
	     
	      
     </div>
    
    <h3>Resumo do Pedido</h3>
    <div class="row mb-4" style="margin: 20px; border-bottom: 1px solid;" >
	     <div class="col-md-8">
	    	 Subtotal
	     </div>
	      <div class="col-md-4" style="text-align: right;">
	    	 <div id="valor"> R$ 999,99</div>
	     </div>
	       <div class="col-md-4">
	    	 Frete
	     </div>
	      <div class="col-md-8" style="text-align: right;" id="frete">
	    	 
	    	
	     </div>
     </div>
     
     
   
    <div class="row mb-4" style="margin-left: 20px; margin-right: 20px; margin-top: 0px" >
	     <div class="col-md-4">
	    	 <h5>Total</h5>
	     </div>
	      <div class="col-md-8" style="text-align: right;">
	    	 <h5> <span id="total"> R$ 999,99 </span></h5>
	     </div>
	      
     </div>
     
     
     <h3>Forma de Pagamento</h3>
    <div class="row mb-4" style="margin: 20px; border-bottom: 1px solid;" >
    	
    	
	     <div class="col-md-12">
	     		<input type="radio" name="formapgto" value="1" checked>
	    	 <label for="formapgto">Paypal</label> 
	     </div>
	     
	     
	     
	      
     </div>
     
		 
		    <button type="submit" class="btn btn-danger btn-lg" style="width: 80%; margin-left: 10%; margin-right: auto; "> <i class="fas fa-cart-plus fa-fw"></i> Continuar </button>
		    <p style="margin-left: 10%; margin-right: 20px; margin-top: 20px;"><a href="{{ url('/') }}"> Continuar Comprando</a> </p>
		        
		    
		 
	  
	  </div>

	  
  </div>
  </form>
</div>
  <script type="text/javascript">
  	$.cookie.json = true;
	t = $.cookie('produtos');

	orderAddRow(t)
	

	
	function orderAddRow($data) {
		var valor = 0;
	    $.each($data,function(index,value) {
	    	
	    	valor += value.preco * value.qtd;
	        
	 
	            
	        var row = 	"<div class=\"row mb-4\" style=\"border-bottom: 1px solid;\" >"
		     + "<div class=\"col-md-5\">"
		     
			+	"<input type=\"hidden\" name=\"idloja[]\" value=\"" +  value.idloja + "\">"
		    +	"<img src=\"{{ Config::get('api.v1.pics') }}/getbyitem/" +  value.produto.id + "\" alt=\"imagem do produto\" class=\"img-thumbnail\" style=\"width: 75px;height: autopx;  float: left; margin-right: 10px\"/>"
		    	
			+   "<h6>" + value.produto.descricao + "</h6>"
		   // +	"<p>descricao</p>"
		    + "</div>"
		    +  "<div class=\"col-md-3\">"
		    +      "<div class=\"input-group\">" 
		    	+			 "<input name=\"qtd[]\" id=\"qtd_" +  value.idloja + "\" type=\"number\" class=\"form-control\" value=\"" + value.qtd + "\" style=\"width: 20px\" />"
		    +	"<div class=\"input-group-append\">"
	    	+  	"<button type=\"button\" class=\"btn btn-success\" onclick=\"altera_carrinho(" +  value.idloja + ")\"><i class=\"fas fa-sync-alt\" aria-hidden=\"true\"></i></button>"
	    	+  "</div>"
		    	
		    	 + "</div>"
		    + "</div>"
		    +   "<div class=\"col-md-1\">"
		    +	"<a href=# onclick=\"remove_carrinho(" +  value.idloja + ")\" ><i class=\"far fa-trash-alt fa-2x\"></i></a>"
		    + "</div>"
		    +  "<div class=\"col-md-2\">"
		    +	 "R$ " + ((value.preco * value.qtd).toFixed(2)).replace(".",",") + ""
		    + "</div>"
		  +   "</div>";
  	            
	        		$('#produtos').append(row);
  	          
	    });
	    
	    $('#valor').empty();
		$('#valor').append(("R$ " + valor.toFixed(2)).replace(".",","));
		
		$('#total').empty();
		$('#total').append(("R$ " + valor.toFixed(2)).replace(".",","));
	
		
	}
  </script>
  
 <script type="text/javascript">
 function getcep(cep){

		$('#frete').empty();
		
		if(cep==''){
			$('#frete').append("CEP em branco");
			return false;
		
		}
	 fetch("{{ Config::get('api.v1.micro') }}/frete/{!! Config::get('api.v1.token') !!}/" + cep   ).then(function(response) {
		  var contentType = response.headers.get("content-type");
		  if(contentType && contentType.indexOf("application/json") !== -1) {
		    return response.json().then(function(json) {
		      // process your JSON further
		    		
		   		//console.log(json);
				orderAddRow(json)
				
				
		    });
		  } else {
		    console.log("nada");
		  }
		});

		

 }

	function orderAddRow($data) {
	    $.each($data,function(index,value) {

	    	if(value.resultado==1){
    	    	 var row = "<p> <input type=\"radio\" name=\"frete\" onchange=\"calcular("+ value.valor +")\" value=\"" + value.tipo + "|" +  value.valor + "\"> " + value.tipo.toUpperCase() + " " + value.valor_rs + "</p>";
                
        		$('#frete').append(row);
	    	} else {

	    		$('#frete').append(value.resultado_txt);
	    		return false;

	    	}
	
	       // console.log(value.tipo);
	          
	    });
	}


 	function calcular(frete){
 		$.cookie.json = true;

 
		var valor =  $.cookie('total');

		valor = valor.replace("R$ ","")
		valor=parseFloat(valor);
		
	
		valor +=  parseFloat(frete);
 		$('#total').empty();
		$('#total').append(("R$ " + valor.toFixed(2)).replace(".",","));
 	 	
 	}
</script>
  
  
@endsection