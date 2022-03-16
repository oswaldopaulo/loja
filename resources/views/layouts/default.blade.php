<!doctype html>
<html lang="pt_BR">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lojinha Ja Guara</title>
<link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('vendor/fontawesome-free-5.13.1-web/css/all.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css')  }}">
   <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
      .box-cookies.hide {
      display: none !important;
    }
    
    .box-cookies {
      position: fixed;
      background: rgba(0, 0, 0, .9);
      width: 100%;
      z-index: 998;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .box-cookies .msg-cookies,
    .box-cookies .btn-cookies {
      text-align: center;
      padding: 25px;
      color: #fff;
      font-size: 18px;
    }
    
    .box-cookies .btn-cookies {
      background: #1e88e5;
      cursor: pointer;
      align-self: normal;
    }
    
    @media screen and (max-width: 600px) {
      .box-cookies {
        flex-direction: column;
      }
    }
    </style>
    
    
    
    <script src="{{ asset ('js/jquery-3.5.1.slim.min.js') }}" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="{{ asset('js/vendor/jquery.slim.min.js') }}"><\/script>')</script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset ('js/jquery.cookie.js') }}"></script>


</head>
<body>
<header>
<!-- Menu Cockie -->

<div class="box-cookies hide">
   <p class="msg-cookies">Este site usa cookies para garantir que você obtenha a melhor experiência.</p>
    <div>
                               <a href="http://localhost:8000/privacy" target="new">Privacy Policy</a>
                                &middot;
                                <a href="http://localhost:8000/condicoes" target="new">Terms &amp; Conditions</a>
                            </div>
   <button class="btn-cookies">Aceitar!</button>
</div>

<!-- Menu come�a aqui -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand">Ja Guara</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample03">
  
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
      </li>
           

    </ul>
         <form class="form-inline my-2 my-md-0">
         	<div class="input-group"> 
         
                      <input id="search"class="form-control" type="text" placeholder="Search">
                       <div class="input-group-append">
                        <button class="btn btn-primary"  onclick="pesquisar()"><i class="fas fa-search"></i></button>
                    </div>
           </div>
    </form>
    <ul class="navbar-nav">
    

        <li class="nav-item dropdown">
        @auth
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user">{{ Auth::user()->name }}</i> </a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
        
  
      <a class="dropdown-item" href="{{ url('profile') }}">Profile </a>
          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                 </form>
  
  
   		
   	
        </div>
        @else
        
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user">Entrar</i> </a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
        
     <a class="dropdown-item" href="{{ route('login') }}">Entrar / Registar </a>
      
     
        
   	</a>
        
   		 @endauth
      </li>
    
     <li class="nav-item">
      <a class="nav-link" href="{{ url('carrinho') }}"><span class="text-primary" id="carrinhoqtd"></span><i class="fas fa-cart-plus fa-fw"></i> Carrinho <span class="text-primary" id="carrinhopreco"></span></a>
      </li>
      
  
      </ul>
   
  </div>
</nav>


<!-- Menu termina aqui -->

</header>
<body>
    <main role="main">
   		 @yield('content')
    </main>
</body>

<footer class="container py-5">
  
  
   <div class="row mb-4">
       
      <div class="card-body">
   
     
        <h6 class="card-title" id="footerEmpresa">Empresa</h6>
        <p class="card-text"><strong>CNPJ:</strong> <span id="footerCnpj"></span> <strong>Endereço:</strong> <span id="footerEndereco"></span>, <span id="footerNum"></span> <span id="footerBairro"></span> <span id="footerCidade"></span>-<span id="footerUf"></span>.</p>
     
      </div>
   
   </div>
</footer>



<script type="text/javascript">


fetch("{{ Config::get('api.v1.url') }}/empresa/{!! Config::get('api.v1.token') !!}" ).then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	      
	      
	     
	    	//p = json.Produtos;
	    	
	    	if(document.getElementById("idempresa"))  idempresa.value = json.id;
	    	if(document.getElementById("loginidempresa"))  idempresa.value = json.id;
	    	
	    	 $("#footerEmpresa").html(json.nome);
	    	 $("#footerCnpj").html(json.cpf);
	    	 $("#footerEndereco").html(json.des_end);
	    	 $("#footerNum").html(json.num_end);
	    	 $("#footerBairro").html(json.bairro);
	    	 $("#footerCidade").html(json.des_cidade);
	    	 $("#footerUf").html(json.des_uf);

	    		
	    
	    	 
	    	 //$("#capa").src("ImagensServlet?id=" + p[0].ID);
	    	 
	    	
	    	 
	    });
	  } else {
	    console.log("Oops, we haven't got JSON!");
	  }
	});
	
