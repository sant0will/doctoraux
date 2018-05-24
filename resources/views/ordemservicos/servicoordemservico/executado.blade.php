@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Execução de Serviços da Ordem</h1>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Serviço executado</h3>
				</div>

                <form class="form-horizontal" method="post" action="{{action('ServicoOrdemServicoController@executado')}}">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">
                        
                        <div class="form-group has-feedback {{ $errors->has('data_inicial') ? 'has-error' : '' }}">
                            <label for="data_inicial" class="col-sm-2 control-label">Data de inicio</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('data_inicial')}}" name="data_inicial" id="data_inicial" placeholder="" minlength="8" maxlength="10" required>
                                @if ($errors->has('data_inicial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_inicial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('data_final') ? 'has-error' : '' }}">
                            <label for="data_final" class="col-sm-2 control-label">Data final</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('data_final')}}" name="data_final" id="data_final" placeholder="" minlength="8" maxlength="8" required>
                                @if ($errors->has('data_final'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_final') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback {{ $errors->has('hora_inicio') ? 'has-error' : '' }}">
                            <label for="hora_inicio" class="col-sm-2 control-label">Hora de inicio</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('hora_inicio')}}" name="hora_inicio" id="hora_inicio" placeholder="" minlength="8" maxlength="8" required>
                                @if ($errors->has('hora_inicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hora_inicio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('hora_fim') ? 'has-error' : '' }}">
                            <label for="hora_fim" class="col-sm-2 control-label">Hora final</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('hora_fim')}}" name="hora_fim" id="hora_fim" placeholder="" minlength="8" maxlength="10" required>
                                @if ($errors->has('hora_fim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hora_fim') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('horimetro_inicio') ? 'has-error' : '' }}">
							<label for="horimetro_inicio" class="col-sm-2 control-label">Horímetro inicial</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="horimetro_inicio" id="horimetro_inicio" placeholder="" minlength="1" maxlength="9" value="{{old('horimetro_inicio')}}">
							</div>
							@if ($errors->has('horimetro_inicio'))
								<span class="help-block">
									<strong>{{ $errors->first('horimetro_inicio') }}</strong>
								</span>
							@endif
                        </div>
                        
                        <div class="form-group has-feedback {{ $errors->has('horimetro_fim') ? 'has-error' : '' }}">
							<label for="horimetro_fim" class="col-sm-2 control-label">Horímetro final</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="horimetro_fim" id="horimetro_fim" placeholder="" minlength="1" maxlength="9" value="{{old('horimetro_fim')}}">
							</div>
							@if ($errors->has('horimetro_fim'))
								<span class="help-block">
									<strong>{{ $errors->first('horimetro_fim') }}</strong>
								</span>
							@endif
						</div>	
                        
                        <div class="form-group has-feedback {{ $errors->has('maquinas') ? 'has-error' : '' }}">
                            <label for="maquinas" class="col-sm-2 control-label">Maquinas</label>
                            <div class="col-sm-10">
                                <select class="form-control" tabindex="-1" aria-hidden="true" id="selectmaquinas" onchange="newSelectMaquinas()" required>
                                    @foreach($maquinas as $maquina)
                                        <option @if(old('maquinas') == $maquina->id) selected @endif value="{{ $maquina->id }}">{{ $maquina->descricao }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('maquinas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maquinas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('operadores') ? 'has-error' : '' }}">
                            <label for="operadores" class="col-sm-2 control-label">Operadores</label>
                            <div class="col-sm-10">
                                <select class="form-control" tabindex="-1" aria-hidden="true" id="selectoperadores" onchange="newSelectOperadores()" required>
                                    @foreach($operadores as $operador)
                                        <option @if(old('operadores') == $operador->id) selected @endif value="{{ $operador->id }}">{{ $cidadaos->find($operador->cidadao_id)->nome }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('operadores'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('operadores') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="text" id="maquinas" name="maquinas" class="maquinas" value="" required readonly hidden>
                        <input type="text" id="operadores" name="operadores" class="operadores" value="" required readonly hidden>

                        <input type="text" name="idservico" value="{{$idservico}}" required readonly hidden>
                        <input type="text" name="idordem" value="{{$idordem}}" required readonly hidden>
					
					</div>

					<div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Salvar</button>	
                        <a href="/ordemservico/{{$idordem}}/ordem" class="btn-cancel pull-right">Cancelar</a>				
					</div>

				</form>
			</div>
		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
    {{-- <style> .table-condensed > thead { display:none; } .table-condensed { width:100%; } </style> --}}
@stop

@section('js')
    <script>
        (function($){
            $.fn.datetimepicker.dates['pt-BR'] = {
                days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
                daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
                daysMin: ["D", "S", "T", "Q", "Q", "S", "S", "D"],
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                today: "Hoje",
                format: 'dd/mm/yyyy',
                suffix: [],
		        meridiem: []
            };
        }(jQuery));
    </script>
    <script>
        $(function() {
            var initDate = new Date();
            $('#data_inicial').datetimepicker({
                language: 'pt-BR',
                pickTime: false,
                //format: 'dd/mm/yyyy',
                autoclose: true,
                minView: 2,
                startDate: new Date(),
            });
            $("#data_inicial").on("change",function(){
                initDate = $(this).val();
                //alert(selected);

                $('#data_final').datetimepicker({
                    language: 'pt-BR',
                    todayHighlight: false,
                    pickTime: false,
                    //format: 'dd/mm/yyyy',
                    autoclose: true,
                    minView: 2,
                    startDate: initDate,
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('#hora_inicio').datetimepicker({
                //language: 'pt-BR',
                formatViewType: 'time',
                pickDate: false,
                minuteStep: 15,
                pickerPosition: 'bottom-right',
                format: 'HH:ii p',
                autoclose: true,
                showMeridian: true,
                startView: 1,
                maxView: 1,
            });
            $('#hora_fim').datetimepicker({
                //language: 'pt-BR',
                formatViewType: 'time',
                pickDate: false,
                minuteStep: 15,
                pickerPosition: 'bottom-right',
                format: 'HH:ii p',
                autoclose: true,
                showMeridian: true,
                startView: 1,
                maxView: 1,
            });
            // }).on("show", function(){
            //         $(".table-condensed .prev").css('visibility', 'hidden');
            //         $(".table-condensed .switch").text("Hora");
            //         $(".table-condensed .next").css('visibility', 'hidden');
            //     });
        });
    </script>

    {{-- Seleção multipla --}}
    <script>
        $(document).ready(function() { 
            $("#selectmaquinas").select2({
                multiple: true,
                placeholder: "--- Selecione as máquinas deste serviço ---",
            });
            $("#selectoperadores").select2({
                multiple: true,
                placeholder: "--- Selecione os operadores deste serviço ---",
            });
        });

        window.onload = function () {
            $("#selectmaquinas").val("");
            $("#selectoperadores").val("");
        }
    </script>
    <script>
        function newSelectMaquinas(){
            var select = $("#selectmaquinas").val();   
            //console.log(select);        
            $("#maquinas").val(select);  
            //console.log($("#maquinas").val());         
        }
        function newSelectOperadores(){
            var select = $("#selectoperadores").val();   
            //console.log(select);        
            $("#operadores").val(select);  
            //console.log($("#operadores").val());         
        }
    </script>
    {{-- Fim seleção multipla --}}

    {{-- Mascara de conteudo --}}
	<script>
		jQuery(function ($) {
			$("#data_final").mask("");
			$("#data_inicial").mask("");
			$("#hora_inicio").mask("");
			$("#hora_fim").mask("");
            $("#horimetro_inicio").mask('00000000.00', {reverse: true});
            $("#horimetro_fim").mask('00000000.00', {reverse: true});
		});
	</script>
@stop

