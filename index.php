<?php

include 'functions.php';
$sql = "SELECT id, room_number, floor, beds FROM stanze";
$result = esegui_query($sql);

// apertura tag html, head e body + inclusione navbar
include 'layout/head.php';
?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Tutte le stanze dell'hotel</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a id="crea-stanza" class="btn btn-success" href="create.php">
                        Crea nuova stanza
                    </a>
                </div>
            </div>

            <?php
            if(!empty($_GET['success'])) { ?>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> <?
                        if($_GET['success'] == 'true') { ?>
                            <div class="alert alert-success" role="alert">
                                Stanza eliminata con successo!
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

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Numero Stanza</th>
                                    <th>Piano</th>
                                    <th>Numero Letti</th>
                                    <th class="text-right">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->num_rows > 0) {

                                    // output data of each row
                                    while($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['room_number']; ?></td>
                                            <td><?php echo $row['floor']; ?></td>
                                            <td><?php echo $row['beds']; ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-info" href="details.php?id_stanza=<?php echo $row['id']; ?>">
                                                    Visualizza
                                                </a>
                                                <a class="btn btn-warning" href="edit.php?id_stanza=<?php echo $row['id']; ?>">
                                                    Modifica
                                                </a>
                                                <a class="btn btn-danger" href="delete.php?id_stanza=<?php echo $row['id']; ?>">
                                                    Cancella
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                	}
                                } elseif ($result) { ?>
                                    <tr>
                                        <td colspan="3">Non ci sono risultati</td>
                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">Si è verificato un errore</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
<?php
// footer + chiusura body e html
include 'layout/footer.php'

 ?>
