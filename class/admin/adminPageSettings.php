<?php 
class adminPageSettings extends Controller_Admin
{
	protected function run($aArgs)
	{
		//includes builder library
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		
		//calls save function
		$this->save($aArgs);
		//calls display function
		$this->display($aArgs);
	}
	
	public function display($aArgs)
	{
		//includes worldclock.admin.js
		$this->importJS('worldclock.admin');
		
		//assign value
		$aTimeZone = $this->listTZ();
		
		$this->assign('aSetting', $aSetting);
		$this->assign('aTimeZone', $aTimeZone);
		$this->assign('sClock1Zone', $sClock1Zone);
		$this->assign('sClock2Zone', $sClock2Zone);
		$this->assign('sMode', $sMode);
		$this->assign('sMsg', $sMsg);
		$this->assign('sClass', $sClass);
		
		//view
		$this->view(__CLASS__);
		
	}
	
	public function save($aArgs)
	{
		//includes worldclock.admin.js
		$this->importJS('worldclock.admin');
		
		//gets data sent by form
		$sFormScript = usbuilder()->getFormAction('pg_worldclock_setting_form', 'adminExecWorldClock');
		$this->writeJs($sFormScript);
		$this->assign("sUrl", common()->getFullUrl());
        $this->assign("seq", $aArgs['seq']);
        $this->assign("bExtensionView", ($aArgs['etype'] ? 1 : 0));
		
		$this->view(__CLASS__);
	}
	
