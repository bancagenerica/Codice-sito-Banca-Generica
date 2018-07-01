<?php
    // In questi header elimino il caching del browser.
    header("Expires: on, 01 Jan 1970 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    
    // Prendo le variabili acquisite in input dal file "registrazione.html" che richiama questo script PHP.
    $cod_fisc = strtoupper($_POST["cod_fiscale"]);
    $nome = strtoupper($_POST["nome"]);
    $cognome = strtoupper($_POST["cognome"]);
    $via = strtoupper($_POST["via"]);
    $n_civico = $_POST["n_civico"];
    $data_nascita = $_POST["data_nascita"];
    $residenza = strtoupper($_POST["residenza"]);
    $n_telefono = $_POST["n_telefono"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Assegno i valori a queste variabili per comporre la stringa di connessione.
    $db_host = "sql302.epizy.com";
    $db_username = "epiz_22087628";
    $db_password = "";
    $db_name = "epiz_22087628_BANCA";
    
    // Mi connetto al database.
    $connection = new mysqli($db_host, $db_username, $dbpassword, $db_name);
    
    // Verifico che non ci siano errori di connessione.
    if ($connection->connect_errno) {
        echo "Connessione fallita: " . $connection->connect_error . ".";
        exit();
    }
    
    // Funzione che restituisce una lettera random dalla 'A' alla 'Z'. Utilizzata per determinare un componente dell'IBAN (il CIN).
    function randomString($length = 1) {
        $str = "";
        $characters = array_merge(range('A','Z'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
    		$rand = mt_rand(0, $max);
    		$str .= $characters[$rand];
	    }
	    return $str;
    }
    
    // Creo l'IBAN randomizzandone ogni componente (Numero di controllo, CIN, ABI, CAB, numero conto).
    $num_controllo = mt_rand(10, 99);
    $cin = randomString(1);
    $abi = mt_rand(10000, 99999);
    $cab = mt_rand(10000, 99999);
    $n_conto = mt_rand(100000000000, 999999999999);
    $iban = "IT" .  $num_controllo . $cin . $abi . $cab . $n_conto;
    
    // Creo le query da eseguire nel database.
    $str_sql1 = "INSERT INTO CLIENTE (COD_FISC, NOME, COGNOME, DATA_NASCITA, VIA, N_CIVICO, RESIDENZA, EMAIL, PASSWORD, NUM_TEL) VALUES ('" . $cod_fisc . "', '" . $nome . "', '" . $cognome . "', '" . $data_nascita . "', '" . $via . "', '" . $n_civico . "', '" . $residenza . "', '" . $email . "', '" . $password . "', '" . $n_telefono . "')";
    $str_sql2 = "INSERT INTO CONTO (IBAN, SALDO, INTERESSE, COD_FISC) VALUES ('" . $iban . "', " . 0 . ", " . 5 . ", '" . $cod_fisc . "')";
    $connection->query($str_sql1);
    $connection->query($str_sql2);
    $i = 0;
    
    $connection->close();
?>

<html>
    <head>
        <title>Registrazione completata - Banca Generica</title>
        <meta charset="utf-8" />
        <link rel="icon" href="https://cdn1.iconfinder.com/data/icons/business-and-finance-20/200/vector_65_09-128.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <style>
            body {
                margin: 0px;
                padding: 0px;
			    height: 100%;
                width: 100%;
			    display: flex;
			    display: -webkit-flex;
			    justify-content: center;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            #contenitore {
			    width: 100%;
			    height: 100%;
			    display: flex;
			    display: -webkit-flex;
			    flex-direction: column;
                font-family: 'Montserrat', sans-serif;
            }

            #a {
                background-color: Teal;
                color: white;
			    width: 100%;
			    height: 10%;
                display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
            }

            #a1 {       
                width: 10%;
			    height: 100%;
            }

            #a2 {
                width: 80%;
			    height: 100%;
            }

            #a3 {
                width: 10%;
			    height: 100%;
            }

            #b {
			    width: 100%;
			    height: 90%;
                display: flex;
			    display: -webkit-flex;
			    flex-direction: row;
                background-color: rgb(230, 255, 255);
            }
            
            #b1 {
			    width: 20%;
			    height: 100%;
                display: flex;
			    display: -webkit-flex;
			    flex-direction: column;
            }

            #b1-void {
                width: 100%;
			    height: 95%;
            }

            #b1-ancor {
                width: 100%;
			    height: 5%;
                text-align: center;
            }

            #indietro {
                text-decoration: none;
                color: DarkBlue;
            }

            #indietro:hover {
                color: Teal;
            }

            #b2 {
			    width: 60%;
			    height: 100%;
                display: flex;
			    display: -webkit-flex;
			    flex-direction: column;
            }

            #b3 {
			    width: 20%;
			    height: 100%;
            }

            #home {
                color: white;
                font-size: 30px;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div id="contenitore">
            <div id="a">
                <div id="a1">
                    <table border="0" width="100%" height="100%">
		                <tr align="left">
                            <td valign="middle">
                                <a href="index.html"><img src="https://cdn1.iconfinder.com/data/icons/business-and-finance-20/200/vector_65_09-64.png"></a>
                            </td>
                        </tr>
		            </table>
                </div>
                <div id="a2">
                    <table border="0" width="100%" height="100%">
		                <tr align="center">
                            <td valign="middle">
                                <p id="home">BANCA GENERICA</p>
                            </td>
                        </tr>
		            </table>
                </div>
                <div id="a3"></div>
            </div>
            <div id="b">
                <div id="b1">
                    <div id="b1-void"></div>
                    <div id="b1-ancor"><a id="indietro" href="index.html">Torna indietro</a></div>
                </div>
                <div id="b2">
                    <table border="0" width="100%" height="100%">
		                <tr align="center">
                            <td valign="middle">
                                <p>Registrazione avvenuta con successo.</p>
                             </td>
                        </tr>
		            </table>
                </div>
                <div id="b3"></div>
            </div>
        </div>
    </body>
</html>