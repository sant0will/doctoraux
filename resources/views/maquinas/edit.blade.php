@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Máquinas</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados da máquina
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{action('CadastroMaquinaController@update', $id)}}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
					
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('descricao') ? 'has-error' : '' }}">
							<label for="descricao" class="col-sm-2 control-label">Descrição *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$maquina->descricao}}" name="descricao" placeholder="" minlength="3" maxlength="45" required>
                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('descricao')[0] }}</strong>
                                    </span>
                                @endif
							</div>
						</div>
                        
                        <div class="form-group has-feedback {{ $errors->has('codigo_frota') ? 'has-error' : '' }}">
							<label for="codigo_frota" class="col-sm-2 control-label">Código da frota</label>
							<div class="col-sm-10">
                                <input type="emais" class="form-control" value="{{$maquina->codigo_frota}}" name="codigo_frota" id="codigo_frota" placeholder="" minlength="1" maxlength="45" readonly>
                                @if ($errors->has('codigo_frota'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('codigo_frota')[0] }}</strong>
                                    </span>
                                @endif
							</div>
                        </div>                  

                        <div class="form-group has-feedback {{ $errors->has('valor') ? 'has-error' : '' }}">
							<label for="valor" class="col-sm-2 control-label">Valor/hora (R$) *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$maquina->valor}}" name="valor" id="valor" placeholder="" minlength="1" maxlength="9" required>
                                @if ($errors->has('valor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('valor')[0] }}</strong>
                                    </span>
                                @endif
							</div>
                        </div>                      
					
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/maquinas" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>
					</div>

				</form>
			</div>
		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
	<script>
		$(function() {
			$('#valor').maskMoney({
				thousands: '',
				decimal: '.',
			});
		})
	</script>
@stop

