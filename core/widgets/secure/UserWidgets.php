<?php 

class UserWidgets {

    public function moneyCards($money=0,$name='Widget',$bg='info',$icon='local_atm'):void
    {

        $data = '<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="social-tile h-165">
            <div class="social-icon bg-'.$bg.'">
                <i class="icon-'.$icon.'"></i>
            </div>
            <div>'.$name.'</div>
            <h6 class="text-grey">'.$money.'</h6>
        </div>
        </div>';
        
        echo $data;
        
    }


    public function moneyCardBig ($money=0,$name='Widget  Big',$link=null,$btnName){

        $data = '<div class="col-xl-4 col-lg-8 col-md-8 col-sm-8 col-12">
        <div class="card h-165">
            <div class="payments-card">
                <h6>'.$name.'</h6>
                <h2>'.$money.'</h2>
                <div class="custom-btn-group mt-4">
                    <button class="btn btn-success ml-0"><i class="icon-credit-card"></i>Add Funds</button>
                    <button class="btn btn-danger"><i class="icon-credit-card"></i>Withdraw</button>
                </div>
            </div>
        </div>
    </div>';
    }

}


?>