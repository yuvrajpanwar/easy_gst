<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\OtherOrderItem;
use App\Models\RegisterUserOrder;
use App\Models\UserBillingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisterUserOrderItem;
use App\Models\RegisterBillingAddress;
use App\Models\RegisterOtherOrderItem;

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
            'title' => $this->get_control_value("title",$request),
            'description' =>$this->get_control_value("description",$request),
            'image' => $this->get_control_value("image",$request),
            'currency' =>'INR',
            'discount' => $this->get_control_value("discount",$request),
            'cod' => 0,
            'emi' => 0,
            'status' => 1,
            'gmqty' => $this->get_control_value("gmqty",$request),
            'unit' => $this->get_control_value("unit",$request),
            'type' => $this->get_control_value("type",$request),
            'product_type' => $this->get_control_value("product_type",$request),
            'hsn_code' => $this->get_control_value("hsn_code",$request),
            'price' => $this->get_control_value("price",$request),
            'cgst_tax' =>$this->get_control_value("cgst_tax",$request),
            'sgst_tax' => $this->get_control_value("sgst_tax",$request),
            'admin_id' => Auth::user()->id,
            'rk_code' => $this->get_control_value("rk_code",$request),
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

        $login_id = Auth::user()->id;

        if(isset($request->add))
        {

            
            $pro_name = $this->get_control_value("pro_name" , $request);
            if(!$pro_name)
            { 
                return redirect()->route('home')->withErrors(['message' => 'Please select a product']);
            }
            
            
            
            date_default_timezone_set('Asia/Kolkata');


            $cuurent_datetime =date("Y-m-d");
            
            $totalitem =sizeof($pro_name);
            $user_type = $this->get_control_value("user_type" , $request);

            $cylinder_name = $this->get_control_value("cylinder_name",$request);
            $cylinder_rate = $this->get_control_value("cylinder_rate",$request);
            $cylinder_pice = $this->get_control_value("cylinder_pice",$request);
              
            $regulator_name = $this->get_control_value("regulator_name",$request);
            $regulator_rate = $this->get_control_value("regulator_rate",$request);
            $regulator_pice = $this->get_control_value("regulator_pice",$request);
            
            $discount_price = $this->get_control_value("discount",$request);
            if($discount_price=="" || $discount_price==null || $discount_price ==0)
            {
                $discount_price = 0.00;
            }

            $remark = $this->get_control_value("remark_text",$request);
            $recipt_no = $this->get_control_value("recipt_no",$request);
            $payment_mode = $this->get_control_value("payment_mode",$request);
            $invoice_date = $this->get_control_value('invoice_date',$request);
            $invoice_date = changeToReverseDate($invoice_date);
            $totalprice = 0;

            if($pro_name!="")
            {
                if($cylinder_rate)
                {
                    $totalitem = $totalitem + 1;
                    $cylinder_amount = $cylinder_rate * $cylinder_pice;   
                }	
                if($regulator_rate)
                {
                    $totalitem = $totalitem + 1;
                    $regulator_amount = $regulator_rate * $regulator_pice;
                }
                
                $order_amount = 0;
                $order_amount = $order_amount + $cylinder_amount + $regulator_amount;
                
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
                $order->recipt_no = $recipt_no;
                $order->totalprice = $totalprice;
                $order->payment_mode = $payment_mode;
                $order->invice_date = $invoice_date;
                
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
                for($j=0; $j < sizeof($pro_names); $j++)
                {   
                    
                    $pro_name = $pro_names[$j];
                
                    $total_pieces = $request->$pro_name;
                    
                    $pro_details = Product::getProductDetails($pro_name);

                    $rate = $pro_details['price'];
                    $rate_all = $rate * $total_pieces;

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
                        
                    $total_amount = $rate_all+ $cgst_amount + $sgst_amount;
                    
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
                        
                        $stock_details = Stock::getStockById($pro_name);
 
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
                    RegisterUserOrder::updateRegisterReceiptNumber($data, $condition);
                }


                // Insert Billing Address details........................................
                $billing_name = $this->get_control_value("billing_name",$request);
                $billing_number = $this->get_control_value("billing_number",$request);
                $billing_address = $this->get_control_value("billing_address",$request);
                $billing_state = $this->get_control_value("billing_state",$request);
                
                $decider = $this->get_control_value("decider",$request);
                if($decider=="no")
                {
                    $shippeing_address = $this->get_control_value("shippeing_address",$request);
                }
                else
                {
                    $shippeing_address = $billing_address;
                } 
                                  
                if ($billing_name !== "" && $billing_address !== "" && $order_id !== "") {
                    $data = [
                        "order_id" => $order_id,
                        "name" => $billing_name,
                        "number" => $billing_number,
                        "billing_address" => $billing_address,
                        "shipping_address" => $shippeing_address,
                        "state" => $billing_state
                    ];   
                    if ($user_type == "General") {
                        
                        UserBillingAddress::create($data);

                    } elseif ($user_type == "Registered") {
                        RegisterBillingAddress::create($data);
                    }
                } 
                //End Insert Billing Address details........................................			


                // Insert Invoice Details.........................................................       
                $invoice_date = changeToReverseDate($this->get_control_value("invoice_date",$request));
                if($invoice_date=="0000-00-00" || $invoice_date=="")
                {
                    dd('here1');
                    redirect( route('home') );die();
                }
                
                $r_charge = $this->get_control_value("r_charge",$request);
                $con_type = $this->get_control_value("con_type",$request);
                $sv_numver = $this->get_control_value("sv_numver",$request);
                $consumer_number = $this->get_control_value("consumer_number",$request);
               
                $date_supply = '0001-01-01';
                $mode = $this->get_control_value("mode",$request);
                $gst_number = $this->get_control_value("gst_number",$request);
                
                if($mode=="Both")
                {
                    $cash_amount=$this->get_control_value("cash_amount",$request);
                    $bank_amount=$this->get_control_value("bank_amount",$request);
                }
                else
                {
                    $cash_amount=0;
                    $bank_amount=0; 
                }	

                if (!empty($invoice_date) && !empty($r_charge) && !empty($order_id)) {

                    if ($user_type == "General") {
                        $table_name = "oredr_basic_details";
                        Order::where('id', $order_id)->update(['invice_date' => $invoice_date]);
                    } elseif ($user_type == "Registered") {
                        $table_name = "register_other_basic_details";
                        RegisterUserOrder::where('id', $order_id)->update(['invice_date' => $invoice_date]);
                    }
                
                    $dataToInsert = [
                        "o_id" => $order_id,
                        "invoice_date" => $invoice_date,
                        "reverse_charge" => $r_charge,
                        "content_type" => $con_type,
                        "sv_number" => $sv_numver,
                        "consumer_number" => $consumer_number,
                        "user_gst" => $gst_number,
                        "date_of_supply" => $date_supply,
                        "payment_mode" => $mode,
                        "cash_amount" => $cash_amount,
                        "bank_amount" => $bank_amount
                    ];
                
                    DB::table($table_name)->insert($dataToInsert);
                }

                // End of Insert invoice details...............................................
                
                return "success"; die();
            }
        }

       
    
    }

    public function get_control_value ( $control_name , Request $request) 
    {   
        $returnvalue ='';

        if ( isset($request->$control_name) ) {

            $returnvalue = $request->$control_name;

        }

        return $returnvalue;

    }

    public function receipt_list()
    {
        return view('receipt_list');
    }
  
}
