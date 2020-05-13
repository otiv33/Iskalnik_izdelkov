<?php
    include_once "header.php"
?>

<h1>Registracija</h1>

<form action="register_db.php" method="POST" class="form-group">
    <input type="text" name="name" required="required" placeholder="Vnesi ime" class="form-control"/><br/>
    <input type="text" name="surname" required="required" placeholder="Vnesi priimek" class="form-control"/><br/>
    <input type="email" name="email" required="required" placeholder="Vnesi elektronski naslov" class="form-control"/><br/>
    <input type="password" name="pass" required="required" placeholder="Vnesi geslo" class="form-control"/><br/>
    <input type="password" name="pass2" required="required" placeholder="Ponovi geslo" class="form-control"/><br/>
    <label>Izberite vrsto računa</label>
    <select id="user_type" name="user_type" required="required" class="form-control">
        <option selected value="user">Navaden uporabnik</option>
        <option value="store owner">Lastnik trgovine</option>
    </select> <br/>
    <input type="submit" value="Registracija" class="form-control"/><br/>
</form>

<?php
    include_once "footer.php"
?>