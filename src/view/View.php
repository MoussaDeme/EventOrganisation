<?php

require_once("Router.php");
require_once ('model/User.php');
require_once ('model/UserBuilder.php');

class View {

	protected $router;
	protected $title;
    protected $content;
    private $menu;
    protected $feedback;
	public function __construct(Router $router,$feedback) {
		$this->router = $router;
		$this->title = null ;
		$this->content = null ;
		$this->feedback = $feedback;
		
	}

    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
      $this->content = $content;
    }
    public function getMenu()
    {
    	$this->menu = array(
				"Accueil" => $this->router->getAcceuil(),
				"Programmes" => $this->router->getProgramme(),
				"Intervenants" => $this->router->getSpeakersList(),
				"s'inscrire" => $this->router->getInscription(),				
				"Sponsors" => $this->router->getSponsorListUser(),
				"A propos"=> $this->router->getApropos(),
			);
        return $this->menu;
    }
    public function setMenu($menu)
    {
      $this->menu = $menu;
    }
    public function getRouter()
    {
        return $this->router;
    }

    /* Listes des pays du monde
      <?php


    /*---------- fin------------------*/
	/* Affiche la page créée. */
	public function render() {
		if ($this->title === null || $this->content === null) {
			$this->makeUnexpectedErrorPage();
		}else{
		include("squelette.php");
      }
    }
	/******************************************************************************/
	/* Méthodes de génération des pages                                           */
  /******************************************************************************/
  

  public function UserCreationSucess()
			{
				$feedback = '<div class="alert alert-success"> <strong>Inscription réussie !</strong> Merci et à Bientot</div>';
				$this->router->POSTredirect($this->router->getAcceuil(),$feedback);
      }
      
      public function UserCreationFail()
			{
				$feedback = '<div class="alert alert-danger"> Veuillez remplir tous les champs</div>';
				$this->router->POSTredirect($this->getInscription(),$feedback);
			}

	public  function makeUserFormPage(UserBuilder $ub)
	{

		/* debut tab liste des pays*/
           // liste des pays */
// code numérique, code alpha 2, code Alpha 3, nom du pays
$countryCode = array(
array('', '', '', 'selectionner...'),	
array('4', 'AFG', 'AF', 'Afghanistan'), 
array('710', 'ZAF', 'ZA', 'Afrique du Sud'), 
array('248', 'ALA', 'AX', 'Aland'), 
array('8', 'ALB', 'AL', 'Albanie'), 
array('12', 'DZA', 'DZ', 'Algérie'), 
array('276', 'DEU', 'DE', 'Allemagne'), 
array('20', 'AND', 'AD', 'Andorre'), 
array('24', 'AGO', 'AO', 'Angola'), 
array('660', 'AIA', 'AI', 'Anguilla'), 
array('10', 'ATA', 'AQ', 'Antarctique'), 
array('28', 'ATG', 'AG', 'Antigua-et-Barbuda'), 
array('682', 'SAU', 'SA', 'Arabie saoudite'), 
array('32', 'ARG', 'AR', 'Argentine'), 
array('51', 'ARM', 'AM', 'Arménie'), 
array('533', 'ABW', 'AW', 'Aruba'), 
array('36', 'AUS', 'AU', 'Australie'), 
array('40', 'AUT', 'AT', 'Autriche'), 
array('31', 'AZE', 'AZ', 'Azerbaïdjan'), 
array('44', 'BHS', 'BS', 'Bahamas'), 
array('48', 'BHR', 'BH', 'Bahreïn'), 
array('50', 'BGD', 'BD', 'Bangladesh'), 
array('52', 'BRB', 'BB', 'Barbade'), 
array('112', 'BLR', 'BY', 'Biélorussie'), 
array('56', 'BEL', 'BE', 'Belgique'), 
array('84', 'BLZ', 'BZ', 'Belize'), 
array('204', 'BEN', 'BJ', 'Bénin'), 
array('60', 'BMU', 'BM', 'Bermudes'), 
array('64', 'BTN', 'BT', 'Bhoutan'), 
array('68', 'BOL', 'BO', 'Bolivie'), 
array('535', 'BES', 'BQ', 'Bonaire', ' Saint-Eustache et Saba'), 
array('70', 'BIH', 'BA', 'Bosnie-Herzégovine'), 
array('72', 'BWA', 'BW', 'Botswana'), 
array('74', 'BVT', 'BV', 'Île Bouvet'), 
array('76', 'BRA', 'BR', 'Brésil'), 
array('96', 'BRN', 'BN', 'Brunei'), 
array('100', 'BGR', 'BG', 'Bulgarie'), 
array('854', 'BFA', 'BF', 'Burkina Faso'), 
array('108', 'BDI', 'BI', 'Burundi'), 
array('136', 'CYM', 'KY', 'Îles Caïmans'), 
array('116', 'KHM', 'KH', 'Cambodge'), 
array('120', 'CMR', 'CM', 'Cameroun'), 
array('124', 'CAN', 'CA', 'Canada'), 
array('132', 'CPV', 'CV', 'Cap-Vert'), 
array('140', 'CAF', 'CF', 'République centrafricaine'), 
array('152', 'CHL', 'CL', 'Chili'), 
array('156', 'CHN', 'CN', 'Chine'), 
array('162', 'CXR', 'CX', 'Île Christmas'), 
array('196', 'CYP', 'CY', 'Chypre'), 
array('166', 'CCK', 'CC', 'Îles Cocos'), 
array('170', 'COL', 'CO', 'Colombie'), 
array('174', 'COM', 'KM', 'Comores'), 
array('178', 'COG', 'CG', 'République du Congo'), 
array('180', 'COD', 'CD', 'République démocratique du Congo'), 
array('184', 'COK', 'CK', 'Îles Cook'), 
array('410', 'KOR', 'KR', 'Corée du Sud'), 
array('408', 'PRK', 'KP', 'Corée du Nord'), 
array('188', 'CRI', 'CR', 'Costa Rica'), 
array('384', 'CIV', 'CI', 'Côte d\'Ivoire'), 
array('191', 'HRV', 'HR', 'Croatie'), 
array('192', 'CUB', 'CU', 'Cuba'), 
array('531', 'CUW', 'CW', 'Curaçao'), 
array('208', 'DNK', 'DK', 'Danemark'), 
array('262', 'DJI', 'DJ', 'Djibouti'), 
array('214', 'DOM', 'DO', 'République dominicaine'), 
array('212', 'DMA', 'DM', 'Dominique'), 
array('818', 'EGY', 'EG', 'Égypte'), 
array('222', 'SLV', 'SV', 'Salvador'), 
array('784', 'ARE', 'AE', 'Émirats arabes unis'), 
array('218', 'ECU', 'EC', 'Équateur'), 
array('232', 'ERI', 'ER', 'Érythrée'), 
array('724', 'ESP', 'ES', 'Espagne'), 
array('233', 'EST', 'EE', 'Estonie'), 
array('840', 'USA', 'US', 'États-Unis'), 
array('231', 'ETH', 'ET', 'Éthiopie'), 
array('238', 'FLK', 'FK', 'Îles Malouines'), 
array('234', 'FRO', 'FO', 'Îles Féroé'), 
array('242', 'FJI', 'FJ', 'Fidji'), 
array('246', 'FIN', 'FI', 'Finlande'), 
array('250', 'FRA', 'FR', 'France'), 
array('266', 'GAB', 'GA', 'Gabon'), 
array('270', 'GMB', 'GM', 'Gambie'), 
array('268', 'GEO', 'GE', 'Géorgie'), 
array('239', 'SGS', 'GS', 'Géorgie du Sud-et-les Îles Sandwich du Sud'), 
array('288', 'GHA', 'GH', 'Ghana'), 
array('292', 'GIB', 'GI', 'Gibraltar'), 
array('300', 'GRC', 'GR', 'Grèce'), 
array('308', 'GRD', 'GD', 'Grenade'), 
array('304', 'GRL', 'GL', 'Groenland'), 
array('312', 'GLP', 'GP', 'Guadeloupe'), 
array('316', 'GUM', 'GU', 'Guam'), 
array('320', 'GTM', 'GT', 'Guatemala'), 
array('831', 'GGY', 'GG', 'Guernesey'), 
array('324', 'GIN', 'GN', 'Guinée'), 
array('624', 'GNB', 'GW', 'Guinée-Bissau'), 
array('226', 'GNQ', 'GQ', 'Guinée équatoriale'), 
array('328', 'GUY', 'GY', 'Guyana'), 
array('254', 'GUF', 'GF', 'Guyane'), 
array('332', 'HTI', 'HT', 'Haïti'), 
array('334', 'HMD', 'HM', 'Îles Heard-et-MacDonald'), 
array('340', 'HND', 'HN', 'Honduras'), 
array('344', 'HKG', 'HK', 'Hong Kong'), 
array('348', 'HUN', 'HU', 'Hongrie'), 
array('833', 'IMN', 'IM', 'Île de Man'), 
array('581', 'UMI', 'UM', 'Îles mineures éloignées des États-Unis'), 
array('92', 'VGB', 'VG', 'Îles Vierges britanniques'), 
array('850', 'VIR', 'VI', 'Îles Vierges des États-Unis'), 
array('356', 'IND', 'IN', 'Inde'), 
array('360', 'IDN', 'ID', 'Indonésie'), 
array('364', 'IRN', 'IR', 'Iran'), 
array('368', 'IRQ', 'IQ', 'Irak'), 
array('372', 'IRL', 'IE', 'Irlande'), 
array('352', 'ISL', 'IS', 'Islande'), 
array('376', 'ISR', 'IL', 'Israël'), 
array('380', 'ITA', 'IT', 'Italie'), 
array('388', 'JAM', 'JM', 'Jamaïque'), 
array('392', 'JPN', 'JP', 'Japon'), 
array('832', 'JEY', 'JE', 'Jersey'), 
array('400', 'JOR', 'JO', 'Jordanie'), 
array('398', 'KAZ', 'KZ', 'Kazakhstan'), 
array('404', 'KEN', 'KE', 'Kenya'), 
array('417', 'KGZ', 'KG', 'Kirghizistan'), 
array('296', 'KIR', 'KI', 'Kiribati'), 
array('414', 'KWT', 'KW', 'Koweït'), 
array('418', 'LAO', 'LA', 'Laos'), 
array('426', 'LSO', 'LS', 'Lesotho'), 
array('428', 'LVA', 'LV', 'Lettonie'), 
array('422', 'LBN', 'LB', 'Liban'), 
array('430', 'LBR', 'LR', 'Liberia'), 
array('434', 'LBY', 'LY', 'Libye'), 
array('438', 'LIE', 'LI', 'Liechtenstein'), 
array('440', 'LTU', 'LT', 'Lituanie'), 
array('442', 'LUX', 'LU', 'Luxembourg'), 
array('446', 'MAC', 'MO', 'Macao'), 
array('807', 'MKD', 'MK', 'Macédoine'), 
array('450', 'MDG', 'MG', 'Madagascar'), 
array('458', 'MYS', 'MY', 'Malaisie'), 
array('454', 'MWI', 'MW', 'Malawi'), 
array('462', 'MDV', 'MV', 'Maldives'), 
array('466', 'MLI', 'ML', 'Mali'), 
array('470', 'MLT', 'MT', 'Malte'), 
array('580', 'MNP', 'MP', 'Îles Mariannes du Nord'), 
array('504', 'MAR', 'MA', 'Maroc'), 
array('584', 'MHL', 'MH', 'Marshall'), 
array('474', 'MTQ', 'MQ', 'Martinique'), 
array('480', 'MUS', 'MU', 'Maurice'), 
array('478', 'MRT', 'MR', 'Mauritanie'), 
array('175', 'MYT', 'YT', 'Mayotte'), 
array('484', 'MEX', 'MX', 'Mexique'), 
array('583', 'FSM', 'FM', 'Micronésie'), 
array('498', 'MDA', 'MD', 'Moldavie'), 
array('492', 'MCO', 'MC', 'Monaco'), 
array('496', 'MNG', 'MN', 'Mongolie'), 
array('499', 'MNE', 'ME', 'Monténégro'), 
array('500', 'MSR', 'MS', 'Montserrat'), 
array('508', 'MOZ', 'MZ', 'Mozambique'), 
array('104', 'MMR', 'MM', 'Birmanie'), 
array('516', 'NAM', 'NA', 'Namibie'), 
array('520', 'NRU', 'NR', 'Nauru'), 
array('524', 'NPL', 'NP', 'Népal'), 
array('558', 'NIC', 'NI', 'Nicaragua'), 
array('562', 'NER', 'NE', 'Niger'), 
array('566', 'NGA', 'NG', 'Nigeria'), 
array('570', 'NIU', 'NU', 'Niue'), 
array('574', 'NFK', 'NF', 'Île Norfolk'), 
array('578', 'NOR', 'NO', 'Norvège'), 
array('540', 'NCL', 'NC', 'Nouvelle-Calédonie'), 
array('554', 'NZL', 'NZ', 'Nouvelle-Zélande'), 
array('86', 'IOT', 'IO', 'Territoire britannique de l\'océan Indien'), 
array('512', 'OMN', 'OM', 'Oman'), 
array('800', 'UGA', 'UG', 'Ouganda'), 
array('860', 'UZB', 'UZ', 'Ouzbékistan'), 
array('586', 'PAK', 'PK', 'Pakistan'), 
array('585', 'PLW', 'PW', 'Palaos'), 
array('275', 'PSE', 'PS', 'Autorité Palestinienne'), 
array('591', 'PAN', 'PA', 'Panama'), 
array('598', 'PNG', 'PG', 'Papouasie-Nouvelle-Guinée'), 
array('600', 'PRY', 'PY', 'Paraguay'), 
array('528', 'NLD', 'NL', 'Pays-Bas'), 
array('604', 'PER', 'PE', 'Pérou'), 
array('608', 'PHL', 'PH', 'Philippines'), 
array('612', 'PCN', 'PN', 'Îles Pitcairn'), 
array('616', 'POL', 'PL', 'Pologne'), 
array('258', 'PYF', 'PF', 'Polynésie française'), 
array('630', 'PRI', 'PR', 'Porto Rico'), 
array('620', 'PRT', 'PT', 'Portugal'), 
array('634', 'QAT', 'QA', 'Qatar'), 
array('638', 'REU', 'RE', 'La Réunion'), 
array('642', 'ROU', 'RO', 'Roumanie'), 
array('826', 'GBR', 'GB', 'Royaume-Uni'), 
array('643', 'RUS', 'RU', 'Russie'), 
array('646', 'RWA', 'RW', 'Rwanda'), 
array('732', 'ESH', 'EH', 'Sahara occidental'), 
array('652', 'BLM', 'BL', 'Saint-Barthélemy'), 
array('659', 'KNA', 'KN', 'Saint-Christophe-et-Niévès'), 
array('674', 'SMR', 'SM', 'Saint-Marin'), 
array('663', 'MAF', 'MF', 'Saint-Martin (Antilles françaises)'), 
array('534', 'SXM', 'SX', 'Saint-Martin'), 
array('666', 'SPM', 'PM', 'Saint-Pierre-et-Miquelon'), 
array('336', 'VAT', 'VA', 'Saint-Siège (État de la Cité du Vatican)'), 
array('670', 'VCT', 'VC', 'Saint-Vincent-et-les-Grenadines'), 
array('654', 'SHN', 'SH', 'Sainte-Hélène', ' Ascension et Tristan da Cunha'), 
array('662', 'LCA', 'LC', 'Sainte-Lucie'), 
array('90', 'SLB', 'SB', 'Salomon'), 
array('882', 'WSM', 'WS', 'Samoa'), 
array('16', 'ASM', 'AS', 'Samoa américaines'), 
array('678', 'STP', 'ST', 'Sao Tomé-et-Principe'), 
array('686', 'SEN', 'SN', 'Sénégal'), 
array('688', 'SRB', 'RS', 'Serbie'), 
array('690', 'SYC', 'SC', 'Seychelles'), 
array('694', 'SLE', 'SL', 'Sierra Leone'), 
array('702', 'SGP', 'SG', 'Singapour'), 
array('703', 'SVK', 'SK', 'Slovaquie'), 
array('705', 'SVN', 'SI', 'Slovénie'), 
array('706', 'SOM', 'SO', 'Somalie'), 
array('729', 'SDN', 'SD', 'Soudan'), 
array('728', 'SSD', 'SS', 'Soudan du Sud'), 
array('144', 'LKA', 'LK', 'Sri Lanka'), 
array('752', 'SWE', 'SE', 'Suède'), 
array('756', 'CHE', 'CH', 'Suisse'), 
array('740', 'SUR', 'SR', 'Suriname'), 
array('744', 'SJM', 'SJ', 'Svalbard et Île Jan Mayen'), 
array('748', 'SWZ', 'SZ', 'Swaziland'), 
array('760', 'SYR', 'SY', 'Syrie'), 
array('762', 'TJK', 'TJ', 'Tadjikistan'), 
array('158', 'TWN', 'TW', 'Taïwan / (République de Chine (Taïwan))'), 
array('834', 'TZA', 'TZ', 'Tanzanie'), 
array('148', 'TCD', 'TD', 'Tchad'), 
array('203', 'CZE', 'CZ', 'République tchèque'), 
array('260', 'ATF', 'TF', 'Terres australes et antarctiques françaises'), 
array('764', 'THA', 'TH', 'Thaïlande'), 
array('626', 'TLS', 'TL', 'Timor oriental'), 
array('768', 'TGO', 'TG', 'Togo'), 
array('772', 'TKL', 'TK', 'Tokelau'), 
array('776', 'TON', 'TO', 'Tonga'), 
array('780', 'TTO', 'TT', 'Trinité-et-Tobago'), 
array('788', 'TUN', 'TN', 'Tunisie'), 
array('795', 'TKM', 'TM', 'Turkménistan'), 
array('796', 'TCA', 'TC', 'Îles Turques-et-Caïques'), 
array('792', 'TUR', 'TR', 'Turquie'), 
array('798', 'TUV', 'TV', 'Tuvalu'), 
array('804', 'UKR', 'UA', 'Ukraine'), 
array('858', 'URY', 'UY', 'Uruguay'), 
array('548', 'VUT', 'VU', 'Vanuatu'), 
array('862', 'VEN', 'VE', 'Venezuela'), 
array('704', 'VNM', 'VN', 'Viêt Nam'), 
array('876', 'WLF', 'WF', 'Wallis-et-Futuna'), 
array('887', 'YEM', 'YE', 'Yémen'), 
array('894', 'ZMB', 'ZM', 'Zambie'), 
array('716', 'ZWE', 'ZW', 'Zimbabwe')
);

		/*   fin liste des pays*/
		$form = '<div class="formUser">';
		$form.= '<form action="'.$this->router->getUserForm().'" method = "POST" enctype="multipart/form-data">';
		$form.='<div class="form-row">';
      
		$form.='<div class="form-group col-md-3"><label class="label">  Nom </label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">perm_identity</i></div>
        </div><input class="form-control" type="text" name ="'.UserBuilder::LN_REF.'" value="'.$ub->getData()[UserBuilder::LN_REF].'" placeholder="Nom"></div></div>';
		$form.='<div class="form-group col-md-3"><label class="label">  Prenom</label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">perm_identity</i></div>
        </div><input class="form-control" type="text" name ="'.UserBuilder::FN_REF.'"value="'.$ub->getData()[UserBuilder::FN_REF].'" placeholder="Prenom"></div></div>';
		$form.='</div>';
		$form.='<div class="form-row">';
		$form.='<div class="form-group col-md-6"><label class="label">  Email</label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">email</i></div>
        </div><input class="form-control" type="mail" name ="'.UserBuilder::MAIL_REF.'"value="'.$ub->getData()[UserBuilder::MAIL_REF].'" placeholder="toto@gmail.com"></div></div> ';
		$form.='</div>';
		
		/*$form.='<label>  Pays <input type="text" name ="'.UserBuilder::ORGANIZATION_REF.'" value="'.$ub->getData()[UserBuilder::ORGANIZATION_REF].'" > </label> <br>';*/
		$form.='<div class="form-row">';
		$form.='<div class="form-group col-md-6"><label class="label">  Adresse </label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">home</i></div>
        </div><input class="form-control"  type="text" placeholder="mondeville" name ="'.UserBuilder::ADRESS_REF.'" value="'.$ub->getData()[UserBuilder::ADRESS_REF].'"></div></div>';
		$form.='</div>';
		$form.='<div class="form-row">';
		$form.='<div class="form-group col-md-6"><label class="label">  Téléphone </label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">call</i></div>
        </div><input class="form-control" type="tel" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name = "'.UserBuilder::TEL_REF.'" value="'.$ub->getData()[UserBuilder::TEL_REF].'" placeholder="0765432134"></div></div>';
		$form.='</div>';
		$form.='<div class="form-row">';
		
         $form.= '<div class="form-group col-md-3"><label class="label">  Allergies </label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">mood_bad</i></div>
        </div><input class="form-control" type="text" name ="'.UserBuilder::ALLERGY_REF.'"value="'.$ub->getData()[UserBuilder::ALLERGY_REF].'" ></div></div>';
		$form.='<div class="form-group col-md-2"><label class="label">  Pays </label><select class="form-control"  name ="'.UserBuilder::COUNTRY_REF.'" value="'.$ub->getData()[UserBuilder::COUNTRY_REF].'" >';												  foreach ($countryCode as $key => $value) {
                 $form.='<option>'.$value[3].'</option>';                                               	
		    }
		$form.='</select>
		</div>';
		$form.= '<div class="form-group col-md-1"><label class="label">Vêtements </label><select class="form-control" name ="'.UserBuilder::SIZE_REF.'" value="'.$ub->getData()[UserBuilder::SIZE_REF].'">
														<option>S</option>
														<option>M</option>
														<option>L</option>
														<option>Xl</option>
														<option>XXl</option>
														</select>
		 </div>';
		$form.='</div>';
		$form.='<div class="form-row">';
		
         //$form.='<div class="form-group col-md-6"><input class="form-control" type="file"   name = "photo" ></div>';
         $form.='<div class="form-group col-md-6"><label class="label">  Alimentation (particulière) </label><div class="input-group mb-2"><div class="input-group-prepend">
          <div class="input-group-text"><i class="material-icons">kitchen</i></div>
        </div><input class="form-control" type="mail" name ="'.UserBuilder::DIET_REF.'" value="'.$ub->getData()[UserBuilder::DIET_REF].'" ></div></div>';
         $form.='</div>';
		$form.='<div class="form-row">';
         $form.='<div class="custom-file form-group col-md-6"> 
             <label class="custom-file-label" for="validatedCustomFile">Chosi une photo</label>
             <input  type="file" class="custom-file-input form-control" name="photo" id="validatedCustomFile">
           </div>
         ';
         $form.='</div>';
		 $form.='<input type="submit"  value = "soumettre"  name = "soumettre" class="btn btn-primary bouton" >';
        

		$form.='</form>';
		$form.='</div>';
		$this->getMenu();
        $this->title = "formulaire";
		$this->content = $form;
 
			}

	public function makeHomePage($text) {
		$this->getMenu();
		$this->title = "Bienvenue !";
		$this->content = '<div class="row">
                    <div class="col-sm-6">
                        <h2>SUMMER SCHOOL</h2>
                        <p>Colloque international organisé par GREYC (UMR 6072)
                       Chaque été, l’école d’été « Science du Web » a pour objectif d’offrir aux participants l’occasion d’approfondir leurs connaissances dans le domaine de la science du Web. Les frais de participation sont maintenus au minimum afin de permettre aux étudiants du monde entier et de divers horizons de participer. L’école d’été met l’accent sur les relations entre les aspects techniques, sociaux, économiques et culturels du Web grâce à un échange actif de personnes de différentes disciplines.</p>
                        <a href="#" class="btn">Lire plus</a>
                    </div>     
                </div>';
        $this->content.= $text;   
	}
	public function makeUnexpectedErrorPage() {
		$this->title = "Erreur";
		$this->getMenu();
		$this->content = "Une erreur inattendue s'est produite.";
	}
	public function makeSpeakersListView($list)
	{
		$this->getMenu();
		$this->title = 'listes des intervenants';
		$s = '';
		?><script>
          function submitform(email)
         {
       		 document.getElementById("email").value = email;
            document.getElementById("myForm").submit();	 
         }                                               
        </script>
        
        <?php
            $s='<section class="listIntervenant">
            <br> <br> <br> <br> <br> <br>';       
            $s.='<div class="row">';
            foreach ($list as $key => $value) {
            	$s.=  '<form method="post" action="'.$this->router->getSpeaker().'" id="myForm">
                  <input id="email" type="hidden" name="email" value="rien" /><br/>
                </form>';?>
              <?php
                
                $s.='<div onclick="submitform(\''.$value->getEmail().'\')" style="color:blue;">
                     
                    <div class="col">   
                    <div class="card cardsHeader">
                   <img class="card-img-top cardsImage" src="upload/'.$value->getPicture().'" alt="Card image" style="width:100%">
                   <div class="card-body">
                   <h4 class="card-title"><span>'.$value->getFirstname().' '.$value->getLastname().'</span></h4>
                </div> 
              </div>
           <br>
           </div>
             </div>
               ';        
            }
            $s.='</div>
           </section>';
        $this->content = $s; 
	}
	public function makeSpeakerPage(Intervenant $intervenant)
	{
		$this->getMenu();
		$s = '';
         $this->title = 'intervenant ';
         $s.='<div class="container-fluid bg-1 text-center">
             <br><br><br>
  <img class="rounded-circle" src="upload/'.$intervenant->getPicture().'"  alt="Bird" width="350" height="350">';
  $s.= '<h2>'.$intervenant->getFirstname().' '.$intervenant->getLastName().'</h2>';
         $s.= '<p>BIOGRAPHIE : <br><span class="pBioSpeaker">'.$intervenant->getBio().'</span></p>';
     $s.='</div>';
         
         $this->content = $s;
  }
  
  public function makeProgramList($list)
	{


    $listTmp =array();
    foreach ($list as $key => $value) {
        $listTmp[]=$value;
    }
    $tab =array();
   
    
    $s="";
    $iter = 2;
    $side = "left";
    $s.='<div class="programs">';
    $s.='<div class="timeline">';
        foreach ($list as $key => $value) {
          $s.='<div class="conteneur '.$side.'" > <div class="content"><h2>'.$value['date'].'</h2>';
        	//$s.="DATE :".$value['date'];
        	$s.='<p> De <strong>'.$value["heure_debut"].' </strong> à  <strong>'.$value['heure_fin'].' </strong> <br>';
        	$s.="<strong>INTERVENANTS :</strong>".$value['nom'].'  '.$value['prenom'].'<br>'; 
        	$s.="<strong>CONTENU DU PROGRAMME : </strong><br>".$value['contenu'].'<br>';
       
          $s.='</p> </div> </div>';
          $iter +=1;
          if ($iter % 2 === 0) {
            $side = "left";
          }
          else {
            $side = "right";
          }
        }
        $s.='</div>';
        $s.='</div>';
        $this->title = "programme";
        $this->content = $s;
        $this->getMenu();
	}
    /*public function displaySuccesSubcribtion()
    {
    	//echo "dans display";
    	 $feedback = '<div class="alert alert-success">
                   <strong>Success!</strong> inscription <a href="#" class="alert-link">reussi</a>.
             </div>';
    	$this->router->postredirect($this->router->getAcceuil(),$feedback);
    	echo 'mauvais'.$this->feedback; 
    	$this->feedback = $feedback;
    	echo 'bon '.$this->feedback; 

    }*/
    public function creationUserEchec(){
      $this->router->POSTredirect($this->router->getInscription(),"Veuillez remplir tous les champs ");
    }

    //Sponsors
    public function makeSponsorList($list)
    {
        $this->title = "liste des sponsors";
        $s = '';
    ?><script>
          function submitform(id)
         {
           document.getElementById("id").value = id;
            document.getElementById("myForm").submit();  

         }
                                                         
        </script>
         
                <?php
            $s='<section class="listIntervenant"> <br>';       
            $s.='<div class="row">';
            foreach ($list as $key => $value) {
              
              $s.=  '<form method="post" action="#">
                
                </form>';?>
              <?php
                $s.=  '<form method="post" action="#">';
                $s.='<div onclick="submitform(\''.$key.'\')" style="color:blue;">
                  
                    <div class="col">   
                    <div class="card cardsHeader">
                   <img class="card-img-top cardsImage" src="upload/'.$value->getPicture().'" alt="Card image" style="width:100%">
                   <div class="card-body">
                   <h4 class="card-title"><span>'.$value->getContent().'</span></h4>
                   <input type="hidden" name="nom" value="'.$value->getName().'">
                    <input type="hidden" name="contenu" value="'.$value->getContent().'">
                   <input type="hidden" name="image" value="'.$value->getPicture().'">
                   <input type="hidden" name="id" value="'.$key.'">
                </div>  
              </div>
           <br>
           </div>
             </div>
               ';        
            }

            $s.='</div>
           </section> </form>';
          $this->getMenu();
        $this->content = $s;
    }
}
?>




