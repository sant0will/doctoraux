@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Perfil</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('pass'))
                        <div class="modal fade" id="modal-pass">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Confirmação</h4>
                                </div>
                                <div class="modal-body">
                                    <p><b>Nome do usuário: {{ session()->get('name') }}</b></p>
                                    <p><b>Email: {{ session()->get('email') }}</b></p>
                                    <p><b>Senha: {{ session()->get('pass') }}</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Fechar</button>       
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        @if(session()->get('success'))
                            <div class="callout callout-success">
                                {{ session()->get('success') }}
                            </div>
                        @else
                            <div class="callout callout-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    @endif                
                <table id="td-cidadaos" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="td-cidadaos_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>CPF / CNPJ</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        
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
            //$('#td-cidadaos').DataTable()
            $('#td-cidadaos').DataTable({
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
            //console.log(id); 
            $(".formdelete").attr('action', ("cidadaos/"+id));
        })

        $( window ).resize(function() {
            if($( window ).width() <= 1100){
                $('.text-show').text('');       
                $('.text-editar').text('');   
                $('.btn-editar').css('float', 'left'); 
                $('.btn-editar').css('width', 28);
                $('.btn-show').css('float', 'left'); 
                $('.btn-show').css('width', 28);
            }else{
                $('.text-show').text('Infos');       
                $('.text-editar').text('Editar');
                $('.btn-editar').css('float', ''); 
                $('.btn-editar').css('width', 'auto');
                $('.btn-show').css('float', ''); 
                $('.btn-show').css('width', 'auto');
            }
        });

        window.onload = function () {
            if($( window ).width() <= 1100){
                $('.text-show').text('');       
                $('.text-editar').text('');   
                $('.btn-editar').css('float', 'left'); 
                $('.btn-editar').css('width', 28);
                $('.btn-show').css('float', 'left'); 
                $('.btn-show').css('width', 28);
            }else{
                $('.text-show').text('Infos');       
                $('.text-editar').text('Editar');
                $('.btn-editar').css('float', ''); 
                $('.btn-editar').css('width', 'auto');
                $('.btn-show').css('float', ''); 
                $('.btn-show').css('width', 'auto');
            }
        }
    </script>
@stop