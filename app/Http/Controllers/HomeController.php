<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\RegisterUserOrder;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function product_list()
    {
        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)->get();
        return view('product_list', ['products' => $products]);
    }

    public function add_product()
    {
        return view('add_product');
    }

    protected function create_product(Product $product , Request $request)
    {
        
        Product::create([
            'title' => $request->title,
            'description' => '',
            'image' => '',
            'currency' =>'INR',
            'discount' => $request->discount,
            'cod' => 0,
            'emi' => 0,
            'status' => 1,
            'gmqty' => '',
            'unit' => '',
            'type' => '',
            'product_type' => '',
            'hsn_code' => $request->hsn_code,
            'price' => $request->price,
            'cgst_tax' => $request->cgst_tax,
            'sgst_tax' => $request->sgst_tax,
            'admin_id' => Auth::user()->id,
            'rk_code' => '',
        ]);

        return redirect(route('product_list'))->with([
            'success' => 'Product added successfully!'
        ]);

        
    }

    public function get_max_date(Request $request)
    {
        $user_type = $request->type;

        if ($user_type == "General") {
            $data_max_order_date = $this->getMaxOrderDate();
        } elseif ($user_type == "Registered") {
            $data_max_order_date = $this->getRegisterMaxOrderDate();
        } else {
            $data_max_order_date = null;
        }

        $data_max_order_date = explode("-",$data_max_order_date);
	    $data_reverse_max_order_date = $data_max_order_date[2]."-".$data_max_order_date[1]."-".$data_max_order_date[0];
        return $data_reverse_max_order_date;
    }

    protected function getMaxOrderDate()
    {
        return Order::selectRaw('MAX(invice_date) as max_date')->value('max_date');
    }

    protected function getRegisterMaxOrderDate()
    {
        return RegisterUserOrder::selectRaw('MAX(invice_date) as max_date')->value('max_date');
    }

    public function calculate_amount(Request $request)
    {
        
        $product_id=$request->pro_id;
        $total_qty=$request->pcs;
        
        $data = $this->get_product_amount($product_id);
        
        $return_content=0;
        $rate=$data["price"];
        $cgst_tax=$data["cgst_tax"];
        $sgst_tax=$data["sgst_tax"];
        
        $cgst_amount=$rate*$cgst_tax/100;
        $sgst_amount=$rate*$sgst_tax/100;
        
        $rate=$rate*$total_qty;
        $cgst_amount=$cgst_amount*$total_qty;
        $sgst_amount=$sgst_amount*$total_qty;
        
        $final_amount=$rate+$cgst_amount+$sgst_amount;
        
        $cgst_amount=round($cgst_amount,2);
        $sgst_amount=round($sgst_amount,2);
        $rate=round($rate,2);
        $final_amount=round($final_amount,2);
        
        $return_content =$rate."-".$cgst_amount."-".$sgst_amount."-".$final_amount;
 
        return $return_content;
    }

    protected function get_product_amount($product_id)
    {
        return Product::find($product_id);
    }

    protected function create_receipt( Request $request )
    {

        if(isset($request->add))
        {
        
            $output = array();

            $pro_name = $request->pro_name;

            if(!$pro_name)
            {
                return redirect(route('home'));
            }
            
             $totalitem =sizeof($pro_name);
            
            date_default_timezone_set('Asia/Kolkata');
            $cuurent_datetime =date("Y-m-d h:i:sa");
            $array2d =$_POST;
            
            $size_data = 0;
            foreach ($array2d as $subArray) {
                $size_data = max($size_data, count($array2d));
            }

            $user_type = $this->get_control_value("user_type");
            
            $cylinder_name = $this->get_control_value("cylinder_name");
            $cylinder_rate = $this->get_control_value("cylinder_rate");
            $cylinder_pice = $this->get_control_value("cylinder_pice");
            $cylinder_amount = $cylinder_rate;
            
            $regulator_name = $this->get_control_value("regulator_name");
            $regulator_rate = $this->get_control_value("regulator_rate");
            $regulator_pice = $this->get_control_value("regulator_pice");
            
            $regulator_amount = $regulator_rate;
            $discount_price = $this->get_control_value("discount");
            $remark = $this->get_control_value("remark_text");
            

            if($pro_name!="")
            {
                if($cylinder_rate)
                {
                    $totalitem = $totalitem+1;
                
                }	
                if($regulator_rate)
                {
                    $totalitem = $totalitem+1;
                
                }
                
                $order_amount=0;
                $order_amount=$order_amount.$cylinder_amount.$regulator_amount;
                if($user_type=="General")
                {
                    $order = new Order();  
                    $otherItem= new OtherOrderItem();
                    $otherItem2= new OtherOrderItem();
                }
                if($user_type=="Registered")
                {
                    $order = new RegisterUserOrder();
                    $otherItem=new RegisterOtherOrderItem();
                    $otherItem2=new RegisterOtherOrderItem();
                }
                       
                $order->admin_id = $login_id;
                $order->totalitem = $totalitem;
                $order->discount = $discount_price;
                $order->status = 3;
                $order->order_remark = $remark;
                $order->user_type = $user_type;
                $order->order_date = $cuurent_datetime;
                $order->save();
                $order_id = $order->id; // This retrieves the inserted order ID
                            
                if($cylinder_name && $cylinder_rate)
                {
                    $otherItem->order_id = $order_id;
                    $otherItem->product_name = $cylinder_name;
                    $otherItem->rate = $cylinder_rate;
                    $otherItem->pro_qty = $cylinder_pice;
                    $otherItem->amount = $cylinder_amount;
                    $otherItem->save();
                }
                           
                if($regulator_name && $regulator_rate)
                {
                    $otherItem2->order_id = $order_id;
                    $otherItem2->product_name = $regulator_name;
                    $otherItem2->rate = $regulator_rate;
                    $otherItem2->pro_qty = $regulator_pice;
                    $otherItem2->amount = $regulator_amount;
                    $otherItem2->save();
                }	     
                       
                $pro_names = $request->pro_name;

                for($j=0; $j < $totalitem; $j++)
                {   
                    
                    $pro_name = $pro_names[$j];
                
                    $total_pieces = $request->pro_name;
            
                    $pro_details = Product::getProductDetails($pro_name);

                    $rate = $pro_details['price'];
                    $rate_all = $rate*$total_pieces;

                    $cgst_tax = $pro_details['cgst_tax'];
                    $sgst_tax = $pro_details['sgst_tax'];
                    
                    if($cgst_tax)
                    {
                        $cgst_amount = $rate_all*$cgst_tax/100;
                    }
                    else
                    {
                        $cgst_amount =0;
                    }	

                    if($sgst_tax)
                    {
                        $sgst_amount = $rate_all*$sgst_tax/100;
                    }
                    else
                    {
                        $sgst_amount =0;
                    }
                        
                    $total_amount = $rate_all+$cgst_amount+$sgst_amount;
                    
                    if($pro_name)
                    {

                        if($user_type=="General")
                        {
                            $orderItem = new OrderItem();
                          
                        }
                        if($user_type=="Registered")
                        {
                            $orderItem = new RegisterUserOrderItem();
                        }

                        $orderItem->admin_id = $login_id;
                        $orderItem->order_id = $order_id;
                        $orderItem->product_id = $pro_name;
                        $orderItem->rate = $rate;
                        $orderItem->cgst_tax = $cgst_tax;
                        $orderItem->cgst_amount = $cgst_amount;
                        $orderItem->sgst_tax = $sgst_tax;
                        $orderItem->sgst_amount = $sgst_amount;
                        $orderItem->qty = $total_pieces;
                        $orderItem->price = $total_amount;
                        $orderItem->save();

                        $order_amount=$order_amount + $total_amount;
                        
                        $stock_details = Stock::getStockById($productID);
 
                        if($stock_details)
                        {
                            $store_qty = $stock_details->gmqty;
                            
                            if ($store_qty >= $total_pieces) {
                                $new_stock = $store_qty - $total_pieces;
                                $stock_details->gmqty = $new_stock;
                                $stock_details->save();
                            }
                            
                        }
                    }     
                    
                }
                if ($user_type == "General") {
                    $invoice_num = "G" . $order_id;
                    $data = [
                        'recipt_no' => $invoice_num,
                        'totalprice' => $order_amount
                    ];
                    $condition = ['id' => $order_id];
                    Order::updateReceiptNumber($data, $condition);
                }
                
                if ($user_type == "Registered") {
                    $invoice_num = "R" . $order_id;
                    $data = [
                        'recipt_no' => $invoice_num,
                        'totalprice' => $order_amount
                    ];
                    $condition = ['id' => $order_id];
                    RegisteredOrder::updateRegisterReceiptNumber($data, $condition);
                }

                // Insert user details........................................
                $billing_name = $this->get_control_value("billing_name");
                $billing_number = $this->get_control_value("billing_number");
                $billing_address = $this->get_control_value("billing_address");
                $billing_state = $this->get_control_value("billing_state");
                
                $decider = $this->get_control_value("decider");
                if($decider=="no")
                {
                    $shippeing_address = $this->get_control_value("shippeing_address");
                }
                else
                {
                    $shippeing_address =$billing_address;
                }
                                  
                if ($billing_name !== "" && $billing_address !== "" && $order_id !== "") {
                    $data = [
                        "order_id" => $order_id,
                        "name" => $billing_name,
                        "number" => $billing_number,
                        "billing_address" => $billing_address,
                        "shipping_address" => $shipping_address,
                        "state" => $billing_state
                    ];
                
                    if ($user_type == "General") {
                        UserBillingAddress::create($data);
                    } elseif ($user_type == "Registered") {
                        RegisterBillingAddress::create($data);
                    }
                }
                
                
                //End Insert user details........................................			

                // Insert Invoice Details.........................................................

                $invoice_date = changeToReverseDate($this->get_control_value("invoice_date"));
                if($invoice_date=="0000-00-00" || $invoice_date=="")
                {
                    redirect( route('home') );die();
                }
                
                $r_charge = $this->get_control_value("r_charge");
                $con_type = $this->get_control_value("con_type");
                $sv_numver = $this->get_control_value("sv_numver");
                $consumer_number = $this->get_control_value("consumer_number");
               
                $date_supply = "";
                $mode = $this->get_control_value("mode");
                $gst_number = $this->get_control_value("gst_number");
                
                if($mode=="Both")
                {
                    $cash_amount=$this->get_control_value("cash_amount");
                    $bank_amount=$this->get_control_value("bank_amount");
                }
                else
                {
                    $cash_amount="";
                    $bank_amount="";
                }	

                if($invoice_date!="" && $r_charge!="" && $order_id!="")
                {
                    if($user_type=="General")
                    {
                        $table_name="oredr_basic_details";
                        updateInvoice_date(array("invice_date"=>$invoice_date),array("id"=>$order_id));
                    }
                    
                    if($user_type=="Registered")
                    {
                        $table_name="register_other_basic_details";
                        updateRegisterInvoice_date(array("invice_date"=>$invoice_date),array("id"=>$order_id));
                    }
                    
                    $q = new Query();
                    $q->insert_into("$table_name",array(
                        "o_id"=>$order_id,
                        "invoice_date"=>$invoice_date,
                        "reverse_charge"=>$r_charge,
                        "content_type"=>$con_type,
                        "sv_number"=>$sv_numver,
                        "consumer_number"=>$consumer_number,
                        "user_gst"=>$gst_number,
                        "date_of_supply"=>$date_supply,
                        "payment_mode"=>$mode,
                        "cash_amount"=>$cash_amount,
                        "bank_amount"=>$bank_amount
                    ))
                    ->run();

                }
                // End of Insert invoice details...............................................
 
                common::set_message(26);
                common::redirect_to(common::get_component_link(array("add_order","list"),array("user_type"=>$user_type)));
                
            }
        }

        return redirect(route('home'))->with([
            'success' => 'Recipt added successfully!'
        ]);
    
    }

    public function get_control_value ( $control_name, Request $request ) 
    {   
        $returnvalue ='';

        if ( isset($request->$control_name) ) {

            $returnvalue = $request->$control_name;

        }

        return $returnvalue;

    }

  
}
