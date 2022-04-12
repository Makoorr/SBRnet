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
        $date=date("Y/m/d");
        date_default_timezone_set("Africa/Tunis");
        $time=date("H:i:s");

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
                $tab.=" <tr style='border: 2px solid ;'>
                            <td style='border: 1px solid;'>$namex</td><td style='border: 1px solid;'>$quantityx</td><td style='border: 1px solid;'>$prixx DT</td>
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
        setcookie("cartquantity", "0", 0 , "/"); //resetting l panier
        echo('merci!');

        //getting the carts' elements from the order
        

        try {
            $mail->addAddress($email);
      
            $mail->isHTML(true);
            $mail->Subject = "Commande d'achat chez SBRPharma";
            $mail->Body = "<h2>Merci d'avoir fait confiance à SBRPharma!</h2>
                            <div>Bonjour Mr/Mme $nom</div>
                            <br>
                            <div>Votre commande a été envoyé avec succès!</div>
                            <div>Nous vous appelerons sur $phone le plus tot possible pour confirmer votre demande.</div>
                            <br>
                            <h5>Votre Commande:</h5>
                            <table style='border: 2px solid ;'>
                                <tbody>
                                    <tr style='border: 2px solid ;'>
                                        <td style='border: 1px solid;'>Nom du produits</td>
                                        <td style='border: 1px solid;'>Quantite</td>
                                        <td style='border: 1px solid;'>Prix unitaire</td>
                                    </tr>"
                                    .$tab.
                                "</tbody>
                            </table>
                            <br>
                            <div>Si vous avez des questions, veuillez nous envoyer une demande <a href='http://localhost/sbrnet/contact.php'>ici</a></div>
                            <div>Cordialement,</div>
                            <div>Equipe SBRPharma</div>
                            ";
            $mail->send();
        } catch(Exception $e) {
            // echo('<div class="alert-error">
            //           <span>'.$e->getMessage().'</span>
            //         </div>');
        }
    }
    else{
        echo('no post');
        setcookie("cartquantity", "0", 0 , "/"); //resetting l panier
    }
?>