	public function listTZ()
	{
		$aTimeZone = array();
	
		$aTimeZone[] = array(
				'group' => 'Africa',
				'location' => array('Abidjan'=>'Africa/Abidjan', 'Accra'=>'Africa/Accra', 'Addis Ababa'=>'Africa/Addis_Ababa', 'Algiers'=>'Africa/Algiers',
						'Asmara'=>'Africa/Asmara', 'Asmera'=>'Africa/Asmera', 'Bamako'=>'Africa/Bamako', 'Bangui'=>'Africa/Bangui',
						'Banjul'=>'Africa/Banjul', 'Bissau'=>'Africa/Bissau', 'Blantyre'=>'Africa/Blantyre', 'Brazzaville'=>'Africa/Brazzaville',
						'Bujumbura'=>'Africa/Bujumbura', 'Cairo'=>'Africa/Cairo', 'Casablanca'=>'Africa/Casablanca', 'Ceuta'=>'Africa/Ceuta',
						'Conakry'=>'Africa/Conakry', 'Dakar'=>'Africa/Dakar', 'Dar es Salaam'=>'Africa/Dar_es_Salaam',
						'Djibouti'=>'Africa/Djibouti', 'Douala'=>'Africa/Douala', 'El Aaiun'=>'Africa/El_Aaiun', 'Freetown'=>'Africa/Freetown',
						'Gaborone'=>'Africa/Gaborone', 'Harare'=>'Africa/Harare', 'Johannesburg'=>'Africa/Johannesburg', 'Kampala'=>'Africa/Kampala',
						'Khartoum'=>'Africa/Khartoum', 'Kigali'=>'Africa/Kigali', 'Kinshasa'=>'Africa/Kinshasa', 'Lagos'=>'Africa/Lagos',
						'Libreville'=>'Africa/Libreville',  'Lome'=>'Africa/Lome', 'Luanda'=>'Africa/Luanda', 'Lubumbashi'=>'Africa/Lubumbashi',
						'Lusaka'=>'Africa/Lusaka', 'Malabo'=>'Africa/Malabo', 'Maputo'=>'Africa/Maputo', 'Maseru'=>'Africa/Maseru', 'Mbabane'=>'Africa/Mbabane',
						'Mogadishu'=>'Africa/Mogadishu', 'Monrovia'=>'Africa/Monrovia', 'Nairobi'=>'Africa/Nairobi', 'Ndjamena'=>'Africa/Ndjamena',
						'Niamey'=>'Africa/Niamey', 'Nouakchot'=>'Africa/Nouakchot', 'Ouagadougou'=>'Africa/Ouagadougou', 'Porto-Novo'=>'Africa/Porto-Novo',
						'Sao Tome'=>'Africa/Sao_Tome', 'Timbuktu'=>'Africa/Timbuktu', 'Tripoli'=>'Africa/Tripoli', 'Tunis'=>'Africa/Tunis', 'Windhoek'=>'Africa/Windhoek'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'America',
				'location' => array('Adak'=>'America/Adak', 'Anchorage'=>'America/Anchorage', 'Anguilla'=>'America/Anguilla', 'Antigua'=>'America/Antigua',
						'Araguaina'=>'America/Araguaina', 'Argentina - Buenos Aires'=>'America/Argentina/Buenos_Aires', 'Argentina - Catamarca'=>'America/Argentina/Catamarca',
						'Argentina - ComodRivadavia' => 'America/Argentina/ComodRivadavia', 'Argentina - Cordoba'=>'America/Argentina/Cordoba',
						'Argentina - Jujuy'=>'America/Argentina/Jujuy', 'Argentina - La Rioja'=>'America/Argentina/La_Rioja', 'Argentina - Mendoza'=>'America/Argentina/Mendoza',
						'Argentina - Rio Gallegos'=>'America/Argentina/Rio_Gallegos', 'Argentina - San Juan'=>'America/Argentina/San_Juan', '
						Argentina - San Luis'=>'America/Argentina/San_Luis', 'Argentina - Tucuman'=>'America/Argentina/Tucuman',
						'Argentina - Ushuaia'=>'America/Argentina/Ushuaia', 'Aruba'=>'America/Aruba', 'Asuncion'=>'America/Asuncion', 'Atikokan'=>'America/Atikokan',
						'Atka'=>'America/Atka', 'Bahia'=>'America/Bahia', 'Barbados'=>'America/Barbados', 'Belem'=>'America/Belem', 'Belize'=>'America/Belize',
						'Blanc-Sablon'=>'America/Blanc-Sablon', 'Boa Vista'=>'America/Boa_Vista', 'Bogota'=>'America/Bogota', 'Boise'=>'America/Boise',
						'Buenos Aires'=>'America/Buenos_Aires', 'Cambridge Bay'=>'America/Cambridge_Bay', 'Campo Grande'=> 'America/Campo_Grande',
						'Cancun'=>'America/Cancun', 'Caracas'=>'America/Caracas', 'Catamarca'=>'America/Catamarca', 'Cayenne'=>'America/Cayenne',
						'Cayman'=>'America/Cayman', 'Chicago'=>'America/Chicago', 'Chihuahua'=>'America/Chihuahua', 'Coral Harbour'=>'America/Coral_Harbour',
						'Cordoba'=>'America/Cordoba', 'Costa Rica'=>'America/Costa_Rica', 'Cuiaba'=>'America/Cuiaba', 'Curacao'=>'America/Curacao',
						'Danmarkshavn'=>'America/Danmarkshavn', 'Dawson'=>'America/Dawson', 'Dawson Creek'=>'America/Dawson_Creek', 'Denver'=>'America/Denver',
						'Detroit'=>'America/Detroit', 'Dominica'=>'America/Dominica', 'Edmonton'=>'America/Edmonton', 'Eirunepe'=>'America/Eirunepe',
						'El Salvador'=>'America/El_Salvador', 'Ensenada'=>'America/Ensenada', 'Fort Wayne'=>'America/Fort_Wayne', 'Fortaleza'=>'America/Fortaleza',
						'Glace Bay'=>'America/Glace_Bay', 'Godthab'=>'America/Godthab', 'Goose Bay'=>'America/Goose_Bay', 'Grand Turk'=>'America/Grand_Turk',
						'Grenada'=>'America/Grenada', 'Guadeloupe'=>'America/Guadeloupe', 'Guatemala'=>'America/Guatemala', 'Guayaquil'=>'America/Guayaquil',
						'Guyana'=>'America/Guyana', 'Halifax'=>'America/Halifax', 'Havana'=>'America/Havana', 'Hermosillo'=>'America/Hermosillo',
						'Indiana - Indianapolis'=>'America/Indiana/Indianapolis', 'Indiana - Knox'=>'America/Indiana/Knox', 'Indiana - Marengo'=>'America/Indiana/Marengo',
						'Indiana - Petersburg'=>'America/Indiana/Petersburg', 'Indiana - Tell City'=>'America/Indiana/Tell_City', 'Indiana - Vevay'=>'America/Indiana/Vevay',
						'Indiana - Vincennes'=>'America/Indiana/Vincennes', 'Indiana - Winamac'=>'America/Indiana/Winamac', 'Indianapolis'=>'America/Indianapolis',
						'Inuvik'=>'America/Inuvik', 'Iqaluit'=>'America/Iqaluit', 'Jamaica'=>'America/Jamaica', 'Jujuy'=>'America/Jujuy', 'Juneau'=>'America/Juneau',
						'Kentucky - Louisville'=>'America/Kentucky/Louisville', 'Kentucky - Monticello'=>'America/Kentucky/Monticello', 'Knox IN'=>'America/Knox_IN',
						'La Paz'=>'America/La_Paz', 'Lima'=>'America/Lima', 'Los Angeles'=>'America/Los_Angeles', 'Louisville'=>'America/Louisville', 'Maceio'=>'America/Maceio',
						'Managua'=>'America/Managua', 'Manaus'=>'America/Manaus', 'Marigot'=>'America/Marigot', 'Martinique'=>'America/Martinique', 'Mazatlan'=>'America/Mazatlan',
						'Mendoza'=>'America/Mendoza', 'Menominee'=>'America/Menominee', 'Merida'=>'America/Merida', 'Mexico City'=>'America/Mexico_City',
						'Miquelon'=>'America/Miquelon', 'Moncton'=>'America/Moncton', 'Monterrey'=>'America/Monterrey', 'Montevideo'=>'America/Montevideo',
						'Montreal'=>'America/Montreal', 'Montserrat'=>'America/Montserrat', 'Nassau'=>'America/Nassau', 'New York'=>'America/New_York', 'Nipigon'=>'America/Nipigon', 'Nome'=>'America/Nome', 'Noronha'=>'America/Noronha', 'North Dakota - Center'=>'America/North_Dakota/Center',
						'North Dakota - New Salem'=>'America/North_Dakota/New_Salem', 'Panama'=>'America/Panama', 'Pangnirtung'=>'America/Pangnirtung',
						'Paramaribo'=>'America/Paramaribo', 'Phoenix'=>'America/Phoenix', 'Port-au-Prince'=>'America/Port-au-Prince', 'Port of Spain'=>'America/Port_of_Spain',
						'Porto Acre'=>'America/Porto_Acre', 'Porto Velho'=>'America/Porto_Velho', 'Puerto Rico'=>'America/Puerto_Rico', 'Rainy River'=>'America/Rainy_River',
						'Rankin Inlet'=>'America/Rankin_Inlet', 'Recife'=>'America/Recife', 'Regina'=>'America/Regina', 'Resolute'=>'America/Resolute', 'Rio Branco'=>'America/Rio_Branco', 'Rosario'=>'America/Rosario', 'Santiago'=>'America/Santiago', 'Santo Domingo'=>'America/Santo_Domingo', 'Sao Paulo'=>'America/Sao_Paulo', 'Scoresbysund'=>'America/Scoresbysund', 'Shiprock'=>'America/Shiprock', 'St. Barthelemy'=>'America/St_Barthelemy', 'St. Johns'=>'America/St_Johns', 'St. Kitts'=>'America/St_Kitts', 'St. Lucia'=>'America/St_Lucia', 'St. Thomas'=>'America/St_Thomas', 'St. Vincent'=>'America/St_Vincent',  'Swift Current'=>'America/Swift_Current', 'Tegucigalpa'=>'America/Tegucigalpa', 'Thule'=>'America/Thule', 'Thunder Bay'=>'America/Thunder_Bay', 'Tijuana'=>'America/Tijuana', 'Toronto'=>'America/Toronto', 'Yakutat'=>'America/Yakutat', 'Yellowknife'=>'America/Yellowknife'
				)
	
		);
	
		$aTimeZone[] = array(
				'group' => 'Antarctica',
				'location' => array('Casey'=>'Antarctica/Casey', 'Davis'=>'Antarctica/Davis', 'Dumont D Urville'=>'Antarctica/DumontDUrville', 'Mawson'=>'Antarctica/Mawson',
						'McMurdo'=>'Antarctica/McMurdo', 'Palmer'=>'Antarctica/Palmer', 'Rothera'=>'Antarctica/Rothera', 'South Pole'=>'Antarctica/South_Pole',
						'Syowa'=>'Antarctica/Syowa', 'Vostok'=>'Antarctica/Vostok'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Arctic',
				'location' => array('Longyearbyen'=>'Arctic/Longyearbyen')
		);
	
		$aTimeZone[] = array(
				'group' => 'Asia',
				'location' => array('Aden'=>'Asia/Aden', 'Almaty'=>'Asia/Almaty', 'Amman'=>'Asia/Amman', 'Anadyr'=>'Asia/Anadyr', 'Aqtau'=>'Asia/Aqtau', 'Aqtobe'=>'Asia/Aqtobe',
						'Ashgabat'=>'Asia/Ashgabat', 'Ashkhabad'=>'Asia/Ashkhabad', 'Baghdad'=>'Asia/Baghdad', 'Bahrain'=>'Asia/Bahrain', 'Baku'=>'Asia/Baku',
						'Bangkok'=>'Asia/Bangkok', 'Beirut'=>'Asia/Beirut', 'Bishkek'=>'Asia/Bishkek', 'Brunei'=>'Asia/Brunei', 'Calcutta'=>'Asia/Calcutta', 'Choibalsan'=>'Asia/Choibalsan',
						'Chongqing'=>'Asia/Chongqing', 'Chungking'=>'Asia/Chungking', 'Colombo'=>'Asia/Colombo', 'Dacca'=>'Asia/Dacca', 'Damascus'=>'Asia/Damascus',
						'Dhaka'=>'Asia/Dhaka', 'Dili'=>'Asia/Dili', 'Dubai'=>'Asia/Dubai', 'Dushanbe'=>'Asia/Dushanbe', 'Gaza'=>'Asia/Gaza', 'Harbin'=>'Asia/Harbin',
						'Ho Chi Minh'=>'Asia/Ho_Chi_Minh', 'Hong Kong'=>'Asia/Hong_Kong', 'Hovd'=>'Asia/Hovd', 'Irkutsk'=>'Asia/Irkutsk', 'Istanbul'=>'Asia/Istanbul',
						'Jakarta'=>'Asia/Jakarta', 'Jayapura'=>'Asia/Jayapura', 'Jerusalem'=>'Asia/Jerusalem', 'Kabul'=>'Asia/Kabul', 'Kamchatka'=>'Asia/Kamchatka',
						'Karachi'=>'Asia/Karachi', 'Kashgar'=>'Asia/Kashgar', 'Katmandu'=>'Asia/Katmandu', 'Kolkata'=>'Asia/Kolkata', 'Krasnoyarsk'=>'Asia/Krasnoyarsk',
						'Kuala Lumpur'=>'Asia/Kuala_Lumpur', 'Kuching'=>'Asia/Kuching', 'Kuwait'=>'Asia/Kuwait', 'Macao'=>'Asia/Macao', 'Macau'=>'Asia/Macau',
						'Magadan'=>'Asia/Magadan', 'Makassar'=>'Asia/Makassar', 'Manila'=>'Asia/Manila', 'Muscat'=>'Asia/Muscat', 'Nicosia'=>'Asia/Nicosia',
						'Novosibirsk'=>'Asia/Novosibirsk', 'Omsk'=>'Asia/Omsk', 'Oral'=>'Asia/Oral', 'Phnom Penh'=>'Asia/Phnom_Penh', 'Pontianak'=>'Asia/Pontianak',
						'Pyongyang'=>'Asia/Pyongyang', 'Qatar'=>'Asia/Qatar', 'Qyzylorda'=>'Asia/Qyzylorda', 'Rangoon'=>'Asia/Rangoon', 'Riyadh'=>'Asia/Riyadh',
						'Saigon'=>'Asia/Saigon', 'Sakhalin'=>'Asia/Sakhalin', 'Samarkand'=>'Asia/Samarkand', 'Seoul'=>'Asia/Seoul', 'Shanghai'=>'Asia/Shanghai',
						'Singapore'=>'Asia/Singapore', 'Taipei'=>'Asia/Taipei', 'Tashkent'=>'Asia/Tashkent', 'Tbilisi'=>'Asia/Tbilisi', 'Tehran'=>'Asia/Tehran',
						'Tel Aviv'=>'Asia/Tel_Aviv', 'Thimbu'=>'Asia/Thimbu', 'Thimphu'=>'Asia/Thimphu', 'Tokyo'=>'Asia/Tokyo', 'Ujung Pandang'=>'Asia/Ujung_Pandang',
						'Ulaanbaatar'=>'Asia/Ulaanbaatar', 'Ulan Bator'=>'Asia/Ulan_Bator', 'Urumqi'=>'Asia/Urumqi', 'Vientiane'=>'Asia/Vientiane', 'Vladivostok'=>'Asia/Vladivostok',
						'Yakutsk'=>'Asia/Yakutsk', 'Yekaterinburg'=>'Asia/Yekaterinburg', 'Yerevan'=>'Asia/Yerevan'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Atlantic',
				'location' => array('Azores'=>'Atlantic/Azores', 'Bermuda'=>'Atlantic/Bermuda', 'Canary'=>'Atlantic/Canary', 'Cape Verde'=>'Atlantic/Cape_Verde',
						'Faeroe'=>'Atlantic/Faeroe', 'Faroe'=>'Atlantic/Faroe', 'Jan Mayen'=>'Atlantic/Jan_Mayen', 'Madeira'=>'Atlantic/Madeira', 'Reykjavik'=>'Atlantic/Reykjavik',
						'South Georgia'=>'Atlantic/South_Georgia', 'St. Helena'=>'Atlantic/St_Helena', 'Stanley'=>'Atlantic/Stanley'
	
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Australia',
				'location' => array('ACT'=>'Australia/ACT', 'Adelaide'=>'Australia/Adelaide', 'Brisbane'=>'Australia/Brisbane', 'Broken Hill'=>'Australia/Broken_Hill', 'Canberra'=>'Australia/Canberra',
						'Currie'=>'Australia/Currie', 'Darwin'=>'Australia/Darwin', 'Eucla'=>'Australia/Eucla', 'Hobart'=>'Australia/Hobart', 'LHI'=>'Australia/LHI',
						'Lindeman'=>'Australia/Lindeman', 'Lord Howe'=>'Australia/Lord_Howe', 'Melbourne'=>'Australia/Melbourne', 'North'=>'Australia/North', 'NSW'=>'Australia/NSW',
						'Perth'=>'Australia/Perth', 'Queensland'=>'Australia/Queensland', 'South'=>'Australia/South', 'Sydney'=>'Australia/Sydney', 'Tasmania'=>'Australia/Tasmania',
						'Victoria'=>'Australia/Victoria', 'West'=>'Australia/West', 'Yancowinna'=>'Australia/Yancowinna'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Europe',
				'location' => array('Amsterdam'=>'Europe/Amsterdam', 'Andorra'=>'Europe/Andorra', 'Athens'=>'Europe/Athens', 'Belfast'=>'Europe/Belfast', 'Belgrade'=>'Europe/Belgrade',
						'Berlin'=>'Europe/Berlin', 'Bratislava'=>'Europe/Bratislava', 'Brussels'=>'Europe/Brussels', 'Bucharest'=>'Europe/Bucharest', 'Budapest'=>'Europe/Budapest',
						'Chisinau'=>'Europe/Chisinau', 'Copenhagen'=>'Europe/Copenhagen', 'Dublin'=>'Europe/Dublin', 'Gibraltar'=>'Europe/Gibraltar', 'Guernsey'=>'Europe/Guernsey',
						'Helsinki'=>'Europe/Helsinki', 'Isle of Man'=>'Europe/Isle_of_Man', 'Istanbul'=>'Europe/Istanbul', 'Jersey'=>'Europe/Jersey', 'Kaliningrad'=>'Europe/Kaliningrad',
						'Kiev'=>'Europe/Kiev', 'Lisbon'=>'Europe/Lisbon', 'Ljubljana'=>'Europe/Ljubljana', 'London'=>'Europe/London', 'Luxembourg'=>'Europe/Luxembourg',
						'Madrid'=>'Europe/Madrid', 'Malta'=>'Europe/Malta', 'Mariehamn'=>'Europe/Mariehamn', 'Minsk'=>'Europe/Minsk', 'Monaco'=>'Europe/Monaco',
						'Moscow'=>'Europe/Moscow', 'Nicosia'=>'Europe/Nicosia', 'Oslo'=>'Europe/Oslo', 'Paris'=>'Europe/Paris', 'Podgorica'=>'Europe/Podgorica',
						'Prague'=>'Europe/Prague', 'Riga'=>'Europe/Riga', 'Rome'=>'Europe/Rome', 'Samara'=>'Europe/Samara', 'San Marino'=>'Europe/San_Marino',
						'Sarajevo'=>'Europe/Sarajevo', 'Simferopol'=>'Europe/Simferopol', 'Skopje'=>'Europe/Skopje', 'Sofia'=>'Europe/Sofia', 'Stockholm'=>'Europe/Stockholm',
						'Tallinn'=>'Europe/Tallinn', 'Tirane'=>'Europe/Tirane', 'Tiraspol'=>'Europe/Tiraspol', 'Uzhgorod'=>'Europe/Uzhgorod', 'Vaduz'=>'Europe/Vaduz',
						'Vatican'=>'Europe/Vatican', 'Vienna'=>'Europe/Vienna', 'Vilnius'=>'Europe/Vilnius', 'Volgograd'=>'Europe/Volgograd', 'Warsaw'=>'Europe/Warsaw',
						'Zagreb'=>'Europe/Zagreb', 'Zaporozhye'=>'Europe/Zaporozhye', 'Zurich'=>'Europe/Zurich'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Indian',
				'location' => array('Antananarivo'=>'Indian/Antananarivo', 'Chagos'=>'Indian/Chagos', 'Christmas'=>'Indian/Christmas', 'Cocos'=>'Indian/Cocos', 'Comoro'=>'Indian/Comoro',
						'Kerguelen'=>'Indian/Kerguelen', 'Mahe'=>'Indian/Mahe', 'Maldives'=>'Indian/Maldives', 'Mauritius'=>'Indian/Mauritius', 'Mayotte'=>'Indian/Mayotte',
						'Reunion'=>'Indian/Reunion'
				)
		);
	
		$aTimeZone[] = array(
				'group' => 'Pacific',
				'location' => array('Apia'=>'Pacific/Apia', 'Auckland'=>'Pacific/Auckland', 'Chatham'=>'Pacific/Chatham', 'Easter'=>'Pacific/Easter', 'Efate'=>'Pacific/Efate',
						'Enderbury'=>'Pacific/Enderbury', 'Fakaofo'=>'Pacific/Fakaofo', 'Fiji'=>'Pacific/Fiji', 'Funafuti'=>'Pacific/Funafuti', 'Galapagos'=>'Pacific/Galapagos',
						'Gambier'=>'Pacific/Gambier', 'Guadalcanal'=>'Pacific/Guadalcanal', 'Guam'=>'Pacific/Guam', 'Honolulu'=>'Pacific/Honolulu', 'Johnston'=>'Pacific/Johnston',
						'Kiritimati'=>'Pacific/Kiritimati', 'Kosrae'=>'Pacific/Kosrae', 'Kwajalein'=>'Pacific/Kwajalein', 'Majuro'=>'Pacific/Majuro',
						'Marquesas'=>'Pacific/Marquesas', 'Midway'=>'Pacific/Midway', 'Nauru'=>'Pacific/Nauru', 'Niue'=>'Pacific/Niue', 'Norfolk'=>'Pacific/Norfolk',
						'Noumea'=>'Pacific/Noumea', 'Pago Pago'=>'Pacific/Pago_Pago', 'Palau'=>'Pacific/Palau', 'Pitcairn'=>'Pacific/Pitcairn', 'Ponape'=>'Pacific/Ponape',
						'Port Moresby'=>'Pacific/Port_Moresby', 'Rarotonga'=>'Pacific/Rarotonga', 'Saipan'=>'Pacific/Saipan', 'Samoa'=>'Pacific/Samoa', 'Tahiti'=>'Pacific/Tahiti',
						'Tarawa'=>'Pacific/Tarawa', 'Tongatapu'=>'Pacific/Tongatapu', 'Truk'=>'Pacific/Truk', 'Wake'=>'Pacific/Wake', 'Wallis'=>'Pacific/Wallis',
						'Yap'=>'Pacific/Yap'
				)
		);
	
		return $aTimeZone;
	}
}