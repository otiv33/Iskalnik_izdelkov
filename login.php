<?php
    include_once "header.php"
?>

<h1>Prijava</h1>

<form action="login_check.php" method="POST" class="form-group">
    <input type="email" name="email" placeholder="Vnesi email" required="required" class="form-control"/><br/>
    <input type="password" name="pass" placeholder="Vnesi geslo" required="required" class="form-control"/><br/>
    <input type="submit" value="Prijava" class="form-control btn btn-primary"/><br/>
    <br/>
    <div class="d-flex justify-content-center">
        <input type="reset" value="Prekliči" class="btn btn-warning"/><br/>
    </div>
</form>

<?php
    include_once "footer.php"
?>