<h1>Register Page</h1>
<?php
require_once __DIR__ . '/../init.php';

?>

<form action="/actions/register.php" method="post">
    <label for="firstname">Firstname :</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">Lastname :</label>
    <input type="text" name="lastname" id="lastname">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email">

    <label for="number_phone">Number-phone :</label>
    <input type="number" name="number_phone" id="email">


    <label for="password">Password :</label>
    <input type="password" name="password" id="password">
    <label for="cpassword">Confirm Password :</label>
    <input type="password" name="cpassword" id="cpassword">

    <input type="submit" value="Envoyez">
</form>