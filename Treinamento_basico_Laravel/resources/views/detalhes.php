<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="/css/app.css"
</head>
<body>

<div class="container">
    <h1>Detalhes do produto</h1>

    <table class="table">
        <tr>
            <td>NOME : </td><td><?= $produto->nome ?></td></br>
            <td>VALOR : </td><td><?= $produto->valor ?></td></br>
            <td>DESCRIÇÃO : </td><td><?= $produto->descricao ?></td></br>
            <td>QUANTIDADE : </td><td><?= $produto->quantidade ?></td></br>
            <td></td><td><a href="lista/">listagem de produtos</a></td></br>
        </tr>

    </table>

</div>
</body>
</html>