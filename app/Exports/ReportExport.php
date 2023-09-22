<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView,ShouldAutoSize
{
    use Exportable;

    protected $from_date ;
    protected $to_date;
    public function __construct($from_date,$to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        
    }
    
    public function view(): View
    {

        $general_user_data = DB::table('orders')->whereBetween('orders.invice_date', [$this->from_date, $this->to_date])
        ->join('user_billing_address', 'orders.id', '=', 'user_billing_address.order_id')
        ->join('oredr_basic_details', 'orders.id', '=', 'oredr_basic_details.o_id')
        ->select('user_billing_address.name','oredr_basic_details.sv_number','oredr_basic_details.content_type','orders.id', 'orders.recipt_no','orders.discount','orders.totalprice','orders.invice_date','orders.order_remark')                                                                
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

        $register_user_data = DB::table('register_user_order')->whereBetween('register_user_order.invice_date', [$this->from_date, $this->to_date])
        ->join('register_billing_address', 'register_user_order.id', '=', 'register_billing_address.order_id')
        ->join('register_other_basic_details', 'register_user_order.id', '=', 'register_other_basic_details.o_id')
        ->select('register_billing_address.name','register_other_basic_details.sv_number','register_other_basic_details.content_type','register_user_order.id', 'register_user_order.recipt_no','register_user_order.discount','register_user_order.totalprice','register_user_order.invice_date','register_user_order.order_remark')                                                                
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


        return view('exports.excel_report', ['products' => $products , 'merged_data'=>$merged_data, 'merged_order_products'=>$merged_order_products]);
    }
}
