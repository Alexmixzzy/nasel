<?php 
@require_once 'core/widgets/secure/UserWidgets.php';
@require_once 'core/components/global/GlobalComponents.php';
class UserComponents {

    protected  $model;

    protected  $obj;

    protected $widget;

    protected $gloCompo;

    private $user;

    private $currency;
    private $sym;

    public function __construct($model,$obj){

        $this->model = $model;
        $this->obj = $obj;
        $this->widget = new UserWidgets();
        $this->gloCompo = new GlobalComponents($model,$obj);
        $this->user = $this->model->authUser;
        $this->currency = $this->model->site->currency;
        $this->sym = $this->obj->xeSym($this->currency);


    }



    private function getPlanData($field,$id){
        return $this->model->getData($this->obj->tb_Plans,$field,'main_id',$id);
    }

    private function investDayPercent($day_counted,$counter,$planType){
        //$planDay = $this->model->getData($this->obj->tb_Plans,$field,'main_id',$id);

        $match = match($counter){
                'hour'=>$this->getPlanData('end_hour',$planType),
                'day'=>$this->getPlanData('end_day',$planType),
                'week'=>$this->getPlanData('end_week',$planType),
                'month'=>$this->getPlanData('end_month',$planType),
                'year'=>$this->getPlanData('end_year',$planType),
        };

        $calc = $this->obj->getPercent($day_counted,$match);
        return $calc;
    }

    private function getUserPayWallet($user){
        $json = array(

            "alexis"=>array('address'=>'ua8933330030','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20'),
            "pascal"=>array('address'=>'dddp930393003','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20'),



        );
        $newArray = $json['peter']=array('address'=>'ua8933330ppppp','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20');
        $newArray = $json['james']=array('address'=>'ua8933330ppppjames','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20');
        $newArray = $json['clems']=array('address'=>'ua8933330pppclems','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20');
        array_push($json,$newArray);

        $data = json_encode($json);
        $jssonGet = json_decode($data,true);
        if(array_key_exists($user,$jssonGet)){
            $arr = $jssonGet[$user];
            return $arr;
        }else{
            return array('status'=>0,'address'=>'none');
        }
        
    
    }

    private function getUserPayWallet2($user){
        $json = array(

            "alexis"=>array('address'=>'ua8933330030','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20'),
            "pascal"=>array('address'=>'dddp930393003','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20'),



        );
        $newArray =$json['peter']= array('address'=>'ua8933330030','coin_type'=>'BTC','name'=>'Blockchain Wallet','network'=>'ERC20');
        array_push($json,$newArray);

        $data = json_encode($json);
        $jssonGet = json_decode($data,true);
        return $jssonGet;
        
    
    }

    public  function withdrawMethods(){
        $data = $this->gloCompo->globalWithdrawMethods();
        $req  = array();

        foreach ($data as $key => $val) {
            # code...
            
            array_push($req,'<option value="'.$key.'"> '.$val['name'].'</value>');
        
        }

        return  $req;
    
    }


    public function userCrumbDashboard():void{
        
        echo '<!-- Page header start -->
        <div class="page-header">
                                
            <!-- Breadcrumb start -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Welcome, '.$this->model->auth->authName.' 
                </li>
            </ol>
            <!-- Breadcrumb end -->
        
            <!-- App actions start -->
            <div class="app-actions">
                <button type="button" class="btn">Today</button>
                <button type="button" class="btn">Yesterday</button>
                <button type="button" class="btn">7 days</button>
                <button type="button" class="btn">15 days</button>
                <button type="button" class="btn active">30 days</button>
            </div>
            <!-- App actions end -->
        
        </div>
        <!-- Page header end -->';

    }

    public function userCrumb($pageName=null):void{
        $name = $pageName  ??  'Welcome, '.$this->model->auth->authName.'';
        
        echo '<!-- Page header start -->
        <div class="page-header">
                                
            <!-- Breadcrumb start -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">'.$name.' 
                </li>
            </ol>
            <!-- Breadcrumb end -->
        
            <!-- App actions start -->
        
            <!-- App actions end -->
        
        </div>
        <!-- Page header end -->';

    }

