@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Bairros</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do Bairros
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/bairros')}}">
					@csrf
					@if(session()->has('message'))
						@if(session()->get('state'))
							<div class="callout callout-success">
								{{ session()->get('message') }}
							</div>
						@else
							<div class="callout callout-danger">
								{{ session()->get('message') }}
							</div>
						@endif
					@endif
					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
							<label for="nome" class="col-sm-2 control-label">Nome do Bairro *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nome" placeholder="" minlength="2" maxlength="45" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('cidade') ? 'has-error' : '' }}">
							<label for="cidade" class="col-sm-2 control-label">Cidade *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cidade_id" placeholder="Videira" value="Videira" readonly>
							</div>
						</div>

					</div>

					<div class="box-footer">						 
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/bairros" class="btn-cancel pull-right">Cancelar</a>
					</div>

					<div class="modal fade" id="modal-default">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Confirmação</h4>
							</div>
							<div class="modal-body">
								<p>Deseja realmente realizar as alterações feitas?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary">Salvar</button>
							</div>
							</div>
						</div>
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

