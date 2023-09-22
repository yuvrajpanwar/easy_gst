<?php

namespace App\Http\Controllers;

// use Dompdf\Dompdf;
// use Dompdf\Options;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\stockDetail;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\CompanyDetail;
use App\Models\OtherOrderItem;
use App\Models\OtherBasicDetail;
use App\Models\RegisterUserOrder;
use App\Models\UserBillingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\RegisterUserOrderItem;
use Illuminate\Support\Facades\Crypt;
use App\Models\RegisterBillingAddress;
use App\Models\RegisterOtherOrderItem;
use App\Models\RegisterOtherBasicDetail;

// $options = new Options();
// $options->set('isRemoteEnabled', true);
// $dompdf = new Dompdf($options);


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('LicenseCheckMiddleware');
        $this->middleware('auth');
  
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();
        
        return view('home', ['products' => $products]);
    }

    public function expired()
    {
        return view('expired');
    }

    public function edit_company_details()
    {
        return view('edit_company_details');
    }

    public function update_company_details(Request $request)
    {
        if (!isset($request->add)) {
            return view('update_company_details')->with(['error', 'something went wrong!']);
        }

        $admin_id = Auth::user()->id;
        CompanyDetail::where('admin_id', $admin_id)->delete();

        $company_name = $this->get_control_value('title',$request);
        $gst_num = $this->get_control_value('gst_num',$request);
        $address = $this->get_control_value('address',$request);
        $city = $this->get_control_value('city',$request);
        $statezip = $this->get_control_value('statezip',$request);
        $country = $this->get_control_value('country',$request);
        $phone = $this->get_control_value('phone',$request);
        $email = $this->get_control_value('email',$request);

        //dd(strlen(Crypt::encrypt($company_name)));
        //dd(Crypt::encryptString($company_name));

        $company_details = [
            'companyname' => $company_name,
            'gst_number' => $gst_num,
            'address' => $address,
            'city' => $city,
            'statezip' => $statezip,
            'country' => $country,
            'phone' => $phone,
            'email' => $email,
        ];

        CompanyDetail::updateOrCreate(['admin_id' => $admin_id], $company_details);

        return redirect(route('home'));
    }

    public function product_list()
    {
        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();
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
            'description' =>$this->get_control_value("content",$request),
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
            'success' => '<strong>New</strong> details has been added successfully.'
        ]);

        
    }

    public function edit_product(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id',$id)->first();
        if(!$product)
        {
            return redirect(route('product_list'))->with(['error' => ' Product not found. ']);
        }
        return view('edit_product',['product'=>$product]);
    }

    public function update_product(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product)
        {
            return redirect(route('product_list'))->with(['error' => ' Product Details not found. ']);
        }

        $title = $this->get_control_value('title',$request);
        $hsn_code = $this->get_control_value('hsn_code',$request);
        $description = $this->get_control_value('content',$request);
        $price =$this->get_control_value('price',$request);
        $discount = $this->get_control_value('discount',$request);
        $cgst_tax = $this->get_control_value('cgst_tax',$request);
        $sgst_tax = $this->get_control_value('sgst_tax',$request);

        $details = [
            'title' => $title,
            'hsn_code' => $hsn_code,
            'description' => $description,
            'price' => $price,
            'discount' => $discount,
            'cgst_tax' => $cgst_tax,
            'sgst_tax' =>  $sgst_tax,
        ];

        Product::updateOrCreate(['id' => $id], $details);

        return redirect(route('product_list'))->with(['success' => ' Product updated successfully. ']);
    }

    public function delete_product($id)
    {

        $product = Product::where('id',$id)->first();
        if(!$product)
        {
            return redirect(route('product_list'))->with(['error'=>' Product details not found in database']);
        }

        Product::updateOrCreate(['id' => $id],['status'=>'0']);
        return redirect(route('product_list'))->with(['success'=>' Product deleted successfully']);
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
            // $cylinder_amount = $cylinder_rate * $cylinder_pice;

            $regulator_name = $this->get_control_value("regulator_name",$request);
            $regulator_rate = $this->get_control_value("regulator_rate",$request);
            $regulator_pice = $this->get_control_value("regulator_pice",$request);
            // $regulator_rate = $regulator_rate * $regulator_pice;
            
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
                else
                {
                    $cylinder_amount = 0;
                }	
                if($regulator_rate)
                {
                    $totalitem = $totalitem + 1;
                    $regulator_amount = $regulator_rate * $regulator_pice;
                }
                else
                {
                    $regulator_amount = 0;
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
                
                return redirect(route('receipt_list',['user_type'=>$user_type]))->with([
                    'success' => '<strong>New</strong> details has been added successfully.'
                ]);
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

    public function receipt_list($user_type = null)
    {   
        

        $user_type =( isset($user_type) ) ? $user_type : "General" ;

        if($user_type != "General" && $user_type != "Registered")
        {
            return redirect(route('home'));
        }

        if ($user_type == "General")
        {
            $data = DB::table('orders')
            ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
            ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
            ->select('user_billing_address.name','orders.id', 'orders.recipt_no','orders.totalitem','orders.discount','orders.totalprice','oredr_basic_details.payment_mode','orders.invice_date','orders.order_remark')                                                                
            ->orderByDesc('orders.invice_date')
            ->where('orders.status',3)
            ->get();
        }
        if($user_type == "Registered")
        {
            $data = DB::table('register_user_order')
            ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
            ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
            ->select('register_billing_address.name','register_user_order.id', 'register_user_order.recipt_no','register_user_order.totalitem','register_user_order.discount','register_user_order.totalprice','register_other_basic_details.payment_mode','register_user_order.invice_date','register_user_order.order_remark')                                                                
            ->orderByDesc('register_user_order.invice_date')
            ->where('register_user_order.status',3)
            ->get();
        }
        return view('receipt_list',['data'=>$data,'user_type'=>$user_type]);
    }

    public function edit_receipt($user_type,$id)
    {
        if($user_type=="General")
        {
            $order = Order::where('id', $id)->first();
            $orderItem = OrderItem::where('order_id', $id)->get();
            $otherItem = OtherOrderItem::where('order_id', $id)->get();
            $basicDetail = OtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = UserBillingAddress::where('order_id', $id)->first();
        }
        if($user_type=="Registered")
        {
            $order = RegisterUserOrder::where('id', $id)->first();
            $orderItem = RegisterUserOrderItem::where('order_id', $id)->get();
            $otherItem = RegisterOtherOrderItem::where('order_id', $id)->get();
            $basicDetail = RegisterOtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = RegisterBillingAddress::where('order_id', $id)->first();
        }

        if (!isset($order) || !isset($orderItem) || !isset($otherItem) || !isset($billingAddress)) {
            return redirect(route('receipt_list',['user_type'=>$user_type]))->with('error', 'One or more required records were not found.');
        }

        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();

        return view('edit_receipt', ['id'=>$id,'user_type'=>$user_type,'order'=>$order,'orderItem'=>$orderItem,'otherItem'=>$otherItem,'billingAddress'=>$billingAddress,'basicDetail'=>$basicDetail,'products'=>$products]);
    }

    public function update_receipt($user_type , $id , Request $request)
    {   

        $login_id = Auth::user()->id;
        if(isset($request->Update))
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
                else
                {
                    $cylinder_amount = 0;
                }	
                if($regulator_rate)
                {
                    $totalitem = $totalitem + 1;
                    $regulator_amount = $regulator_rate * $regulator_pice;
                }
                else
                {
                    $regulator_amount = 0;
                }
                
                $order_amount = 0;
                $order_amount = $order_amount + $cylinder_amount + $regulator_amount;
                
                if($user_type=="General")
                {
                    
                    $otherItems = OtherOrderItem::where('order_id', $id)->get();
                    foreach ($otherItems as $otherItem) {
                        $otherItem->delete();
                    }
                    $orderItems = OrderItem::where('order_id', $id)->get();
                    foreach ($orderItems as $Item) {
                        $Item->delete();
                    }

                    $order = Order::where('id', $id)->first();
                    $otherItem = new OtherOrderItem();
                    $otherItem2 = new OtherOrderItem();
                }
                if($user_type=="Registered")
                {
                    
                    $otherItems = RegisterOtherOrderItem::where('order_id', $id)->get();
                    foreach ($otherItems as $otherItem) {
                        $otherItem->delete();
                    }  
                    $orderItems = RegisterUserOrderItem::where('order_id', $id)->get();
                    foreach ($orderItems as $Item) {
                        $Item->delete();
                    }
                    
                    $order =  RegisterUserOrder::where('id', $id)->first();
                    $otherItem= new RegisterOtherOrderItem();
                    $otherItem2= new RegisterOtherOrderItem();
                }
                       
                $order->admin_id = $login_id;
                $order->totalitem = $totalitem;
                $order->discount = $discount_price;
                $order->status = 3;
                $order->order_remark = $remark; 
                $order->user_type = $user_type;
                $order->recipt_no = $recipt_no;
                $order->totalprice = $totalprice;
                $order->payment_mode = $payment_mode;
     
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
                        "name" => $billing_name,
                        "number" => $billing_number,
                        "billing_address" => $billing_address,
                        "shipping_address" => $shippeing_address,
                        "state" => $billing_state
                    ];   
                    if ($user_type == "General") {
                        UserBillingAddress::updateOrCreate(['order_id' => $order_id], $data);
                    } elseif ($user_type == "Registered") {
                        RegisterBillingAddress::updateOrCreate(['order_id' => $order_id], $data);
                    }
                } 
                //End Insert Billing Address details........................................			


                // Insert Invoice Details.........................................................  
                if ($user_type == "General") {
                    $invoice_date = Order::where('id', $order_id)->value('invice_date');       
                } elseif ($user_type == "Registered") {
                    $invoice_date = RegisterUserOrder::where('id', $order_id)->value('invice_date');
                }     
               
                if($invoice_date=="0000-00-00" || $invoice_date=="")
                {
                    dd($invoice_date,'invalid invoice date');
                    return redirect( route('home') );
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
                
                    $dataToUpdate = [
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
                
                    DB::table($table_name)->where('o_id', $order_id)->update($dataToUpdate);
                }

                // End of Insert invoice details...............................................
                
                return redirect(route('receipt_list', ['user_type' => $user_type]))->with([
                    'success' => '<strong>New</strong> details has been updated successfully.'
                ]);
            }
        }

    
    }

    public function view_receipt($user_type,$id)
    {

        if($user_type=="General")
        {
            $order = Order::where('id', $id)->first();
            $orderItem = OrderItem::where('order_id', $id)->get();
            $otherItem = OtherOrderItem::where('order_id', $id)->get();
            $basicDetail = OtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = UserBillingAddress::where('order_id', $id)->first();
        }
        if($user_type=="Registered")
        {
            $order = RegisterUserOrder::where('id', $id)->first();
            $orderItem = RegisterUserOrderItem::where('order_id', $id)->get();
            $otherItem = RegisterOtherOrderItem::where('order_id', $id)->get();
            $basicDetail = RegisterOtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = RegisterBillingAddress::where('order_id', $id)->first();
        }

        $products=[]; 
        foreach($orderItem as $order_item)
        {
            $product =Product::where('id',$order_item->product_id)->first();
            $products[]=$product; 
        }

        $total_values=[];

        $total_amount_before_tax=0;
        $total_taxable_value=0;
        $total_cgst=0;
        $total_sgst=0;   
        $total_qty =0;
        
        foreach($otherItem as $item)
        {
            $total_qty += $item->pro_qty;
            $total_amount_before_tax += $item->rate*$item->pro_qty;
        }
        foreach($orderItem as $item)
        {
            $total_qty += $item->qty;
            $total_amount_before_tax += $item->rate*$item->qty;
            $total_taxable_value += $item->rate*$item->qty;
            $total_cgst += $item->cgst_amount;
            $total_sgst += $item->sgst_amount;
        }
        $total_amount_after_tax = $total_amount_before_tax + $total_cgst + $total_sgst;

        $total_values = [
            'total_amount_before_tax' => $total_amount_before_tax,
            'total_amount_after_tax' => $total_amount_after_tax,
            'total_taxable_value' => $total_taxable_value,
            'total_cgst' => $total_cgst,
            'total_sgst' => $total_sgst,
            'total_qty' => $total_qty,
        ];
          

        if (!isset($order) || !isset($orderItem) || !isset($otherItem) || !isset($billingAddress)) {
            return redirect(route('receipt_list',['user_type'=>$user_type]))->with('error', 'One or more required records were not found.');
        }

        $loggedInUserId = Auth::user()->id;
        $company_detail = CompanyDetail::where('admin_id', $loggedInUserId)->first();

        return view('view_receipt', ['total_values'=>$total_values,'products'=>$products,'company_detail'=>$company_detail,'id'=>$id,'user_type'=>$user_type,'order'=>$order,'order_items'=>$orderItem,'other_items'=>$otherItem,'billing_address'=>$billingAddress,'basic_detail'=>$basicDetail,'products'=>$products]);
    }
    
    public function receipt_pdf($user_type,$id)
    {

        if($user_type=="General")
        {
            $order = Order::where('id', $id)->first();
            $orderItem = OrderItem::where('order_id', $id)->get();
            $otherItem = OtherOrderItem::where('order_id', $id)->get();
            $basicDetail = OtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = UserBillingAddress::where('order_id', $id)->first();
        }
        if($user_type=="Registered")
        {
            $order = RegisterUserOrder::where('id', $id)->first();
            $orderItem = RegisterUserOrderItem::where('order_id', $id)->get();
            $otherItem = RegisterOtherOrderItem::where('order_id', $id)->get();
            $basicDetail = RegisterOtherBasicDetail::where('o_id', $id)->first();
            $billingAddress = RegisterBillingAddress::where('order_id', $id)->first();
        }

        $products=[]; 
        foreach($orderItem as $order_item)
        {
            $product =Product::where('id',$order_item->product_id)->first();
            $products[]=$product; 
        }

        $total_values=[];

        $total_amount_before_tax=0;
        $total_taxable_value=0;
        $total_cgst=0;
        $total_sgst=0;   
        $total_qty =0;
        
        foreach($otherItem as $item)
        {
            $total_qty += $item->pro_qty;
            $total_amount_before_tax += $item->rate*$item->pro_qty;
        }
        foreach($orderItem as $item)
        {
            $total_qty += $item->qty;
            $total_amount_before_tax += $item->rate*$item->qty;
            $total_taxable_value += $item->rate*$item->qty;
            $total_cgst += $item->cgst_amount;
            $total_sgst += $item->sgst_amount;
        }
        $total_amount_after_tax = $total_amount_before_tax + $total_cgst + $total_sgst;

        $total_values = [
            'total_amount_before_tax' => $total_amount_before_tax,
            'total_amount_after_tax' => $total_amount_after_tax,
            'total_taxable_value' => $total_taxable_value,
            'total_cgst' => $total_cgst,
            'total_sgst' => $total_sgst,
            'total_qty' => $total_qty,
        ];
          

        if (!isset($order) || !isset($orderItem) || !isset($otherItem) || !isset($billingAddress)) {
            return redirect(route('receipt_list',['user_type'=>$user_type]))->with('error', 'One or more required records were not found.');
        }

        $loggedInUserId = Auth::user()->id;
        $company_detail = CompanyDetail::where('admin_id', $loggedInUserId)->first();



        $pdf = app('dompdf.wrapper'); 
        // return View('receipt_pdf', ['total_values'=>$total_values,'products'=>$products,'company_detail'=>$company_detail,'id'=>$id,'user_type'=>$user_type,'order'=>$order,'order_items'=>$orderItem,'other_items'=>$otherItem,'billing_address'=>$billingAddress,'basic_detail'=>$basicDetail,'products'=>$products]);
        $pdf->loadView('receipt_pdf', ['total_values'=>$total_values,'products'=>$products,'company_detail'=>$company_detail,'id'=>$id,'user_type'=>$user_type,'order'=>$order,'order_items'=>$orderItem,'other_items'=>$otherItem,'billing_address'=>$billingAddress,'basic_detail'=>$basicDetail,'products'=>$products])->setOptions(['defaultFont' => '']);
        // return $pdf->download('receipt.pdf');
        return $pdf->download('receipt.pdf');

    }

    public function cancel_receipt($user_type,$id)
    {
        if($user_type!='General' && $user_type!='Registered')
        {
            return redirect(route('receipt_list'))->with(['error'=>'Invalid User Type !']);
        }
        if($user_type=='General')
        {
            $receipt = Order::where('id',$id)->first();
        }
        if($user_type=='Registered')
        {
            $receipt = RegisterUserOrder::where('id',$id)->first();
        }
        if(!$receipt)
        {
            return redirect(route('receipt_list'))->with(['error'=>'Receipt not found in database !']);
        }
        if($user_type=='General')
        {
            Order::updateOrCreate(['id' => $id], ['status'=>'2']);
        }
        if($user_type=='Registered')
        {
            RegisterUserOrder::updateOrCreate(['id' => $id], ['status'=>'2']);
        }
        return redirect(route('receipt_list'))->with(['success'=>'invoice canceled successfully !']);

    }

    public function cancel_list($user_type = null)
    {   
        

        $user_type =( isset($user_type) ) ? $user_type : "General" ;

        if($user_type != "General" && $user_type != "Registered")
        {
            return redirect(route('home'));
        }

        if ($user_type == "General")
        {
            $data = DB::table('orders')
            ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
            ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
            ->select('user_billing_address.name','orders.id', 'orders.recipt_no','orders.totalitem','orders.discount','orders.totalprice','oredr_basic_details.payment_mode','orders.invice_date','orders.order_remark')                                                                
            ->orderByDesc('orders.invice_date')
            ->where('orders.status',2)
            ->get();
        }
        if($user_type == "Registered")
        {
            $data = DB::table('register_user_order')
            ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
            ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
            ->select('register_billing_address.name','register_user_order.id', 'register_user_order.recipt_no','register_user_order.totalitem','register_user_order.discount','register_user_order.totalprice','register_other_basic_details.payment_mode','register_user_order.invice_date','register_user_order.order_remark')                                                                
            ->orderByDesc('register_user_order.invice_date')
            ->where('register_user_order.status',2)
            ->get();
        }
        return view('cancel_list',['data'=>$data,'user_type'=>$user_type]);
    }

    public function search_by_date(Request $request)
    {
        if(!isset($request->search))
        {
            return redirect(route('receipt_list'));
        }
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $user_type = $request->user_type;

        if($user_type != "General" && $user_type != "Registered")
        {
            return redirect(route('home'));
        }

        if ($user_type == "General")
        {
            $data = DB::table('orders')
            ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
            ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
            ->select('user_billing_address.name','orders.id', 'orders.recipt_no','orders.totalitem','orders.discount','orders.totalprice','oredr_basic_details.payment_mode','orders.invice_date','orders.order_remark')                                                                
            ->orderByDesc('orders.invice_date')
            ->where('orders.status',3)
            ->whereBetween('orders.invice_date', [$from_date, $to_date])
            ->get();
        }
        if($user_type == "Registered")
        {
            $data = DB::table('register_user_order')
            ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
            ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
            ->select('register_billing_address.name','register_user_order.id', 'register_user_order.recipt_no','register_user_order.totalitem','register_user_order.discount','register_user_order.totalprice','register_other_basic_details.payment_mode','register_user_order.invice_date','register_user_order.order_remark')                                                                
            ->orderByDesc('register_user_order.invice_date')
            ->where('register_user_order.status',3)
            ->whereBetween('register_user_order.invice_date', [$from_date, $to_date])
            ->get();
        }
        return view('receipt_list',['data'=>$data,'user_type'=>$user_type]);
        
    }

    public function search_cancel_receipts(Request $request)
    {
        if(!isset($request->search))
        {
            return redirect(route('cancel_list'));
        }
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $user_type = $request->user_type;

        if($user_type != "General" && $user_type != "Registered")
        {
            return redirect(route('home'));
        }

        if ($user_type == "General")
        {
            $data = DB::table('orders')
            ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
            ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
            ->select('user_billing_address.name','orders.id', 'orders.recipt_no','orders.totalitem','orders.discount','orders.totalprice','oredr_basic_details.payment_mode','orders.invice_date','orders.order_remark')                                                                
            ->orderByDesc('orders.invice_date')
            ->where('orders.status',2)
            ->whereBetween('orders.invice_date', [$from_date, $to_date])
            ->get();
        }
        if($user_type == "Registered")
        {
            $data = DB::table('register_user_order')
            ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
            ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
            ->select('register_billing_address.name','register_user_order.id', 'register_user_order.recipt_no','register_user_order.totalitem','register_user_order.discount','register_user_order.totalprice','register_other_basic_details.payment_mode','register_user_order.invice_date','register_user_order.order_remark')                                                                
            ->orderByDesc('register_user_order.invice_date')
            ->where('register_user_order.status',2)
            ->whereBetween('register_user_order.invice_date', [$from_date, $to_date])
            ->get();
        }
        return view('cancel_list',['data'=>$data,'user_type'=>$user_type]);
        
    }

    public function add_stock()
    {
        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();
        return view('add_stock' ,['products' => $products]);
    }

    protected function create_stock( Request $request)
    {
        $id = $request->prid;
        
        $current_time = Carbon::now();
        $current_time = $current_time->toDateTimeString();
        
        $data_for_stock = [
            "admin_id" => Auth::user()->id,
            "product_id" => $this->get_control_value('prid',$request),
            "gmqty" =>  $this->get_control_value('gmqty',$request),
            "unit" => $this->get_control_value('unit',$request),
            "base_qty" =>  $this->get_control_value('base_qty',$request),
            "date" => $current_time,

        ];
        $data_for_stock_details = [
            "admin_id" => Auth::user()->id,
            "product_id" => $this->get_control_value('prid',$request),
            "gmqty" =>  $this->get_control_value('gmqty',$request),
            "unit" => $this->get_control_value('unit',$request),
            "invoice_number" =>  $this->get_control_value('in_number',$request),
            "vendor_name" => $this->get_control_value('name',$request),
            "invoice_date" =>  $this->get_control_value('invoice_date',$request),
            "date" => $current_time,
        ]; 

        $stock = Stock::where('product_id',$id)->first();
        if($stock)
        {
            $data_for_stock['gmqty'] += $stock['gmqty'] ;
        }

        $invoice = stockDetail::where('invoice_number',$request->in_number)->first();
        if($invoice)
        {
            return redirect(route('add_stock'))->with(['error'=>'invoice number already exists']);
        }

        Stock::updateOrCreate(['product_id' => $id], $data_for_stock);
        stockDetail::Create($data_for_stock_details);

        return redirect(route('purchased_stock'))->with([
            'success' => ' Stock has been added successfully.'
        ]);

    }

    public function available_stock()
    {
        $stock = DB::table('stock')
        ->join('products', 'stock.product_id', '=', 'products.id')
        ->select('stock.gmqty', 'products.title')
        ->get();
        return view('available_stock',['stock'=>$stock]);
    }

    public function purchased_stock()
    {
        $stock = DB::table('stock_details')
        ->join('products', 'stock_details.product_id', '=', 'products.id')
        ->select('stock_details.id','stock_details.invoice_date','stock_details.invoice_number','stock_details.vendor_name','products.title','stock_details.gmqty')
        ->orderByDesc('stock_details.invoice_date')
        ->get();
        return view('purchased_stock',['stock'=>$stock]);
    }

    public function edit_stock(Request $request)
    {
        $id = $request->id;
        $stock = stockDetail::where('id',$id)->first();

        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();

       

        if(!$stock)
        {
            return redirect(route('purchased_stock'))->with(['error' => ' stock not found. ']);
        }

        return view('edit_stock',['stock'=>$stock,'products'=>$products]);
    }

    public function update_stock(Request $request)
    {
        $id = $request->id;
        $current_time = Carbon::now();
        $current_time = $current_time->toDateTimeString();

        $old_details = stockDetail::where('id',$id)->first(); 

        if(!$old_details)
        {
            return redirect(route('purchased_stock'))->with(['errro'=>'details not found !']);
        }      

        $new_details = [
            "admin_id" => Auth::user()->id,
            "product_id" => $this->get_control_value('prid',$request),
            "gmqty" =>  $this->get_control_value('gmqty',$request),
            "unit" => $this->get_control_value('unit',$request),
            "invoice_number" =>  $this->get_control_value('in_number',$request),
            "vendor_name" => $this->get_control_value('name',$request),
            "invoice_date" =>  $this->get_control_value('invoice_date',$request),
            "date" => $current_time,
        ];

        if($new_details['product_id']==$old_details['product_id'])
        {   
            $stock = Stock::where('product_id',$old_details['product_id'])->first();   
            $new_gmqty_in_stock = $stock['gmqty'] - $old_details['gmqty'] + $new_details['gmqty'];
            $stock->gmqty = $new_gmqty_in_stock;
            $stock->save();
        }
        else
        {
            $stock_old_product = Stock::where('product_id',$old_detials['product_id'])->first(); 
            $stock_old_product->gmqty =  $stock_old_product->gmqty - $old_detials['gmqty'];
            $stock_old_product->save();

            $new_product_stock = Stock::where('product_id',$new_details['product_id'])->first();
            if(!$new_product_stock) 
            {
                $data_for_stock = [
                    "admin_id" => Auth::user()->id,
                    "product_id" => $this->get_control_value('prid',$request),
                    "gmqty" =>  $this->get_control_value('gmqty',$request),
                    "unit" => $this->get_control_value('unit',$request),
                    "base_qty" =>  $this->get_control_value('base_qty',$request),
                    "date" => $current_time,
        
                ];
                Stock::create($data_for_stock);
            }
            else
            {
                $new_product_stock->gmqty += $new_details['gmqty'];
                $new_product_stock->save();
            }
            
        }

        stockDetail::updateOrCreate(['id' => $id], $new_details);     

        return redirect(route('purchased_stock'))->with(['success'=>'Details updated successfully !']);
    }

    public function sale_report(Request $request)
    {
        $from_date = date("Y-m-d");
        $to_date = date("Y-m-d");
       
        if($request->search)
        {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
        }

        $general_user_data = DB::table('orders')->whereBetween('orders.invice_date', [$from_date, $to_date])
        ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
        ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
        ->select('user_billing_address.name','oredr_basic_details.sv_number','orders.id', 'orders.recipt_no','orders.discount','orders.totalprice','orders.invice_date','orders.order_remark')                                                                
        ->orderByDesc('orders.invice_date')
        ->where('orders.status',3)
        ->get();     

        $order_products=[];
        foreach($general_user_data as $row)
        {
            $id = ($row->id );
            $order_products[$row->recipt_no] = DB::table('order_item')->where('order_id',$id)
            ->join('products','order_item.product_id','=','products.id')
            ->select('order_item.*','products.title')
            ->get();
        }   

        $register_user_data = DB::table('register_user_order')->whereBetween('register_user_order.invice_date', [$from_date, $to_date])
        ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
        ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
        ->select('register_billing_address.name','register_other_basic_details.sv_number','register_user_order.id', 'register_user_order.recipt_no','register_user_order.discount','register_user_order.totalprice','register_user_order.invice_date','register_user_order.order_remark')                                                                
        ->orderByDesc('register_user_order.invice_date')
        ->where('register_user_order.status',3)
        ->get();     

        $register_order_products=[];
        foreach($register_user_data as $row)
        {
            $id = ($row->id );
            $register_order_products[$row->recipt_no] = DB::table('register_user_order_item')->where('order_id',$id)
            ->join('products','register_user_order_item.product_id','=','products.id')
            ->select('register_user_order_item.*','products.title')
            ->get();
        }   

        $loggedInUserId = Auth::user()->id;
        $products = Product::where('admin_id', $loggedInUserId)
        ->where('status','1')->get();

        $merged_data = $general_user_data->concat($register_user_data);
        $merged_data = $merged_data->sortBy('invice_date');
        $merged_order_products = array_merge($order_products,$register_order_products);

        return view('sale_report', ['from_date'=>$from_date,'to_date'=>$to_date, 'products' => $products , 'merged_data'=>$merged_data, 'merged_order_products'=>$merged_order_products ]);
    }

    public function report_export(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        ob_end_clean(); 
        ob_start();
        return Excel::download(new ReportExport($from_date,$to_date), 'report-'.$from_date.'-'.$to_date.'.xls' );
    }

    public function general_report()
    {
        $sale_today = 0;
        $today = now()->format('Y-m-d'); 

        $orders = Order::where('invice_date', $today)
        ->select('totalprice', 'discount')
        ->get();
        foreach ($orders as $order) {
            $sale_today += $order->totalprice - $order->discount;
        }
        $register_user_order = RegisterUserOrder::where('invice_date', $today)
        ->select('totalprice', 'discount')
        ->get();
        foreach ($register_user_order as $order) {
            $sale_today += $order->totalprice - $order->discount;
        }


        $sale_this_month = 0;
        $month_start_date =  now()->startOfMonth()->format('Y-m-d'); 

        $orders_this_month = Order::whereBetween('invice_date', [$month_start_date, $today])
        ->select('totalprice', 'discount')
        ->where('status',3)
        ->get();
        foreach ($orders_this_month as $order) {
            $sale_this_month += $order->totalprice - $order->discount;
        }
        $register_user_month_orders = RegisterUserOrder::whereBetween('invice_date', [$month_start_date, $today])
        ->select('totalprice', 'discount')
        ->where('status',3)
        ->get();
        foreach ($register_user_month_orders as $order) {
            $sale_this_month += $order->totalprice - $order->discount;
        }


        $sale_till_date = 0;
        $orders_this_month = Order::select('totalprice', 'discount')
        ->where('status',3)
        ->get();
        foreach ($orders_this_month as $order) {
            $sale_till_date += $order->totalprice - $order->discount;
        }
        $register_user_month_orders = RegisterUserOrder::select('totalprice', 'discount')
        ->where('status',3)
        ->get();
        foreach ($register_user_month_orders as $order) {
            $sale_till_date += $order->totalprice - $order->discount;
        }

        $from_date = date("Y-m-d");
        $to_date = date("Y-m-d");

        return view('general_report',['sale_today'=>$sale_today,'sale_this_month'=>$sale_this_month,'sale_till_date'=>$sale_till_date]);
    }
  
}