    public function userProfileCard() :void{
        $pfimage = $this->model->auth->authImage;
        if(!empty($pfimage)){
        $image = $pfimage;
        }else{
            $image = 'avater.png';
        }

        echo '
        <div class="card h-100">
            <div class="card-body">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img src="../static/public/images/profile/'.$image.'" alt="'.$this->model->authUser.' Image">
                        </div>
                        <h5 class="user-name">'.$this->model->auth->authName.'</h5>
                        <h6 class="user-email">'.$this->model->authEmail.'</h6>
                    </div>
                    <div class="about">
                        <h5 class="mb-2 text-primary">About</h5>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    
    ';
    }

    public function userBalanceCard(){
        
    }

    public function userPlanOptions (): void{
            $this->gloCompo->globalPlanOptions();
    }

    public function userPlanOptions2 (){
        return $this->gloCompo->globalPlanOptions2();
        
    
        
}

    public function  userMinDepositInput()  :void{

        echo $this->gloCompo->globalMinDeposit();
    }

    public function userPayMethods() :void{

        $this->gloCompo->globalPaymentMethods();
    }

    public function userAcceptedCoins(){
            $this->gloCompo->globalAcceptedCoins();
    }

    public function userCryptoQr(): void{
        $address =null;
        $amount =0;
        if(!empty($_SESSION['d_address'])){
            $address = $_SESSION['d_address'];
            
        }

        if(!empty($_SESSION['d_amount'])){
            $amount = $_SESSION['d_amount'];
        }

        $image = '<img class="image-responsive" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=bitcoin:'.$address.'?amount='.$amount.'">  ';

        echo $image;
    }


    public function userCapitalReset(){
        $opt = implode("",$this->userPlanOptions2());
        $clause1 = array('closed','done');
        $clause2 = array();
        $capitals = $this->model->getRowsOR($this->obj->tb_Invest,$this->user,'username',50,$clause1,'status');
        if (!empty($capitals ) && is_array($capitals)) {
            $status = null;
            echo '<div class="card-body">
            <ul class="team-activity">';
            foreach ($capitals  as $key) {
                $percent = $this->investDayPercent($key['day_counter'],$key['counter_type'],$key['plan_type']);
                $badge = $this->obj->statusBadge($key['status']);
                $statusName  = $this->obj->statusName($key['status']);
                $percbadge  = $this->obj->percentBadge($percent);
                $percStatus  = $this->obj->percentName($percent);
                $haveReturn = $this->getPlanData('return_invest',$key['plan_type']);
                if($haveReturn==='yes'){
                    $roi = $this->getPlanData('return_fold',$key['plan_type']);
                    $foldAmount = $this->obj->getPercentBal($roi,$key['amount']);
                    $roiPerc  = $this->obj->getPercent($foldAmount,$key['amount']);

                }else{
                    $roi = 0;
                    $foldAmount = 0;
                    $roiPerc =0;
                }
                
                if($percent >=100 ){
                    $perceDis  =100;
                }else{
                    $perceDis = $percent;
                }
                
                if($key['status']==='closed'){
                    $opts ='';
                    $btn_Type='button';
                    $btn_Text = 'Closed';
                    $btn_Name = 'Closed';
                    $percentDisName  = 'Completed (Closed)';
                    $perceDis =100;
                }else{
                    $btn_Type='submit';
                    $btn_Text = 'Reset';
                    $btn_Name = 'resetInvest';
                    $percentDisName = $percStatus; // 'Complete (success)';
                    $opts = '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="Street">Select  New Plan </label>
                        <select  class="form-control form-control-lg" id="plan" name="plan">
                        '.$opt.'
                        </select>
                    </div>
                    </div>';

                }

            

                
                echo '<li class="product-list clearfix">
                <form action="reset-investment" method="POST" enctype="multipart/form-data">
                <div class="product-time">
                    
                    <p class="date center-text">Action</p>
                   <!-- <span class="badge badge-info">Reset</span>-->
                   <button class="badge badge-'.$badge.'" type="'.$btn_Type.'" name="'.$btn_Name.'">'.$btn_Text.'</button>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>'.$key['category'].'</h6>
                        <p class="text-'.$badge.'">Deposit: '.$this->sym.$this->obj->fmt($key['amount'],2).' '.$this->currency.'</p>
                        <p>ID:'.$key['invest_id'].' : </p>
                        <p class="text-'.$badge.'">Profit: '.$this->sym.$this->obj->fmt($key['profits'],2).' '.$this->currency.'</p>
                        <p class="text-'.$badge.'">ROI: '.$this->sym.$this->obj->fmt($foldAmount,2).' '.$this->currency.' | '.$roiPerc.'% of Invested Fund</p>
                        <!--<p>Status: <span class="badge badge-pill badge-'.$badge.'">'.$statusName.'</span></p>-->
                        
                        <p hidden><input type="hidden" id="invest_id" name="invest_id" value="'.$key['invest_id'].'" style="display:none;"></p>
                        <div class="row gutters">
										
										'.$opts.'


									</div>
                        
                    </div>
                    <div class="status" hidden>
                        <div class="progress">
                            <div class="progress-bar bg-'.$percbadge.'" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
                                <span class="sr-only">'.$percent.'% Complete (success)</span>
                            </div>
                        </div>
                        <p>'.$percentDisName.' '.$perceDis.'%</p>
                    </div>
                </div>
                '.$this->obj->crfToken2().'
                </form>
            </li>';
            echo '<li class="product-list clearfix">
            
            <div class="product-info">

                <div class="status">
                <div class="progress">
                <div class="progress-bar bg-' . $percbadge . '" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%">
                    <span class="sr-only">' . $percent . '% Complete (success)</span>
                </div>
            </div>
            <p>' . $percentDisName . ' ' . $perceDis . '%</p>
                </div>
            </div>
        </li>';
        echo '<li class="product-list clearfix">
        <div class="product-time">
        

        </div>
        <div class="product-info">

            <div class="status">
            </div>
        </div>
    </li>';

            

            }

            echo ' </ul>
            </div>';
        }else{
            echo '<li class="product-list clearfix">
            
                <div class="product-info">
                    <p>You currently do not have any invest that need reset</p>
                    
                </div>
            </li>';
        }

    }

