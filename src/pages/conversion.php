<form action="/actions/conversion.php" method="post">
    <p>FROM</p>
    <label for="amount">Amount :</label>
    <input type="text" name="amount" id="amount-convert">
    <label for="currency">Choose your currency :</label>
    <select name="currency">
        <option disabled selected="selected">--Please choose an option--</option>
        <?php
        $dbManager = new DbManager($db);
        $results = $dbManager->getAll("currencies");
        foreach ($results as $result) { ?>
            <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>;
        <?php } ?>
    </select>
    <!-- <p>TO</p> -->
    <!-- <label for="amount-to">Result :</label>
    <input type="text" name="amount-to" id="amount-convert-to" readonly>
    <label for="currency-to">Choose your currency :</label> -->
    <select name="currencyfin">
        <option disabled selected="selected">--Please choose an option--</option>
        <?php
        $dbManager = new DbManager($db);
        $results = $dbManager->getAll("currencies");
        foreach ($results as $result) { ?>
            <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>;
        <?php } ?>
    </select>

    <input type="submit" value="Convert">
</form>