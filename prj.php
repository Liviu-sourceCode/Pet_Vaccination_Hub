<?php
$servername = "localhost"; // Sau adresa IP a serverului MySQL
$port = "port"; // Portul implicit pentru MySQL
$username = "username";
$password = "########"; // Parola ta de conexiune
$database = "database_name";

// Crearea conexiunii
$conn = new mysqli($servername . ':' . $port, $username, $password, $database);

// Verifica conexiunea
if ($conn->connect_error) {
    die("Conexiune esuata: " . $conn->connect_error);
}

//se verifica daca exista vreo cerere de tip POST
if (($_SERVER["REQUEST_METHOD"])  == "POST") {
//zona pentru gestionarea animalelor

    // Adăugare animal
    if (isset($_POST["adauga_animal"])) {
        $nume_animal = $_POST["nume_animal"];
        $specie = $_POST["specie"];
        $varsta = $_POST["varsta"];
  
        $sql = "INSERT INTO animale (nume, specie, varsta) VALUES ('$nume_animal', '$specie', $varsta)";
        if ($conn->query($sql) === TRUE) {
            // Dacă inserarea a fost reușită, extragem ID-ul animalului adăugat
        $last_inserted_id = $conn->insert_id;
        echo "Animalul a fost adăugat cu succes! ID-ul animalului este: " . $last_inserted_id . "<br>";
            
        } else {
            echo "Eroare: " . $sql . "<br>" . $conn->error;
        }
    }


    // Ștergere animal
    if (isset($_POST["sterge_animal"])) {
        $id_animal = $_POST["id_animal"];

        // Verificăm dacă ID-ul există în tabel
        $check_query = "SELECT id FROM animale WHERE id = $id_animal";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // ID-ul există în tabel, efectuăm operația de ștergere
            $delete_query = "DELETE FROM animale WHERE id = $id_animal";
            if (mysqli_query($conn, $delete_query)) {
                echo "Animalul cu ID-ul $id_animal a fost șters cu succes!<br>";
            } else {
                echo "Eroare la ștergerea animalului: " . mysqli_error($conn);
            }
        } else {
            // ID-ul nu există în tabel, afișăm un mesaj corespunzător
            echo "Nu există nici un animal cu ID-ul $id_animal!<br>";
        }
    } 

// Stergerea tuturor animalelor
    if(isset($_POST["sterge_toate_animalele"])){
    $sql = "DELETE FROM animale";
    if (mysqli_query($conn, $sql)) {
    echo "Toate datele din tabelul 'animale' au fost șterse cu succes!<br>";
    $reset_auto_increment = "ALTER TABLE animale AUTO_INCREMENT = 1";

// Executarea comenzii SQL
if (mysqli_query($conn, $reset_auto_increment)) {
    echo "Incrementul a fost resetat cu succes!";
} else {
    echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
}
} else {
    echo "Eroare la ștergerea datelor din tabelul 'animale': " . mysqli_error($conn);
}
    }

// Comanda SQL pentru selectarea tuturor inregistrarilor din tabelul "animale"
$sql_select_animale = "SELECT * FROM animale";
$result = $conn->query($sql_select_animale);

// Verifica daca interogarea a returnat rezultate

if ($result->num_rows > 0 && (isset($_POST["adauga_animal"]) || isset($_POST["sterge_animal"])))  {
    echo "Elementele din tabelul 'animale':<br>";
    // Afiseaza rezultatele
    while ($row = $result->fetch_assoc()) {
        
        echo " ID: " . $row["id"] . " - Nume: " . $row["nume"] . " - Specie: " . $row["specie"] . " - Varsta: " .$row["varsta"] . "<br>";
    }
 } else if(isset($_POST["sterge_animal"])) {
    echo "Nu au fost gasite inregistrari in tabelul 'animale'!<br>";

    // Comanda SQL pentru a reseta incrementul
$reset_auto_increment = "ALTER TABLE animale AUTO_INCREMENT = 1";

// Executarea comenzii SQL
if (mysqli_query($conn, $reset_auto_increment)) {
    echo "Incrementul a fost resetat cu succes!";
  } else {
    echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
  }
 }