    public function userInvestMents(){
        
        $capitals = $this->model->getRows($this->obj->tb_Invest,$this->user,'username',50,'confirmed','status');
        if (!empty($capitals ) && is_array($capitals)) {
            $status = null;
            echo '<div class="card-body">
            <ul class="team-activity">';
            foreach ($capitals  as $key) {
                $percent = $this->investDayPercent($key['day_counter'],$key['counter_type'],$key['plan_type']);
                $badge = $this->obj->statusBadge($key['status']);
                $statusName  = $this->obj->statusNameINV($key['status']);
                $percbadge  = $this->obj->percentBadge($percent);
                $percStatus  = $this->obj->percentName($percent);
                
                echo '<li class="product-list clearfix">
                <div class="product-time" hidden>
                    <p class="date center-text">Action</p>
                    <span class="badge badge-info">Topup</span>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>'.$key['category'].'</h6>
                        <p class="text-'.$badge.'">Deposit: '.$this->sym.$this->obj->fmt($key['amount'],2).' '.$this->currency.'</p>
                        <p>ID:'.$key['invest_id'].' : </p>
                        <p class="text-'.$badge.'">Profit: '.$this->sym.$this->obj->fmt($key['profits'],2).' '.$this->currency.'</p>
                        <p>Status: <span class="badge badge-pill badge-'.$badge.'">'.$statusName.'</span></p>
                    </div>
                    <div class="status">
                        <div class="progress">
                            <div class="progress-bar bg-'.$percbadge.'" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
                                <span class="sr-only">'.$percent.'% Complete (success)</span>
                            </div>
                        </div>
                        <p>'.$percStatus.' '.$percent.'%</p>
                    </div>
                </div>
            </li>';

            }

            echo ' </ul>
            </div>';
        }

    }

