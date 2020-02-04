<?php

include 'functions.php';

    // recuperare i dati della stanza da salvare
    $numero_stanza = intval($_POST['numero_stanza']);
    $piano = intval($_POST['piano']);
    $letti = intval($_POST['letti']);
    // Costruisco le query in base all'operazione letta dall'input hidden del form di provenienza
    var_dump($_POST['operazione']);
    switch ($_POST['operazione']) {
        case crea:
            if(!empty($_POST) && controlla_dati_stanza($_POST['numero_stanza'], $_POST['piano'], intval($_POST['letti'])))
            {
            // salvare la stanza nel db
            $sql = "INSERT INTO stanze (room_number, floor, beds, created_at, updated_at) VALUES ($numero_stanza, $piano, $letti, NOW(), NOW())";
            $result = esegui_query($sql);
            } else {
                $result = false;
            }

            if($result) {
                $get_message = '?success=true';
            } else {
                $get_message = '?success=false';
            }

            // Visualizzare un messaggio di conferma => redirect con parametro GET
            header('Location: create.php' .$get_message);

            break;
        case modifica:
            if (!empty($_POST['id_stanza'])) {
                // salvare la stanza nel db (salvare le  modifiche)
                $id_stanza = intval($_POST['id_stanza']);
                $sql = "UPDATE stanze SET room_number = $numero_stanza, floor = $piano, beds = $letti, updated_at = NOW() WHERE id=".$id_stanza;
                $result = esegui_query($sql);

            } else {
                $result = false;
            }

            if($result) {
                $get_message = '?success=true&id_stanza='.$id_stanza;
            } else {
                $get_message = '?success=false='.$id_stanza;
            }

            // Visualizzare un messaggio di conferma => redirect con parametro GET
            header('Location: edit.php' .$get_message);

            break;
        case cancella:
            if (!empty($_POST['id_stanza'])) {
                $id_stanza = intval($_POST['id_stanza']);
                $sql = "DELETE FROM stanze WHERE id=".$id_stanza;
                $result = esegui_query($sql);

            } else {
                $result = false;
            }

            if($result) {
                $get_message = '?success=true';
            } else {
                $get_message = '?success=false';
            }

            // Visualizzare un messaggio di conferma => redirect con parametro GET
            header('Location: index.php' .$get_message);

            break;
    }
