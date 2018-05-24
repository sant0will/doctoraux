@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Cidadãos</h3>
            <a href="/cidadaos/create" class="btn bg-blue pull-right btn-cadastro-cidadao"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar novo cidadão</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
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
                        @foreach($cidadaos as $cidadao)
                        <tr>
                            <td>{{$cidadao->id}}</td>
                            <td>{{$cidadao->nome}}</td>
                            <td>{{$cidadao->cpfcnpj}}</td>
                            <td>{{$cidadao->email}}</td>
                            <td> 
                                <a type="button" class="btn-show btn-sm bg-blue" href="/cidadaos/{{$cidadao->id}}">
                                    <i class="fa-tables fa fa-eye" aria-hidden="true"></i>
                                    <span class="text-show">Infos</span>
                                </a>
                                <a type="button" class="btn-editar btn-modal btn-sm bg-yellow" href="/cidadaos/{{ $cidadao->id }}/edit">
                                    <i class="fa-tables fa fa-pencil" aria-hidden="true"></i>
                                    <span class="text-editar">Editar</span>
                                </a>
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