    public function userCapitalWithdrawx(){
        
        $capitals = $this->model->getRows($this->obj->tb_Invest,$this->user,'username',50);
        if (!empty($capitals ) && is_array($capitals)) {
            $status = null;
            echo '<div class="card-body">
            <ul class="team-activity">';
            foreach ($capitals  as $key) {
                $percent = $this->investDayPercent($key['day_counter'],$key['counter_type'],$key['plan_type']);
                $badge = $this->obj->statusBadge($key['status']);
                $statusName  = $this->obj->statusName($key['status']);
                $percbadge  = $this->obj->percentBadge($percent);
                $percStatus  = $this->obj->percentName($percent);
                
                echo '<li class="product-list clearfix">
                <div class="product-time">
                    <p class="date center-text">Action</p>
                    <span class="badge badge-info">Reset</span>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>'.$key['category'].'</h6>
                        <p class="text-'.$badge.'">Deposit: '.$this->sym.$this->obj->fmt($key['amount'],2).' '.$this->currency.'</p>
                        <p>ID:'.$key['invest_id'].' : </p>
                        <p class="text-'.$badge.'">Profit: '.$this->sym.$this->obj->fmt($key['profits'],2).' '.$this->currency.'</p>
                        <p>Status: <span class="badge badge-pill badge-'.$badge.'">'.$statusName.'</span></p>
                    </div>
                    <div class="status">
                        <div class="progress">
                            <div class="progress-bar bg-'.$percbadge.'" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
                                <span class="sr-only">'.$percent.'% Complete (success)</span>
                            </div>
                        </div>
                        <p>'.$percStatus.' '.$percent.'%</p>
                    </div>
                </div>
            </li>';

            }

            echo ' </ul>
            </div>';
        }

    }

