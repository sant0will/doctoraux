@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
                <h3 class="title-b-page box-title">Abertura de ordem de serviço</h3>
                <a href="/cidadaos/create" class="btn bg-blue pull-right btn-cadastro-cidadao"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar novo cidadão</a>
            </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">                

                <table id="td-abreordem" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="td-abreordem_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>CPF / CNPJ</th>
                        <th>E-mail</th>
                        <th>Abertura de ordem</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cidadaos as $cidadao)
                        <tr>
                            <td>{{$cidadao->id}}</td>
                            <td>{{$cidadao->nome}}</td>
                            <td>{{$cidadao->cpfcnpj}}</td>
                            <td>{{$cidadao->email}}</td>
                            <td> 
                                <a type="button" class="btn-modal btn-sm bg-blue" href="" id="btn-modal" data-cidadao-id="{{$cidadao->id}}" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa-tables fa fa-file" aria-hidden="true"></i>
                                    <span class="text-os">Abrir ordem de serviço</span>
                                </a>
                                {{-- Modal --}}
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Confirmação</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ao prosseguir você atesta que o cidadão selecinado não possui nenhum débito pendente no sistema na data de abertura desta ordem.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                            <form class="formordemservico">                                      
                                                <button type="submit" class="btn btn-primary">Prosseguir</button>
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
            //$('#td-abreordem').DataTable()
            $('#td-abreordem').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })

        $('.btn-modal').click(function(){
            var id = $(this).data('cidadao-id');
            console.log(id); 
            
            $(".formordemservico").attr('action', ("ordemservico/"+id+"/create"));
        })

        $( window ).resize(function() {
            if($( window ).width() <= 1050){
                $('.text-os').text('');       
                $('.btn-os').css('float', 'left'); 
                $('.btn-os').css('width', 28);
            }else{
                $('.text-os').text('Abrir ordem de serviço');       
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
                $('.text-os').text('Abrir ordem de serviço');       
                $('.btn-os').css('float', ''); 
                $('.btn-os').css('width', 'auto');
            }
        }

    </script>
@stop