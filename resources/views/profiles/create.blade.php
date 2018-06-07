@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Perfil</p>
@stop

@section('content')


    <div class="row" >
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados da pessoa
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/profiles')}}">
					@csrf

					<div class="box-body">
						@if(session()->has('success'))
							@if(session()->get('success'))
								<div class="callout callout-success">
									{{ session()->get('success') }}
								</div>
							@endif
						@elseif(session()->has('error'))
							@if(session()->get('error')) 
								<div class="callout callout-danger">
									{{ session()->get('error') }}
								</div>
							@endif
						@endif
						
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Nome completo *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" id="name" placeholder="" minlength="7" maxlength="50" value="{{old('name')}}" required>
							</div>
							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->get('name')[0] }}</strong>
								</span>
							@endif
						</div>
	

						<div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
							<label for="phone" class="col-sm-2 control-label">Telefone *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="phone" id="phone" placeholder="" minlength="10" maxlength="15" value="{{old('phone')}}" required>
							</div>
							@if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->get('phone')[0] }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group has-feedback {{ $errors->has('gender') ? 'has-error' : '' }}">
							<label class="col-sm-2 control-label" for="Gender">Genêro *</label>
							<div class="col-sm-10"> 
								<label class="radio-inline" for="Gender-0">
									<input type="radio" name="sexo" id="Gender-0" value="1" checked="checked">
									Masculino
								</label> 
								<label class="radio-inline" for="Gender-1">
									<input type="radio" name="sexo" id="Gender-1" value="2">
									Feminino
								</label> 
								<label class="radio-inline" for="Gender-2">
									<input type="radio" name="sexo" id="Gender-2" value="3">
									Outro
								</label>
							</div>
						</div>

					</div>
					<div class="box-header with-border">
						<h3 class="box-title">Dados do endereço	</h3>
					</div>
					<div class="box-body">
						<div class="form-group has-feedback {{ $errors->has('cep') ? 'has-error' : '' }}">
							<label for="cep" class="col-sm-2 control-label">CEP *</label>
							<div class="cep col-sm-10">
								<input type="text" class="form-control" name="cep" id="cep" minlength="8" maxlength="9" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('estado') ? 'has-error' : '' }}">
							<label for="estado" class="col-sm-2 control-label">Estado *</label>
							<div class="col-sm-10">
								<select id="estado" class="form-control" name="estado" required>
									<option value="" selected>--- Escolha um estado ---</option>
									@foreach($estados as $estado)
										<option estado-uf="{{ $estado->uf }}" value="{{ $estado->id }}">{{$estado->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('cidade') ? 'has-error' : '' }}">
							<label for="cidade" class="col-sm-2 control-label">Cidade *</label>
							<div class="col-sm-10">
								<select id="cidade" class="form-control" name="cidade" required>
									<option value="" selected>--- Escolha uma cidade ---</option>
									@foreach($cidades as $cidade)
										<option cidade-uf="{{ $cidade->uf }}" value="{{ $cidade->id }}">{{$cidade->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('bairro') ? 'has-error' : '' }}">
							<label for="bairro" class="col-sm-2 control-label">Bairro *</label>	
							<div id="bairro-div-input" class="col-sm-10" >
								<input type="text" class="form-control" name="bairro" id="bairro-input" placeholder="" minlength="3" maxlength="90">
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('logradouro') ? 'has-error' : '' }}">
							<label for="logradouro" class="col-sm-2 control-label">Logradouro *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logradouro" placeholder="" minlength="3" maxlength="90" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('numero') ? 'has-error' : '' }}">
							<label for="numero" class="col-sm-2 control-label">Número *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="numero" id="numero" placeholder="" maxlength="6" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('complemento') ? 'has-error' : '' }}">
							<label for="complemento" class="col-sm-2 control-label">Complemento</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="complemento" placeholder="" maxlength="90">
							</div>
						</div>

						<input type="text" value="{{$user_id}}" hidden>
					</div>	

					{{-- Formulário caso seja Médico --}}
					@if($user_type == 2)
						<div class="box-header with-border">
							<h3 class="box-title">Dados do Médico	</h3>
						</div>
						<div class="box-body">
							<div class="form-group has-feedback {{ $errors->has('crm') ? 'has-error' : '' }}">
								<label for="crm" class="col-sm-2 control-label">CRM *</label>
								<div class="crm col-sm-10">
									<input type="text" class="form-control" name="crm" id="crm" minlength="7" maxlength="7" value="{{old('crm')}}" required>
								</div>
								@if ($errors->has('crm'))
									<span class="help-block">
										<strong>{{ $errors->get('crm')[0] }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
								<label for="cpf" class="col-sm-2 control-label">CPF *</label>
								<div class="cpf col-sm-10">
									<input type="text" class="form-control" name="cpf" id="cpf" minlength="8" maxlength="9" value="{{old('cpf')}}" required>
								</div>
								@if ($errors->has('cpf'))
									<span class="help-block">
										<strong>{{ $errors->get('cpf')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('birth') ? 'has-error' : '' }}">
								<label for="birth" class="col-sm-2 control-label">Data de Nascimento *</label>	
								<div id="birth-div-input" class="col-sm-10" >
									<input type="text" class="form-control" name="birth" id="birth" placeholder="" minlength="10" maxlength="10" value="{{old('birth')}}" required>
								</div>
								@if ($errors->has('birth'))
									<span class="help-block">
										<strong>{{ $errors->get('birth')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
								<label for="email" class="col-sm-2 control-label">Email *</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" placeholder="" minlength="3" maxlength="90" value="{{old('email')}}" required>
								</div>
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->get('email')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('phone2') ? 'has-error' : '' }}">
								<label for="phone2" class="col-sm-2 control-label">Telefone Secundário</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="phone2" id="phone" placeholder="" minlength="10" maxlength="15" value="{{old('phone')}}">
								</div>
								@if ($errors->has('phone2'))
									<span class="help-block">
										<strong>{{ $errors->get('phone2')[0] }}</strong>
									</span>
								@endif
							</div>
						</div>
					@elseif($user_type == 3)
					<div class="box-header with-border">
							<h3 class="box-title">Dados do Atendente</h3>
						</div>
						<div class="box-body">
							<div class="form-group has-feedback {{ $errors->has('crm') ? 'has-error' : '' }}">
								<label for="crm" class="col-sm-2 control-label">CRM *</label>
								<div class="crm col-sm-10">
									<input type="text" class="form-control" name="crm" id="crm" minlength="7" maxlength="7" value="{{old('crm')}}" required>
								</div>
								@if ($errors->has('crm'))
									<span class="help-block">
										<strong>{{ $errors->get('crm')[0] }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('especialidade') ? 'has-error' : '' }}">
							<label for="especialidade" class="col-sm-2 control-label">especialidade de Medida *</label>
							<div class="col-sm-10">
								<select id="especialidade" class="form-control" name="especialidade" required>
										<option value="--- Selecione a especialidade ---" selected>--- Selecione a especialidade ---</option>
									@foreach($especialidades as $especialidade)
										<option value="{{ $especialidade->id }}">{{$especialidade->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
							<div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
								<label for="cpf" class="col-sm-2 control-label">CPF *</label>
								<div class="cpf col-sm-10">
									<input type="text" class="form-control" name="cpf" id="cpf" minlength="8" maxlength="9" value="{{old('cpf')}}" required>
								</div>
								@if ($errors->has('cpf'))
									<span class="help-block">
										<strong>{{ $errors->get('cpf')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('birth') ? 'has-error' : '' }}">
								<label for="birth" class="col-sm-2 control-label">Data de Nascimento *</label>	
								<div id="birth-div-input" class="col-sm-10" >
									<input type="text" class="form-control" name="birth" id="birth" placeholder="" minlength="10" maxlength="10" value="{{old('birth')}}" required>
								</div>
								@if ($errors->has('birth'))
									<span class="help-block">
										<strong>{{ $errors->get('birth')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
								<label for="email" class="col-sm-2 control-label">Email *</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" placeholder="" minlength="3" maxlength="90" value="{{old('email')}}" required>
								</div>
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->get('email')[0] }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group has-feedback {{ $errors->has('phone2') ? 'has-error' : '' }}">
								<label for="phone2" class="col-sm-2 control-label">Telefone Secundário</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="phone2" id="phone" placeholder="" minlength="10" maxlength="15" value="{{old('phone')}}">
								</div>
								@if ($errors->has('phone2'))
									<span class="help-block">
										<strong>{{ $errors->get('phone2')[0] }}</strong>
									</span>
								@endif
							</div>
						</div>
					@endif

					<div class="box-footer">						 
						<button type="submit" class="btn btn-primary pull-right" id="btn-submit">Salvar</button>
						<a href="/profiles" class="btn-cancel pull-right">Cancelar</a>
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

	

	{{-- Mascara de conteudo --}}
	<script>
		jQuery(function ($) {
			$("#phone").mask("(99) 9999-99999");
			$("#phone2").mask("(99) 9999-99999");
			$("#cpf").mask('000.000.000-00', {reverse: true});
			$("#birth")).mask('00/00/0000');
			$("#cep").mask("99999-999");
			$("#numero").mask("99999");
			$("#horas").mask('AAA:ZA', { reverese:true,
				'translation': {
				A: {pattern: /[0-9]/},
				Z: {pattern: /[0-5]/},
				}, 
			});
		});
	</script>	
@stop

