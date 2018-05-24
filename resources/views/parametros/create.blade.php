@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Parâmetros</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do parâmetro
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/parametros')}}">
					@csrf
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('parametro') ? 'has-error' : '' }}">
							<label for="parametro" class="col-sm-2 control-label">Parâmetro *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('parametro')}}" name="parametro" placeholder="" minlength="8" maxlength="45" required>
                                @if ($errors->has('parametro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parametro') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>           
						<div class="form-group has-feedback {{ $errors->has('descricao') ? 'has-error' : '' }}">
							<label for="descricao" class="col-sm-2 control-label">Descrição *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('descricao')}}" name="descricao" placeholder="" minlength="10" maxlength="150" required>
                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>           
						<div class="form-group has-feedback {{ $errors->has('valor') ? 'has-error' : '' }}">
							<label for="valor" class="col-sm-2 control-label">Valor *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('valor')}}" name="valor" placeholder="" minlength="1" maxlength="200" required>
                                @if ($errors->has('valor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valor') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>                                
					
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/parametros" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>
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

@stop

