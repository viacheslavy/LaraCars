<?php function xmlEscape($string){ return htmlspecialchars($string, ENT_XML1, 'UTF-8'); } ?>
<?xml version="1.0" encoding="UTF-8"?>
<client>
	@foreach ($getCars as $car)
		<annonce id="{!! xmlEscape($car->id) !!}">
			<reference>{!! xmlEscape($car->referenceID) !!}</reference>
			<titre>{!! xmlEscape($car->brand) !!} {!! xmlEscape($car->model) !!} {!! xmlEscape($car->year) !!}</titre>
			<texte></texte>
			<date_saisie>{!! xmlEscape(date("d/m/Y")) !!}</date_saisie>
			<vehicule>
				<categorie>11000</categorie>
				<marque>{!! xmlEscape($car->brand) !!}</marque>
				<modele>{!! xmlEscape($car->model) !!}</modele>
				@if(!empty($car->body))
					<carrosserie>{!! xmlEscape($car->body) !!}</carrosserie>
				@else
					<carrosserie>Coupé</carrosserie>
				@endif
				@if(!empty($car->version))
					<version>{!! xmlEscape($car->version) !!};{!! xmlEscape($car->year) !!}</version>
				@else
					<version>{!! xmlEscape($car->year) !!}</version>
				@endif
				<?php
					$translate = [
						"Yellow" => "Jaune", "Blue" => "Bleu", "Black" => "Noir", "White" => "Blanc", "Blue and White" => "Bleu et blanc",
						"BlueandWhite" => "Bleu et blanc", "Red" => "Rouge", "Brown" => "Brun", "Tan" => "Brun",
						"Green" => "Vert", "SILVER" => "Argent", "Gray" => "Gris", "Gold" => "Or", "Orange" => "Orange",
						"Blue and Gray" => "Bleu et Gris", "BlueandGray" => "Bleu et Gris", "white/black" => "blanc/noir",
						"white / black" => "blanc/noir", "Dark Blue" => "Bleu foncé", "DarkBlue" => "Bleu foncé", "Turquoise" => "Turquoise",
						"Red and Black" => "Rouge et Noir", "RedandBlack" => "Rouge et Noir", "Satin Red" => "Rouge satin", "SatinRed" => "Rouge satin", 
						"Grey" => "Gris", "Caribbean Blue" => "Bleu caraibe", "CaribbeanBlue" => "Bleu caraibe", "Bronze" => "Bronze",
						"WHITE WITH GREEN TOP" => "blanc avec capote verte", "WHITEWITHGREENTOP" => "blanc avec capote verte",
						"GREEN AND WHITE" => "vert et blanc", "GREENANDWHITE" => "vert et blanc", "MARLBORO MAROON" => "marron", "MARLBOROMAROON" => "marron",
						"Daytona blue" => "bleu", "Daytonablue" => "bleu", "Teal was candy apple red" => "rouge", "CARDINAL RED" => "rouge", "CARDINALRED" => "rouge",
						"Frost Beige" => "beige", "FrostBeige" => "beige", "Brown and Black" => "martin et noir", "BrownandBlack" => "martin et noir",
						"Black/Brown" => "noir/marron", "BlackBrown" => "noir/marron", "Black Brown" => "noir/marron", "Off White" => "blanc casse", "OffWhite" => "blanc casse",
						"Tan Leather" => "marron", "TanLeather" => "marron", "Burgundy Red" => "bordeaux", "BurgundyRed" => "bordeaux", "Tan/Red" => "marron/rouge", "TanRed" => "marron/rouge",
						"Blue Vinyl or red leather" => "vynil bleu ou cuir rouge", "Custom" => "sur mesure", "Sublime Green" => "vert", "SublimeGreen" => "vert", "White & Tan" => "blanc et marron",
						"White and Tan" => "blanc et marron", "Cortez Silver" => "gris", "CortezSilver" => "gris", "Daytona Yellow" => "jaune", "DaytonaYellow" => "jaune", "Automatic 4-Speed" => "Automatique 4 vitesses",
						"Automatic4-Speed" => "Automatique 4 vitesses", "Automatic 3-Speed" => "Automatique 3 vitesses", "Automatic3-Speed" => "Automatique 3 vitesses", "Automatic" => "Automatique",
						"Manual" => "Manuelle", "2 Speed Automatic" => "Automatique 2 vitesses", "2SpeedAutomatic" => "Automatique 2 vitesses", "4 Speed Manual" => "Manuelle 4 vitesses", 
						"4SpeedManual" => "Manuelle 4 vitesses", "5 Speed (Tremec)" => "5 vitesses (Tremec)", "5Speed(Tremec)" => "5 vitesses (Tremec)", "Manual 3-Speed" => "Manuelle 3 vitesses",
						"Manual3-Speed" => "Manuelle 3 vitesses", 
					];
					$interior_color = "autre";
					$exterior_color = "autre";
					if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
						$data = @unserialize($car->specification);
						if($data && isset($data['Exterior Color'])){
							$exterior_color = $data['Exterior Color'];
							foreach($translate as $key2 => $value2){ if(strtolower($data['Exterior Color']) === strtolower($key2)){ $exterior_color = $value2; break; } }
						}
						if($data && isset($data['Interior Color'])){
							$interior_color = $data['Interior Color'];
							foreach($translate as $key2 => $value2){ if(strtolower($data['Interior Color']) === strtolower($key2)){ $interior_color = $value2; break; } }
						}
						if($data && isset($data['exterior'])){
							$exterior_color = $data['exterior'];
							foreach($translate as $key2 => $value2){ if(strtolower($data['exterior']) === strtolower($key2)){ $exterior_color = $value2; break; } }
						}
						if($data && isset($data['interior'])){
							$interior_color = $data['interior'];
							foreach($translate as $key2 => $value2){ if(strtolower($data['interior']) === strtolower($key2)){ $interior_color = $value2; break; } }
						}
					}
				?>
				<couleur>{!! xmlEscape($exterior_color) !!}</couleur>
				<millesime>{!! xmlEscape($car->year) !!}</millesime>
				<interieur_couleur>{!! xmlEscape($interior_color) !!}</interieur_couleur>
				<energie>essence</energie>
				<nb_portes></nb_portes>
				@if(!empty($car->mileage))
					<kilometrage>{!! xmlEscape(round(filter_var($car->mileage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 1.6)) !!}</kilometrage>
				@else
					<kilometrage>500</kilometrage>
				@endif
				<mise_en_circulation></mise_en_circulation>
				<boite_de_vitesse>@if($car->transmission =='automatic') automatique @elseif($car->transmission =='manual') manuelle @else automatique @endif</boite_de_vitesse>
				<?php
					$texte = '';
					if(!empty($car->version)){ $texte .= $car->version; }
					$car->cylinders = '';
					if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
						$specification = @unserialize($car->specification);
						if($specification && isset($specification['Number of Cylinders'])){ $car->cylinders = intval($specification['Number of Cylinders']); };
						if($specification && isset($specification['Cylinders'])){ $car->cylinders = intval($specification['Cylinders']); }
					}
					/*if(!empty($car->version) && !empty($car->cylinders)){ $texte .= ';'; }
					if(!empty($car->cylinders)){ $texte .= $car->cylinders; }
					if(!empty($car->engine) && !empty($car->cylinders)){ $texte .= ';'; }
					if(!empty($car->engine)){ $texte .= $car->engine; }
					if(!empty($car->option) && !empty($car->engine)){ $texte .= ';'; }
					if(!empty($car->option)){ $texte .= $car->option; }*/
					if(!empty($car->version) && !empty($car->engine)){ $texte .= ';'; }
					if(!empty($car->engine)){ $texte .= $car->engine; }
					if(!empty($car->option) && !empty($car->engine)){ $texte .= ';'; }
					if(!empty($car->option)){ $texte .= $car->option; }
				?>
				@if(!empty($car->cylinders))
					<cylindre>{!! xmlEscape($car->cylinders) !!}</cylindre>
				@endif
				<equipements>{!! xmlEscape($texte) !!} <?php if($texte != ''){ echo ";"; } ?>Nous contacter pour connaitre toutes les options de ce véhicule, Dossier photo complémentaire sur demande. Notre tarif comprend toutes les taxes avec une livraison au port du Havre, livraison possible sur toute la France et en Europe. Tous nos véhicules sont expertisés minutieusement avant votre achat définitif. Des années d'expérience dans les voitures anciennes.
				N'hésitez pas à nous contacter pour plus d'informations.
				Contact : 01 80 89 45 45
				</equipements>
			</vehicule>
			<offre>
				<type>o</type>
				<prix>{!! xmlEscape($car->price) !!}</prix>
			</offre>
			<photos>
				@foreach($car->images as $image)
					<photo>{!! xmlEscape($image->big) !!}</photo>
				@endforeach
			</photos>
			<url_annonce_sur_site_annonceur>http://fastandretro.com/product/{!! xmlEscape($car->id) !!}</url_annonce_sur_site_annonceur>
			<!-- Virtual tour -->
			<contact_a_afficher>Fast and Retro</contact_a_afficher>
			<!-- contact name -->
			<email_a_afficher>contact@fastandretro.com</email_a_afficher>
			<!-- contact email -->
			<telephone_a_afficher>+33 1 80 89 45 45</telephone_a_afficher>
			<!-- contact main phone number -->
			<telephone_mobile_a_afficher>xxx</telephone_mobile_a_afficher>
			<!-- contact main mobile-phone number -->
		</annonce>
	@endforeach
</client>