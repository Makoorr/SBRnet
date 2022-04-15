<?php
    require_once('config.php');
    require_once('mail.php');
?>

<?php
    //done tkoun empty (yaani mehoush mizel ki checkouta)
    $test=! empty ($_POST) && ! empty($_COOKIE) && ! isset($_COOKIE['done']) && ! empty($_POST['nom']) && ! empty($_POST['prenom']) 
        && ! empty($_POST['email']) && ! empty($_POST['phone']) && ! empty($_POST['ville']) && ! empty($_POST['address']) && ! empty($_POST['zip']);
    if($test){
        if(isset($_POST['nom']))
        $nom=$_POST['nom'];
        if(isset($_POST['prenom']))
        $prenom=$_POST['prenom'];
        if(isset($_POST['email']))
        $email=$_POST['email'];
        if(isset($_POST['phone']))
        $phone=$_POST['phone'];
        if(isset($_POST['ville']))
        $ville=$_POST['ville'];
        if(isset($_POST['address']))
        $address=$_POST['address'];
        if(isset($_POST['zip']))
        $zip=$_POST['zip'];

        if(isset($_COOKIE['cartquantity']))
        $cartquantity=$_COOKIE['cartquantity'];
        if(isset($_COOKIE['total']))
        $total=$_COOKIE['total'];

        $date=date("Y-m-d");
        date_default_timezone_set("Africa/Tunis");
        $time=date("H:i:s");

        //Checking if commande deja put into here (fi nhar heka)
        $sql = "SELECT nom,prenom,email,phone,ville,address,zip,total,cartquantity,date from commande where nom='$nom' and prenom='$prenom' and date='$date'
                                and email='$email' and phone='$phone' and ville='$ville' and address='$address' and zip='$zip' and total='$total' and cartquantity='$cartquantity';";

        foreach ($db->query($sql) as $com) {
            $checknom=$com['nom'];
            $checkprenom=$com['prenom'];
            $checkdate=$com['date'];
            $checkemail=$com['email'];
            $checkphone=$com['phone'];
            $checkville=$com['ville'];
            $checkaddress=$com['address'];
            $checkzip=$com['zip'];
            $checktotal=$com['total'];
            $checkcartquantity=$com['cartquantity'];
        }

        if ( $nom!=$checknom or $prenom!=$checkprenom or $date!=$checkdate or $email!=$checkemail
        or $phone!=$checkphone or $ville!=$checkville or $address!=$checkaddress or $zip!=$checkzip or $total!=$checktotal or $cartquantity!=$checkcartquantity    
        ){ //Menghir INSERT ken el commande bel details hedhom deja mawjouda (fel nhar hedha kahaw el verif)

        function CheckCookieById($id){
            if(! empty($_COOKIE["img$id"]) && ! empty($_COOKIE["price$id"]) && ! empty($_COOKIE["quantity$id"]) && ! empty($_COOKIE["name$id"]))
                return true;
            else
                return false;
        }

        if($cartquantity>0)
            $s=$cartquantity; //decompteur s
        else
            $s=0;

        $x=1;

        $sql = "INSERT INTO commande (nom,prenom,email,phone,ville,address,zip,total,cartquantity,date,time) VALUES(:nom,:prenom,:email,:phone,:ville,:address,:zip,:total,:cartquantity,:date,:time)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':phone'=>$phone,':ville'=>$ville,':address'=>$address,':zip'=>$zip,':total'=>$total,':cartquantity'=>$cartquantity,':date'=>$date,':time'=>$time]);

        //getting the idcommande
        $sql = "SELECT idcommande from commande where nom='$nom' and prenom='$prenom' and date='$date' and time='$time'";
        foreach ($db->query($sql) as $idcom) {
            $idcommande=$idcom['idcommande'];
        }

        //initialiazing tab elements
        $tab="";

        while($s!=0){ //Ajout lel entité achat
            if(CheckCookieById($x)){

                //getting products' details from cookies
                $namex=$_COOKIE["name$x"];
                $prixx=intval($_COOKIE["price$x"]);
                $quantityx=$_COOKIE["quantity$x"];
                $pricex=intval($_COOKIE["price$x"])*intval($_COOKIE["quantity$x"]); //prix total (prix unitaire * quantite)
                
                //appending ltab
                $tab.=" <tr style='color:white;'>
                            <td style='border-bottom:1px solid white;border-right:1px solid white;color: white;width: 20em'>$namex</td>
                            <td style='border-bottom:1px solid white;border-right:1px solid white;color: white;width: 10em;'>$quantityx</td>
                            <td style='border-bottom:1px solid white;color: white;width: 10em;'>$prixx DT</td>
                        </tr>";

                //getting the idproduits
                $sql = "SELECT idproduits from produits where nom='$namex' and prix='$prixx'";
                foreach ($db->query($sql) as $idprod) {
                    $idproduits=$idprod['idproduits'];
                }

                $sql = "INSERT INTO achat (idproduits,idcommande,quantite,prix) VALUES(:idproduits,:idcommande,:quantite,:prix)";
                $stmtinsert1 = $db->prepare($sql);
                $result = $stmtinsert1->execute([':idproduits'=>$idproduits,':idcommande'=>$idcommande,':quantite'=>$quantityx,':prix'=>$pricex]);
                $s--;
            }
            $x++;
        }
    
        //getting the carts' elements from the order
        try {
            $mail->addAddress($email);
      
            $mail->isHTML(true);
            $mail->Subject = "Commande d'achat chez SBRPharma";
            $mail->Body = "<link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap' rel='stylesheet'>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap' rel='stylesheet'>
        
                <table  width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td style='background-color: #24282D;' width='33%'></td>
                        <td style='background-color: #1c1e1f;'>
        
                            <div style='background-color: #14ae5c;height: 7em;display:flex;justify-content: left;'>
                                <h2 style='font-family: Poppins, sans-serif;;font-size: 20px;font-weight: 600;font-stretch:extra-expanded;color: white;padding:1.3em;'>Merci d'avoir fait confiance à SBRPharma!</h2>
                            </div>
        
                            <div style='padding: 1em;'>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Bonjour $nom ,</p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Votre commande #$idcommande a été envoyé avec succès! <br>
                                Nous vous appelerons sur $phone le plus tôt possible pour confirmer votre demande.</p>
                                
                                <p style='font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-weight: 600;color: white;'>[Commande #$idcommande]($date)</p>
                                <table style='color: white;border: 1px solid white;'>
                                    <tbody>
                                        <tr style='color: white;'>
                                            <td style='border-right:1px solid white;color: white;width: 20em'>Nom du produits</td>
                                            <td style='border-right:1px solid white;color: white;width: 10em;'>Quantite</td>
                                            <td style='color: white;width: 10em;'>Prix unitaire</td>
                                        </tr>"
                                        .$tab.
                                    "</tbody>
                                    </table>
                                    <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Prix Total: $pricex DT</p>
                                    <br>
                                    <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Si vous avez des questions, veuillez nous envoyer une demande <a href='http://localhost/sbrnet/contact.php'>ici</a></p>
                                    <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Cordialement,<br>
                                    Equipe SBRPharma</p>
                                </div>
            
                            </td>
                            <td style='background-color: #24282D;' width='33%'></td>
                        </tr>
                    </table>";
            $mail->send();
        } catch(Exception $e) {
            // echo('<div class="alert-error">
            //           <span>'.$e->getMessage().'</span>
            //         </div>');
        }
    } //Fin check (commande mawjouda ou non)
    }//Fin if ($test)
    setcookie("cartquantity", "0", 0 , "/"); //resetting l panier
    setcookie("post","1",time()+60*5,"/");
?>