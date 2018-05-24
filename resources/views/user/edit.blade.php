@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Cadastro do Usuário</h1>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do usuário</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{action('AuthUserController@update', $user->id)}}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
			
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
           

					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">Type</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="{{$Type}}" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Usuário</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="" minlength="4" maxlength="50" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('name')[0] }}</strong>
                                    </span>
                                @endif
							</div>
						</div>
                        
                        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
                                <input type="emais" class="form-control" value="{{ $user->email }}" name="email" id="email" placeholder="" minlength="7" maxlength="50" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('email')[0] }}</strong>
                                    </span>
                                @endif
							</div>
                        </div>                     
					
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>				
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

