<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="/css/app.css"
</head>
<body>

<div class="container">
    <h1>Listagem de produtos</h1>

    <table class="table">

        <th>NOME</th>
        <th>VALOR</th>
        <th>DESCRICAO</th>
        <th>QUANTIDADE</th>

        <?php foreach ($produtos as $p) : ?>

        <tr>
            <td><?= $p->nome ?></td>
        </tr>
        <tr>
            <td><?= $p->valor ?></td>
        </tr>
        <tr>
            <td><?= $p->descricao ?></td>
        </tr>
        <tr>
            <td><?= $p->quantidade ?></td>
        </tr>
        <tr>
            <td><a href="/detalhes/produto/<?= $p->id ?>"><span class="glyphicon glyphicon-search"></span></a></td>
        </tr>

        <?php endforeach ?>

    </table>

</div>
</body>
</html>