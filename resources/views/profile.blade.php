@extends('layouts.default')
@section('content')
<div class="container">


  
   
      <div style="margin-left: 100px;">
      @foreach ($errors->all() as $error)
        <ul class="nav flex-column"> 
        <li class="nav-item"> <span class="help-block text-danger"><strong>{{ $error }}</strong> </span> </li>
        
        </ul>
    @endforeach
	</div>
   
  
  <div class="row mb-4" style="margin-left: 20px; margin-top: 50px; margin-right: 20px">
    <h3><i class="fas fa-cart-plus fa-fw"></i> Minhas Informações</h3>
   </div>
   
   <div class="row mb-4" style="margin-left: 20px; margin-top: 50px; margin-right: 20px">
   

	<div class="col-md-12 detail-grid-col">
		<div class="col-md-12">
			
			<ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Compras</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Endereços</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              	
              	<div class="col-md-12 detail-grid-col">
            		<div class="col-md-12">
            			<div class="row mb-4" style="border-bottom: 1px solid;" >
            			     <div class="col-md-4">
            			    	 Pedido
            			     </div>
            			      <div class="col-md-2">
            			    	 Data
            			     </div>
            			       <div class="col-md-2">
            			    	 Valor
            			     </div>
            			      <div class="col-md-4">
            			    	 Status
            			     </div>
            			  </div>
            	     </div>
            	     
            	     <div class="col-md-12" id="pedidos">
            		
            			  
            	     </div>
            	</div>
				
				
				</div>
				
				
				
              	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              	
              	
              	<div style="margin: 10px">
              	<h1>Meus Dados</h1>
              		<form role="form" action="{{ url('profile') }}" class="form" method="post">
            	    	 	 {{ csrf_field() }}
            	    	 	 <input type="hidden" name="token" value="{!! Config::get('api.v1.token') !!}">
            				 <input type="hidden" name="idempresa" id="idempresa" value="">
            			 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                  <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name}}" required autofocus>
            
                                </div>
                          </div>   
            			 
            			 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                   <input  type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
            
                                         
                                </div>
                          </div>   
            			 
                			 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                                    <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                                    <div class="col-sm-10">
                    			       <input  type="password" class="form-control" name="password">
            
                                           
                                	</div>
                                
                        	</div>
                        	
                        	 <div class="form-group row">
                                    <label for="confirma" class="col-sm-2 col-form-label">Confirma</label>
                                    <div class="col-sm-10">
                    			     	 <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                	</div>
                                
                        	</div>
                        	
            				<div class="form-group row">
                            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                              <input id="telefone" type="text" class="form-control" name="telefone" value="{{ Auth::user()->telefone }}" required>
        
                            </div>
             		 </div>
            	
				
             	 <div class="form-group row">
             	  		<label for="cep" class="col-sm-2 col-form-label">Cep</label>
                        <div class="col-sm-10">
        			     	  <div class="input-group"> 
                    	    	 <input type="text" id="cep" name="cep"  value="{{ Auth::user()->cep }}"  onchange="getcep(this.value)" class="form-control" size="8" placeholder="Digite o CEP"> 
                    	    	  <div class="input-group-append">
                    	    	  	<button type="button" class="btn btn-primary" onclick="getcep(cep.value)">Buscar</button>
                    	    	  </div>
                	    	  	</div>
                    	</div>
             	    </div>
                 	
                 	
                 	 <div class="form-group row">
                            <label for="rua" class="col-sm-2 col-form-label">Rua</label>
                            <div class="col-sm-10">
                              <input id="rua" type="text" class="form-control" name="rua" value="{{ Auth::user()->rua }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 	 <div class="form-group row">
                            <label for="numero" class="col-sm-2 col-form-label">Numero</label>
                            <div class="col-sm-10">
                              <input id="numero" type="text" class="form-control" name="numero" value="{{ Auth::user()->numero }}"  required>
        
                            </div>
             		 </div>
             		 
             		 <div class="form-group row">
                            <label for="rua" class="col-sm-2 col-form-label">Bairro</label>
                            <div class="col-sm-10">
                              <input id="bairro" type="text" class="form-control" name="bairro" value="{{ Auth::user()->bairro }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 
             		  <div class="form-group row">
                            <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                            <div class="col-sm-10">
                              <input id="cidade" type="text" class="form-control" name="cidade" value="{{ Auth::user()->cidade }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 <div class="form-group row">
                            <label for="uf" class="col-sm-2 col-form-label">UF</label>
                            <div class="col-sm-10">
                              <input id="uf" type="text" class="form-control" name="uf" value="{{ Auth::user()->uf }}" required readonly>
        
                            </div>
             		 </div>
                         	
                             
                         
                         	
                    
                           
            					
            					
            					<button type="submit" class="btn btn-primary btn-lg">Atualizar</button>
            				
           			 </form>
           			 </div>
              	
              	</div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              	
              	
              		<div class="col-md-12 detail-grid-col">
	
                    	{{ session('warning') }}
                    	
                    	<div class="card bg-light mb-3">
                          <div class="card-header"> <h5>Endereço de Entrega</h5></div>
                          <div class="card-body row col-md-12">
                          
                           <div class="col-md-4 detail-grid-col">
                                <div class="card bg-light mb-4">
                                  <div class="card-header"><input type="radio" name="cep" id="cep" value="1" onchange="getcep(this.value)" checked> {{Auth::user()->cep}} </div>
                                  <div class="card-body">
                                  <p style="margin: 0" > {{ Auth::user()->name }} </p>
                                   <p style="margin: 0" > {{ Auth::user()->rua }}, {{ Auth::user()->numero }}  </p>
                                   <p style="margin: 0" > {{ Auth::user()->bairro }} </p>
                                   <p style="margin: 0" > {{ Auth::user()->cidade }}/{{ Auth::user()->uf }}  </p>
                                  
                           
                                   
                                  </div>
                                </div>
                            </div>
                              
                          </div>
                        </div>
                      </div>
              
              
              
              </div>
            </div>
			
			
			
			
	     </div>
	     
	     <div class="col-md-12" id="produtos">
		
			  
	     </div>
	</div>
	
	
	
    
     
		 
		  
		    
		 
	  
	  </div>

	</form>  
