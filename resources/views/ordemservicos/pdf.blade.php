<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
            .header img{ 
                width: 100%;
            }

            .header h5{ 
                text-align: center;
            }

            .header .header-date{ 
                text-align: right;
            }
            .comments{
                margin-top: 70px;
            }
            .content p{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 22px;
            }
            .footer{
                margin-top: 150px;
                width: 100%;
                display: inline-block;
            }
            .footer div{
                float: left;
                width: 49%;
            }
            .small-footer{
                clear: both;
                float: left;
                font-size: 18px;
            }
            .small-footer2{
                clear: both;
                float: left;
                font-size: 20px;
                margin-top: 110px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="img/header.jpg" alt="asdfas">
            <h5>
                ANEXO ÚNICO
            </h5>
            <h5>
                Decreto nº 11.542/15
            </h5>
            <h5>
                <b>
                    Requiremento de Serviços nº {{$ordemservico->numero_ordem}}/{{ substr($ordemservico->data_abertura, 6, 4)}}
                </b>
            </h5>
            <h5 class="header-date">
                Videira, Santa Catarina, {{ date("d/m/Y") }}
            </h5>
        </div>

        <div class="content">
            <p align="justify">
                Eu, <b>{{$cidadao->nome}}</b> inscrito no {{ $cidadao->Type == 1 ? "CPF" : "CNPJ"}} sob o nº <b>{{$cidadao->cpfcnpj}}</b> produtor(a) residente na(o) bairro <b>{{$endereco->bairro}}</b>
                na(o) cidade de <b>{{$endereco->cidade}}</b> no estado de <b>{{$endereco->estado}}</b>, com telefone: <b>{{$cidadao->telefone1}}</b> venho por meio desta requerer a prestação de serviços de até oito (8) horas máquina, 
                consistente no(s) serviço(s) de:
                <b>
                    @foreach($servicos_ordem as $so)
                        @foreach($servicos as $servico)
                            {{ $so == $servico->id ?$servico->descricao.",": null }}
                        @endforeach
                    @endforeach
                </b>e por se tratar de serviço inerente à exploração de atividades agropecuárias, nos termos do artigo 8º, da Lei nº 3.463/2017, 
                declarando sob as penas da lei e da veracidade da declaração, que me utilizei desse benefício neste ano. Me responsabilizo ainda, 
                caso os serviços prestados exceda as oito (8) horas máquina, conforme artigo 8º, da Lei nº 3.463/2017 pelo pagamento do excedente, 
                em conformidade com os termos contidos no Decreto nº 10.682/2013 e a tabela que regulamenta a prestação de serviços nas propriedades rurais, 
                através das máquinas e equipamentos da Secretaria Municipal da Agricultura e Meio Ambiente, com fundamento nos artigos 72 e 125, § 5º da Lei Orgânica e, 
                ainda, a vista do contido nas Leis Municipais nº 1.281/2003(alterada pela Lei nº 2.171/2009) e 2.851/2013, autorizando a expedição de documento hábil a cobrança do excedente (DAM), 
                responsabilizando-me a quitar em trinta (30) dias. Número da Inscrição Estadual de Produtor Rural: <b>{{$cidadao->inscricao_prod_rural}}</b>. Declaro ainda, sob as penas da veracidade da informação, 
                que não possuo débito em aberto junto ao Município de Videira, conforme o artigo 5º do Decreto 10.682/2013.
            </p>
        </div>

        <div class="content">
            <p align="justify" style="white-space: pre-line">
                <b>
                    {{ $ordemservico->observacao }}
                </b>
            </p>
        </div>

        <div class="footer">
            <div>
                <p>
                    Nome: ____________________________
                </p>
                <p>
                    <small class="small-footer">
                        Nome do Responsável pelo Recebimento do Requerimento
                    </small>
                </p>
            </div>
            <div>
                <p>
                    Assinatura: ____________________________
                </p>
                <p>
                    <small class="small-footer">
                        Assinatura do Requerente
                    </small>
                </p>
            </div>
        </div>
        <div class="small-footer2">
            <p>
                <small>
                    (A via original com a assinatura do requerente e do responsável pelo recebimento do requerimento, 
                    ficará arquivada na Secretaria de Agricultura e Meio Ambiente e deverá juntar-se à via com o despacho e 
                    assinatura(s) digital(is) compondo o Processo Administrativo)
                </small>
            </p>
        </div>
        
    </body>
</html>