    public function userCapitalWithdraw(){
        
        $opt = implode("",$this->withdrawMethods());
        $data  = $this->getUserPayWallet($this->user);
        
        $clause1 = array('done');
        $clause2 = array();
        $capitals = $this->model->getRows($this->obj->tb_Invest,$this->user,'username',50,'done','status');
        if (!empty($capitals ) && is_array($capitals)) {
            $status = null;
            echo '<div class="card-body">
            <ul class="team-activity">';
            foreach ($capitals  as $key) {
                $percent = $this->investDayPercent($key['day_counter'],$key['counter_type'],$key['plan_type']);
                $badge = $this->obj->statusBadge($key['status']);
                $statusName  = $this->obj->statusName($key['status']);
                $percbadge  = $this->obj->percentBadge($percent);
                $percStatus  = $this->obj->percentName($percent);
                $haveReturn = $this->getPlanData('return_invest',$key['plan_type']);
                if($haveReturn==='yes'){
                    $roi = $this->getPlanData('return_fold',$key['plan_type']);
                    $foldAmount = $this->obj->getPercentBal($roi,$key['amount']);
                    $roiPerc  = $this->obj->getPercent($foldAmount,$key['amount']);

                }else{
                    $roi = 0;
                    $foldAmount = 0;
                    $roiPerc =0;
                }
                
                if($percent >=100 ){
                    $perceDis  =100;
                }else{
                    $perceDis = $percent;
                }
                
                if($key['status']==='closed'){
                    $opts ='';
                    $btn_Type='button';
                    $btn_Text = 'Closed';
                    $btn_Name = 'Closed';
                    $percentDisName  = 'Completed (Closed)';
                    $perceDis =100;
                }else{
                    $btn_Type='submit';
                    $btn_Text = 'Request';
                    $btn_Name = 'reqCapital';
                    $percentDisName = $percStatus; // 'Complete (success)';
                    $opts = '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="Street">Select  Method </label>
                        <select  class="form-control form-control-lg" id="payMethod" name="payMethod">
                        '.$opt.'
                        </select>
                    </div>
                    </div>';
                    $opts2 = '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="Street">Select  Account </label>
                        <select  class="form-control form-control-lg" id="payAddress" name="payAddress">
                        <optgroup label="'.$data['coin_type'].':'.$data['address'].'">
                        <option value="'.$data['address'].'"> '.$data['name'].' ('.$data['coin_type'].' - '.$data['network'].')</value>
                        </optgroup>
                        </select>
                    </div>
                    </div>';

                }

            

                
                echo '<li class="product-list clearfix">
                <form action="requestCapital" method="POST" enctype="multipart/form-data">
                <div class="product-time">
                    
                    <p class="date center-text">Action</p>
                   <!-- <span class="badge badge-info">Reset</span>-->
                   <button class="badge badge-'.$badge.'" type="'.$btn_Type.'" name="'.$btn_Name.'">'.$btn_Text.'</button>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>'.$key['category'].'</h6>
                        <p class="text-'.$badge.'">Deposit: '.$this->sym.$this->obj->fmt($key['amount'],2).' '.$this->currency.'</p>
                        <p>ID:'.$key['invest_id'].' : </p>
                        <p class="text-'.$badge.'">Profit: '.$this->sym.$this->obj->fmt($key['profits'],2).' '.$this->currency.'</p>
                        <p class="text-'.$badge.'">ROI: '.$this->sym.$this->obj->fmt($foldAmount,2).' '.$this->currency.' | '.$roiPerc.'% of Invested Fund</p>
                        <!--<p>Status: <span class="badge badge-pill badge-'.$badge.'">'.$statusName.'</span></p>-->
                        
                        <p hidden><input type="hidden" id="invest_id" name="invest_id" value="'.$key['invest_id'].'" style="display:none;"></p>
                        <div class="row gutters">
										
										'.$opts.'
                                        '.$opts2.'


									</div>
                        
                    </div>
                    <div class="status" hidden>
                        <div class="progress">
                            <div class="progress-bar bg-'.$percbadge.'" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
                                <span class="sr-only">'.$percent.'% Complete (success)</span>
                            </div>
                        </div>
                        <p>'.$percentDisName.' '.$perceDis.'%</p>
                    </div>
                </div>
                '.$this->obj->crfToken2().'
                </form>
            </li>';
            echo '<li class="product-list clearfix">
            
            <div class="product-info">

                <div class="status">
                <div class="progress">
                <div class="progress-bar bg-' . $percbadge . '" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%">
                    <span class="sr-only">' . $percent . '% Complete (success)</span>
                </div>
            </div>
            <p>' . $percentDisName . ' ' . $perceDis . '%</p>
                </div>
            </div>
        </li>';
        echo '<li class="product-list clearfix">
        <div class="product-time">
        

        </div>
        <div class="product-info">

            <div class="status">
            </div>
        </div>
    </li>';

            

            }

            echo ' </ul>
            </div>';
        }else{
            echo '<li class="product-list clearfix">
            
                <div class="product-info">
                    <p>You currently do not have any investment that can be withdrawn</p>
                    
                </div>
            </li>';
        }

    }

    public function userPayWallet($user=null){
        $data  = $this->getUserPayWallet($this->user);
        //echo $data['address'];
                echo '<optgroup label="'.$data['coin_type'].':'.$data['address'].'">';
                echo '<option value="'.$data['address'].'"> '.$data['name'].' ('.$data['coin_type'].' - '.$data['network'].')</value>';
                echo '</optgroup>';
    }

    public function userPayWallet2($user=null){
        $data  = $this->getUserPayWallet2($user??$this->user);
        var_dump($data);
    }

    public  function userWithdrawMethods() :void{
        $opt = implode("",$this->withdrawMethods());
        //$data =  $this->withdrawMethods();
            echo $opt;
    
    }

