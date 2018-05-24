<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <meta charset="UTF-8">
        <style type="text/css">

        </style>
    </head>
    <body>
        <div class="header">
            <h4>Olá {{$nome}},</h4>
            <p>Atendemos a sua solicitação de recuperação da senha de access ao sistema <b>SisObras</b>. <br>
               Utilize a senha gerada abaixo para acessar sua conta. </p><br>
            <h4>Data da Solicitação: {{ $data }}.</h4>
            <h4>Senha: {{$senha}}</h4><br>
        </div>
        <div class="footer">
            <p> Caso não tenha conhecimento do que se trata este e-mail, desconsidere-o. </p> 
            <p> Em caso de dúvida ou problemas relacionados a recuperação de senha, entre em contato pelo email: ti.hernandez@videira.sc.gov.br </p>
            <p> Atenciosamente </p>
        </div>
    </body>
</html>