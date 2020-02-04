<?php
// apertura tag html, head e body + inclusione navbar
include 'layout/head.php';

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Crea una nuova stanza</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a id="torna-in-home" class="btn btn-success" href="index.php">
                    Torna in homepage
                </a>
            </div>
        </div>

        <?php
        if(!empty($_GET['success'])) { ?>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3"> <?
                    if($_GET['success'] == 'true') { ?>
                        <div class="alert alert-success" role="alert">
                            Stanza inserita con successo!
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
        } ?>

        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="operations_crud.php">
                  <input type="hidden" name="operazione" value="crea">
                  <div class="form-group">
                    <label for="numero_stanza">Numero stanza</label>
                    <input name="numero_stanza" type="text" class="form-control" id="numero_stanza" placeholder="Numero stanza" required>
                  </div>
                  <div class="form-group">
                    <label for="piano">Piano</label>
                    <input name="piano" type="text" class="form-control" id="piano" placeholder="Piano" required>
                  </div>
                  <div class="form-group">
                    <label for="letti">Numero letti</label>
                    <input name="letti" type="text" class="form-control" id="letti" placeholder="Letti" required>
                  </div>
                  <button id="crea-stanza-create" name="create-button" type="submit" class="btn btn-success">Crea stanza</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
// footer + chiusura body e html
include 'layout/footer.php'

 ?>