    public function ffg(){

        echo '<div class="card-body">
        <ul class="team-activity">
            <li class="product-list clearfix">
                <div class="product-time">
                    <p class="date center-text">02:30 pm</p>
                    <span class="badge badge-info">New</span>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>Smart - Admin Dashboard</h6>
                        <p>by Luke Etheridge</p>
                    </div>
                    <div class="status">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
                                <span class="sr-only">49% Complete (success)</span>
                            </div>
                        </div>
                        <p>(225 of 700gb)</p>
                    </div>
                </div>
            </li>
            <li class="product-list clearfix">
                <div class="product-time">
                    <p class="date center-text">11:30 am</p>
                    <span class="badge badge-info">Task</span>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>User_Profile.php</h6>
                        <p>by Rovane Durso</p>	
                    </div>
                    <div class="status">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                <span class="sr-only">75% Complete (success)</span>
                            </div>
                        </div>
                        <p>(485 of 850gb)</p>
                    </div>
                </div>
            </li>
            <li class="product-list clearfix">
                <div class="product-time">
                    <p class="date center-text">12:50 pm</p>
                    <span class="badge badge-success">Closed</span>
                </div>
                <div class="product-info">
                    <div class="activity">
                        <h6>Material Design Kit</h6>
                        <p>by Cosmin Capitanu</p>
                    </div>
                    <div class="status">
                        <span class="line-seven" style="display: none;">5,3,9,6,5,9,7,3,5,7</span><svg class="peity" height="25" width="150"><polyline fill="none" points="0 11.333333333333332 16.666666666666668 16 33.333333333333336 2 50 9 66.66666666666667 11.333333333333332 83.33333333333334 2 100 6.666666666666668 116.66666666666667 16 133.33333333333334 11.333333333333332 150 6.666666666666668" stroke="#5fa22d" stroke-width="4" stroke-linecap="square"></polyline></svg>
                    </div>
                </div>
            </li>
        </ul>
    </div>';
    }


    public function withdrawCapyx($Tradex_user){
	
        $sql = "SELECT * FROM $this->obj->tb_Invest WHERE username = '".$Tradex_user."'  and `deposit_status`='confirmed' and `place_order`!='done'   and day_counter !='0'  ORDER BY id DESC";
        //$dbs = new DBConnection();
          $dbs = $this->model;
          $db = $dbs->DBConnections();
          $stmt = $db->prepare($sql);
          $stmt->execute();
         
         echo '
  <table class="table table-blue no-margin" id="">
          <thead>
            <tr id="latest-txs">
        
            <th>Capital </th>
             <th>Investment ID </th>
             <th>Invested Fund </i></th>
             <th>Profit Earned</th>
             <th>Duration</th>
        
              <th>Date Created </th>
             <th>Status </th>
             
             
            
        </tr>
        
</thead>
        <tbody>

        <form method="post" enctype="multipart/form-data" action="" id="formInt" >
        ';
            $i =0; $sum=0; $expire = 6;
          
          if(!empty($stmt) ){
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $exp = $expire - $row['day_counter'];
                  if($row['coin_type']=='BTC'){
                      $dex_amt = $row['coin_amount'];
                  }else if($row['coin_type']=='ETH'){
                      $dex_amt = $row['coin_amount'];
                  }else if($row['coin_type']=='USD'){
                      $dex_amt = '$'.number_format($row['amount'],2);
                  }else{
                      $aamt = 0;
                     $dex_amt = number_format($aamt,2);
                  }
                  

echo '
<tr role="new-tx">

<!--<td>'. $i.'</td>-->
<td>
<label class="intre label">Withdraw
<input type="checkbox" id="intrestcapy" name="intrestcapy" value="'.$row['transaction_id'].'" style="display:none;">
<span class="checkmark"></span>
</label>
</td>
<td>'.$row['transaction_id'].'</td>

<td>$'. number_format($row['amount'],2).'

<div hidden="true"><input type="text" hidden="true" value="'.$row['amount'].'" ></div></td>

<td>$'. number_format($row['intrest_growth'],2).'</td>




<td>'.$row['day_counter'].'</td>

<!--<td>'.$row['deposit_category'].'</td>-->

<!--<td>'.$dex_amt.' '.$row['coin_type'].'</td>-->

<!--<td>'.$row['total_paid'].'</td>-->

<td>'.$row['date_created'].'</td>
<td><span class="label label-success">'.$row['deposit_status'].'</span></td>





</tr> 

';
         $i++;
              }
             
              }else{
                  echo '<td colspan="8">No investment record yet</td>';
                 // echo '';
                  }
              echo '
              <button type="submit" name="sub" style="display:none;"></button>
                    </form>
              </tbody>
    </table>
              ';
              return $this;
}



}
