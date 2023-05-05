<?php
/*
This PHP class is free software: you can redistribute it and/or modify
the code under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

However, the license header, copyright and author credits 
must not be modified in any form and always be displayed.

This class is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

@author geoPlugin (gp_support@geoplugin.com)
@copyright Copyright geoPlugin (gp_support@geoplugin.com)
$version 1.2


This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses

Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned.

See http://www.geoplugin.com/webservices/php for more specific details of this free service

*/

trait GeoPlugins {
	
	//the geoPlugin server
	var $geo_host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}&lang={LANG}';
    var $geo_hostCur = 'http://www.geoplugin.net/currency/php.gp?from={fsym}&to={tsym}&amount={amt}';
    var $geo_rd = 'from=USD&to=EUR&amount=100.50';
	//the default base currency
	var $geo_currency = 'USD';
	
	//the default language
	var $geo_lang = 'en';
/*
supported languages:
de
en
es
fr
ja
pt-BR
ru
zh-CN
*/

	//initiate the geoPlugin vars
	public $geo_ip = null;
	public $geo_city = null;
	public $geo_region = null;
	public $geo_regionCode = null;
	public $geo_regionName = null;
	public $geo_dmaCode = null;
	public $geo_countryCode = null;
	public $geo_countryName = null;
	public $geo_inEU = null;
	public $geo_euVATrate = false;
	public $geo_continentCode = null;
	public $geo_continentName = null;
	public $geo_latitude = null;
	public $geo_longitude = null;
	public $geo_locationAccuracyRadius = null;
	public $geo_timezone = null;
	public $geo_currencyCode = null;
	public $geo_currencySymbol = null;
	public $geo_currencyConverter = null;
    
    public $geo_fromCode = null;
    public $geo_fromName = null;
    public $geo_fromAmount = null;
    public $geo_fromSym = null;
    public $geo_toCode = null;
    public $geo_toName = null;
    public $geo_toAmount = null;
    public $geo_toSym = null;
    public $geo_curUpdated =null;
    
	
	function __construct() {
    //$this->geoLocate();
	}
	
	public function geoLocate($ip = null) {
		
      global $_SERVER;
		
		if ( is_null( $ip ) ) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$geo_host = str_replace( '{IP}', $ip, $this->geo_host );
		$geo_host = str_replace( '{CURRENCY}', $this->geo_currency, $geo_host );
		$geo_host = str_replace( '{LANG}', $this->geo_lang, $geo_host );
		
		$data = array();
		
		$response = $this->geoFetch($geo_host);
		
		$data = unserialize($response);
		
		//set the geoPlugin vars
		$this->geo_ip = $ip;

        //if(!empty($data)){

        
		$this->geo_city = $data['geoplugin_city'];
		$this->geo_region = $data['geoplugin_region'];
		$this->geo_regionCode = $data['geoplugin_regionCode'];
		$this->geo_regionName = $data['geoplugin_regionName'];
		$this->geo_dmaCode = $data['geoplugin_dmaCode'];
		$this->geo_countryCode = $data['geoplugin_countryCode'];
		$this->geo_countryName = $data['geoplugin_countryName'];
		$this->geo_inEU = $data['geoplugin_inEU'];
		$this->geo_euVATrate = $data['geoplugin_euVATrate'];
		$this->geo_continentCode = $data['geoplugin_continentCode'];
		$this->geo_continentName = $data['geoplugin_continentName'];
		$this->geo_latitude = $data['geoplugin_latitude'];
		$this->geo_longitude = $data['geoplugin_longitude'];
		$this->lgeo_ocationAccuracyRadius = $data['geoplugin_locationAccuracyRadius'];
		$this->geo_timezone = $data['geoplugin_timezone'];
		$this->geo_currencyCode = $data['geoplugin_currencyCode'];
		$this->geo_currencySymbol = $data['geoplugin_currencySymbol'];
		$this->geo_currencyConverter = $data['geoplugin_currencyConverter'];

       // }
		
	}
	
	public function geoFetch($host) {

		if ( function_exists('curl_init') ) {
						
			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
			$response = curl_exec($ch);
			curl_close ($ch);
			
		} else if ( ini_get('allow_url_fopen') ) {
			
			//fall back to fopen()
			$response = file_get_contents($host, 'r');
			
		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		
		}
		
		return $response;
	}
	
	public function geoConvert($amount, $float=2, $symbol=true) {
		
		//easily convert amounts to geolocated currency.
		if ( !is_numeric($this->geo_currencyConverter) || $this->geo_currencyConverter == 0 ) {
			trigger_error('geoPlugin class Notice: currencyConverter has no value.', E_USER_NOTICE);
			return $amount;
		}
		if ( !is_numeric($amount) ) {
			trigger_error ('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.', E_USER_WARNING);
			return $amount;
		}
		if ( $symbol === true ) {
			return $this->geo_currencySymbol . round( ($amount * $this->geo_currencyConverter), $float );
		} else {
			return round( ($amount * $this->geo_currencyConverter), $float );
		}
	}
	
	public function geoNearby($radius=10, $limit=null) {

		if ( !is_numeric($this->geo_latitude) || !is_numeric($this->geo_longitude) ) {
			trigger_error ('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
			return array( array() );
		}
		
		$host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->geo_latitude . "&long=" . $this->geo_longitude . "&radius={$radius}";
		
		if ( is_numeric($limit) )
			$host .= "&limit={$limit}";
			
		return unserialize( $this->geoFetch($host) );

	}
    
    public function geoCurrency($ip = null) {
		
		global $_SERVER;
		
		if ( is_null( $ip ) ) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$pi =null || [];
		$host = str_replace( '{IP}', $pi, $this->geo_host );
		$host = str_replace( '{CURRENCY}', $ip, $host );
		$host = str_replace( '{LANG}', $this->geo_lang, $host );
		
		$data = array();
		
		$response = $this->geoFetch($host);
		
		$data = unserialize($response);
		
		//set the geoPlugin vars
		//$this->ip = $ip;
		$this->geo_city = $data['geoplugin_city'];
		$this->geo_region = $data['geoplugin_region'];
		$this->geo_regionCode = $data['geoplugin_regionCode'];
		$this->geo_regionName = $data['geoplugin_regionName'];
		$this->geo_dmaCode = $data['geoplugin_dmaCode'];
		$this->geo_countryCode = $data['geoplugin_countryCode'];
		$this->geo_countryName = $data['geoplugin_countryName'];
		$this->geo_inEU = $data['geoplugin_inEU'];
		$this->geo_euVATrate = $data['geoplugin_euVATrate'];
		$this->geo_continentCode = $data['geoplugin_continentCode'];
		$this->geo_continentName = $data['geoplugin_continentName'];
		$this->geo_latitude = $data['geoplugin_latitude'];
		$this->geo_longitude = $data['geoplugin_longitude'];
		$this->geo_locationAccuracyRadius = $data['geoplugin_locationAccuracyRadius'];
		$this->geo_timezone = $data['geoplugin_timezone'];
		$this->geo_currencyCode = $data['geoplugin_currencyCode'];
		$this->geo_currencySymbol = $data['geoplugin_currencySymbol'];
		$this->geo_currencyConverter = $data['geoplugin_currencyConverter'];
		
	}
    
    public function geoCurrency2($fsym,$tsym,$amt) {
		
		
		$hostCur = str_replace( '{fsym}', $fsym, $this->hostCur );
		$hostCur = str_replace( '{tsym}', $tsym, $hostCur );
		$hostCur = str_replace( '{amt}', $amt, $hostCur);
		
		$data = array();
		
		$response = $this->geoFetch($hostCur);
		
		$data = unserialize($response);
		
		//set the geoPlugin vars
		//$this->ip = $ip;
		$this->geo_fromAmount = $data['from_amount'];
		$this->geo_fromName = $data['from_name'];
		$this->geo_fromCode = $data['from_code'];
		$this->geo_fromSym = $data['from_symbol'];
		$this->geo_toAmount = $data['to_amount'];
		$this->geo_toName = $data['to_name'];
		$this->geo_toCode = $data['to_code'];
		$this->geo_toSym = $data['to_symbol'];
        $this->geo_curUpdated = $data['currency_updated'];
		
		
	}

	
}

//$geo = new GeoPlugin();
//$geo->geoLocate();

?>