</div>
  <script type="text/javascript">


  fetch("{{ Config::get('api.v1.url') }}/transacoes?token={!! Config::get('api.v1.token') !!}&iduser=" + {{ Auth::user()->id }}   ).then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	    		
	   		//console.log(json);
			orderAddRowPedidos(json)
			
			
	    });
	  } else {
	    console.log("nada");
	  }
	});
	

	
	function orderAddRowPedidos($data) {
		var valor = 0;
	    $.each($data,function(index,value) {
	    	
	  		if(value.status=="A"){

	  			value.status = "<a href=\"{!! Config::get('api.v1.micro') !!}/paywithpaypal/" + value.id + "\">A</a>";
	  		}
	        
	            
	            
	        var row = 	"<div class=\"row mb-4\" style=\"border-bottom: 1px solid;\" >"
		     + "<div class=\"col-md-4\">"
		     	
			+   "<h6><a href=\"#\" onclick=\"openwindows('{{ url('itens') }}/"+ value.id +"')\"> <i class=\"fa fa-eye\" aria-hidden=\"true\"></i>" + value.id+ "</a></h6>"
		   // +	"<p>descricao</p>"
		    + "</div>"
		    +  "<div class=\"col-md-2\">"
		    +	value.data_trans
		    + "</div>"
		    +   "<div class=\"col-md-2\">"
		    +	parseFloat(value.total + value.valorfrete).toFixed(2)
		    + "</div>"
		    +  "<div class=\"col-md-4\">"
		    +	 value.status
		    + "</div>"
		  +   "</div>";
  	            
	       $('#pedidos').append(row);
  	          
	    });
	    

	
	    
	}

	function openwindows(url){

		

		 newwindow=window.open(url,name,'width=560,height=340,toolbar=0,menubar=0,location=0');  
		   if (window.focus) {newwindow.focus()}
	}
  </script>
  <script type="text/javascript">
 function getcep(cep){

		$('#frete').empty();
		
		if(cep==''){
			$('#frete').append("CEP em branco");
			return false;
		
		}
	 fetch("{{ Config::get('api.v1.micro') }}/cep/{!! Config::get('api.v1.token') !!}/" + cep   ).then(function(response) {
		  var contentType = response.headers.get("content-type");
		  if(contentType && contentType.indexOf("application/json") !== -1) {
		    return response.json().then(function(json) {
		      // process your JSON further
		    		
		   		console.log(json.cep);
				//orderAddRow(json)


				if(json.cep){

					rua.value = json.logradouro
					bairro.value = json.bairro;
					cidade.value = json.localidade;
					uf.value= json.uf;

					numero.focus();

				}


			
				
				
		    });
		  } else {
		    console.log("nada");
		  }
		});

		

 }





</script>

  
  
@endsection