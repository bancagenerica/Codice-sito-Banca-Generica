<?php

header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$email = $_POST["email"];
$password = $_POST["password"];

$db_host = "sql302.epizy.com";
$db_username = "epiz_22087628";
$db_password = "";
$db_name = "epiz_22087628_BANCA";

$connection = new mysqli($db_host, $db_username, $dbpassword, $db_name);

if ($connection->connect_errno) {
    echo "Connessione fallita: " . $connection->connect_error . ".";
    exit();
}

$str_sql = "SELECT COD_FISC FROM CLIENTE WHERE EMAIL = '" . $email . "' AND (PASSWORD = '" . $password . "')";
$result1 = $connection->query($str_sql);
$connection->close();

if ($result1->num_rows > 0) {

    $connection->close();
    // header("location: /index.html");
    
    $row = $result1->fetch_assoc();
    $cod_fisc = $row["COD_FISC"];
    $connection2 = new mysqli($db_host, $db_username, $dbpassword, $db_name);
    // stringa che dovrà poi essere eseguita per estrarre il saldo e info su transazioni.
    $str_sql = "SELECT SALDO, IBAN FROM CONTO WHERE COD_FISC = '" . $cod_fisc . "'";
    $result2 = $connection2->query($str_sql);    
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
?>

<html>
    <head>
    <title>Conto - Banca Generica</title>
    <meta charset="utf-8" />
    <link rel="icon" href="https://cdn1.iconfinder.com/data/icons/business-and-finance-20/200/vector_65_09-128.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
    <style>
		body {
            margin: 0px;
			padding: 0px;
			height: 100%;
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
            text-align: center;
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
        }

        #b1 {
			width: 20%;
			height: 100%;
            display: flex;
			display: -webkit-flex;
			flex-direction: column;
            background-color: rgb(230, 255, 255);
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
            background-color: rgb(230, 255, 255);
        }

        #home {
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        #b2-p {
            height: 10%;
            margin-left: 2%;
            font-size: 40px;
            font-weight: bold;
        }

        #contenuto {
            height: 40%;
            margin-left: 2%;
            margin-right: 2%;
            text-align: justify;
        }

        #saldo {
            font-size: 150px;
            font-weight: bold;
            color: darkblue;
        }

        #iban {
            font-size: 18px;
        }
        
        #transazioni {
            height: 50%;
            margin-left: 2%;
            margin-right: 2%;
        }
        
        #p-transazioni {
            height: 10%;
            font-size: 40px;
            font-weight: bold;
        }
        
        th {
            background-color: Teal;
            font-size: 20px;
            color: white;
            padding-left: 7px;
            padding-right: 7px;
        }
        
        #avvertenze {
            font-size: 10px;
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
                    <span id="b2-p"><p>SALDO:</p></span>
                    <span id="contenuto">
                        <table border="0" width="100%" height="80%">
    	                    <tr align="left">
                                <td valign="middle">
                                    <p id="saldo"><?php echo "\xE2\x82\xAc" . $row["SALDO"]; ?></p>
                                </td>
                            </tr>
		                </table>
                        <table border="0" width="100%" height="20%">
                            <tr align="left">
                                <td valign="middle">
                                    <p id="iban">
                                        <?php
                                                    $iban = $row["IBAN"];
                                                    echo "IBAN: " . $iban; 
                                                }                   
                                                $connection2->close();
                                            } else {
                                                $connection2->close();
                                                echo "Nessun conto corrispondente alle credenziali selezionate. Per chiarimenti conttattaci alla seguente mail: bancagenerica1@gmail.com";
                                                exit();
                                            }
                                        ?>
                                    </p>
                                </td>
                            </tr>
		                </table>
                    </span>
                    <div id="transazioni">
                        <p id="p-transazioni">ULTIME TRANSAZIONI:</p>
                        <?php
                            $connection3 = new mysqli($db_host, $db_username, $dbpassword, $db_name);
                            $str_sql = "SELECT * FROM TRASFERIMENTO WHERE IBAN_EMITTENTE ='" . $iban . "' OR IBAN_RICEVENTE ='" . $iban . "' ORDER BY DATA DESC LIMIT 5";
                            $result3 = $connection3->query($str_sql);
                            if ($result3->num_rows > 0) {
                                echo "<table><tr><th>ID</th><th>IBAN Emittente</th><th>IBAN Ricevente</th><th>Importo</th><th>Data</th></tr>";
                                while($row = $result3->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td align='center'>" . $row["ID_TRASFERIMENTO"] . "</td>";
                                    echo "<td align='center'>" . $row["IBAN_EMITTENTE"] . "</td>";
                                    echo "<td align='center'>" . $row["IBAN_RICEVENTE"] . "</td>";
                                    echo "<td align='center'>" . $row["IMPORTO"] . "</td>";
                                    echo "<td align='center'>" . $row["DATA"] . "</td>";
                                    echo "</tr>";
                                }        
                                echo "</table>";
                            } else {
                                $connection3->close();
                                echo "Nessuna transazione presente.";
                                exit();
                            }
                            $connection3->close();
                        ?>
                        <div id="avvertenze"><p>Sono mostrate a schermo solo le ultime 5 transazioni.</p></div>
                    </div>
                </div>
                <div id="b3"></div>
            </div>
		</div>
    </body>
</html>
            
<?
} else {
    $connection->close();
    echo "Nome utente o password errati.";
    exit();
}

?>