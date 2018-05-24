@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Visualização de Cidadãos</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do cidadão</h3>
				</div>				
				<form class="form-horizontal">							
					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
							<label for="nome" class="col-sm-2 control-label">Nome completo</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" name="nome" value="{{ $cidadao->nome }}" placeholder="" minlength="7" maxlength="50" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
							@if($cidadao->Type == 1)
								<label for="cpf" class="col-sm-2 control-label">CPF</label>
							@else
								<label for="cpf" class="col-sm-2 control-label">CNPJ</label>
							@endif
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cpf" id="cpf" value="{{ $cidadao->cpfcnpj }}" placeholder="" minlength="11" maxlength="14" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="email" id="email" value="{{ $cidadao->email }}" placeholder="" minlength="7" maxlength="50" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone1') ? 'has-error' : '' }}">
							<label for="telefone1" class="col-sm-2 control-label">Telefone 1</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone1" id="telefone1" value="{{ $cidadao->telefone1 }}" placeholder="" minlength="10" maxlength="15" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone2') ? 'has-error' : '' }}">
							<label for="telefone2" class="col-sm-2 control-label">Telefone 2</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone2" id="telefone2" value="{{ $cidadao->telefone2 }}" placeholder="" minlength="10" maxlength="15" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone2') ? 'has-error' : '' }}">
							<label for="telefone2" class="col-sm-2 control-label">Inscrição Estadual de Produtor Rural</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="inscricao" id="inscricao" value="{{ $cidadao->inscricao_prod_rural }}" placeholder="" minlength="10" maxlength="15" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone2') ? 'has-error' : '' }}">
							<label for="telefone2" class="col-sm-2 control-label">Horas de Serviço Comsumidas</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="horas" id="horas" value="{{ $horasServico }}" placeholder="" minlength="10" maxlength="15" readonly>
							</div>
						</div>
					
					</div>				
					<div class="box-header with-border">
						<h3 class="box-title">Endereço</h3>
					</div>

					<div class="box-body">
						<table class="table table-condensed">
							<tr>
								<th>Logradouro</th>
								<th>Numero</th>
								<th>CEP</th>
								<th>Bairro</th>
								<th>Cidade</th>
								<th>Estado</th>
								<th>Complemento</th>
							</tr>
							@foreach($enderecos as $endereco)
								<tr>
									<td id="column-tb">{{$endereco->logradouro}}</td>
									<td>{{$endereco->numero}}</td>
									<td>{{$endereco->cep}}</td>
									<td>{{$endereco->bairro}}</td>
									<td>{{$endereco->cidade}}</td>
									<td>{{$endereco->estado}}</td>
									<td>{{$endereco->complemento == null ? 'Sem Complemento' : $endereco->complemento}}</td>
								</tr>
							@endforeach
						</table>
						<div class="box-footer">
							<a href="/cidadaos" type="button" class="btn btn-primary pull-left"> <i class="fa-back fa fa-chevron-left" aria-hidden="true"></i>Voltar</a>  
							{{-- @if($user_id != null)    
								<a href="/usuarios/{{$user_id}}" type="button" class="btn btn-primary pull-right"><i class="fa-tables fa fa-user" aria-hidden="true"></i> Visualizar página do usuário</a>                                          
							@endif --}}
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop