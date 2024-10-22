<?php

class Country {

    private static $instance = null;


    private function get_countries() {
        return array(
            'afghanistan' => esc_html__('Afghanistan','world-domi-map'),
            'albania' => esc_html__('Albania','world-domi-map'),
            'algeria' => esc_html__('Algeria','world-domi-map'),
            'american-samoa' => esc_html__('American Samoa','world-domi-map'),
            'andorra' => esc_html__('Andorra','world-domi-map'),
            'angola' => esc_html__('Angola','world-domi-map'),
            'anguilla' => esc_html__('Anguilla','world-domi-map'),
            'antigua-and-barbuda' => esc_html__('Antigua and Barbuda','world-domi-map'),
            'argentina' => esc_html__('Argentina','world-domi-map'),
            'armenia' => esc_html__('Armenia','world-domi-map'),
            'aruba' => esc_html__('Aruba','world-domi-map'),
            'australia' => esc_html__('Australia','world-domi-map'),
            'austria' => esc_html__('Austria','world-domi-map'),
            'azerbaijan' => esc_html__('Azerbaijan','world-domi-map'),
            'bahamas' => esc_html__('Bahamas','world-domi-map'),
            'bahrain' => esc_html__('Bahrain','world-domi-map'),
            'bangladesh' => esc_html__('Bangladesh','world-domi-map'),
            'barbados' => esc_html__('Barbados','world-domi-map'),
            'belarus' => esc_html__('Belarus','world-domi-map'),
            'belgium' => esc_html__('Belgium','world-domi-map'),
            'belize' => esc_html__('Belize','world-domi-map'),
            'benin' => esc_html__('Benin','world-domi-map'),
            'bermuda' => esc_html__('Bermuda','world-domi-map'),
            'bhutan' => esc_html__('Bhutan','world-domi-map'),
            'bolivia' => esc_html__('Bolivia','world-domi-map'),
            'bosnia-and-herzegovina' => esc_html__('Bosnia and Herzegovina','world-domi-map'),
            'botswana' => esc_html__('Botswana','world-domi-map'),
            'brazil' => esc_html__('Brazil','world-domi-map'),
            'british-virgin-islands' => esc_html__('British Virgin Islands','world-domi-map'),
            'brunei-darussalam' => esc_html__('Brunei Darussalam','world-domi-map'),
            'bulgaria' => esc_html__('Bulgaria','world-domi-map'),
            'burkina-faso' => esc_html__('Burkina Faso','world-domi-map'),
            'burundi' => esc_html__('Burundi','world-domi-map'),
            'cambodia' => esc_html__('Cambodia','world-domi-map'),
            'cameroon' => esc_html__('Cameroon','world-domi-map'),
            'canada' => esc_html__('Canada','world-domi-map'),
            'canary-islands-spain' => esc_html__('Canary Islands (Spain)','world-domi-map'),
            'cape-verde' => esc_html__('Cape Verde','world-domi-map'),
            'cayman-islands' => esc_html__('Cayman Islands','world-domi-map'),
            'central-african-republic' => esc_html__('Central African Republic','world-domi-map'),
            'chad' => esc_html__('Chad','world-domi-map'),
            'chile' => esc_html__('Chile','world-domi-map'),
            'china' => esc_html__('China','world-domi-map'),
            'colombia' => esc_html__('Colombia','world-domi-map'),
            'comoros' => esc_html__('Comoros','world-domi-map'),
            'costa-rica' => esc_html__('Costa Rica','world-domi-map'),
            'croatia' => esc_html__('Croatia','world-domi-map'),
            'cuba' => esc_html__('Cuba','world-domi-map'),
            'curacao' => esc_html__('Curaçao','world-domi-map'),
            'cyprus' => esc_html__('Cyprus','world-domi-map'),
            'czech-republic' => esc_html__('Czech Republic','world-domi-map'),
            'dem-rep-korea' => esc_html__('Dem. Rep. Korea','world-domi-map'),
            'democratic-republic-of-the-congo' => esc_html__('Democratic Republic of the Congo','world-domi-map'),
            'denmark' => esc_html__('Denmark','world-domi-map'),
            'djibouti' => esc_html__('Djibouti','world-domi-map'),
            'dominica' => esc_html__('Dominica','world-domi-map'),
            'dominican-republic' => esc_html__('Dominican Republic','world-domi-map'),
            'ecuador' => esc_html__('Ecuador','world-domi-map'),
            'egypt' => esc_html__('Egypt','world-domi-map'),
            'el-salvador' => esc_html__('El Salvador','world-domi-map'),
            'equatorial-guinea' => esc_html__('Equatorial Guinea','world-domi-map'),
            'eritrea' => esc_html__('Eritrea','world-domi-map'),
            'estonia' => esc_html__('Estonia','world-domi-map'),
            'eswatini' => esc_html__('Eswatini','world-domi-map'),
            'ethiopia' => esc_html__('Ethiopia','world-domi-map'),
            'faeroe-islands' => esc_html__('Faeroe Islands','world-domi-map'),
            'falkland-islands' => esc_html__('Falkland Islands','world-domi-map'),
            'federated-states-of-micronesia' => esc_html__('Federated States of Micronesia','world-domi-map'),
            'fiji' => esc_html__('Fiji','world-domi-map'),
            'finland' => esc_html__('Finland','world-domi-map'),
            'france' => esc_html__('France','world-domi-map'),
            'french-guiana' => esc_html__('French Guiana','world-domi-map'),
            'french-polynesia' => esc_html__('French Polynesia','world-domi-map'),
            'gabon' => esc_html__('Gabon','world-domi-map'),
            'georgia' => esc_html__('Georgia','world-domi-map'),
            'germany' => esc_html__('Germany','world-domi-map'),
            'ghana' => esc_html__('Ghana','world-domi-map'),
            'greece' => esc_html__('Greece','world-domi-map'),
            'greenland' => esc_html__('Greenland','world-domi-map'),
            'grenada' => esc_html__('Grenada','world-domi-map'),
            'guadeloupe' => esc_html__('Guadeloupe','world-domi-map'),
            'guam' => esc_html__('Guam','world-domi-map'),
            'guatemala' => esc_html__('Guatemala','world-domi-map'),
            'guinea' => esc_html__('Guinea','world-domi-map'),
            'guinea-bissau' => esc_html__('Guinea-Bissau','world-domi-map'),
            'guyana' => esc_html__('Guyana','world-domi-map'),
            'haiti' => esc_html__('Haiti','world-domi-map'),
            'honduras' => esc_html__('Honduras','world-domi-map'),
            'hungary' => esc_html__('Hungary','world-domi-map'),
            'iceland' => esc_html__('Iceland','world-domi-map'),
            'india' => esc_html__('India','world-domi-map'),
            'indonesia' => esc_html__('Indonesia','world-domi-map'),
            'iran' => esc_html__('Iran','world-domi-map'),
            'iraq' => esc_html__('Iraq','world-domi-map'),
            'ireland' => esc_html__('Ireland','world-domi-map'),
            'israel' => esc_html__('Israel','world-domi-map'),
            'italy' => esc_html__('Italy','world-domi-map'),
            'ivory-coast' => esc_html__('Ivory Coast','world-domi-map'),
            'jamaica' => esc_html__('Jamaica','world-domi-map'),
            'japan' => esc_html__('Japan','world-domi-map'),
            'jordan' => esc_html__('Jordan','world-domi-map'),
            'kazakhstan' => esc_html__('Kazakhstan','world-domi-map'),
            'kenya' => esc_html__('Kenya','world-domi-map'),
            'kiribati' => esc_html__('Kiribati','world-domi-map'),
            'kosovo' => esc_html__('Kosovo','world-domi-map'),
            'kuwait' => esc_html__('Kuwait','world-domi-map'),
            'kyrgyzstan' => esc_html__('Kyrgyzstan','world-domi-map'),
            'lao-pdr' => esc_html__('Lao PDR','world-domi-map'),
            'laos' => esc_html__('Laos','world-domi-map'),
            'latvia' => esc_html__('Latvia','world-domi-map'),
            'lebanon' => esc_html__('Lebanon','world-domi-map'),
            'lesotho' => esc_html__('Lesotho','world-domi-map'),
            'liberia' => esc_html__('Liberia','world-domi-map'),
            'libya' => esc_html__('Libya','world-domi-map'),
            'liechtenstein' => esc_html__('Liechtenstein','world-domi-map'),
            'lithuania' => esc_html__('Lithuania','world-domi-map'),
            'luxembourg' => esc_html__('Luxembourg','world-domi-map'),
            'macedonia' => esc_html__('Macedonia','world-domi-map'),
            'madagascar' => esc_html__('Madagascar','world-domi-map'),
            'malawi' => esc_html__('Malawi','world-domi-map'),
            'malaysia' => esc_html__('Malaysia','world-domi-map'),
            'maldives' => esc_html__('Maldives','world-domi-map'),
            'mali' => esc_html__('Mali','world-domi-map'),
            'malta' => esc_html__('Malta','world-domi-map'),
            'marshall-islands' => esc_html__('Marshall Islands','world-domi-map'),
            'martinique' => esc_html__('Martinique','world-domi-map'),
            'mauritania' => esc_html__('Mauritania','world-domi-map'),
            'mauritius' => esc_html__('Mauritius','world-domi-map'),
            'mayotte' => esc_html__('Mayotte','world-domi-map'),
            'mexico' => esc_html__('Mexico','world-domi-map'),
            'moldova' => esc_html__('Moldova','world-domi-map'),
            'monaco' => esc_html__('Monaco','world-domi-map'),
            'mongolia' => esc_html__('Mongolia','world-domi-map'),
            'montenegro' => esc_html__('Montenegro','world-domi-map'),
            'montserrat' => esc_html__('Montserrat','world-domi-map'),
            'morocco' => esc_html__('Morocco','world-domi-map'),
            'mozambique' => esc_html__('Mozambique','world-domi-map'),
            'myanmar' => esc_html__('Myanmar','world-domi-map'),
            'namibia' => esc_html__('Namibia','world-domi-map'),
            'nauru' => esc_html__('Nauru','world-domi-map'),
            'nepal' => esc_html__('Nepal','world-domi-map'),
            'netherlands' => esc_html__('Netherlands','world-domi-map'),
            'new-caledonia' => esc_html__('New Caledonia','world-domi-map'),
            'new-zealand' => esc_html__('New Zealand','world-domi-map'),
            'nicaragua' => esc_html__('Nicaragua','world-domi-map'),
            'niger' => esc_html__('Niger','world-domi-map'),
            'nigeria' => esc_html__('Nigeria','world-domi-map'),
            'northern-mariana-islands' => esc_html__('Northern Mariana Islands','world-domi-map'),
            'norway' => esc_html__('Norway','world-domi-map'),
            'oman' => esc_html__('Oman','world-domi-map'),
            'pakistan' => esc_html__('Pakistan','world-domi-map'),
            'palau' => esc_html__('Palau','world-domi-map'),
            'palestine' => esc_html__('Palestine','world-domi-map'),
            'panama' => esc_html__('Panama','world-domi-map'),
            'papua-new-guinea' => esc_html__('Papua New Guinea','world-domi-map'),
            'paraguay' => esc_html__('Paraguay','world-domi-map'),
            'peru' => esc_html__('Peru','world-domi-map'),
            'philippines' => esc_html__('Philippines','world-domi-map'),
            'poland' => esc_html__('Poland','world-domi-map'),
            'portugal' => esc_html__('Portugal','world-domi-map'),
            'puerto-rico' => esc_html__('Puerto Rico','world-domi-map'),
            'qatar' => esc_html__('Qatar','world-domi-map'),
            'republic-of-congo' => esc_html__('Republic of Congo','world-domi-map'),
            'republic-of-korea' => esc_html__('Republic of Korea','world-domi-map'),
            'reunion' => esc_html__('Reunion','world-domi-map'),
            'romania' => esc_html__('Romania','world-domi-map'),
            'russian-federation' => esc_html__('Russian Federation','world-domi-map'),
            'rwanda' => esc_html__('Rwanda','world-domi-map'),
            'saba-netherlands' => esc_html__('Saba (Netherlands)','world-domi-map'),
            'saint-kitts-and-nevis' => esc_html__('Saint Kitts and Nevis','world-domi-map'),
            'saint-lucia' => esc_html__('Saint Lucia','world-domi-map'),
            'saint-vincent-and-the-grenadines' => esc_html__('Saint Vincent and the Grenadines','world-domi-map'),
            'saint-barthelemy' => esc_html__('Saint-Barthélemy','world-domi-map'),
            'saint-martin' => esc_html__('Saint-Martin','world-domi-map'),
            'samoa' => esc_html__('Samoa','world-domi-map'),
            'san-marino' => esc_html__('San Marino','world-domi-map'),
            'sao-tome-and-principe' => esc_html__('Sao Tome and Principe','world-domi-map'),
            'saudi-arabia' => esc_html__('Saudi Arabia','world-domi-map'),
            'senegal' => esc_html__('Senegal','world-domi-map'),
            'serbia' => esc_html__('Serbia','world-domi-map'),
            'seychelles' => esc_html__('Seychelles','world-domi-map'),
            'sierra-leone' => esc_html__('Sierra Leone','world-domi-map'),
            'singapore' => esc_html__('Singapore','world-domi-map'),
            'sint-maarten' => esc_html__('Sint Maarten','world-domi-map'),
            'slovakia' => esc_html__('Slovakia','world-domi-map'),
            'slovenia' => esc_html__('Slovenia','world-domi-map'),
            'solomon-islands' => esc_html__('Solomon Islands','world-domi-map'),
            'somalia' => esc_html__('Somalia','world-domi-map'),
            'south-africa' => esc_html__('South Africa','world-domi-map'),
            'south-sudan' => esc_html__('South Sudan','world-domi-map'),
            'spain' => esc_html__('Spain','world-domi-map'),
            'sri-lanka' => esc_html__('Sri Lanka','world-domi-map'),
            'st-eustatius-netherlands' => esc_html__('St. Eustatius (Netherlands)','world-domi-map'),
            'sudan' => esc_html__('Sudan','world-domi-map'),
            'suriname' => esc_html__('Suriname','world-domi-map'),
            'swaziland' => esc_html__('Swaziland','world-domi-map'),
            'sweden' => esc_html__('Sweden','world-domi-map'),
            'switzerland' => esc_html__('Switzerland','world-domi-map'),
            'syria' => esc_html__('Syria','world-domi-map'),
            'sao-tome-and-principe' => esc_html__('São Tomé and Principe','world-domi-map'),
            'taiwan' => esc_html__('Taiwan','world-domi-map'),
            'tajikistan' => esc_html__('Tajikistan','world-domi-map'),
            'tanzania' => esc_html__('Tanzania','world-domi-map'),
            'thailand' => esc_html__('Thailand','world-domi-map'),
            'the-gambia' => esc_html__('The Gambia','world-domi-map'),
            'timor-leste' => esc_html__('Timor-Leste','world-domi-map'),
            'togo' => esc_html__('Togo','world-domi-map'),
            'tonga' => esc_html__('Tonga','world-domi-map'),
            'trinidad-and-tobago' => esc_html__('Trinidad and Tobago','world-domi-map'),
            'tunisia' => esc_html__('Tunisia','world-domi-map'),
            'turkey' => esc_html__('Turkey','world-domi-map'),
            'turkmenistan' => esc_html__('Turkmenistan','world-domi-map'),
            'turks-and-caicos-islands' => esc_html__('Turks and Caicos Islands','world-domi-map'),
            'tuvalu' => esc_html__('Tuvalu','world-domi-map'),
            'uganda' => esc_html__('Uganda','world-domi-map'),
            'ukraine' => esc_html__('Ukraine','world-domi-map'),
            'united-arab-emirates' => esc_html__('United Arab Emirates','world-domi-map'),
            'united-kingdom' => esc_html__('United Kingdom','world-domi-map'),
            'united-states' => esc_html__('United States','world-domi-map'),
            'united-states-virgin-islands' => esc_html__('United States Virgin Islands','world-domi-map'),
            'uruguay' => esc_html__('Uruguay','world-domi-map'),
            'uzbekistan' => esc_html__('Uzbekistan','world-domi-map'),
            'vanuatu' => esc_html__('Vanuatu','world-domi-map'),
            'vatican-city' => esc_html__('Vatican City','world-domi-map'),
            'venezuela' => esc_html__('Venezuela','world-domi-map'),
            'vietnam' => esc_html__('Vietnam','world-domi-map'),
            'western-sahara' => esc_html__('Western Sahara','world-domi-map'),
            'yemen' => esc_html__('Yemen','world-domi-map'),
            'zambia' => esc_html__('Zambia','world-domi-map'),
            'zimbabwe' => esc_html__('Zimbabwe','world-domi-map')
        );
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Country();
        }

        return self::$instance;
    }

    public function get_names() {
        return self::get_countries();
    }

    public function get_country_name($slug) {
        $normalizedSlug = sanitize_title($slug);
        $countries = self::get_countries();

        if (isset($countries[$normalizedSlug])) {
            return $countries[$normalizedSlug];
        }

        return "";
    }

    public function get_key_of_country($country_name){
        $countries = self::get_countries();
        $key = array_search($country_name, $countries);
        return $key;
    }

    public function get_ordered_countries(){
        $countries = self::get_countries();
        asort($countries);
        return $countries;
    }
}
