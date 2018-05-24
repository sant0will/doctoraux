@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Serviços</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do serviço
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/servicos')}}">
					@csrf
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('descricao') ? 'has-error' : '' }}">
							<label for="descricao" class="col-sm-2 control-label">Descrição *</label>
							<div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('descricao')}}" name="descricao" placeholder="" minlength="3" maxlength="45" required>
                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>                                          
					
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/servicos" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>
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

