<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * TablerForm helper
 */
class TablerFormHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $helpers = ['Html','Form'];

    protected $templates = [
        'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
        'inputContainerError' => '<div class="form-group {{type}}{{required}} error">{{content}}{{error}}</div>',
        ];



    public function input($fieldName,array $options = []){
       $ptemplates = $this->templates;
       $tag_start = '';
       $tag_end = '';
       if(isset($options['prepend'])){
            $ptemplates  = array_merge($this->templates,['input'=>'<div class="input-group"><span class="input-group-prepend">
                            <span class="input-group-text">' . $options['prepend']  . '</span>
                          </span><input type="{{type}}" name="{{name}}"{{attrs}} ></div>']);
                          unset($options['prepend']);
       }


       if(isset($options['type']) && ($options['type'] == 'checkbox')){
          $ptemplates  = array_merge($this->templates,['nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}<span class="custom-control-label">{{text}}</span></label>']);
          if(isset($options['label']) && !is_array($options['label'])){
              $labelText =  $options['label'];
              unset($options['label']);
              $options = array_merge(['class'=>'custom-control-input','label'=>['text'=>$labelText,'class'=>'custom-control custom-checkbox']],$options);

          }
          else
              $options = array_merge(['class'=>'custom-control-input','label'=>['class'=>'custom-control custom-checkbox']],$options);

        }


        if(isset($options['input-group'])){
           $group_text =  $options['input-group'];
           unset($options['input-group']);
           $ptemplates  = array_merge($this->templates,['input' => '<div class="input-group"><input type="{{type}}" name="{{name}}"{{attrs}} > <span class="input-group-append"> <span >' . $group_text . '</span</span></div>' ]);

        }

        if(isset($options['selectgroup'])){
            $options['type'] = 'radio';
            unset($options['selectgroup']);
            $ptemplates  = array_merge($this->templates,['checkboxWrapper'=>'{{label}}',
            'formGroup' => '{{label}}<div class="selectgroup w-100">{{input}}</div>',
            'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}<span class="selectgroup-button">{{text}}</span></label>',
            ]);
             $options['labelOptions']= ['class'=>'selectgroup-item'];
             $options['class'] = 'selectgroup-input';
        }

        if(isset($options['multiple']) && $options['multiple'] == 'checkbox'){
             $ptemplates  = array_merge($this->templates,['checkboxWrapper'=>'{{label}}',
             'formGroup' => '{{label}}<div class="selectgroup selectgroup-pills">{{input}}</div>',
             'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}<span class="selectgroup-button">{{text}}</span></label>',
             ]);

             $class= 'selectgroup-input';
             if(isset($options['class']))
                $options['class'] .= " " . $class;
            else
              $options['class'] = $class;
              
             $options['labelOptions']= ['class'=>'selectgroup-item'];

        }

        if(!isset($options['class']))
          $options['class'] =  'form-control';

        if(isset($options['label'])){
            $label_options = $options['label'];
            if(!is_array($label_options))
              $options['label'] =  ['text'=>$label_options,'class'=>'form-label'];
            else if(!isset($label_options['class'])){
                $label_options['class'] = 'form-label';
                $options['label'] = $label_options;
            }


         }else{
             $options['label'] = ['class'=>'form-label'];
         }


         if(isset($options['help'])){

             $ptemplates  = array_merge($ptemplates,['label' => '<label{{attrs}}>{{text}}<span class="col-auto align-self-center">
                              <span class="form-help" data-toggle="popover" data-placement="top" data-content="' .  $options['help']  .  '" data-original-title="" title="" aria-describedby="popover249753">?</span>
                          </span></label>',]);

         }


         if(isset($options['row'])){
             $col = 2;
             $row_class = '';
             if(is_array($options['row'])){
                 $col = $options['row']['col'];
                 $row_class = $options['row']['class'];

             }else{
                $col = $options['row'];
             }
              $tag_start  = "<div class='col-lg-{$col} {$row_class}'>";
              $tag_end = '</div>';
              unset($options['row']);
         }

         if(isset($options['bd_district'])){

          $bd_districts =[
              'Dhaka',
              'Faridpur',
              'Gazipur',
              'Gopalganj',
              'Jamalpur',
              'Kishoreganj',
              'Madaripur',
              'Manikganj',
              'Munshiganj',
              'Mymensingh',
              'Narayanganj',
              'Narsingdi',
              'Netrokona',
              'Rajbari',
              'Shariatpur',
              'Sherpur',
              'Tangail',
              'Bogura',
              'Joypurhat',
              'Naogaon',
              'Natore',
              'Nawabganj',
              'Pabna',
              'Rajshahi',
              'Sirajgonj',
              'Dinajpur',
              'Gaibandha',
              'Kurigram',
              'Lalmonirhat',
              'Nilphamari',
              'Panchagarh',
              'Rangpur',
              'Thakurgaon',
              'Barguna',
              'Barishal',
              'Bhola',
              'Jhalokati',
              'Patuakhali',
              'Pirojpur',
              'Bandarban',
              'Brahmanbaria',
              'Chandpur',
              'Chattogram',
              'Cumilla',
              'Cox\'s Bazar',
              'Feni',
              'Khagrachari',
              'Lakshmipur',
              'Noakhali',
              'Rangamati',
              'Habiganj',
              'Maulvibazar',
              'Sunamganj',
              'Sylhet',
              'Bagerhat',
              'Chuadanga',
              'Jashore',
              'Jhenaidah',
              'Khulna',
              'Kushtia',
              'Magura',
              'Meherpur',
              'Narail',
              'Satkhira'];

              $district_array = array_combine($bd_districts,$bd_districts);
              $options['options'] = $district_array;



         }
         if(isset($options['country'])){
         
            $options['options'] = $this->country_data();

            unset($options['country']);
         }





        return  $tag_start . $this->Form->control($fieldName,array_merge(['templates'=>$ptemplates],$options)) . $tag_end;

    }
    public function control($fieldName,array $options = []){

        return $this->input($fieldName,$options);
    }

    public function country_data(){
        return  array(
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, the Democratic Republic of the",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'Ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, the Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "CS" => "Serbia and Montenegro",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.s.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
            );
    }








}