</script>
<script type="text/javascript">

function remove_carrinho(id){


	var test = false;
	var total = 0;
	$.cookie.json = true;

		
	t = $.cookie('produtos');
	count = t.length;

	for (var i = 0; i < t.length; i++){
   		 
   		 
		  if (t[i].idloja == id){
   				t.splice(i, 1);
   		  } 
   	
	}

	for (var i = 0; i < t.length; i++){
  		 
  		 
		total += parseFloat(t[i].preco) *  parseFloat(t[i].qtd);
		
   		 	
	}

	
	
	$.cookie('produtos', t);
	$.cookie('total', ("R$ " + total.toFixed(2)).replace(".",","));
	$.cookie('qtd', t.length);


	window.location.href = "{{ url('carrinho') }}";
	
}

function altera_carrinho(id){


	var test = false;
	var total = 0;
	$.cookie.json = true;

		
	t = $.cookie('produtos');
	count = t.length;
	qtd = document.getElementById("qtd_" + id).value;


	if(qtd==null || qtd=="" || qtd <= 0){

		remove_carrinho(id);
		return false;

	}
	
	for (var i = 0; i < t.length; i++){
   		 
   		 
		  if (t[i].idloja == id){
   				t[i].qtd=parseFloat(qtd);;
   		  } 

		  total += parseFloat(t[i].preco) *  parseFloat(t[i].qtd);
   	
	}



	
	
	$.cookie('produtos', t);
	$.cookie('total', ("R$ " + total.toFixed(2)).replace(".",","));
	$.cookie('qtd', t.length);


	window.location.href = "{{ url('carrinho') }}";
	
}
function setsession(id){
	
	
	  if(id==0) {
		  //var arr = JSON.parse(getCookie("produtos"));
	     	//console.log(arr);
	     	
	     	//$.removeCookie('produtos')
	    	 $('#carrinhoqtd').empty();
			$('#carrinhoqtd').append($.cookie('qtd')?$.cookie('qtd'):"");
			
			$('#carrinhopreco').empty();
			$('#carrinhopreco').append("R$ " + $.cookie('total')?$.cookie('total'):0);
			 return false;
	  }
	
	  fetch("{{ Config::get('api.v1.url') }}/item/{!! Config::get('api.v1.token') !!}?id=" + id).then(function(response) {
	  var contentType = response.headers.get("content-type");
	  if(contentType && contentType.indexOf("application/json") !== -1) {
	    return response.json().then(function(json) {
	      // process your JSON further
	      
	      
	   		
			var test = false;
			var total = 0;
	   		$.cookie.json = true;

	   		
	   		t = $.cookie('produtos');

		
	   		
	   		json[0].qtd = 1;


	   	

	   		if(t == null){
	   			t=json;
	   			total += parseFloat(json[0].preco*json[0].qtd);

	   			
		   		
	   		}	else{

	   			for (var i = 0; i < t.length; i++){
	  	   		  // look for the entry with a matching `code` value
	  	   		 
	  	   		  total += parseFloat(t[i].preco);
	  	   		  if (t[i].idloja == id){
	  	   			t[i].qtd += 1;  
	  	   		    test=true;
	  	   		  }
	   			}

				if(test==false)	{
					total += parseFloat(json[0].preco*json[0].qtd);
					t.push(json[0]);
				}
	   		}

	   	
	   		

	   		$.cookie('produtos', t);
	   		$.cookie('total', total);
	   		$.cookie('qtd', t.length);

	   		//console.log($.cookie('produtos'));
  			$('#carrinhoqtd').empty();
			$('#carrinhoqtd').append(t.length);
			
			$('#carrinhopreco').empty();
			$('#carrinhopreco').append("R$ " + total);

			window.location.href = "{{ url('carrinho') }}";
			
	    });
	  } else {
	    console.log("Oops, we haven't got JSON!");
	  }
	});
		
	
	}



setsession(0);

(() => {
  if (!localStorage.pureJavaScriptCookies) {
    document.querySelector(".box-cookies").classList.remove('hide');
  }
  
  const acceptCookies = () => {
    document.querySelector(".box-cookies").classList.add('hide');
    localStorage.setItem("pureJavaScriptCookies", "accept");
  };
  
  const btnCookies = document.querySelector(".btn-cookies");
  
  btnCookies.addEventListener('click', acceptCookies);
})();
</script>
</html>
