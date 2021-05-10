<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
 <%@ page session="true" %>
<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">
<title>Lojinha Ja Guara</title>
<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="vendor/fontawesome-free-5.13.1-web/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/estilo.css">
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
    </style>
</head>
<body>
<header>
<!-- Menu começa aqui -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand">Ja Guara</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample03">
  
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.jsp">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contatos</a>
      </li>
     

    </ul>
         <form class="form-inline my-2 my-md-0">
      <input id="search"class="form-control" type="text" placeholder="Search">
       <div class="input-group-append">
                        <button class="btn btn-primary"  onclick="pesquisar()"><i class="fas fa-search"></i></button>
                    </div>
    </form>
    <ul class="navbar-nav">
    

        <li class="nav-item dropdown">
         <% if( session.getAttribute("username") != null) {%>
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"><%= session.getAttribute("username") %></i> </a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
        
     <% if(session.getAttribute("admin").equals("1"))  { %>
     		   <a class="dropdown-item" href="produtos.jsp">Produtos </a>
     <% } %>
      <a class="dropdown-item" href="profile.jsp">Profile </a>
          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="LoginServlet" method="POST" style="display: none;">



                                          <input type="hidden" value="1" name="logout">



                                 </form>
  
  
   		
   	
        </div>
        <% }  else {%>
        
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user">Entrar</i> </a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
        
     <a class="dropdown-item" href="login.jsp">Entrar / Registar </a>
      
     
        
   	</a>
        
   		<% } %>
      </li>
    
     <li class="nav-item">
      <a class="nav-link" href="carrinho.jsp"><span class="text-primary" id="carrinhoqtd"></span><i class="fas fa-cart-plus fa-fw"></i> Carrinho <span class="text-primary" id="carrinhopreco"></span></a>
      </li>
      
  
      </ul>
   
  </div>
</nav>


<!-- Menu termina aqui -->

</header>
<main role="main">
