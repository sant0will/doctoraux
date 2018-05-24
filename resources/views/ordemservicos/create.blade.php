@extends('adminlte::page')

@section('title')

@section('content_header')
    <p class="header-title">Cadastro de Ordem de Serviço</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados da ordem
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/ordemservico')}}">
					@csrf
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cidadão</label>
                            <div class="col-sm-10">
                                <input name="cidadao" value="{{ $cidadao->id }}" required readonly hidden>
                                <input type="text" class="form-control" value="{{ $cidadao->nome }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Data e hora atual</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="data" value="{{ $data }}" readonly>
                            </div>
                        </div>

                        <div id="divhoras" class="form-group" hidden>
                            <label class="col-sm-2 control-label">Horas de serviço já utilizadas</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $horas_servico }}" readonly>
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('setores') ? 'has-error' : '' }}">
                            <label for="setores" class="col-sm-2 control-label">Setor *</label>
                            <div class="col-sm-10">
                                <select id="setores" class="form-control" name="setor" required>
                                    <option value="" selected>--- Escolha um setor ---</option>
                                    @foreach($setores as $setor)
                                        <option @if(old('setor') == $setor->id) selected @endif value="{{ $setor->id }}">{{$setor->nome}}</option>
                                    @endforeach
								</select>
								@if ($errors->has('setores'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('setores') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group has-feedback {{ $errors->has('meios') ? 'has-error' : '' }}">
                            <label for="meios" class="col-sm-2 control-label">Meio de abertura *</label>
                            <div class="col-sm-10">
                                <select id="meios" class="form-control" name="meio" required>
                                    <option value="" selected>--- Escolha um meio ---</option>
                                    @foreach($meios as $meio)
                                        <option @if(old('meio') == $meio->id) selected @endif value="{{ $meio->id }}">{{$meio->nome}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('meios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meios') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>             

                        <div class="form-group has-feedback {{ $errors->has('servicos') ? 'has-error' : '' }}">
							<label for="servicos" class="col-sm-2 control-label">Serviços *</label>
							<div class="col-sm-10">
								<select class="form-control" tabindex="-1" aria-hidden="true" id="selectservicos"  onchange="newSelect()" required>
									@foreach($servicos as $servico)
                                        <option @if(old('servicos') == $servico->id) selected @endif value="{{ $servico->id }}">{{ $servico->descricao }}</option>
									@endforeach
								</select>
								@if ($errors->has('servicos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('servicos') }}</strong>
                                    </span>
                                @endif
							</div>
                        </div>

                        <input type="text" id="servicos" name="servicos" class="servicos" value="" required readonly hidden>
                        
                        <div class="form-group has-feedback {{ $errors->has('observacao') ? 'has-error' : '' }}">
                            <label for="observacao" class="col-sm-2 control-label">Observações</label>
                            <div class="col-sm-10">
                                <textarea id="field" onkeyup="countChar(this)" onkeydown="limitTextareaLine(this)" class="form-control" rows="6" name="observacao" maxlength="1000" placeholder=""></textarea>
                                <p class="pull-right help-block"><small id="charNum">1000</small></p>
                                <div class="theCount" hidden>Lines used: <span id="linesUsed">0</span></div>
                            </div>
                        </div>
                        
					
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>					
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
        $(document).ready(function(){

        var lines = 10;
        var linesUsed = $('#linesUsed');

            $('#field').keydown(function(e) {

                newLines = $(this).val().split("\n").length;
                linesUsed.text(newLines);

                if(e.keyCode == 13 && newLines >= lines) {
                    linesUsed.css('color', 'red');
                    return false;
                }
                else {
                    linesUsed.css('color', '');
                }
            });
        });

        $('#field').keyup(function () {
            var max = 1000;
            var len = $(this).val().length;
            if (len >= max) {
                $('#charNum').text(' Você atingiu o limite de caracteres.');
            } else {
                var char = max - len;
                $('#charNum').text(char + ' Caracteres sobrando');
            }
        });
      </script>
    <script>
        $(document).ready(function() { 
            $("#selectservicos").select2({
                multiple: true,
                placeholder: "--- Selecione os serviços desta ordem ---",
            });
        });

        window.onload = function () {
            $("#selectservicos").val("");
        }
    </script>
    <script>
        function newSelect(){
            var select = $("#selectservicos").val();   
            //console.log(select);        
            $("#servicos").val(select);  
            console.log($("#servicos").val());         
        }
    </script>
    <script>
        $("#setores").on('change', function() {
			
			var setor = $(this).find('option:selected').val();			
            console.log("setor: "+setor);

            if(setor == 1){
                $("#divhoras").prop("hidden", false);
            }else{
                $("#divhoras").prop("hidden", true);
            }

		});
    </script>

@stop

