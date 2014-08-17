@extends('layout.base')
{{--Título--}}
@section('titulo')
	<title>Detalle de orden de trabajo</title>
@stop
{{--Head--}}
{{--Header--}}
@section('header')
    {{ HTML::link('logCliente','',array('class'=>'ui-btn-right ui-corner-all','data-icon'=>'back','data-iconpos'=>'notext')); }}
@stop
{{--Primario--}}
@section('principal')
    @if($orden)
        <h3 align="center">Orden de trabajo Nro {{$orden->id}}</h3>      
        {{--Opción de la orden de trabajo--}}
        {{Form::open(array('id'=>'ordenForm'))}}
            {{--Fecha de ingreso y usuario que ingresó el equipo--}}
            <?php $sucursal = Sucursal::findOrFail($orden->Sucursal_id) ?>
            <div class="ui-grid-a ui-responsive">
                <div class="ui-block-a">
                    <div class="bloque">
                        {{Form::label('fechaIngreso','Ingreso:')}}
                        {{Form::text('fechaIngreso',date("d M Y",strtotime($orden->created_at ))." en ". $sucursal->nombre,array('data-mini'=>'true','readonly'=>'true'))}}
                    </div>                                          
                </div>
                <div class="ui-block-b">
                    <div class="bloque">
                        {{Form::label('integrante','Integrante:')}}
                        <?php $user = User::findOrFail($orden->user_id) ?>
                        {{Form::text('user',$user->nombres,array('data-mini'=>'true','readonly'=>'true'))}}
                    </div>                      
                </div>                      
            </div>
            <br><br>            
            {{--Datos del equipo--}}                                    
            <span><strong>Equipo:</strong></span><br/>
            <?php $equipo = Equipo::findOrFail($orden->equipo_id); ?>
            <div data-role="fieldcontain">
                {{Form::label('tipo','Tipo:')}}
                {{Form::text('tipo',$equipo->tipo,array('data-mini'=>'true','readonly'=>'true'))}}
            </div>
            <div data-role="fieldcontain">
                {{Form::label('marca','Marca:')}}
                {{Form::text('marca',$equipo->marca,array('data-mini'=>'true','readonly'=>'true'))}}
            </div>
            <div data-role="fieldcontain">
                {{Form::label('modelo','Modelo:')}}
                {{Form::text('modelo',$equipo->modelo,array('data-mini'=>'true','readonly'=>'true'))}}
            </div>
            <div data-role="fieldcontain">
                {{Form::label('serie','Número de serie:')}}
                {{Form::text('serie',$equipo->serie,array('data-mini'=>'true','readonly'=>'true'))}}
            </div><br/>
            {{--Problemas y accesorios--}}
            <div class="ui-grid-a ui-responsive">
                <div class="ui-block-a">
                    <div class="bloque">
                        {{Form::label('problema','Problema:')}}
                        {{Form::textarea('problema',$orden->problema,array('data-mini'=>'true','readonly'=>'true'))}}                   
                    </div>                                          
                </div>
                <div class="ui-block-b">
                    <div class="bloque">
                        {{Form::label('accesorios','Accesorios:')}}
                        {{Form::textarea('accesorios',$orden->accesorios,array('data-mini'=>'true','readonly'=>'true'))}}
                    </div>                      
                </div>                      
            </div>
            <br/>
            {{--Detalle de la reparación--}}
            <h4>Detalles de la reparación</h4>
            <div class="ui-grid-a ui-responsive">
                <div class="ui-block-a">
                    <div class="bloque">
                        {{Form::label('detalle','Detalle de la reparación:')}}
                        {{Form::textarea('detalle',$orden->detalle,array('data-mini'=>'true','readonly'=>'true','id'=>'detalleRep'))}}                  
                    </div>                                          
                </div>
                <div class="ui-block-b">
                    <div class="bloque">
                        {{Form::label('informe','Informe al cliente:')}}
                        {{Form::textarea('informe',$orden->informe,array('data-mini'=>'true','readonly'=>'true','id'=>'informeRep'))}}
                    </div>
                </div>                      
            </div>
            <br/>
            {{--Estado de la reparación--}}
            <h4>Estado de la reparación</h4>
            <div data-role="fieldcontain">
                {{Form::label('estado','Estado de reparación:')}}
                @if($orden->estado == '0')
                    {{Form::text('serie','Sin revisar',array('data-mini'=>'true','readonly'=>'true'))}}
                @elseif($orden->estado == '1')
                    {{Form::text('serie','En reparación',array('data-mini'=>'true','readonly'=>'true'))}}
                @else
                    {{Form::text('serie','Reparación terminada el '.date("d M Y",strtotime($orden->fecha_terminado)),array('data-mini'=>'true','readonly'=>'true'))}}
                @endif
            </div> 
            {{--Detalles del presupuesto--}}
            <h4>Detalles del presupuesto</h4>
            @if($orden->presupuestado != '1')
                <span>No presupuestado</span>
            @else
                <table data-role="table"  class="movie-list ui-responsive" >
                    <thead>
                        <tr>
                            <th>Detalle</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orden->presupuestos as $valores)
                        <tr>                            
                            <td>{{$valores->detalle}}</td>
                            <td>$ {{number_format($valores->pivot->valor_actual,2) }}</td>                          
                        </tr>
                        @endforeach
                        <tr>
                            <td style="text-align: right;"><b>Subtotal</b></td>
                            <td>$ {{number_format($orden->subtotal,2) }}</td>                           
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>IVA</b></td>
                            <td> 12%</td>                           
                        </tr>                   
                        <tr>
                            <td style="text-align: right;"><b>TOTAL</b></td>
                            <td>$ {{number_format($orden->total,2) }}</td>                          
                        </tr>       
                    </tbody>
                </table>
            @endif                                  
        {{Form::close()}}   
        <div data-role="controlgroup" data-type="horizontal" align="center">
            {{HTML::link('logCliente','Principal',array('data-role'=>'button','data-mini'=>'true'))}}
        </div>
    @else
        <p>La orden de trabajo solicitada no se encuentra disponible</p> 
    @endif
@stop
{{--Secundario--}}
@section('secundario')
	
@stop