// zona pentru gestionarea vaccinurilor

    // Adăugare vaccin
    if (isset($_POST["adauga_vaccin"])) {
        $nume_vaccin = $_POST["nume_vaccin"];
        $tip_vaccin = $_POST["tip_vaccin"];
        $data_aplicare = $_POST["data_aplicare"];
        

        $sql = "INSERT INTO vaccinuri (nume, tip) VALUES ('$nume_vaccin', '$tip_vaccin')";
        if ($conn->query($sql) === TRUE) {
            echo "Vaccinul a fost adăugat cu succes!";

            // Extragem ID-ul vaccinului adăugat
            $last_inserted_id = $conn->insert_id;
            echo " ID-ul vaccinului este: " . $last_inserted_id . "<br>";
        } else {
            echo "Eroare la adăugarea vaccinului: " . $conn->error;
        }
    }

    // Ștergere vaccin
    if (isset($_POST["sterge_vaccin"])) {
        $id_vaccin = $_POST["id_vaccin"];

        $check_query = "SELECT id FROM vaccinuri WHERE id = $id_vaccin";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $delete_query = "DELETE FROM vaccinuri WHERE id = $id_vaccin";
            if (mysqli_query($conn, $delete_query)) {
                echo "Vaccinul cu ID-ul $id_vaccin a fost șters cu succes!<br>";
            } else {
                echo "Eroare la ștergerea vaccinului:" . mysqli_error($conn);
            }
        } else {
            echo "Nu există niciun vaccin cu ID-ul $id_vaccin!<br>";
        }
    }

    // Ștergere tuturor vaccinurilor
    if (isset($_POST["sterge_toate_vaccinurile"])) {
        $sql_delete_all = "DELETE FROM vaccinuri";
        if (mysqli_query($conn, $sql_delete_all)) {
            echo "Toate datele din tabelul 'vaccinuri' au fost șterse cu succes!<br>";
            $reset_auto_increment = "ALTER TABLE vaccinuri AUTO_INCREMENT = 1";
            if (mysqli_query($conn, $reset_auto_increment)) {
                echo "Incrementul a fost resetat cu succes!<br>";
            } else {
                echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
            }
        } else {
            echo "Eroare la ștergerea datelor din tabelul 'vaccinuri': " . mysqli_error($conn);
        }
    }

    // Selectare și afișare vaccinuri
    $sql_select_vaccinuri = "SELECT * FROM vaccinuri";
    $result = $conn->query($sql_select_vaccinuri);

    if ($result->num_rows > 0 && (isset($_POST["adauga_vaccin"]) || isset($_POST["sterge_vaccin"])))  {
        echo "Elementele din tabelul 'vaccinuri':<br>";
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nume: " . $row["nume"]. " - Tip: " . $row["tip"]  .  "<br>";
        }
    } else if(isset($_POST["sterge_vaccin"])) {
        echo "Nu au fost găsite înregistrări în tabelul 'vaccinuri'!<br>";
    }

    // Resetează incrementul dacă nu există înregistrări în tabelul vaccinuri
    if ($result->num_rows == 0 &&  isset($_POST["sterge_vaccin"])) {
        $reset_auto_increment = "ALTER TABLE vaccinuri AUTO_INCREMENT = 1";
        if (mysqli_query($conn, $reset_auto_increment)) {
            echo "Incrementul a fost resetat cu succes!";
        } else {
            echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
        }
    }

  // Vizualizare animale si vaccinuri disponibile

  $sql_select_animale = "SELECT * FROM animale";
  $result = $conn->query($sql_select_animale);
  
  if (isset($_POST["verifica"])) {
      if ($result->num_rows > 0) {
          echo "Elementele din tabelul de animale:<br>";
          while ($row = $result->fetch_assoc()) {
            echo " ID: " . $row["id"]. " - Nume: " . $row["nume"]. " - Specie: " . $row["specie"]. " - Varsta: " .$row["varsta"] . "<br>";
          }
      } else {
          echo "Nu au fost găsite înregistrări în tabelul 'animale'!<br>";
      }

      $sql_select_vaccinuri = "SELECT * FROM vaccinuri";
      $result = $conn->query($sql_select_vaccinuri);

    if ($result->num_rows > 0) {
        echo "Elementele din tabelul de vaccinuri:<br>";
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nume: " . $row["nume"]. " - Tip: " . $row["tip"]  .  "<br>";
        }
    } else {
        echo "Nu au fost găsite înregistrări în tabelul 'vaccinuri'!<br>";
    }

    $sql_select_administrare_vaccinuri = "SELECT * FROM administrare_vaccinuri";
    $result = $conn->query($sql_select_administrare_vaccinuri);

    if ($result -> num_rows > 0) {
         echo "Elementele din tabelul 'administrare vaccinuri':<br>";
         while ($row = $result ->fetch_assoc()){
            echo "ID: " . $row["id"] . " -ID animal: " . $row["id_animal"] . " -ID vaccin: " . $row["id_vaccin"] . " -Data aplicare: " . $row["data_aplicare"] . "<br>"; 
         } 

    } else {
        echo "Nu au fost gasite inregistrari in tabelul 'administrare vaccinuri'!<br>";
        if ($result->num_rows == 0) {
            $reset_auto_increment = "ALTER TABLE administrare_vaccinuri AUTO_INCREMENT = 1";
            if (mysqli_query($conn, $reset_auto_increment)) {
                echo "Incrementul a fost resetat cu succes!";
            } else {
                echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
            }
        }
     }
  }



    // zona pentru administrarea vaccinurilor
    
    if (isset($_POST["salveaza_administrarea"])) {
     
            $id_animal = $_POST["id_animal_ad"];
            $id_vaccin = $_POST["id_vaccin_ad"];
            $data_aplicare = $_POST["data_aplicare"];
        
            // Verificăm dacă animalul există în baza de date
            $animal_query = "SELECT id FROM animale WHERE id = $id_animal";
            $animal_result = mysqli_query($conn, $animal_query);
            if (mysqli_num_rows($animal_result) == 0) {
                echo "Animalul specificat nu există în baza de date.";
                exit; // Ieșim din script dacă animalul nu există
            } 
            
        
            // Verificăm dacă vaccinul există în baza de date
            $vaccin_query = "SELECT id FROM vaccinuri WHERE id = $id_vaccin";
            $vaccin_result = mysqli_query($conn, $vaccin_query);
            if (mysqli_num_rows($vaccin_result) == 0) {
                echo "Vaccinul specificat nu există în baza de date.";
                exit; // Ieșim din script dacă vaccinul nu există
            }
        
            // Inserarea datelor în tabelul de administrare a vaccinurilor
$sql = "INSERT INTO administrare_vaccinuri (id_animal, id_vaccin, data_aplicare) VALUES ('$id_animal', '$id_vaccin', '$data_aplicare')";
if ($conn->query($sql) === TRUE) {
    // Interogarea pentru a obține numele animalului
    $animal_query = "SELECT nume FROM animale WHERE id = $id_animal";
    $result_animal = $conn->query($animal_query);
    
    // Interogarea pentru a obține numele vaccinului
    $vaccin_query = "SELECT nume FROM vaccinuri WHERE id = $id_vaccin";
    $result_vaccin = $conn->query($vaccin_query);
    
    // Verificăm dacă ambele interogări au returnat rezultate
    if ($result_animal->num_rows > 0 && $result_vaccin->num_rows > 0) {
        // Extragem datele din rândurile rezultate
        $row_animal = $result_animal->fetch_assoc();
        $row_vaccin = $result_vaccin->fetch_assoc();
        
        // Afișăm mesajul de succes folosind numele animalului și al vaccinului
        echo "Administrarea vaccinului " . "'" .$row_vaccin["nume"] . "'" ." pentru animalul " . "'" .$row_animal["nume"] . "'" . " la data de '$data_aplicare' a fost realizată cu succes!";
    } else {
        echo "Nu s-au găsit înregistrări pentru ID-urile specificate.";
    }
} else {
    // Afișăm eroarea specifică pentru interogarea de inserare
    echo "Eroare la administrarea vaccinului: " . $sql . "<br>" . $conn->error;
   }
  }

  if (isset($_POST["sterge_administrarea"])) {
    $id_administrare = $_POST["id_administrare"];

    // Verificăm dacă ID-ul există în tabel
    $check_query = "SELECT id FROM administrare_vaccinuri WHERE id = $id_administrare";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // ID-ul există în tabel, efectuăm operația de ștergere
        $delete_query = "DELETE FROM administrare_vaccinuri WHERE id = $id_administrare";
        if (mysqli_query($conn, $delete_query)) {
            echo "Administrarea cu ID-ul $id_administrare a fost ștearsa cu succes!<br>";
            $sql_select_administrare_vaccinuri = "SELECT * FROM administrare_vaccinuri";
            $result = $conn->query($sql_select_administrare_vaccinuri);
        if ($result->num_rows == 0) {
            $reset_auto_increment = "ALTER TABLE administrare_vaccinuri AUTO_INCREMENT = 1";
            if (mysqli_query($conn, $reset_auto_increment)) {
                echo "Incrementul a fost resetat cu succes.";
            } else {
                echo "Eroare la resetarea incrementului: " . mysqli_error($conn);
            }
        }
        } else {
            echo "Eroare la ștergerea administrarii: " . mysqli_error($conn);
        }
    } else {
        // ID-ul nu există în tabel, afișăm un mesaj corespunzător
        echo "Nu există nici o administrare cu ID-ul $id_administrare!<br>";
        
    }

  }
} 

// Închide conexiunea
$conn->close();

