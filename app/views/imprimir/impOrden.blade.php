@extends('layout.base')
@section('principal')
	<?php $or = Orden::find($orden) ?>		
	<p>Bienvenido <strong>{{$or->id}}</strong></p>
@stop

