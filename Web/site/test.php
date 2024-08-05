<?php 
$itens = [
    ['descricao' => 'Item 1', 'nome' => 'item1', 'valor' => 10.00],
    ['descricao' => 'Item 2', 'nome' => 'item2', 'valor' => 20.00],
    ['descricao' => 'Item 3', 'nome' => 'item3', 'valor' => 30.00],
    ['descricao' => 'Item 4', 'nome' => 'item4', 'valor' => 40.00],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soma de Valores e Itens Escolhidos</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <form id="itens-form">
        <label for="itens">Escolha os itens:</label>
        <select id="itens" name="itens" multiple="multiple" style="width: 100%;">
            <?php foreach ($itens as $item): ?>
                <option value="<?php echo $item['valor']; ?>" data-descricao="<?php echo $item['descricao']; ?>">
                    <?php echo $item['descricao']; ?> - <?php echo $item['nome']; ?> - R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <p>Total: R$ <span id="total">0.00</span></p>
    <p>Itens Escolhidos: <span id="chosen-items"></span></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#itens').select2();

            $('#itens').on('change', function() {
                let total = 0;
                let chosenItems = [];
                $('#itens option:selected').each(function() {
                    total += parseFloat($(this).val());
                    chosenItems.push($(this).data('descricao'));
                });
                $('#total').text(total.toFixed(2));
                $('#chosen-items').text(chosenItems.join(', '));
            });
        });
    </script>
</body>
</html>
