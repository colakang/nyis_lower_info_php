<?php
namespace app\index\event;

require_once("/data0/htdocs/shipment/extend/easypost/lib/easypost.php");

use \think\Db;

class Shipment
{
   public function buyLabel($from,$to,$weight,$service='Priority',$packing="Parcel")
    {


   	//\EasyPost\EasyPost::setApiKey('HUjGvm9o0Xitk3ExqUHtlw');	//Test
   	\EasyPost\EasyPost::setApiKey('wEg2lmRCAEAJqsN8VOALvQ');	//Product

	$to_address = \EasyPost\Address::create($to);
	$from_address = \EasyPost\Address::create($from);
	switch ($service)
	{
		case "Ground":
			$arr = array(
        			"length" => 20,
        			"width" => 14,
        			"height" => 4,
        			"weight" => $weight
    				);
			$carrier = "FedEx";
			break;
		default:
			$arr = array(
        			"predefined_package" => $packing,
        			"weight" => $weight
    				);
			$carrier = "USPS";
			break;
	}
	$parcel = \EasyPost\Parcel::create($arr);
	$shipment = \EasyPost\Shipment::create(
    		array(
        		"to_address"   => $to_address,
        		"from_address" => $from_address,
        		"parcel"       => $parcel
    		)
	);

	
	$shipment->buy($shipment->lowest_rate($carrier,$service));

//	$shipment->insure(array('amount' => 100));
	$shipment->label(array("file_format"=>"PDF"));
	return $shipment;
	//return "<a href='".$shipment->postage_label->label_pdf_url."'>View PDF</a>";
    }


   public function getRow($uid = 1,$status = 1)
    {
	return Db::query('select a.id,a.customer_id,a.product_info,a.amount,a.track_service,a.order_id,a.weight,a.weight_g,a.type,a.buy,a.packing,(select name from think_shipment_address where id=a.send_from_id) as send_from,(select name from think_shipment_address where id=a.send_to_id) as send_to from think_shipment as a where status='.$status.' and uid='.$uid);
    }

   public function getBuidLabel($uid = 1,$status = 2)
    {
	return Db::query('select id,customer_id,amount,track_service,order_id,weight,weight_g,type,track_id,track_url,zone,list_rate,fee,packing,status from think_shipment where status>='.$status.' and status<>9 and uid='.$uid);
    }
 
   public function getNumbers($uid = 1)
    {
	return Db::query('select status,type,count(*) as number from think_shipment  where uid='.$uid.' group by status,type');
    }

    public function getBuying($uid = 1)
    {
	$buy = Db::query('select count(*) as buying from think_shipment  where uid='.$uid.' and status = 1 and buy=1 and weight>0 and weight_g>0');
	return $buy[0]['buying'];
    }
 
    public function getFee($weight,$amount,$type=1)
    {
	$fees = array (
			"1"=>array(			//发货运单处理费;
				"level_1"=>0.48,
				"level_2"=>0.65,
				"level_2"=>0.81,
				"level_3"=>1.29,
				"level_4"=>1.94,
				"level_5"=>4.84,
				"level_6"=>9.68,
				),
			"2"=>array(			//退货运单处理费;
				"level_1"=>0.63,
				"level_2"=>0.84,
				"level_2"=>1.05,
				"level_3"=>1.68,
				"level_4"=>2.52,
				"level_5"=>6.29,
				"level_6"=>12.58,
				),
			"3"=>array(			//自助运单处理费;
				"level_1"=>0,
				"level_2"=>0,
				"level_2"=>0,
				"level_3"=>0,
				"level_4"=>0,
				"level_5"=>0,
				"level_6"=>0,
				),
		
		);

	switch(true)
	{
		case ($weight<=500):
			$fee = $fees[$type]['level_1'];
			break;
		case ($weight<=1000):
			$fee = $fees[$type]['level_2'];
			break;
		case ($weight<=2000):
			$fee = $fees[$type]['level_3'];
			break;
		case ($weight<=10000):
			$fee = $fees[$type]['level_4'];
			break;
		case ($weight<=30000):
			$fee = $fees[$type]['level_5'];
			break;
		case ($weight<=50000):
			$fee = $fees[$type]['level_6'];
			break;
		case ($weight<=70000):
			$fee = $fees[$type]['level_7'];
			break;
	}
	return $fee*$amount;
    }

}
