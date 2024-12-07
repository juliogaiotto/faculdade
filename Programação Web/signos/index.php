<?php include('layouts/header.php'); ?>


    <form id="signo-form" method="POST" action="show_zodiac_sign.php">
    <div class="row">
        <div class="col-lg-3 mx-auto">
            <div class="p-2">
                <h4>Descubra seu Signo</h4>
                
                <label for="fname" class="m-2 form-label">Data de nascimento:</label><br>
                <input id="data_nascimento" name="data_nascimento" type="date" class="m-2 form-control">
                <button type="submit" class="m-2 form-control btn btn-primary w-100">Sign in</button>
                
                <!-- <input class="form-control" type="submit" value="Submit"> -->
            </div>
        </div>
    </div>
    </form>

<?php include('layouts/footer.php'); ?>