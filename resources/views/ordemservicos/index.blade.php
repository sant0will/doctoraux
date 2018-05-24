@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Ordens de Serviço</h3>
            <a href="/novaordem" class="btn bg-blue pull-right btn-cadastro-ordemservico"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar nova ordem</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">

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

                <table id="tb-ordemservico" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tb-ordemservico_info">
                    <thead>
                    <tr>
                        <th>Data de abertura</th>
                        <th>Numero da ordem</th>
                        <th>Setor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($ordemservicos as $ordemservico)
                        <tr>
                            <td>{{$ordemservico->data_abertura}}</td>
                            <td>{{$ordemservico->numero_ordem}}</td>
                            <td>{{$setores->find($ordemservico->setor_id)->nome}}</td>
                            <td>
                                <span 
                                    @if($ordemservico->status == 1) class="label bg-blue" 
                                    @elseif($ordemservico->status == 2) class="label bg-yellow"
                                    @elseif($ordemservico->status == 3) class="label bg-blue" 
                                    @elseif($ordemservico->status == 4) class="label bg-gray" 
                                    @elseif($ordemservico->status == 5) class="label bg-red" 
                                    @elseif($ordemservico->status == 6) class="label bg-green" 
                                @endif
                                    >{{$status->find($ordemservico->status)->descricao}}</span>
                            </td>
                            <td> 
                                {{-- <a type="button" class="btn-modal btn-sm bg-primary" href="" id="btn-modal-mail" data-ordemservico-id="{{$ordemservico->id}}" data-toggle="modal" data-target="#modal-os">
                                    <i class="fa-tables fa fa-file" aria-hidden="true"></i>Gerar novo PDF
                                </a> --}}
                                <a type="button" href="/ordemservico/{{$ordemservico->id}}/ordem" class="btn-os btn-sm bg-olive">
                                    <i class="fa-tables fa fa-file" aria-hidden="true"></i>
                                    <span class="text-os">Ordem de serviços</span>
                                </a>
                                {{-- Modal --}}
                                <div class="modal fade" id="modal-os">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Confirmação</h4>
                                        </div>
                                        {{-- Body --}}
                                        <div class="body modal-body">
                                            <p>Gerar nova via da ordem de serviços?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                            {{-- Form de download --}}
                                            <form class="formdownload">                                      
                                                <button type="submit" class="btn btn-primary" onclick="closeModal()">Download</button>
                                            </form>
                                            {{-- Form de email --}}
                                            <form class="formemail">                                      
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- ./Modal --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {
            //$('#tb-ordemservico').DataTable()
            $('#tb-ordemservico').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order": [[ 0, "desc" ]]
            })
        })

        $('.btn-modal').click(function(){
            var id = $(this).data('ordemservico-id');
            
            $(".formdownload").attr('action', ("generate/"+id+"/pdf"));   
            
            $(".formemail").attr('action', ("send/"+id+"/pdf"));
        })

        $( window ).resize(function() {
            if($( window ).width() <= 1050){
                $('.text-os').text('');       
                $('.btn-os').css('float', 'left'); 
                $('.btn-os').css('width', 28);
            }else{
                $('.text-os').text('Ordem de serviços');       
                $('.btn-os').css('float', ''); 
                $('.btn-os').css('width', 'auto');
            }
        });

        window.onload = function () {
            if($( window ).width() <= 1050){
                $('.text-os').text('');       
                $('.btn-os').css('float', 'left'); 
                $('.btn-os').css('width', 28);
            }else{
                $('.text-os').text('Ordem de serviços');       
                $('.btn-os').css('float', ''); 
                $('.btn-os').css('width', 'auto');
            }
        }
    </script>
    <script>
        function closeModal(){
            $("#modal-os").modal('hide');
        }
    </script>
@stop