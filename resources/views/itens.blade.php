<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Itens</title>
<link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

<table class="table">
<tr>
	<th>Descrição</th>
	<th>QTD</th>
	<th>Preço</th>
	<th>Total</th>
</tr>

@foreach($t as $r)
<tr>

	<td>{{$r->description}}</td>
	<td>{{$r->quantity}}</td>
	<td>{{$r->price_unit}}</td>
	<td>{{$r->price_unit * $r->quantity}}</td>
</tr>
@endforeach

</table>

</body>
</html>