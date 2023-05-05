<?php
class StaticWalletApi{

    protected $amount;
    protected $apiKey = 'c171eaf4c8b5edf0382212e3a9f7406b2507cad668cf6f7476e870ffaa049280';
    protected $access_key = 'public_Wi8s4N_4-ZvxPyvb2E98HmBcdUED6SPgTQPQ_4wdP9Y';
    protected $endpoint = 'price';

    protected $model;
    protected $obj;

    protected $table;

    public function __construct($model){
        $this->model = $model;
        $this->table = $model->tb_BoxStaticWallet;

    }







    private function getApiKey(){
        $this->model->getdata($this->model->tb_BoxStaticApi,'api_key','id',1,'use_now','yes');
    }

    private function getWallet($coin){
        return $this->model->getdata($this->model->tb_BoxStaticWallet,'wallet','type',$coin,'status','on');
    }
    private function staticConvert( $m_amount, $fsym, $tsym ) {
        $out = array();
        
        $from = $fsym;
        $to = $tsym;
        $amount = $m_amount;

        $ch = curl_init( 'https://min-api.cryptocompare.com/data/' . $this->endpoint . '?fsym=' . $from . '&tsyms=' . $to . '&amount=' . $amount . '&api_key=' . $this->apiKey . '' );


        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        // get the JSON data:
        $json = curl_exec( $ch );
        curl_close( $ch );

        // Decode JSON response:
        $conversionResult = json_decode( $json, true );

        // access the conversion result
        //echo $conversionResult[$from];

        $c_amount = $conversionResult[ $to ] * $amount;

        if ( $c_amount > 0 ) {


            //$out['block_address'] = $w_address;
            //$out['block_amount'] = $btcAmount;
            $out[ 'status' ] = 100;
            $out[ 'amount' ] = $c_amount;
            $out['address'] = $this->getWallet($tsym);
            


            return $out;


        } else {
            $out[ 'status' ] = 0;
            $out[ 'amount' ] = 0;
            $out['address'] =null;
            
            return $out;
        }

    }

    public function  apiStaticConvert($m_amount, $fsym, $tsym){
        return $this->staticConvert($m_amount, $fsym, $tsym);
    }
}

?>