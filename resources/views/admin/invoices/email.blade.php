
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Auktion - 
OBJET : Relance d’impayé - facture n° [numéro de la facture]</title>
</head>
<body>
    <p>
    	{{$data->form_of_address}} {{ $data->first_name}} ,
    	<br/>
	    Sauf erreur ou omission de notre part, nous constatons que la facture n° {{$data->ref_number}}, datée du {{$data->created_at}} pour un montant de {{$data->total}} CHF, est arrivée à échéance. Or, nous sommes toujours en attente de votre paiement.

	    <br/>
		C’est pourquoi nous vous saurions gré de bien vouloir solder votre facture (en copie de ce mail) dans les plus brefs délais.
		<br/> 

		Si toutefois votre règlement avait été adressé avant réception de ce mail, nous vous prions de ne pas en tenir compte.

	</p>
    
    
</body>
</html>






