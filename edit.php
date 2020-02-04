<?php

include 'functions.php';

// Pagina dettaglio stanza

$sql = "SELECT * FROM stanze WHERE id = " . $_GET['id_stanza'];
$result = esegui_query($sql);
// visualizzo i dettagli della stanza

include 'layout/head.php';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Modifica una stanza</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a id="torna-in-home" class="btn btn-success" href="index.php">
                    Torna in homepage
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($result && $result->num_rows > 0) {
                    if(!empty($_GET['success'])) { ?>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3"> <?
                                if($_GET['success'] == 'true') { ?>
                                    <div class="alert alert-success" role="alert">
                                        Stanza modificata con successo!
                                    </div>
                                    <?php
                                } else { ?>
                                    <div class="alert alert-danger" role="alert">
                                        Si è verificato un errore.
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                    // output data of each row
                    $row = $result->fetch_assoc(); ?>
                <form method="post" action="operations_crud.php">
                    <input type="hidden" name="id_stanza" value="<?php echo $row['id'] ?>">
                    <input type="hidden" name="operazione" value="modifica">
                  <div class="form-group">
                    <label for="numero_stanza">Numero stanza</label>
                    <input name="numero_stanza" type="text" class="form-control" value="<?php echo $row['room_number'];?>" id="numero_stanza" required>
                  </div>
                  <div class="form-group">
                    <label for="piano">Piano</label>
                    <input name="piano" type="text" class="form-control" id="piano" value="<?php echo $row['floor'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="letti">Numero letti</label>
                    <input name="letti" type="text" class="form-control" id="letti" value="<?php echo $row['beds'];?>" required>
                  </div>
                  <button id="crea-stanza-create" name="edit-button" type="submit" class="btn btn-success">Modifica stanza</button>
                </form>
                <?php
            } elseif ($result) { ?>
                <p>Non ci sono risultati</p>
                <?php
            } else {
                ?>
                <p>Si è verificato un errore</p>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</main>

<?php
// footer + chiusura body e html
include 'layout/footer.php'

 ?>
