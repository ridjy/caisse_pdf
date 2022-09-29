<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo css_url('form'); ?>" />
		<title><?php echo $titre ?></title>     
	</head>
	<body>

        <?php $a=getdate();
        ?>

	<div id="page"> 
        <img src="<?php echo img_url('logo.jpg') ?>" alt="logo"> 
        <form method="POST" name="general" action="<?php echo site_url('pdf/fiche');?>">
		
        <div class="entete">
        <h5>ENTREE DE CAISSE</h5><div id="no"><label>Référence encaissement N° :</label><input type="text" class="point" size="30" name="journal" value="<?php echo $a['year'].'00000'.$n ; ?>"></div> 
		</div>
        
        <table id="tab1">
           <tr><td>Date  </td><td><input type="text" id="date" size="10" value="<?php echo $a['mday'].'/'.$a['mon'].'/'.$a['year'];?>" readonly></td></tr> 
        </table>
        
        <table id="tab2">
        <tr><td><label>Nom du client:</label></td><td><input type="text" class="point" size="25" name="nom"></td><td style="width:35px;"></td><td><label>REF IRIS :</label></td><td><input type="text" class="point" name="ref"></td></tr> 
        </table>    

        <fieldset>
        <table id="tab3">
        <tr><td><label>Objet de l'encaissement :</label></td><td><input type="text" size="30" name="objet"></td></tr>
        <tr><td><label>N° des factures :</label></td><td><input type="text" size="30" name="num"></td></tr>
        <tr><td><label>Avance sur dossier N° :</label></td><td><input type="text" size="30" name="avance"></td><td style="width:30px;"></td><td><label>AGENCE :</label></td><td><input type="text" class="point" name="agence"></td></tr>
        <tr><td><label>Autres :</label></td><td><input type="text" size="30" name="autre"></td></tr>
        </table>
        </fieldset>

        <div id="pied">
        <label>MONTANT Ar : </label><input type="text" style="height:35px;font-size:14px;" name="montant">
        <input type="Submit" value="Generer pdf">
        <input type="Reset" value="Reset">
        </div>

    </form>
    </div>
		
			
                

               
	</body>	

   

</html>
