<?php
if(isset($_POST['sessionInfo']) and isset($_POST['otp'])){
$sessionInfo=$_POST['sessionInfo']; 
$code=$_POST['otp'];
$data = array("sessionInfo" => $sessionInfo,
"code"=>$code
);                                                                    
$data_string = json_encode($data);                                                                                   
$api_key="AIzaSyArCAgzbztQ1bJT8MRbJJ4z586ccvahyx4";                                                                                                           
$ch = curl_init('https://www.googleapis.com/identitytoolkit/v3/relyingparty/verifyPhoneNumber?key='.$api_key);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
$obj = json_decode( $result, true );
if($obj["phoneNumber"]){
    //verified
}else{
    //not verified
}

}
/*AJOnW4Qjufg5i5odVy8X2AxbEpM6dVE9vZg_o4q1YSfumCaRy5BPp74agEODG2LosEuZAWZuhPZoIMqnVSghRGAxvJcbTvjvmJrH8R79ybhdruYuXBbzqAHjye6gyeqF1GGOOza-gyg4b95r1WOgjtPsBl_eQCEmDhCoM2dbtlupn5wApDmRfolVjyuLnlApsQXKoU_14bTU__PNUQm4mV-SN-CjZ-mLpewzH_4wbgBa457MyMVwrqg*/
?>