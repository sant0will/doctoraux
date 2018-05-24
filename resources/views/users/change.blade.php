@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Usuários</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do usuário
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>

				<form class="form-horizontal" method="post" action="{{action('NewPassController@updatepassword', Auth::user()->id) }}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">   						
						<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password" class="col-sm-2 control-label">Senha *</label>
							<div class="col-sm-10">
                                <input type="password" class="password form-control" value="" name="password" id="password" minlength="6" maxlength="50" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('password')[0] }}</strong>
                                    </span>
                                @endif
							</div>
						</div>
                        
                        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="password_confirmation" class="col-sm-2 control-label">Confirme a Senha *</label>
							<div class="col-sm-10">
                                <input type="password" class="password form-control" value="" name="password_confirmation" id="password_confirmation" minlength="6" maxlength="50" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('password_confirmation')[0] }}</strong>
                                    </span>
                                @endif
							</div>
						</div>  
						<div class="form-group has-feedback {{ $errors->has('show') ? 'has-error' : '' }}">
							<label for="password_confirmation" class="col-sm-2 control-label">Mostrar senha</label>	
							<div class="col-sm-10 checkbox">
								<label>
									<input type="checkbox" id="show">
								</label>
							</div>
						</div>
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/users" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>						
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
		$( "#show" ).change(function() {
			if ( $( "#show" ).prop( "checked" ) ){
				$( ".password" ).attr('type', 'text');
			}else{
				$( ".password" ).attr('type', 'password');
			}
			
		});
		
	</script>
@stop

