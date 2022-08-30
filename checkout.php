<?php
    require_once('config.php');
    require_once('mail.php');
?>

<?php
    $frais=7;
    //done tkoun empty (yaani mehoush mizel ki checkouta)
    $test=! empty ($_POST) && ! empty($_COOKIE) && ! isset($_COOKIE['done']) && ! empty($_POST['nom']) && ! empty($_POST['prenom']) 
        && ! empty($_POST['email']) && ! empty($_POST['phone']) && ! empty($_POST['ville']) && ! empty($_POST['address']) && ! empty($_POST['zip']);
    if($test){
        if(isset($_POST['nom']))
        $nom=htmlspecialchars($_POST['nom']);
        if(isset($_POST['prenom']))
        $prenom=htmlspecialchars($_POST['prenom']);
        if(isset($_POST['email']))
        $email=htmlspecialchars($_POST['email']);
        if(isset($_POST['phone']))
        $phone=htmlspecialchars($_POST['phone']);
        if(isset($_POST['ville']))
        $ville=htmlspecialchars($_POST['ville']);
        if(isset($_POST['address']))
        $address=htmlspecialchars($_POST['address']);
        if(isset($_POST['zip']))
        $zip=htmlspecialchars($_POST['zip']);

        if(isset($_COOKIE['cartquantity']))
        $cartquantity=intval($_COOKIE['cartquantity']);

        function CheckCookieById($id){
            if(! empty($_COOKIE["price$id"]) && ! empty($_COOKIE["quantity$id"]) && ! empty($_COOKIE["name$id"]))
                return true;
            else
                return false;
        }

        if($cartquantity>0)
            $s=$cartquantity; //decompteur s
        else
            $s=0;
        $x=1;

        //Calculating total
        $total=0;
        while($s!=0){
            if(CheckCookieById($x)){
                //getting products' prices from id($x)
                $sql = "SELECT prix from produits where idproduits=:idproduits";
                $stm = $db->prepare($sql);
                $stm->execute(array('idproduits'=>$x));
                $req = $stm->fetchAll();

                foreach ($req as $prod) {
                    $prix_uni=intval($prod['prix']);
                }

                $price = $prix_uni * intval($_COOKIE["quantity$x"]);
                $total = $total + $price;
                echo("<h1>price$x: $price | total : $total</h1>");

                $s--;
            }
            $x++;
        }

        setcookie("post","1",time()+5,"/");

        if (intval($total) < 50) {
            $total=intval($total)+$frais;
        }
        else {
            $frais=0;
            $total = intval($total);
        }
        echo("<h1>total apres frais: $total</h1>");

        $date=date("Y-m-d");
        date_default_timezone_set("Africa/Tunis");
        $time=date("H:i:s");

        /* Begin a transaction, turning off autocommit */
        $db->beginTransaction();
        /* Begin a transaction, turning off autocommit */

        /*Checking if commande deja put into here (fi nhar heka)*/
        $sql = "SELECT nom,prenom,email,phone,ville,address,zip,total,cartquantity,date from commande where nom=:nom and prenom=:prenom and date=:date
                                and email=:email and phone=:phone and ville=:ville and address=:address and zip=:zip and total=:total and cartquantity=:cartquantity;";
        $stm = $db->prepare($sql);
        $stm->execute(array('nom'=>$nom,'prenom'=>$prenom,'email'=>$email,'phone'=>$phone,'ville'=>$ville,'address'=>$address,'zip'=>$zip,'total'=>$total,'cartquantity'=>$cartquantity,'date'=>$date));
        $req = $stm->fetchAll();
        foreach ($req as $com) {
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
        /*Checking if commande deja put into here (fi nhar heka)*/

        if ( $nom!=$checknom or $prenom!=$checkprenom or $date!=$checkdate or $email!=$checkemail
        or $phone!=$checkphone or $ville!=$checkville or $address!=$checkaddress or $zip!=$checkzip or $total!=$checktotal or $cartquantity!=$checkcartquantity    
        ){ //Menghir INSERT ken el commande bel details hedhom deja mawjouda (fel nhar hedha kahaw el verif)

        $sql = "INSERT INTO commande (nom,prenom,email,phone,ville,address,zip,total,cartquantity,date,time) VALUES(:nom,:prenom,:email,:phone,:ville,:address,:zip,:total,:cartquantity,:date,:time)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':phone'=>$phone,':ville'=>$ville,':address'=>$address,':zip'=>$zip,':total'=>$total,':cartquantity'=>$cartquantity,':date'=>$date,':time'=>$time]);

        //getting the idcommande
        $sql = "SELECT idcommande from commande where nom=:nom and prenom=:prenom and date=:date and time=:time";
        $stm = $db->prepare($sql);
        $stm->execute(array('nom'=>$nom,'prenom'=>$prenom,'date'=>$date,'time'=>$time));
        $req = $stm->fetchAll();
        foreach ($req as $idcom) {
            $idcommande=$idcom['idcommande'];
        }

        //initialiazing tab elements
        $tab="";
        if($cartquantity>0)
            $s=$cartquantity; //decompteur s
        else
            $s=0;
        $x=1;

        while($s!=0){ //Ajout lel entité achat
            if(CheckCookieById($x)){
                $idproduits = $x;

                //getting products' details from id($x)
                $sql = "SELECT nom,prix from produits where idproduits=:idproduits";
                $stm = $db->prepare($sql);
                $stm->execute(array('idproduits'=>$idproduits));
                $req = $stm->fetchAll();

                foreach ($req as $prod) {
                    $namex=$prod['nom'];
                    $prixx=intval($prod['prix']);
                }
                
                $quantityx=$_COOKIE["quantity$x"];
                $pricex=$prixx*intval($_COOKIE["quantity$x"]); //prix total (prix unitaire * quantite)

                $sql = "INSERT INTO achat (idproduits,idcommande,quantite,prix) VALUES(:idproduits,:idcommande,:quantite,:prix)";
                $stmtinsert1 = $db->prepare($sql);
                $result = $stmtinsert1->execute([':idproduits'=>$idproduits,':idcommande'=>$idcommande,':quantite'=>$quantityx,':prix'=>$pricex]);
                $s--;

                //appending ltab
                $tab.=" <tr style='color:white;'>
                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 20em;'>$namex</td>
                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 10em;'>$quantityx</td>
                            <td style='border-bottom:1px solid #ebebeb86;width: 10em;'>$prixx DT</td>
                        </tr>";
            }
            $x++;
        }

        //Commiting insertion
        $db->commit();

        $addliv="<tr style='color: #ebebeb;'>
                    <td style='color: #ebebeb;width: 15em;'>$nom $prenom</td>
                </tr>
                <tr style='color: #ebebeb;'>
                    <td style='color: #ebebeb;width: 15em;'>$phone</td>
                </tr>
                <tr style='color: #ebebeb;'>
                    <td style='color: #ebebeb;width: 15em;'>$zip, $ville</td>
                </tr>
                <tr style='color: #ebebeb;'>
                    <td style='color: #ebebeb;width: 15em;'>$address</td>
                </tr>";
    
        //getting the carts' elements from the order
        try {
            $mail->addAddress($email);
      
            $mail->isHTML(true);
            $mail->Subject = "Commande d'achat chez SBRSwitchmed";
            $mail->Body = "        
                <table  width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td style='background-color: #24282D;' width='33%'></td>
                        <td style='background-color: #1c1e1f;'>
        
                            <div style='height: 7em;'>
                                <img src='cid:header'>
                            </div>
        
                            <div style='padding: 1em;'>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Bonjour $prenom ,</p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Votre commande #$idcommande a été envoyé avec succès! <br>
                                Nous vous appelerons sur $phone le plus tôt possible pour confirmer votre demande.</p>
                                
                                <p style='font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-weight: 600;color: white;'>[Commande #$idcommande]($date)</p>
                                <table style='color: #ebebeb86;border: 1px solid;border-collapse: collapse;'>
                                    <tbody>
                                        <tr style='color: #ebebeb;'>
                                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 20em;'>Nom du produits</td>
                                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 10em;'>Quantite</td>
                                            <td style='border-bottom:1px solid #ebebeb86;width: 10em;'>Prix unitaire</td>
                                        </tr>
                                        $tab
                                    </tbody>
                                </table>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Prix Total(+Frais de Livraison($frais DT)): $total DT</p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Adresse de livraison:</p>
                                <table style='color: #ebebeb86;border: 1px solid;border-collapse: collapse;'>
                                    <tbody>
                                        $addliv
                                    </tbody>
                                </table>
                                <br>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Si vous avez des questions, veuillez nous envoyer une demande <a href='http://localhost/sbrnet/contact.php'>ici</a></p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Cordialement,<br>
                                Equipe SBRSwitchmed</p>
                            </div>

                        </td>
                        <td style='background-color: #24282D;' width='33%'></td>
                    </tr>
                </table>";
            $mail->addEmbeddedImage(dirname(__FILE__)."/assets/img/mailheader.png","header");
            $mail->send();
        } catch(Exception $e) {
            // echo('<div class="alert-error">
            //           <span>'.$e->getMessage().'</span>
            //         </div>');
        }

        //Sending email to the admins
        try {
            $mail2->addAddress("makoorr@gmail.com");
      
            $mail2->isHTML(true);
            $mail2->Subject = "Commande d'achat chez SBRSwitchmed";
            $mail2->Body = "        
                <table  width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td style='background-color: #24282D;' width='33%'></td>
                        <td style='background-color: #1c1e1f;'>
        
                            <div style='height: 7em;'>
                                <img src='cid:header'>
                            </div>
        
                            <div style='padding: 1em;'>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Bonjour $prenom ,</p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Votre commande #$idcommande a été envoyé avec succès! <br>
                                Nous vous appelerons sur $phone le plus tôt possible pour confirmer votre demande.</p>
                                
                                <p style='font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-weight: 600;color: white;'>[Commande #$idcommande]($date)</p>
                                <table style='color: #ebebeb86;border: 1px solid;border-collapse: collapse;'>
                                    <tbody>
                                        <tr style='color: #ebebeb;'>
                                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 20em;'>Nom du produits</td>
                                            <td style='border-bottom:1px solid #ebebeb86;border-right:1px solid #ebebeb86;color: #ebebeb;width: 10em;'>Quantite</td>
                                            <td style='border-bottom:1px solid #ebebeb86;width: 10em;'>Prix unitaire</td>
                                        </tr>
                                        $tab
                                    </tbody>
                                </table>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Prix Total(+Frais de Livraison($frais DT)): $total DT</p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Adresse de livraison:</p>
                                <table style='color: #ebebeb86;border: 1px solid;border-collapse: collapse;'>
                                    <tbody>
                                        $addliv
                                    </tbody>
                                </table>
                                <br>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Si vous avez des questions, veuillez nous envoyer une demande <a href='http://localhost/sbrnet/contact.php'>ici</a></p>
                                <p style='color: white;font-size:small;font-weight: 600;font-family: Montserrat, sans-serif;'>Cordialement,<br>
                                Equipe SBRSwitchmed</p>
                            </div>

                        </td>
                        <td style='background-color: #24282D;' width='33%'></td>
                    </tr>
                </table>";
            $mail2->addEmbeddedImage(dirname(__FILE__)."/assets/img/mailheader.png","header");
            $mail2->send();
        } catch(Exception $e) {
            // echo('<div class="alert-error">
            //           <span>'.$e->getMessage().'</span>
            //         </div>');
        }

    } else{ //Fin check (commande mawjouda ou non)
        /* Recognize mistake and roll back changes */
        $db->rollBack();
    }
    }//Fin if ($test)
?>