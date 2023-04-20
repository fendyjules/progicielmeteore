<?php 
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=meteoredatabase','root',''); }   
 
  catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }


if (isset($_GET['id'])) 
if (isset($_GET['iddossier']))
{
$iddossier=trim(stripcslashes(htmlspecialchars($_GET['iddossier'])));
$iduser=trim(stripcslashes(htmlspecialchars($_GET['id']))); 
  
// connexion à la base de données pour recupérer le statut du dossier    
$recherchedossier =$bdd->prepare("SELECT statutdossier FROM dossiersmeteore  WHERE id_dossier=$iddossier ");
$recherchedossier->execute(); 

while($rowdossier = $recherchedossier->fetch(PDO::FETCH_ASSOC)) :

if ($rowdossier['statutdossier']=="Traitement en cours") {

    $sql = "UPDATE `dossiersmeteore` SET statutdossier='Traitement en pause'  WHERE id_dossier=$iddossier"; 
    $req = $bdd->prepare($sql); 
    $exec = $req->execute();

}
else {

}
endwhile;
 // connexion à la table journal de traitement dossier, pour recuperer la date debut du traitement en cours     
 $recherchedossier =$bdd->prepare("SELECT debuttraitement  FROM journaltraitementdossier
 WHERE id_dossier=$iddossier AND id_user=$iduser ORDER BY id_traitement Desc Limit 1 ");
$recherchedossier->execute(); 

while($rowdossier = $recherchedossier->fetch(PDO::FETCH_ASSOC)) :

$debut= $rowdossier['debuttraitement'];
endwhile;
$Nowini = date("Y-m-d H:i:s");  
// On transforme les 2 dates en timestamp
$datedebut = strtotime($debut);
$Now = strtotime($Nowini);

// On récupère la différence de timestamp entre les 2 précédents
$dureeTimestamp = $Now - $datedebut;

// ** Pour convertir le timestamp (exprimé en secondes) en jours **
// On sait que 1 heure = 60 secondes * 60 minutes et que 1 jour = 24 heures donc :
// 86 400 = 60*60*24
$dureetraitement = $dureeTimestamp/3600; 
            
           $miseajourtraitement = "UPDATE `journaltraitementdossier` SET  fintraitement ='$Nowini', dureetraitement=$dureetraitement WHERE id_dossier=$iddossier AND id_user=$iduser ORDER BY id_traitement DESC LIMIT 1";
           $miseajourtraitement = $bdd->prepare($miseajourtraitement); 
           $execmiseajour = $miseajourtraitement->execute();  
}

$_SESSION = array();
session_destroy();
header("location:index.php");
?>