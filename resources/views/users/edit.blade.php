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
				
				<form class="form-horizontal" method="post" action="{{action('UserController@update', $id)}}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

                        <div class="form-group has-feedback {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type" class="col-sm-2 control-label">Tipo *</label>
                            <div class="col-sm-10">
                                <select id="type" class="form-control" name="type" required>
                                    @foreach($types as $type)
                                        <option @if($user->type_id == $type->id) selected @endif value="{{ $type->id }}">{{$type->name}}</option>
                                    @endforeach
								</select>
								@if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('type')[0] }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Usuário *</label>
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
							<label for="email" class="col-sm-2 control-label">Email *</label>
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

@stop

