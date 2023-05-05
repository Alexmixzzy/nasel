<?php 

trait Countries {

    
    public function wcOptions(){


    }

    public function wcFlags($isoCode,  $pathLevel='../') {
    
      return '<img class="" height="25" width="25" src="'.$pathLevel.'static/public/flags/'.strtolower($isoCode).'.svg">';

    }

    public  function wcCurrency($isoCode='NG'){
      $data =[];
      try {
        //code...
        $data = $this->wcFetch($isoCode);

       // return $data['currencies']; // for all currencies
       if(!empty($data['currencies'])){
        if(!empty($data['currencies'][1])){
          echo $data['currencies'][1]['currency'];
         }else{
          echo $data['currencies'][0]['currency'];
         }
        }else{
          echo 'empty';
        }

       
       
      } catch (\Throwable $e) {
        //throw $th;
        return $e;
      }
        
    }

    public  function wcFetch($isCode=null){
    $data = [];
    $data = $this->wcAll();
    $name =null;

    //return $data['countries'][0]['country']['name'];

    $countries = $data['countries'];

    $len = count($countries);
    $count = $len -1;
    //return $len;
     
      //return $data['countries'][0]['country']['name'];
     try {
      //code...
      for($i=0; $i <=$count;  $i++){
        
        //return $countries[$i]['country']['name'];
        //return $i;
       //echo $countries[$i]['country']['isoCode'].'<br>';
      
       
       if(!empty($isCode)){
        if($countries[$i]['country']['isoCode'] === $isCode){
          // echo $countries[$i]['country']['name'];
          //var_dump($countries[$i]['country']);
          //echo 'found';
           return $countries[$i]['country'].$this->wcFlags($isCode);
          }
       }else{
        echo $countries[$i]['country']['name'].'- -'.$this->wcFlags($countries[$i]['country']['isoCode']).'  ['.$countries[$i]['country']['currencies'][0]['currency'].']'.'<br>';
        
       }
      }
     } catch (\Throwable $e) {
      //throw $th;
      return $e;
     }
      
     
     

    }


    private function wcSort($isCode, $data){
      $data = [];
      $data = $this->wcAll();
      $countries = $data['countries'];
  
      //return $data['countries'][0]['country']['name'];
      for($i =0; $i<count($countries); $i++){
      foreach ($countries[$i] as $key => $value) {
        # code...
      }



    }

    }

