@extends('layouts.default')
@section('content')

<div class="container">
  <div class="row mb-4" style="margin-top: 30px">
    <h3><i class="fas fa-user fa-fw"></i>Autenticar</h3>
  
 
   </div>
   
      <div style="margin-left: 100px;">
      @foreach ($errors->all() as $error)
        <ul class="nav flex-column"> 
        <li class="nav-item"> <span class="help-block text-danger"><strong>{{ $error }}</strong> </span> </li>
        
        </ul>
    @endforeach
	</div>
   
   
   <div class="row mb-4">
   

	<div class="col-md-5 detail-grid-col" style="background-color: Gainsboro; margin: 10px">
		<h3>Logar no site</h3>
    <div class="row mb-4" style="margin: 20px;" >
	     <div class="col-md-12">
	  
	    	 
	 
	    
	    	<form role="form" action="{{ route('login') }}" class="form" method="post">
			 {{ csrf_field() }}
			 <input type="hidden" name="token" value="{!! Config::get('api.v1.token') !!}">
			 <input type="hidden" name="loginidempresa" id="loginidempresa" value="">
			 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                       <input  type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                       
                              
                    </div>
              </div>   
			 
    			 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                        <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
        			       <input  type="password" class="form-control" name="password" required>

                    	</div>
                    
            	</div>
            	
            	
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
            	
				
             	
                 
             
             	
        
               
					
					
					<button type="submit" class="btn btn-primary btn-lg">Entrar</button>
					 <a class="btn btn-link" href="{{ route('password.request') }}">
                                   Esqueceu a senha?
                                </a>
				
            </form>
	     </div>
	    
     </div>
     
     
   
		 
	</div>
    <div class="col-md-5 detail-grid-col" style="background-color: Gainsboro; margin: 10px">
    
    <h3>Não cadastrado? Registre-se</h3>
    <div class="row mb-4" style="margin: 20px;" >
	     <div class="col-md-12">
	      
	     
	    	 

	    	 	<form role="form" action="{{ route('register') }}" class="form" method="post">
	    	 	 {{ csrf_field() }}
	    	 	 <input type="hidden" name="token" value="{!! Config::get('api.v1.token') !!}">
				 <input type="hidden" name="idempresa" id="idempresa" value="">
			 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                    <label for="name" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    </div>
              </div>   
			 
			 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                       <input  type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                             
                    </div>
              </div>   
			 
    			 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                        <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
        			       <input  type="password" class="form-control" name="password" required>

                               
                    	</div>
                    
            	</div>
            	
            	 <div class="form-group row">
                        <label for="confirma" class="col-sm-2 col-form-label">Confirma</label>
                        <div class="col-sm-10">
        			     	 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    	</div>
                    
            	</div>
            	
            	<div class="form-group row">
                            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                              <input id="telefone" type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" required>
        
                            </div>
             		 </div>
            	
				
             	 <div class="form-group row">
             	  		<label for="cep" class="col-sm-2 col-form-label">Cep</label>
                        <div class="col-sm-10">
        			     	  <div class="input-group"> 
                    	    	 <input type="text" id="cep" name="cep"  value="{{ old('cep') }}"  onchange="getcep(this.value)" class="form-control" size="8" placeholder="Digite o CEP"> 
                    	    	  <div class="input-group-append">
                    	    	  	<button type="button" class="btn btn-primary" onclick="getcep(cep.value)">Buscar</button>
                    	    	  </div>
                	    	  	</div>
                    	</div>
             	    </div>
                 	
                 	
                 	 <div class="form-group row">
                            <label for="rua" class="col-sm-2 col-form-label">Rua</label>
                            <div class="col-sm-10">
                              <input id="rua" type="text" class="form-control" name="rua" value="{{ old('rua') }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 	 <div class="form-group row">
                            <label for="numero" class="col-sm-2 col-form-label">Numero</label>
                            <div class="col-sm-10">
                              <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}"  required>
        
                            </div>
             		 </div>
             		 
             		 <div class="form-group row">
                            <label for="rua" class="col-sm-2 col-form-label">Bairro</label>
                            <div class="col-sm-10">
                              <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 
             		  <div class="form-group row">
                            <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                            <div class="col-sm-10">
                              <input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}" required readonly>
        
                            </div>
             		 </div>
             		 
             		 <div class="form-group row">
                            <label for="uf" class="col-sm-2 col-form-label">UF</label>
                            <div class="col-sm-10">
                              <input id="uf" type="text" class="form-control" name="uf" value="{{ old('uf') }}" required readonly>
        
                            </div>
             		 </div>
        
               
					
					
					<button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
				
            </form>
	     </div>
	   
     
     
   
		 
	  
	  </div>

	  
  </div>
</div>
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