<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <script src="jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#nome").blur(function(){
                    tabel();
                });
                $("#decada").change(function(){
                    tabel();
                });
                function tabel(){
                    nomep =$("#nome").val();
                    decada =$("#decada").val();
                    $.getJSON("https://servicodados.ibge.gov.br/api/v2/censos/nomes/ranking/?decada="+ decada, function(dados){
                        tabelinha = "";
                        console.log(dados[0].res);
                        $.each(dados[0].res, function(indice,valor){
                            estilo = "";
                            if(valor.nome.toUpperCase() == nomep.toUpperCase()){
                                estilo = "style='color:green'";
                            }
                            tabelinha = tabelinha + "<tr><td>" + valor.ranking + "</td><td " + estilo + ">" + valor.nome + "</td><td>" + valor.frequencia + "</td><tr>";
                        });
                        $("#tabelinha").html(tabelinha);
                    });
                };
            });
        </script>
    </head>
    <body>
        <input type ="text" name ="nome" id ="nome" required />
        <input type ="number" name ="decada" id ="decada" min ="1930" max ="2010" step ="10" placeholder="1930"/>
        <hr />
        <table border="1" >
            <tr>
                <td id="titulo">Posição</td>
                <td id="titulo">Nome</td>
                <td id="titulo">Frequência</td>
            </tr>
        </table>
        <table border="1" id="tabelinha">
        </table>
    </body>
</html>