    public function wcAll(){
        $data = [
            'countries' => [
              0 => [
                'country' => [
                  'name' => 'Afghanistan',
                  'active' => 'Y',
                  'isoCode' => 'AF',
                  'dialCode' => 93,
                  'currencies' => [
                    0 => [
                      'currency' => 'AFN',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              1 => [
                'country' => [
                  'name' => 'American Samoa',
                  'active' => 'Y',
                  'isoCode' => 'AS',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              2 => [
                'country' => [
                  'name' => 'Aruba',
                  'active' => 'Y',
                  'isoCode' => 'AW',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'AWG',
                    ],
                  ],
                ],
              ],
              3 => [
                'country' => [
                  'name' => 'Bermuda',
                  'active' => 'Y',
                  'isoCode' => 'BM',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              4 => [
                'country' => [
                  'name' => 'Belarus',
                  'active' => 'Y',
                  'isoCode' => 'BY',
                  'dialCode' => 375,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              5 => [
                'country' => [
                  'name' => 'Cayman Islands',
                  'active' => 'Y',
                  'isoCode' => 'KY',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'KYD',
                    ],
                  ],
                ],
              ],
              6 => [
                'country' => [
                  'name' => 'Eritrea',
                  'active' => 'Y',
                  'isoCode' => 'ER',
                  'dialCode' => 291,
                  'currencies' => [
                    0 => [
                      'currency' => 'ERN',
                    ],
                  ],
                ],
              ],
              7 => [
                'country' => [
                  'name' => 'Fiji',
                  'active' => 'Y',
                  'isoCode' => 'FJ',
                  'dialCode' => 679,
                  'currencies' => [
                    0 => [
                      'currency' => 'FJD',
                    ],
                  ],
                ],
              ],
              8 => [
                'country' => [
                  'name' => 'Falkland Islands (Malvinas)',
                  'active' => 'Y',
                  'isoCode' => 'FK',
                  'dialCode' => 500,
                  'currencies' => [
                    0 => [
                      'currency' => 'FKP',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              9 => [
                'country' => [
                  'name' => 'Grenada',
                  'active' => 'Y',
                  'isoCode' => 'GD',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              10 => [
                'country' => [
                  'name' => 'Equatorial Guinea',
                  'active' => 'Y',
                  'isoCode' => 'GQ',
                  'dialCode' => 240,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              11 => [
                'country' => [
                  'name' => 'Jamaica',
                  'active' => 'Y',
                  'isoCode' => 'JM',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'JMD',
                    ],
                  ],
                ],
              ],
              12 => [
                'country' => [
                  'name' => 'Kosovo',
                  'active' => 'Y',
                  //'isoCode' => 'K1',
                  'isoCode' => 'XK',
                  'dialCode' => 383,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              13 => [
                'country' => [
                  'name' => 'Lithuania',
                  'active' => 'Y',
                  'isoCode' => 'LT',
                  'dialCode' => 370,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              14 => [
                'country' => [
                  'name' => 'Madagascar',
                  'active' => 'Y',
                  'isoCode' => 'MG',
                  'dialCode' => 261,
                  'currencies' => [
                    0 => [
                      'currency' => 'MGA',
                    ],
                  ],
                ],
              ],
              15 => [
                'country' => [
                  'name' => 'Mongolia',
                  'active' => 'Y',
                  'isoCode' => 'MN',
                  'dialCode' => 976,
                  'currencies' => [
                    0 => [
                      'currency' => 'MNT',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              16 => [
                'country' => [
                  'name' => 'Malawi',
                  'active' => 'Y',
                  'isoCode' => 'MW',
                  'dialCode' => 265,
                  'currencies' => [
                    0 => [
                      'currency' => 'MWK',
                    ],
                  ],
                ],
              ],
              17 => [
                'country' => [
                  'name' => 'New Zealand',
                  'active' => 'Y',
                  'isoCode' => 'NZ',
                  'dialCode' => 64,
                  'currencies' => [
                    0 => [
                      'currency' => 'NZD',
                    ],
                  ],
                ],
              ],
              18 => [
                'country' => [
                  'name' => 'Solomon Islands',
                  'active' => 'Y',
                  'isoCode' => 'SB',
                  'dialCode' => 677,
                  'currencies' => [
                    0 => [
                      'currency' => 'SBD',
                    ],
                  ],
                ],
              ],
              19 => [
                'country' => [
                  'name' => 'Singapore',
                  'active' => 'Y',
                  'isoCode' => 'SG',
                  'dialCode' => 65,
                  'currencies' => [
                    0 => [
                      'currency' => 'SGD',
                    ],
                  ],
                ],
              ],
              20 => [
                'country' => [
                  'name' => 'Sudan',
                  'active' => 'Y',
                  'isoCode' => 'SD',
                  'dialCode' => 249,
                  'currencies' => [
                    0 => [
                      'currency' => 'SDG',
                    ],
                  ],
                ],
              ],
              21 => [
                'country' => [
                  'name' => 'South Sudan',
                  'active' => 'Y',
                  'isoCode' => 'SS',
                  'dialCode' => 211,
                  'currencies' => [
                    0 => [
                      'currency' => 'SSP',
                    ],
                  ],
                ],
              ],
              22 => [
                'country' => [
                  'name' => 'Slovenia',
                  'active' => 'Y',
                  'isoCode' => 'SI',
                  'dialCode' => 386,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              23 => [
                'country' => [
                  'name' => 'Senegal',
                  'active' => 'Y',
                  'isoCode' => 'SN',
                  'dialCode' => 221,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              24 => [
                'country' => [
                  'name' => 'Suriname',
                  'active' => 'Y',
                  'isoCode' => 'SR',
                  'dialCode' => 597,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              25 => [
                'country' => [
                  'name' => 'Turkey',
                  'active' => 'Y',
                  'isoCode' => 'TR',
                  'dialCode' => 90,
                  'currencies' => [
                    0 => [
                      'currency' => 'TRY',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              26 => [
                'country' => [
                  'name' => 'Taiwan',
                  'active' => 'Y',
                  'isoCode' => 'TW',
                  'dialCode' => 886,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              27 => [
                'country' => [
                  'name' => 'United States',
                  'active' => 'Y',
                  'isoCode' => 'US',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              28 => [
                'country' => [
                  'name' => 'Mayotte',
                  'active' => 'Y',
                  'isoCode' => 'YT',
                  'dialCode' => 262,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              29 => [
                'country' => [
                  'name' => 'United Arab Emirates',
                  'active' => 'Y',
                  'isoCode' => 'AE',
                  'dialCode' => 971,
                  'currencies' => [
                    0 => [
                      'currency' => 'AED',
                    ],
                  ],
                ],
              ],
              30 => [
                'country' => [
                  'name' => 'Albania',
                  'active' => 'Y',
                  'isoCode' => 'AL',
                  'dialCode' => 355,
                  'currencies' => [
                    0 => [
                      'currency' => 'ALL',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              31 => [
                'country' => [
                  'name' => 'Burkina Faso',
                  'active' => 'Y',
                  'isoCode' => 'BF',
                  'dialCode' => 226,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              32 => [
                'country' => [
                  'name' => 'Bahrain',
                  'active' => 'Y',
                  'isoCode' => 'BH',
                  'dialCode' => 973,
                  'currencies' => [
                    0 => [
                      'currency' => 'BHD',
                    ],
                  ],
                ],
              ],
              33 => [
                'country' => [
                  'name' => 'Bolivia',
                  'active' => 'Y',
                  'isoCode' => 'BO',
                  'dialCode' => 591,
                  'currencies' => [
                    0 => [
                      'currency' => 'BOB',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              34 => [
                'country' => [
                  'name' => 'Cyprus (Northern)',
                  'active' => 'Y',
                  'isoCode' => 'C2',
                  'dialCode' => 90,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              35 => [
                'country' => [
                  'name' => 'Canada',
                  'active' => 'Y',
                  'isoCode' => 'CA',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'CAD',
                    ],
                  ],
                ],
              ],
              36 => [
                'country' => [
                  'name' => 'Switzerland',
                  'active' => 'Y',
                  'isoCode' => 'CH',
                  'dialCode' => 41,
                  'currencies' => [
                    0 => [
                      'currency' => 'CHF',
                    ],
                  ],
                ],
              ],
              37 => [
                'country' => [
                  'name' => 'Czech Republic',
                  'active' => 'Y',
                  'isoCode' => 'CZ',
                  'dialCode' => 420,
                  'currencies' => [
                    0 => [
                      'currency' => 'CZK',
                    ],
                  ],
                ],
              ],
              38 => [
                'country' => [
                  'name' => 'Egypt',
                  'active' => 'Y',
                  'isoCode' => 'EG',
                  'dialCode' => 20,
                  'currencies' => [
                    0 => [
                      'currency' => 'EGP',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              39 => [
                'country' => [
                  'name' => 'Spain',
                  'active' => 'Y',
                  'isoCode' => 'ES',
                  'dialCode' => 34,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              40 => [
                'country' => [
                  'name' => 'Georgia',
                  'active' => 'Y',
                  'isoCode' => 'GE',
                  'dialCode' => 995,
                  'currencies' => [
                    0 => [
                      'currency' => 'GEL',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              41 => [
                'country' => [
                  'name' => 'French Guiana',
                  'active' => 'Y',
                  'isoCode' => 'GF',
                  'dialCode' => 594,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              42 => [
                'country' => [
                  'name' => 'Gibraltar',
                  'active' => 'Y',
                  'isoCode' => 'GI',
                  'dialCode' => 350,
                  'currencies' => [
                    0 => [
                      'currency' => 'GBP',
                    ],
                  ],
                ],
              ],
              43 => [
                'country' => [
                  'name' => 'Haiti',
                  'active' => 'Y',
                  'isoCode' => 'HT',
                  'dialCode' => 509,
                  'currencies' => [
                    0 => [
                      'currency' => 'HTG',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              44 => [
                'country' => [
                  'name' => 'Iceland',
                  'active' => 'Y',
                  'isoCode' => 'IS',
                  'dialCode' => 354,
                  'currencies' => [
                    0 => [
                      'currency' => 'ISK',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              45 => [
                'country' => [
                  'name' => 'Kenya',
                  'active' => 'Y',
                  'isoCode' => 'KE',
                  'dialCode' => 254,
                  'currencies' => [
                    0 => [
                      'currency' => 'KES',
                    ],
                  ],
                ],
              ],
              46 => [
                'country' => [
                  'name' => 'Saint Kitts and Nevis',
                  'active' => 'Y',
                  'isoCode' => 'KN',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              47 => [
                'country' => [
                  'name' => 'Liberia',
                  'active' => 'Y',
                  'isoCode' => 'LR',
                  'dialCode' => 231,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              48 => [
                'country' => [
                  'name' => 'Marshall Islands',
                  'active' => 'Y',
                  'isoCode' => 'MH',
                  'dialCode' => 692,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              49 => [
                'country' => [
                  'name' => 'Maldives',
                  'active' => 'Y',
                  'isoCode' => 'MV',
                  'dialCode' => 960,
                  'currencies' => [
                    0 => [
                      'currency' => 'MVR',
                    ],
                  ],
                ],
              ],
              50 => [
                'country' => [
                  'name' => 'Nigeria',
                  'active' => 'Y',
                  'isoCode' => 'NG',
                  'dialCode' => 234,
                  'currencies' => [
                    0 => [
                      'currency' => 'NGN',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              51 => [
                'country' => [
                  'name' => 'Niue',
                  'active' => 'Y',
                  'isoCode' => 'NU',
                  'dialCode' => 683,
                  'currencies' => [
                    0 => [
                      'currency' => 'NZD',
                    ],
                  ],
                ],
              ],
              52 => [
                'country' => [
                  'name' => 'Philippines',
                  'active' => 'Y',
                  'isoCode' => 'PH',
                  'dialCode' => 63,
                  'currencies' => [
                    0 => [
                      'currency' => 'PHP',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              53 => [
                'country' => [
                  'name' => 'Pakistan',
                  'active' => 'Y',
                  'isoCode' => 'PK',
                  'dialCode' => 92,
                  'currencies' => [
                    0 => [
                      'currency' => 'PKR',
                    ],
                  ],
                ],
              ],
              54 => [
                'country' => [
                  'name' => 'Puerto Rico',
                  'active' => 'Y',
                  'isoCode' => 'PR',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              55 => [
                'country' => [
                  'name' => 'Reunion Island',
                  'active' => 'Y',
                  'isoCode' => 'RE',
                  'dialCode' => 262,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              56 => [
                'country' => [
                  'name' => 'Argentina',
                  'active' => 'Y',
                  'isoCode' => 'AR',
                  'dialCode' => 54,
                  'currencies' => [
                    0 => [
                      'currency' => 'ARS',
                    ],
                  ],
                ],
              ],
              57 => [
                'country' => [
                  'name' => 'Barbados',
                  'active' => 'Y',
                  'isoCode' => 'BB',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'BBD',
                    ],
                  ],
                ],
              ],
              58 => [
                'country' => [
                  'name' => 'Belgium',
                  'active' => 'Y',
                  'isoCode' => 'BE',
                  'dialCode' => 32,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              59 => [
                'country' => [
                  'name' => 'Bhutan',
                  'active' => 'Y',
                  'isoCode' => 'BT',
                  'dialCode' => 975,
                  'currencies' => [
                    0 => [
                      'currency' => 'BTN',
                    ],
                  ],
                ],
              ],
              60 => [
                'country' => [
                  'name' => 'Central African Republic',
                  'active' => 'Y',
                  'isoCode' => 'CF',
                  'dialCode' => 236,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              61 => [
                'country' => [
                  'name' => 'Algeria',
                  'active' => 'Y',
                  'isoCode' => 'DZ',
                  'dialCode' => 213,
                  'currencies' => [
                    0 => [
                      'currency' => 'DZD',
                    ],
                  ],
                ],
              ],
              62 => [
                'country' => [
                  'name' => 'Estonia',
                  'active' => 'Y',
                  'isoCode' => 'EE',
                  'dialCode' => 372,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              63 => [
                'country' => [
                  'name' => 'France',
                  'active' => 'Y',
                  'isoCode' => 'FR',
                  'dialCode' => 33,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              64 => [
                'country' => [
                  'name' => 'Guinea',
                  'active' => 'Y',
                  'isoCode' => 'GN',
                  'dialCode' => 224,
                  'currencies' => [
                    0 => [
                      'currency' => 'GNF',
                    ],
                  ],
                ],
              ],
              65 => [
                'country' => [
                  'name' => 'Iraq',
                  'active' => 'Y',
                  'isoCode' => 'IQ',
                  'dialCode' => 964,
                  'currencies' => [
                    0 => [
                      'currency' => 'IQD',
                    ],
                  ],
                ],
              ],
              66 => [
                'country' => [
                  'name' => 'Italy',
                  'active' => 'Y',
                  'isoCode' => 'IT',
                  'dialCode' => 39,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              67 => [
                'country' => [
                  'name' => 'Kyrghyz Republic',
                  'active' => 'Y',
                  'isoCode' => 'KG',
                  'dialCode' => 996,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              68 => [
                'country' => [
                  'name' => 'Kiribati',
                  'active' => 'Y',
                  'isoCode' => 'KI',
                  'dialCode' => 686,
                  'currencies' => [
                    0 => [
                      'currency' => 'AUD',
                    ],
                  ],
                ],
              ],
              69 => [
                'country' => [
                  'name' => 'Luxembourg',
                  'active' => 'Y',
                  'isoCode' => 'LU',
                  'dialCode' => 352,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              70 => [
                'country' => [
                  'name' => 'Morocco',
                  'active' => 'Y',
                  'isoCode' => 'MA',
                  'dialCode' => 212,
                  'currencies' => [
                    0 => [
                      'currency' => 'MAD',
                    ],
                  ],
                ],
              ],
              71 => [
                'country' => [
                  'name' => 'Mexico',
                  'active' => 'Y',
                  'isoCode' => 'MX',
                  'dialCode' => 52,
                  'currencies' => [
                    0 => [
                      'currency' => 'MXN',
                    ],
                  ],
                ],
              ],
              72 => [
                'country' => [
                  'name' => 'Mozambique',
                  'active' => 'Y',
                  'isoCode' => 'MZ',
                  'dialCode' => 258,
                  'currencies' => [
                    0 => [
                      'currency' => 'MZN',
                    ],
                  ],
                ],
              ],
              73 => [
                'country' => [
                  'name' => 'Nicaragua',
                  'active' => 'Y',
                  'isoCode' => 'NI',
                  'dialCode' => 505,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              74 => [
                'country' => [
                  'name' => 'Nepal',
                  'active' => 'Y',
                  'isoCode' => 'NP',
                  'dialCode' => 977,
                  'currencies' => [
                    0 => [
                      'currency' => 'NPR',
                    ],
                  ],
                ],
              ],
              75 => [
                'country' => [
                  'name' => 'Peru',
                  'active' => 'Y',
                  'isoCode' => 'PE',
                  'dialCode' => 51,
                  'currencies' => [
                    0 => [
                      'currency' => 'PEN',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              76 => [
                'country' => [
                  'name' => 'French Polynesia',
                  'active' => 'Y',
                  'isoCode' => 'PF',
                  'dialCode' => 689,
                  'currencies' => [
                    0 => [
                      'currency' => 'XPF',
                    ],
                  ],
                ],
              ],
              77 => [
                'country' => [
                  'name' => 'Qatar',
                  'active' => 'Y',
                  'isoCode' => 'QA',
                  'dialCode' => 974,
                  'currencies' => [
                    0 => [
                      'currency' => 'QAR',
                    ],
                  ],
                ],
              ],
              78 => [
                'country' => [
                  'name' => 'Somalia',
                  'active' => 'Y',
                  'isoCode' => 'SO',
                  'dialCode' => 252,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              79 => [
                'country' => [
                  'name' => 'Chad',
                  'active' => 'Y',
                  'isoCode' => 'TD',
                  'dialCode' => 235,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              80 => [
                'country' => [
                  'name' => 'Togo',
                  'active' => 'Y',
                  'isoCode' => 'TG',
                  'dialCode' => 228,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              81 => [
                'country' => [
                  'name' => 'Vietnam',
                  'active' => 'Y',
                  'isoCode' => 'VN',
                  'dialCode' => 84,
                  'currencies' => [
                    0 => [
                      'currency' => 'VND',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              82 => [
                'country' => [
                  'name' => 'Cyprus',
                  'active' => 'Y',
                  'isoCode' => 'CY',
                  'dialCode' => 357,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              83 => [
                'country' => [
                  'name' => 'Finland',
                  'active' => 'Y',
                  'isoCode' => 'FI',
                  'dialCode' => 358,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              84 => [
                'country' => [
                  'name' => 'Micronesia',
                  'active' => 'Y',
                  'isoCode' => 'FM',
                  'dialCode' => 691,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              85 => [
                'country' => [
                  'name' => 'Greece',
                  'active' => 'Y',
                  'isoCode' => 'GR',
                  'dialCode' => 30,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              86 => [
                'country' => [
                  'name' => 'Guatemala',
                  'active' => 'Y',
                  'isoCode' => 'GT',
                  'dialCode' => 502,
                  'currencies' => [
                    0 => [
                      'currency' => 'GTQ',
                    ],
                  ],
                ],
              ],
              87 => [
                'country' => [
                  'name' => 'Croatia',
                  'active' => 'Y',
                  'isoCode' => 'HR',
                  'dialCode' => 385,
                  'currencies' => [
                    0 => [
                      'currency' => 'HRK',
                    ],
                  ],
                ],
              ],
              88 => [
                'country' => [
                  'name' => 'Jordan',
                  'active' => 'Y',
                  'isoCode' => 'JO',
                  'dialCode' => 962,
                  'currencies' => [
                    0 => [
                      'currency' => 'JOD',
                    ],
                  ],
                ],
              ],
              89 => [
                'country' => [
                  'name' => 'Cambodia',
                  'active' => 'Y',
                  'isoCode' => 'KH',
                  'dialCode' => 855,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              90 => [
                'country' => [
                  'name' => 'Comoros',
                  'active' => 'Y',
                  'isoCode' => 'KM',
                  'dialCode' => 269,
                  'currencies' => [
                    0 => [
                      'currency' => 'KMF',
                    ],
                  ],
                ],
              ],
              91 => [
                'country' => [
                  'name' => 'Korea, Republic of',
                  'active' => 'Y',
                  'isoCode' => 'KR',
                  'dialCode' => 82,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              92 => [
                'country' => [
                  'name' => 'Kuwait',
                  'active' => 'Y',
                  'isoCode' => 'KW',
                  'dialCode' => 965,
                  'currencies' => [
                    0 => [
                      'currency' => 'KWD',
                    ],
                  ],
                ],
              ],
              93 => [
                'country' => [
                  'name' => 'Saint Lucia',
                  'active' => 'Y',
                  'isoCode' => 'LC',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              94 => [
                'country' => [
                  'name' => 'Moldova, Republic of',
                  'active' => 'Y',
                  'isoCode' => 'MD',
                  'dialCode' => 373,
                  'currencies' => [
                    0 => [
                      'currency' => 'MDL',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                    2 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              95 => [
                'country' => [
                  'name' => 'Mauritania',
                  'active' => 'Y',
                  'isoCode' => 'MR',
                  'dialCode' => 222,
                  'currencies' => [
                    0 => [
                      'currency' => 'MRU',
                    ],
                  ],
                ],
              ],
              96 => [
                'country' => [
                  'name' => 'Malaysia',
                  'active' => 'Y',
                  'isoCode' => 'MY',
                  'dialCode' => 60,
                  'currencies' => [
                    0 => [
                      'currency' => 'MYR',
                    ],
                  ],
                ],
              ],
              97 => [
                'country' => [
                  'name' => 'Niger',
                  'active' => 'Y',
                  'isoCode' => 'NE',
                  'dialCode' => 227,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              98 => [
                'country' => [
                  'name' => 'Oman',
                  'active' => 'Y',
                  'isoCode' => 'OM',
                  'dialCode' => 968,
                  'currencies' => [
                    0 => [
                      'currency' => 'OMR',
                    ],
                  ],
                ],
              ],
              99 => [
                'country' => [
                  'name' => 'Tajikistan',
                  'active' => 'Y',
                  'isoCode' => 'TJ',
                  'dialCode' => 992,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              100 => [
                'country' => [
                  'name' => 'Tunisia',
                  'active' => 'Y',
                  'isoCode' => 'TN',
                  'dialCode' => 216,
                  'currencies' => [
                    0 => [
                      'currency' => 'TND',
                    ],
                  ],
                ],
              ],
              101 => [
                'country' => [
                  'name' => 'Tanzania',
                  'active' => 'Y',
                  'isoCode' => 'TZ',
                  'dialCode' => 255,
                  'currencies' => [
                    0 => [
                      'currency' => 'TZS',
                    ],
                  ],
                ],
              ],
              102 => [
                'country' => [
                  'name' => 'Virgin Islands, U.S.',
                  'active' => 'Y',
                  'isoCode' => 'VI',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              103 => [
                'country' => [
                  'name' => 'Curacao',
                  'active' => 'Y',
                  'isoCode' => 'CW',
                  'dialCode' => 599,
                  'currencies' => [
                    0 => [
                      'currency' => 'ANG',
                    ],
                  ],
                ],
              ],
              104 => [
                'country' => [
                  'name' => 'Saint Barthelemy',
                  'active' => 'Y',
                  'isoCode' => 'BL',
                  'dialCode' => 590,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              105 => [
                'country' => [
                  'name' => 'Belize',
                  'active' => 'Y',
                  'isoCode' => 'BZ',
                  'dialCode' => 501,
                  'currencies' => [
                    0 => [
                      'currency' => 'BZD',
                    ],
                  ],
                ],
              ],
              106 => [
                'country' => [
                  'name' => 'Congo (DRC)',
                  'active' => 'Y',
                  'isoCode' => 'CD',
                  'dialCode' => 243,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              107 => [
                'country' => [
                  'name' => 'Congo',
                  'active' => 'Y',
                  'isoCode' => 'CG',
                  'dialCode' => 242,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              108 => [
                'country' => [
                  'name' => 'Cook Islands',
                  'active' => 'Y',
                  'isoCode' => 'CK',
                  'dialCode' => 682,
                  'currencies' => [
                    0 => [
                      'currency' => 'NZD',
                    ],
                  ],
                ],
              ],
              109 => [
                'country' => [
                  'name' => 'Chile',
                  'active' => 'Y',
                  'isoCode' => 'CL',
                  'dialCode' => 56,
                  'currencies' => [
                    0 => [
                      'currency' => 'CLP',
                    ],
                  ],
                ],
              ],
              110 => [
                'country' => [
                  'name' => 'Denmark',
                  'active' => 'Y',
                  'isoCode' => 'DK',
                  'dialCode' => 45,
                  'currencies' => [
                    0 => [
                      'currency' => 'DKK',
                    ],
                  ],
                ],
              ],
              111 => [
                'country' => [
                  'name' => 'Dominica',
                  'active' => 'Y',
                  'isoCode' => 'DM',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              112 => [
                'country' => [
                  'name' => 'Gabon',
                  'active' => 'Y',
                  'isoCode' => 'GA',
                  'dialCode' => 241,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              113 => [
                'country' => [
                  'name' => 'Guadeloupe',
                  'active' => 'Y',
                  'isoCode' => 'GP',
                  'dialCode' => 590,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              114 => [
                'country' => [
                  'name' => 'Guam',
                  'active' => 'Y',
                  'isoCode' => 'GU',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              115 => [
                'country' => [
                  'name' => 'Guyana',
                  'active' => 'Y',
                  'isoCode' => 'GY',
                  'dialCode' => 592,
                  'currencies' => [
                    0 => [
                      'currency' => 'GYD',
                    ],
                  ],
                ],
              ],
              116 => [
                'country' => [
                  'name' => 'Hungary',
                  'active' => 'Y',
                  'isoCode' => 'HU',
                  'dialCode' => 36,
                  'currencies' => [
                    0 => [
                      'currency' => 'HUF',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              117 => [
                'country' => [
                  'name' => 'Ireland',
                  'active' => 'Y',
                  'isoCode' => 'IE',
                  'dialCode' => 353,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              118 => [
                'country' => [
                  'name' => 'Israel',
                  'active' => 'Y',
                  'isoCode' => 'IL',
                  'dialCode' => 972,
                  'currencies' => [
                    0 => [
                      'currency' => 'ILS',
                    ],
                  ],
                ],
              ],
              119 => [
                'country' => [
                  'name' => 'Lebanon',
                  'active' => 'Y',
                  'isoCode' => 'LB',
                  'dialCode' => 961,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              120 => [
                'country' => [
                  'name' => 'Latvia',
                  'active' => 'Y',
                  'isoCode' => 'LV',
                  'dialCode' => 371,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              121 => [
                'country' => [
                  'name' => 'Monaco',
                  'active' => 'Y',
                  'isoCode' => 'MC',
                  'dialCode' => 377,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              122 => [
                'country' => [
                  'name' => 'Montenegro',
                  'active' => 'Y',
                  'isoCode' => 'ME',
                  'dialCode' => 382,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              123 => [
                'country' => [
                  'name' => 'Myanmar',
                  'active' => 'Y',
                  'isoCode' => 'MM',
                  'dialCode' => 95,
                  'currencies' => [
                    0 => [
                      'currency' => 'MMK',
                    ],
                  ],
                ],
              ],
              124 => [
                'country' => [
                  'name' => 'Norway',
                  'active' => 'Y',
                  'isoCode' => 'NO',
                  'dialCode' => 47,
                  'currencies' => [
                    0 => [
                      'currency' => 'NOK',
                    ],
                  ],
                ],
              ],
              125 => [
                'country' => [
                  'name' => 'Nauru',
                  'active' => 'Y',
                  'isoCode' => 'NR',
                  'dialCode' => 674,
                  'currencies' => [
                    0 => [
                      'currency' => 'AUD',
                    ],
                  ],
                ],
              ],
              126 => [
                'country' => [
                  'name' => 'Papua New Guinea',
                  'active' => 'Y',
                  'isoCode' => 'PG',
                  'dialCode' => 675,
                  'currencies' => [
                    0 => [
                      'currency' => 'PGK',
                    ],
                  ],
                ],
              ],
              127 => [
                'country' => [
                  'name' => 'Portugal',
                  'active' => 'Y',
                  'isoCode' => 'PT',
                  'dialCode' => 351,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              128 => [
                'country' => [
                  'name' => 'Sweden',
                  'active' => 'Y',
                  'isoCode' => 'SE',
                  'dialCode' => 46,
                  'currencies' => [
                    0 => [
                      'currency' => 'SEK',
                    ],
                  ],
                ],
              ],
              129 => [
                'country' => [
                  'name' => 'Trinidad and Tobago',
                  'active' => 'Y',
                  'isoCode' => 'TT',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'TTD',
                    ],
                  ],
                ],
              ],
              130 => [
                'country' => [
                  'name' => 'Virgin Islands, British',
                  'active' => 'Y',
                  'isoCode' => 'VG',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              131 => [
                'country' => [
                  'name' => 'South Africa',
                  'active' => 'Y',
                  'isoCode' => 'ZA',
                  'dialCode' => 27,
                  'currencies' => [
                    0 => [
                      'currency' => 'ZAR',
                    ],
                  ],
                ],
              ],
              132 => [
                'country' => [
                  'name' => 'Zambia',
                  'active' => 'Y',
                  'isoCode' => 'ZM',
                  'dialCode' => 260,
                  'currencies' => [
                    0 => [
                      'currency' => 'ZMW',
                    ],
                  ],
                ],
              ],
              133 => [
                'country' => [
                  'name' => 'Zimbabwe',
                  'active' => 'Y',
                  'isoCode' => 'ZW',
                  'dialCode' => 263,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              134 => [
                'country' => [
                  'name' => 'Austria',
                  'active' => 'Y',
                  'isoCode' => 'AT',
                  'dialCode' => 43,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              135 => [
                'country' => [
                  'name' => 'Bosnia and Herzegovina',
                  'active' => 'Y',
                  'isoCode' => 'BA',
                  'dialCode' => 387,
                  'currencies' => [
                    0 => [
                      'currency' => 'BAM',
                    ],
                  ],
                ],
              ],
              136 => [
                'country' => [
                  'name' => 'Bulgaria',
                  'active' => 'Y',
                  'isoCode' => 'BG',
                  'dialCode' => 359,
                  'currencies' => [
                    0 => [
                      'currency' => 'BGN',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              137 => [
                'country' => [
                  'name' => 'Benin',
                  'active' => 'Y',
                  'isoCode' => 'BJ',
                  'dialCode' => 229,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              138 => [
                'country' => [
                  'name' => 'Cameroon',
                  'active' => 'Y',
                  'isoCode' => 'CM',
                  'dialCode' => 237,
                  'currencies' => [
                    0 => [
                      'currency' => 'XAF',
                    ],
                  ],
                ],
              ],
              139 => [
                'country' => [
                  'name' => 'China',
                  'active' => 'Y',
                  'isoCode' => 'CN',
                  'dialCode' => 86,
                  'currencies' => [
                    0 => [
                      'currency' => 'CNY',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              140 => [
                'country' => [
                  'name' => 'Colombia',
                  'active' => 'Y',
                  'isoCode' => 'CO',
                  'dialCode' => 57,
                  'currencies' => [
                    0 => [
                      'currency' => 'COP',
                    ],
                  ],
                ],
              ],
              141 => [
                'country' => [
                  'name' => 'Cape Verde',
                  'active' => 'Y',
                  'isoCode' => 'CV',
                  'dialCode' => 238,
                  'currencies' => [
                    0 => [
                      'currency' => 'CVE',
                    ],
                  ],
                ],
              ],
              142 => [
                'country' => [
                  'name' => 'Germany',
                  'active' => 'Y',
                  'isoCode' => 'DE',
                  'dialCode' => 49,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              143 => [
                'country' => [
                  'name' => 'United Kingdom',
                  'active' => 'Y',
                  'isoCode' => 'GB',
                  'dialCode' => 44,
                  'currencies' => [
                    0 => [
                      'currency' => 'GBP',
                    ],
                  ],
                ],
              ],
              144 => [
                'country' => [
                  'name' => 'Gambia',
                  'active' => 'Y',
                  'isoCode' => 'GM',
                  'dialCode' => 220,
                  'currencies' => [
                    0 => [
                      'currency' => 'GMD',
                    ],
                  ],
                ],
              ],
              145 => [
                'country' => [
                  'name' => 'Hong Kong',
                  'active' => 'Y',
                  'isoCode' => 'HK',
                  'dialCode' => 852,
                  'currencies' => [
                    0 => [
                      'currency' => 'HKD',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              146 => [
                'country' => [
                  'name' => 'Liechtenstein',
                  'active' => 'Y',
                  'isoCode' => 'LI',
                  'dialCode' => 423,
                  'currencies' => [
                    0 => [
                      'currency' => 'CHF',
                    ],
                  ],
                ],
              ],
              147 => [
                'country' => [
                  'name' => 'Macedonia',
                  'active' => 'Y',
                  'isoCode' => 'MK',
                  'dialCode' => 389,
                  'currencies' => [
                    0 => [
                      'currency' => 'MKD',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              148 => [
                'country' => [
                  'name' => 'Malta',
                  'active' => 'Y',
                  'isoCode' => 'MT',
                  'dialCode' => 356,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              149 => [
                'country' => [
                  'name' => 'Palau',
                  'active' => 'Y',
                  'isoCode' => 'PW',
                  'dialCode' => 680,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              150 => [
                'country' => [
                  'name' => 'Romania',
                  'active' => 'Y',
                  'isoCode' => 'RO',
                  'dialCode' => 40,
                  'currencies' => [
                    0 => [
                      'currency' => 'RON',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              151 => [
                'country' => [
                  'name' => 'Russian Federation',
                  'active' => 'Y',
                  'isoCode' => 'RU',
                  'dialCode' => 7,
                  'currencies' => [
                    0 => [
                      'currency' => 'RUB',
                    ],
                  ],
                ],
              ],
              152 => [
                'country' => [
                  'name' => 'Seychelles',
                  'active' => 'Y',
                  'isoCode' => 'SC',
                  'dialCode' => 248,
                  'currencies' => [
                    0 => [
                      'currency' => 'SCR',
                    ],
                  ],
                ],
              ],
              153 => [
                'country' => [
                  'name' => 'El Salvador',
                  'active' => 'Y',
                  'isoCode' => 'SV',
                  'dialCode' => 503,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              154 => [
                'country' => [
                  'name' => 'Uganda',
                  'active' => 'Y',
                  'isoCode' => 'UG',
                  'dialCode' => 256,
                  'currencies' => [
                    0 => [
                      'currency' => 'UGX',
                    ],
                  ],
                ],
              ],
              155 => [
                'country' => [
                  'name' => 'Uruguay',
                  'active' => 'Y',
                  'isoCode' => 'UY',
                  'dialCode' => 598,
                  'currencies' => [
                    0 => [
                      'currency' => 'UYU',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              156 => [
                'country' => [
                  'name' => 'Uzbekistan',
                  'active' => 'Y',
                  'isoCode' => 'UZ',
                  'dialCode' => 998,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              157 => [
                'country' => [
                  'name' => 'Vanuatu',
                  'active' => 'Y',
                  'isoCode' => 'VU',
                  'dialCode' => 678,
                  'currencies' => [
                    0 => [
                      'currency' => 'VUV',
                    ],
                  ],
                ],
              ],
              158 => [
                'country' => [
                  'name' => 'Serbia',
                  'active' => 'Y',
                  'isoCode' => 'YU',
                  'dialCode' => 381,
                  'currencies' => [
                    0 => [
                      'currency' => 'RSD',
                    ],
                    1 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              159 => [
                'country' => [
                  'name' => 'Australia',
                  'active' => 'Y',
                  'isoCode' => 'AU',
                  'dialCode' => 61,
                  'currencies' => [
                    0 => [
                      'currency' => 'AUD',
                    ],
                  ],
                ],
              ],
              160 => [
                'country' => [
                  'name' => 'Bangladesh',
                  'active' => 'Y',
                  'isoCode' => 'BD',
                  'dialCode' => 880,
                  'currencies' => [
                    0 => [
                      'currency' => 'BDT',
                    ],
                  ],
                ],
              ],
              161 => [
                'country' => [
                  'name' => 'Burundi',
                  'active' => 'Y',
                  'isoCode' => 'BI',
                  'dialCode' => 257,
                  'currencies' => [
                    0 => [
                      'currency' => 'BIF',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              162 => [
                'country' => [
                  'name' => 'Brunei',
                  'active' => 'Y',
                  'isoCode' => 'BN',
                  'dialCode' => 673,
                  'currencies' => [
                    0 => [
                      'currency' => 'BND',
                    ],
                  ],
                ],
              ],
              163 => [
                'country' => [
                  'name' => 'Brazil',
                  'active' => 'Y',
                  'isoCode' => 'BR',
                  'dialCode' => 55,
                  'currencies' => [
                    0 => [
                      'currency' => 'BRL',
                    ],
                  ],
                ],
              ],
              164 => [
                'country' => [
                  'name' => 'Botswana',
                  'active' => 'Y',
                  'isoCode' => 'BW',
                  'dialCode' => 267,
                  'currencies' => [
                    0 => [
                      'currency' => 'BWP',
                    ],
                  ],
                ],
              ],
              165 => [
                'country' => [
                  'name' => 'Ivory Coast',
                  'active' => 'Y',
                  'isoCode' => 'CI',
                  'dialCode' => 225,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              166 => [
                'country' => [
                  'name' => 'Cuba',
                  'active' => 'Y',
                  'isoCode' => 'CU',
                  'dialCode' => 53,
                  'currencies' => [
                    0 => [
                      'currency' => 'CUP',
                    ],
                  ],
                ],
              ],
              167 => [
                'country' => [
                  'name' => 'Dominican Republic',
                  'active' => 'Y',
                  'isoCode' => 'DO',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'DOP',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              168 => [
                'country' => [
                  'name' => 'Honduras',
                  'active' => 'Y',
                  'isoCode' => 'HN',
                  'dialCode' => 504,
                  'currencies' => [
                    0 => [
                      'currency' => 'HNL',
                    ],
                  ],
                ],
              ],
              169 => [
                'country' => [
                  'name' => 'Indonesia',
                  'active' => 'Y',
                  'isoCode' => 'ID',
                  'dialCode' => 62,
                  'currencies' => [
                    0 => [
                      'currency' => 'IDR',
                    ],
                  ],
                ],
              ],
              170 => [
                'country' => [
                  'name' => 'India',
                  'active' => 'Y',
                  'isoCode' => 'IN',
                  'dialCode' => 91,
                  'currencies' => [
                    0 => [
                      'currency' => 'INR',
                    ],
                  ],
                ],
              ],
              171 => [
                'country' => [
                  'name' => 'Japan',
                  'active' => 'Y',
                  'isoCode' => 'JP',
                  'dialCode' => 81,
                  'currencies' => [
                    0 => [
                      'currency' => 'JPY',
                    ],
                  ],
                ],
              ],
              172 => [
                'country' => [
                  'name' => 'Laos',
                  'active' => 'Y',
                  'isoCode' => 'LA',
                  'dialCode' => 856,
                  'currencies' => [
                    0 => [
                      'currency' => 'LAK',
                    ],
                  ],
                ],
              ],
              173 => [
                'country' => [
                  'name' => 'Macao',
                  'active' => 'Y',
                  'isoCode' => 'MO',
                  'dialCode' => 853,
                  'currencies' => [
                    0 => [
                      'currency' => 'MOP',
                    ],
                  ],
                ],
              ],
              174 => [
                'country' => [
                  'name' => 'Martinique',
                  'active' => 'Y',
                  'isoCode' => 'MQ',
                  'dialCode' => 596,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              175 => [
                'country' => [
                  'name' => 'Montserrat',
                  'active' => 'Y',
                  'isoCode' => 'MS',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              176 => [
                'country' => [
                  'name' => 'Poland',
                  'active' => 'Y',
                  'isoCode' => 'PL',
                  'dialCode' => 48,
                  'currencies' => [
                    0 => [
                      'currency' => 'PLN',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              177 => [
                'country' => [
                  'name' => 'New Caledonia',
                  'active' => 'Y',
                  'isoCode' => 'NC',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XPF',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              178 => [
                'country' => [
                  'name' => 'Paraguay',
                  'active' => 'Y',
                  'isoCode' => 'PY',
                  'dialCode' => 595,
                  'currencies' => [
                    0 => [
                      'currency' => 'PYG',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              179 => [
                'country' => [
                  'name' => 'St. Maarten',
                  'active' => 'Y',
                  'isoCode' => 'S1',
                  'dialCode' => -720,
                  'currencies' => [
                    0 => [
                      'currency' => 'ANG',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              180 => [
                'country' => [
                  'name' => 'St. Martin',
                  'active' => 'Y',
                  'isoCode' => 'MF',
                  'dialCode' => -720,
                  'currencies' => [
                    0 => [
                      'currency' => 'ANG',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              181 => [
                'country' => [
                  'name' => 'Saudi Arabia',
                  'active' => 'Y',
                  'isoCode' => 'SA',
                  'dialCode' => 966,
                  'currencies' => [
                    0 => [
                      'currency' => 'SAR',
                    ],
                  ],
                ],
              ],
              182 => [
                'country' => [
                  'name' => 'Sierra Leone',
                  'active' => 'Y',
                  'isoCode' => 'SL',
                  'dialCode' => 232,
                  'currencies' => [
                    0 => [
                      'currency' => 'SLL',
                    ],
                  ],
                ],
              ],
              183 => [
                'country' => [
                  'name' => 'Thailand',
                  'active' => 'Y',
                  'isoCode' => 'TH',
                  'dialCode' => 66,
                  'currencies' => [
                    0 => [
                      'currency' => 'THB',
                    ],
                  ],
                ],
              ],
              184 => [
                'country' => [
                  'name' => 'Turkmenistan',
                  'active' => 'Y',
                  'isoCode' => 'TM',
                  'dialCode' => 993,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              185 => [
                'country' => [
                  'name' => 'Tonga',
                  'active' => 'Y',
                  'isoCode' => 'TO',
                  'dialCode' => 676,
                  'currencies' => [
                    0 => [
                      'currency' => 'TOP',
                    ],
                  ],
                ],
              ],
              186 => [
                'country' => [
                  'name' => 'Ukraine',
                  'active' => 'Y',
                  'isoCode' => 'UA',
                  'dialCode' => 380,
                  'currencies' => [
                    0 => [
                      'currency' => 'UAH',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              187 => [
                'country' => [
                  'name' => 'Saint Vincent and the Grenadines',
                  'active' => 'Y',
                  'isoCode' => 'VC',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              188 => [
                'country' => [
                  'name' => 'Northern Mariana Islands',
                  'active' => 'Y',
                  'isoCode' => 'XQ',
                  'dialCode' => NULL,
                  'currencies' => [
                    0 => [
                      'currency' => 'GBP',
                    ],
                  ],
                ],
              ],
              189 => [
                'country' => [
                  'name' => 'Antigua and Barbuda',
                  'active' => 'Y',
                  'isoCode' => 'AG',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                  ],
                ],
              ],
              190 => [
                'country' => [
                  'name' => 'Anguilla',
                  'active' => 'Y',
                  'isoCode' => 'AI',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'XCD',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              191 => [
                'country' => [
                  'name' => 'Andorra',
                  'active' => 'Y',
                  'isoCode' => 'AD',
                  'dialCode' => 376,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              192 => [
                'country' => [
                  'name' => 'Angola',
                  'active' => 'Y',
                  'isoCode' => 'AO',
                  'dialCode' => 244,
                  'currencies' => [
                    0 => [
                      'currency' => 'AOA',
                    ],
                  ],
                ],
              ],
              193 => [
                'country' => [
                  'name' => 'Azerbaijan',
                  'active' => 'Y',
                  'isoCode' => 'AZ',
                  'dialCode' => 994,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              194 => [
                'country' => [
                  'name' => 'Costa Rica',
                  'active' => 'Y',
                  'isoCode' => 'CR',
                  'dialCode' => 506,
                  'currencies' => [
                    0 => [
                      'currency' => 'CRC',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              195 => [
                'country' => [
                  'name' => 'Djibouti',
                  'active' => 'Y',
                  'isoCode' => 'DJ',
                  'dialCode' => 253,
                  'currencies' => [
                    0 => [
                      'currency' => 'DJF',
                    ],
                  ],
                ],
              ],
              196 => [
                'country' => [
                  'name' => 'Ecuador',
                  'active' => 'Y',
                  'isoCode' => 'EC',
                  'dialCode' => 593,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              197 => [
                'country' => [
                  'name' => 'Ethiopia',
                  'active' => 'Y',
                  'isoCode' => 'ET',
                  'dialCode' => 251,
                  'currencies' => [
                    0 => [
                      'currency' => 'ETB',
                    ],
                  ],
                ],
              ],
              198 => [
                'country' => [
                  'name' => 'Ghana',
                  'active' => 'Y',
                  'isoCode' => 'GH',
                  'dialCode' => 233,
                  'currencies' => [
                    0 => [
                      'currency' => 'GHS',
                    ],
                  ],
                ],
              ],
              199 => [
                'country' => [
                  'name' => 'Guinea-Bissau',
                  'active' => 'Y',
                  'isoCode' => 'GW',
                  'dialCode' => 245,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              200 => [
                'country' => [
                  'name' => 'Kazakhstan',
                  'active' => 'Y',
                  'isoCode' => 'KZ',
                  'dialCode' => 7,
                  'currencies' => [
                    0 => [
                      'currency' => 'KZT',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              201 => [
                'country' => [
                  'name' => 'Sri Lanka',
                  'active' => 'Y',
                  'isoCode' => 'LK',
                  'dialCode' => 94,
                  'currencies' => [
                    0 => [
                      'currency' => 'LKR',
                    ],
                  ],
                ],
              ],
              202 => [
                'country' => [
                  'name' => 'Mali',
                  'active' => 'Y',
                  'isoCode' => 'ML',
                  'dialCode' => 223,
                  'currencies' => [
                    0 => [
                      'currency' => 'XOF',
                    ],
                  ],
                ],
              ],
              203 => [
                'country' => [
                  'name' => 'Northern Mariana Islands',
                  'active' => 'Y',
                  'isoCode' => 'MP',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              204 => [
                'country' => [
                  'name' => 'Mauritius',
                  'active' => 'Y',
                  'isoCode' => 'MU',
                  'dialCode' => 230,
                  'currencies' => [
                    0 => [
                      'currency' => 'MUR',
                    ],
                  ],
                ],
              ],
              205 => [
                'country' => [
                  'name' => 'Netherlands',
                  'active' => 'Y',
                  'isoCode' => 'NL',
                  'dialCode' => 31,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              206 => [
                'country' => [
                  'name' => 'Panama',
                  'active' => 'Y',
                  'isoCode' => 'PA',
                  'dialCode' => 507,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              207 => [
                'country' => [
                  'name' => 'Rwanda',
                  'active' => 'Y',
                  'isoCode' => 'RW',
                  'dialCode' => 250,
                  'currencies' => [
                    0 => [
                      'currency' => 'RWF',
                    ],
                    1 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              208 => [
                'country' => [
                  'name' => 'Slovakia',
                  'active' => 'Y',
                  'isoCode' => 'SK',
                  'dialCode' => 421,
                  'currencies' => [
                    0 => [
                      'currency' => 'EUR',
                    ],
                  ],
                ],
              ],
              209 => [
                'country' => [
                  'name' => 'Sao Tome and Principe',
                  'active' => 'Y',
                  'isoCode' => 'ST',
                  'dialCode' => 239,
                  'currencies' => [
                    0 => [
                      'currency' => 'STD',
                    ],
                  ],
                ],
              ],
              210 => [
                'country' => [
                  'name' => 'East Timor',
                  'active' => 'Y',
                  'isoCode' => 'TP',
                  'dialCode' => 670,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              211 => [
                'country' => [
                  'name' => 'Tuvalu',
                  'active' => 'Y',
                  'isoCode' => 'TV',
                  'dialCode' => 688,
                  'currencies' => [
                    0 => [
                      'currency' => 'AUD',
                    ],
                  ],
                ],
              ],
              212 => [
                'country' => [
                  'name' => 'Venezuela',
                  'active' => 'Y',
                  'isoCode' => 'VE',
                  'dialCode' => 58,
                  'currencies' => [
                    0 => [
                      'currency' => 'VEF',
                    ],
                  ],
                ],
              ],
              213 => [
                'country' => [
                  'name' => 'Samoa',
                  'active' => 'Y',
                  'isoCode' => 'WS',
                  'dialCode' => 685,
                  'currencies' => [
                    0 => [
                      'currency' => 'WST',
                    ],
                  ],
                ],
              ],
              214 => [
                'country' => [
                  'name' => 'Lesotho',
                  'active' => 'Y',
                  'isoCode' => 'LS',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'LSL',
                    ],
                  ],
                ],
              ],
              215 => [
                'country' => [
                  'name' => 'Namibia',
                  'active' => 'Y',
                  'isoCode' => 'NA',
                  'dialCode' => 1,
                  'currencies' => [
                    0 => [
                      'currency' => 'NAD',
                    ],
                  ],
                ],
              ],
              216 => [
                'country' => [
                  'name' => 'Yemen',
                  'active' => 'Y',
                  'isoCode' => 'YE',
                  'dialCode' => 967,
                  'currencies' => [
                    0 => [
                      'currency' => 'USD',
                    ],
                  ],
                ],
              ],
              217 => [
                'country' => [
                  'name' => 'Syria',
                  'active' => 'Y',
                  'isoCode' => 'SY',
                  'dialCode' => 963,
                  'currencies' => [
                    0 => [
                      'currency' => 'SYP',
                    ],
                  ],
                ],
              ],
            ],
        ];

        return $data;
    }


}



?>