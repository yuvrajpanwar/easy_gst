@extends('layouts.app')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('title')
    Dashboard
@endsection

@push('css')
    <style>
        .add_delete_box {
            width: 5%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .row_con_mrg {
            margin-bottom: 35px;
        }

        .sel_distri {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .title_allign {
            text-align: left !important;
        }
    </style>
    <style>
        .label {
            margin: 0 20px 0 10px;

            padding: 3px 5px 2px;
            background-color: #F66;
        }
    </style>
@endpush


@section('content')

    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-plus-square"></i> Generate Receipt      
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle fa-fw"></i> Add Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <form id="form" action="" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="col-lg-12" id="row_container">
                                    <div class="form-group row_con_mrg">
                                        <div class="col-lg-4">
                                            <label>Security Deposit For All Cylinder</label>
                                            <input class="text-input form-control" type="hidden" name="cylinder_name"
                                                value="Security Deposit cylinder" autocomplete="off" id="cylinder_name"
                                                placeholder="Security Deposit cylinder" readonly />
                                        </div>
                                        <div class="col-lg-2">
                                            <input class="text-input form-control" type="text" name="cylinder_rate"
                                                value="" autocomplete="off" id="cylinder_rate" placeholder="SUM" />

                                        </div>
                                        <div class="col-lg-2">
                                            <label>Cylinder Count</label>
                                        </div>
                                        <div class="col-lg-1" style="width: 95px;">
                                            <select name="cylinder_pice" id="cylinder_pice"
                                                class="cylinder_pice form-control">
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                                <option value='11'>11</option>
                                                <option value='12'>12</option>
                                                <option value='13'>13</option>
                                                <option value='14'>14</option>
                                                <option value='15'>15</option>
                                                <option value='16'>16</option>
                                                <option value='17'>17</option>
                                                <option value='18'>18</option>
                                                <option value='19'>19</option>
                                                <option value='20'>20</option>
                                                <option value='21'>21</option>
                                                <option value='22'>22</option>
                                                <option value='23'>23</option>
                                                <option value='24'>24</option>
                                                <option value='25'>25</option>
                                                <option value='26'>26</option>
                                                <option value='27'>27</option>
                                                <option value='28'>28</option>
                                                <option value='29'>29</option>
                                                <option value='30'>30</option>
                                                <option value='31'>31</option>
                                                <option value='32'>32</option>
                                                <option value='33'>33</option>
                                                <option value='34'>34</option>
                                                <option value='35'>35</option>
                                                <option value='36'>36</option>
                                                <option value='37'>37</option>
                                                <option value='38'>38</option>
                                                <option value='39'>39</option>
                                                <option value='40'>40</option>
                                                <option value='41'>41</option>
                                                <option value='42'>42</option>
                                                <option value='43'>43</option>
                                                <option value='44'>44</option>
                                                <option value='45'>45</option>
                                                <option value='46'>46</option>
                                                <option value='47'>47</option>
                                                <option value='48'>48</option>
                                                <option value='49'>49</option>
                                                <option value='50'>50</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row_con_mrg">
                                        <div class="col-lg-4">
                                            <label>Security Deposit For All Regulator</label>
                                            <input class="text-input form-control" type="hidden" name="regulator_name"
                                                value="Security Deposit regulator" autocomplete="off"
                                                id="regulator_name" placeholder="Security Deposit regulator" readonly />
                                        </div>
                                        <div class="col-lg-2">
                                            <input class="text-input form-control" type="text" name="regulator_rate"
                                                value="" autocomplete="off" id="regulator_rate" placeholder="SUM" />

                                        </div>
                                        <div class="col-lg-2">
                                            <label>Regulator Count</label>
                                        </div>
                                        <div class="col-lg-1" style="width: 95px;">
                                            <select name="regulator_pice" id="regulator_pice" class="form-control">
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>
                                                <option value='7'>7</option>
                                                <option value='8'>8</option>
                                                <option value='9'>9</option>
                                                <option value='10'>10</option>
                                                <option value='11'>11</option>
                                                <option value='12'>12</option>
                                                <option value='13'>13</option>
                                                <option value='14'>14</option>
                                                <option value='15'>15</option>
                                                <option value='16'>16</option>
                                                <option value='17'>17</option>
                                                <option value='18'>18</option>
                                                <option value='19'>19</option>
                                                <option value='20'>20</option>
                                                <option value='21'>21</option>
                                                <option value='22'>22</option>
                                                <option value='23'>23</option>
                                                <option value='24'>24</option>
                                                <option value='25'>25</option>
                                                <option value='26'>26</option>
                                                <option value='27'>27</option>
                                                <option value='28'>28</option>
                                                <option value='29'>29</option>
                                                <option value='30'>30</option>
                                                <option value='31'>31</option>
                                                <option value='32'>32</option>
                                                <option value='33'>33</option>
                                                <option value='34'>34</option>
                                                <option value='35'>35</option>
                                                <option value='36'>36</option>
                                                <option value='37'>37</option>
                                                <option value='38'>38</option>
                                                <option value='39'>39</option>
                                                <option value='40'>40</option>
                                                <option value='41'>41</option>
                                                <option value='42'>42</option>
                                                <option value='43'>43</option>
                                                <option value='44'>44</option>
                                                <option value='45'>45</option>
                                                <option value='46'>46</option>
                                                <option value='47'>47</option>
                                                <option value='48'>48</option>
                                                <option value='49'>49</option>
                                                <option value='50'>50</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row_con_mrg">
                                        <div class="col-lg-6">
                                            <label>Select User Type</label>
                                            <select class="text-input form-control" name="user_type" id="user_type">
                                                <option value="">Select User Type</option>
                                                <option value="General">General</option>
                                                <option value="Registered">Registered</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row_con_mrg" id="rowCount0">
                                        <h4><b>Product Details</b></h4>
                                        <div class="form-group">

                                            <!--<table class='table invite_contact_list'>-->
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Rate</th>
                                                            <th>CGST</th>
                                                            <th>SGST</th>
                                                            <th>Amount</th>
                                                            <th>Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="odd gradeX">
                                                            <td><input type='checkbox' name='all' id='allcheck'
                                                                    value="all"> All</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        @php
                                                            $count =1;
                                                        @endphp
                                                        @foreach ($products as $product)

                                                            <tr class="odd gradeX">
                                                                <td>
                                                                    <input type='checkbox' name='pro_name[]'
                                                                        class='contact_check roles' id="product-{{$count}}"
                                                                        value='{{$product->id}}'> {{$product->title}}
                                                                </td>

                                                                <td>
                                                                    <label id="price_lb-{{$count}}">{{$product->price}}</label>
                                                                    
                                                                </td>

                                                                <td>
                                                                    <label id="cgst_lb-{{$count}}">{{$product->price * $product->cgst_tax / 100}}</label>
                                                                    
                                                                </td>

                                                                <td>
                                                                    <label id="sgst_lb-{{$count}}">{{$product->price * $product->sgst_tax / 100}}</label>
                                                                
                                                                </td>

                                                                <td>
                                                                    <label id="total_amount_lb-{{$count}}">{{$product->price+($product->price * $product->cgst_tax / 100)+($product->price * $product->sgst_tax / 100)}}</label>
                                                                
                                                                </td>

                                                                <td>
                                                                
                                                                    <select name="{{$product->id}}" class="total_pices total_pices-{{$product->id}}" id="total_pices-{{$count}}">
                                                                        <option value='1'>1</option>
                                                                        <option value='2'>2</option>
                                                                        <option value='3'>3</option>
                                                                        <option value='4'>4</option>
                                                                        <option value='5'>5</option>
                                                                        <option value='6'>6</option>
                                                                        <option value='7'>7</option>
                                                                        <option value='8'>8</option>
                                                                        <option value='9'>9</option>
                                                                        <option value='10'>10</option>
                                                                        <option value='11'>11</option>
                                                                        <option value='12'>12</option>
                                                                        <option value='13'>13</option>
                                                                        <option value='14'>14</option>
                                                                        <option value='15'>15</option>
                                                                        <option value='16'>16</option>
                                                                        <option value='17'>17</option>
                                                                        <option value='18'>18</option>
                                                                        <option value='19'>19</option>
                                                                        <option value='20'>20</option>
                                                                        <option value='21'>21</option>
                                                                        <option value='22'>22</option>
                                                                        <option value='23'>23</option>
                                                                        <option value='24'>24</option>
                                                                        <option value='25'>25</option>
                                                                        <option value='26'>26</option>
                                                                        <option value='27'>27</option>
                                                                        <option value='28'>28</option>
                                                                        <option value='29'>29</option>
                                                                        <option value='30'>30</option>
                                                                        <option value='31'>31</option>
                                                                        <option value='32'>32</option>
                                                                        <option value='33'>33</option>
                                                                        <option value='34'>34</option>
                                                                        <option value='35'>35</option>
                                                                        <option value='36'>36</option>
                                                                        <option value='37'>37</option>
                                                                        <option value='38'>38</option>
                                                                        <option value='39'>39</option>
                                                                        <option value='40'>40</option>
                                                                        <option value='41'>41</option>
                                                                        <option value='42'>42</option>
                                                                        <option value='43'>43</option>
                                                                        <option value='44'>44</option>
                                                                        <option value='45'>45</option>
                                                                        <option value='46'>46</option>
                                                                        <option value='47'>47</option>
                                                                        <option value='48'>48</option>
                                                                        <option value='49'>49</option>
                                                                        <option value='50'>50</option>
                                                                        <option value='51'>51</option>
                                                                        <option value='52'>52</option>
                                                                        <option value='53'>53</option>
                                                                        <option value='54'>54</option>
                                                                        <option value='55'>55</option>
                                                                        <option value='56'>56</option>
                                                                        <option value='57'>57</option>
                                                                        <option value='58'>58</option>
                                                                        <option value='59'>59</option>
                                                                        <option value='60'>60</option>
                                                                        <option value='61'>61</option>
                                                                        <option value='62'>62</option>
                                                                        <option value='63'>63</option>
                                                                        <option value='64'>64</option>
                                                                        <option value='65'>65</option>
                                                                        <option value='66'>66</option>
                                                                        <option value='67'>67</option>
                                                                        <option value='68'>68</option>
                                                                        <option value='69'>69</option>
                                                                        <option value='70'>70</option>
                                                                        <option value='71'>71</option>
                                                                        <option value='72'>72</option>
                                                                        <option value='73'>73</option>
                                                                        <option value='74'>74</option>
                                                                        <option value='75'>75</option>
                                                                        <option value='76'>76</option>
                                                                        <option value='77'>77</option>
                                                                        <option value='78'>78</option>
                                                                        <option value='79'>79</option>
                                                                        <option value='80'>80</option>
                                                                        <option value='81'>81</option>
                                                                        <option value='82'>82</option>
                                                                        <option value='83'>83</option>
                                                                        <option value='84'>84</option>
                                                                        <option value='85'>85</option>
                                                                        <option value='86'>86</option>
                                                                        <option value='87'>87</option>
                                                                        <option value='88'>88</option>
                                                                        <option value='89'>89</option>
                                                                        <option value='90'>90</option>
                                                                        <option value='91'>91</option>
                                                                        <option value='92'>92</option>
                                                                        <option value='93'>93</option>
                                                                        <option value='94'>94</option>
                                                                        <option value='95'>95</option>
                                                                        <option value='96'>96</option>
                                                                        <option value='97'>97</option>
                                                                        <option value='98'>98</option>
                                                                        <option value='99'>99</option>
                                                                        <option value='100'>100</option>
                                                                        <option value='101'>101</option>
                                                                        <option value='102'>102</option>
                                                                        <option value='103'>103</option>
                                                                        <option value='104'>104</option>
                                                                        <option value='105'>105</option>
                                                                        <option value='106'>106</option>
                                                                        <option value='107'>107</option>
                                                                        <option value='108'>108</option>
                                                                        <option value='109'>109</option>
                                                                        <option value='110'>110</option>
                                                                        <option value='111'>111</option>
                                                                        <option value='112'>112</option>
                                                                        <option value='113'>113</option>
                                                                        <option value='114'>114</option>
                                                                        <option value='115'>115</option>
                                                                        <option value='116'>116</option>
                                                                        <option value='117'>117</option>
                                                                        <option value='118'>118</option>
                                                                        <option value='119'>119</option>
                                                                        <option value='120'>120</option>
                                                                        <option value='121'>121</option>
                                                                        <option value='122'>122</option>
                                                                        <option value='123'>123</option>
                                                                        <option value='124'>124</option>
                                                                        <option value='125'>125</option>
                                                                        <option value='126'>126</option>
                                                                        <option value='127'>127</option>
                                                                        <option value='128'>128</option>
                                                                        <option value='129'>129</option>
                                                                        <option value='130'>130</option>
                                                                        <option value='131'>131</option>
                                                                        <option value='132'>132</option>
                                                                        <option value='133'>133</option>
                                                                        <option value='134'>134</option>
                                                                        <option value='135'>135</option>
                                                                        <option value='136'>136</option>
                                                                        <option value='137'>137</option>
                                                                        <option value='138'>138</option>
                                                                        <option value='139'>139</option>
                                                                        <option value='140'>140</option>
                                                                        <option value='141'>141</option>
                                                                        <option value='142'>142</option>
                                                                        <option value='143'>143</option>
                                                                        <option value='144'>144</option>
                                                                        <option value='145'>145</option>
                                                                        <option value='146'>146</option>
                                                                        <option value='147'>147</option>
                                                                        <option value='148'>148</option>
                                                                        <option value='149'>149</option>
                                                                        <option value='150'>150</option>
                                                                        <option value='151'>151</option>
                                                                        <option value='152'>152</option>
                                                                        <option value='153'>153</option>
                                                                        <option value='154'>154</option>
                                                                        <option value='155'>155</option>
                                                                        <option value='156'>156</option>
                                                                        <option value='157'>157</option>
                                                                        <option value='158'>158</option>
                                                                        <option value='159'>159</option>
                                                                        <option value='160'>160</option>
                                                                        <option value='161'>161</option>
                                                                        <option value='162'>162</option>
                                                                        <option value='163'>163</option>
                                                                        <option value='164'>164</option>
                                                                        <option value='165'>165</option>
                                                                        <option value='166'>166</option>
                                                                        <option value='167'>167</option>
                                                                        <option value='168'>168</option>
                                                                        <option value='169'>169</option>
                                                                        <option value='170'>170</option>
                                                                        <option value='171'>171</option>
                                                                        <option value='172'>172</option>
                                                                        <option value='173'>173</option>
                                                                        <option value='174'>174</option>
                                                                        <option value='175'>175</option>
                                                                        <option value='176'>176</option>
                                                                        <option value='177'>177</option>
                                                                        <option value='178'>178</option>
                                                                        <option value='179'>179</option>
                                                                        <option value='180'>180</option>
                                                                        <option value='181'>181</option>
                                                                        <option value='182'>182</option>
                                                                        <option value='183'>183</option>
                                                                        <option value='184'>184</option>
                                                                        <option value='185'>185</option>
                                                                        <option value='186'>186</option>
                                                                        <option value='187'>187</option>
                                                                        <option value='188'>188</option>
                                                                        <option value='189'>189</option>
                                                                        <option value='190'>190</option>
                                                                        <option value='191'>191</option>
                                                                        <option value='192'>192</option>
                                                                        <option value='193'>193</option>
                                                                        <option value='194'>194</option>
                                                                        <option value='195'>195</option>
                                                                        <option value='196'>196</option>
                                                                        <option value='197'>197</option>
                                                                        <option value='198'>198</option>
                                                                        <option value='199'>199</option>
                                                                        <option value='200'>200</option>

                                                                    </select>
                                                                </td>
                                                            </tr> 
                                                            @php
                                                                $count++;
                                                            @endphp       
                                                        @endforeach
                                                        

                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <label>Discount</label>
                                                <input class="text-input form-control" type="text" name="discount"
                                                    value="" autocomplete="off" id="discount" placeholder="Discount" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-6">
                                            <!--<input class="btn col-md-12 btn-primary" id="final_done" type="submit" name="add" value="Next" />-->
                                            <a class="btn col-md-12 btn-primary" id="products_sceren_next">Next</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12" id="userdetails_container" style="display:none;">
                                    <h4><b>User Details</b></h4>
                                    <div class="form-group row_con_mrg">

                                        <h5>Billing Address</h5>
                                        <div class="col-lg-6">
                                            <input class="text-input form-control" type="text" name="billing_name"
                                                value="" autocomplete="off" id="billing_name" placeholder="Name" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="text-input form-control" type="text" name="billing_number"
                                                value="" autocomplete="off" id="billing_number"
                                                placeholder="Mobile Number" />

                                        </div>


                                    </div>
                                    <div class="form-group">

                                        <div class="col-lg-6">
                                            <input class="text-input form-control" type="text" name="billing_address"
                                                value="" autocomplete="off" id="billing_address"
                                                placeholder="Address" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="text-input form-control" type="text" name="billing_state"
                                                value="Uttarakhand" autocomplete="off" id="billing_state" readonly
                                                placeholder="State" />
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <a class="btn col-md-12 btn-primary" id="back_product_details">Back</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <!--<input class="btn col-md-12 btn-primary" id="final_done" type="submit" name="add" value="Next" />-->
                                            <a class="btn col-md-12 btn-primary" id="user_sceren_next">Next</a>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12" id="invoice_details_container" style="display:none;">
                                    <h4><b>Invoice Detail</b></h4>

                                    <div class="form-group row_con_mrg">
                                        <div class="col-lg-6">
                                            <label>Invoice Date </label>
                                            <input class="text-input form-control datepicker" type="text"
                                                name="invoice_date" value="" autocomplete="off" id="invoice_date"
                                                placeholder="Invoice Date" />
                                            <input type="hidden" name="hdninvoice_date" id="hdninvoice_date" value="">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Reverse Charge </label>
                                            <select class="text-input form-control" name="r_charge" id="r_charge">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-lg-6">
                                            <label>Connection Type </label>
                                            <select class="text-input form-control" name="con_type" id="con_type">
                                                <option value="">Select Connection Type</option>
                                                <option value="NC">NC</option>
                                                <option value="DBC">DBC</option>
                                                <option value="Incoming TV">Incoming TV</option>
                                                <option value="NC-DBC">NC-DBC</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>SV Number </label>
                                            <input class="text-input form-control" type="text" name="sv_numver" value=""
                                                autocomplete="off" id="sv_numver" placeholder="SV Number" />
                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-lg-6">
                                            <label>Consumer Number </label>
                                            <input class="text-input form-control" type="text" name="consumer_number"
                                                value="" autocomplete="off" id="consumer_number"
                                                placeholder="Consumer Number" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Cust. GST Number </label>
                                            <input class="text-input form-control" type="text" name="gst_number"
                                                value="" autocomplete="off" id="gst_number"
                                                placeholder="Cust. GST Number" />
                                        </div>

                                    </div>

                                    <div class="form-group row_con_mrg">
                                        <div class="col-lg-6">
                                            <label for="text1" class="control-label col-lg-12"
                                                style="text-align: left;">Mode of payment</label>
                                            <input class="mode_control" type="radio" name="mode" value="cash"
                                                style="width: 40px; height: 1.2em;">Cash

                                            <input class="mode_control" type="radio" name="mode" id="bank_link"
                                                value="Bank" style="margin-left:15px; width: 40px; height: 1.2em;">Bank

                                            <input class="mode_control" type="radio" name="mode" id="both_link"
                                                value="Both" style="margin-left:15px; width: 40px; height: 1.2em;">Both

                                            <input class="mode_control" type="radio" name="mode" id="" value="Credit"
                                                style="margin-left:15px; width: 40px; height: 1.2em;">Credit


                                        </div>
                                        <div class="col-lg-6">
                                            <label>Remark </label>
                                            <textarea class="form-control col-lg-12" name="remark_text"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group amount_block" style="display:none;">
                                        <label  style="display:none;">Total Amount: <label id="order_amounts" style="display:none;"></label></label>
                                    </div>
                                    <div class="form-group amount_block" style="display:none;">

                                        <div class="col-lg-6">
                                            <label>Cash Amount </label>
                                            <input type="hidden" name="total_amount" id="total_amount" value="">
                                            <input class="text-input form-control" type="text" name="cash_amount"
                                                value="" autocomplete="off" id="cash_amount"
                                                placeholder="Cash Amount" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Bank Amount </label>
                                            <input class="text-input form-control" type="text" name="bank_amount"
                                                value="" autocomplete="off" id="bank_amount"
                                                placeholder="Bank Amount" />
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <a class="btn col-md-12 btn-primary" id="back_user_details">Back</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="btn col-md-8 btn-primary" id="final_done" type="submit"
                                                name="add" value="Done" />
                                        </div>

                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade bs-example-modal-lg" id="mediaModel" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-body">

                        <div class="mediafiles" id="mediaContents">
                            <form>
                                <input class="pull-left" id="file_upload" name="file_upload" type="file"
                                    multiple="true" />
                            </form>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="panel-heading">
                                        <label class="panel-title">Media Files</label>
                                    </div>
                                    <div id="mediafiles">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    
   

    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable({
                "bSort": false
            });

        });
    </script>
    <script>
    </script>
   <link rel="stylesheet" type="text/css" href="{{asset('public/plugins/uploadify/uploadify.css')}}">
    <script>
        $('#mediaModel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            $('#file_upload').uploadify({
                'formData': {
                    'timestamp': '',
                    'token': '6b79a77180e9ec3a7ca351ebe54641a2'
                },
                'swf': 'plugins/uploadify/uploadify.swf',
                'uploader': 'plugins/uploadify/uploadmedia.php',
                'onUploadSuccess': function (file, data, response) {
                    modal.find('#mediafiles').prepend(data);
                }
            });


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $.ajax({
                type: "POST",
                url: "plugins/media/load.php",
                data: {}
            })
                .done(function (msg) {
                    modal.find('#mediafiles').html(msg);
                });
            });

        $('#mediafiles').on('click', '.media-img', function (event) {
            var name = $(this).data("name");
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '<img src="' + name + '" />');
            $('#mediaModel').modal('hide')
        });
        tinymce.init({
            selector: "textarea#elm1",
            theme: "modern",
            width: '100%',
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                { title: 'Bold text', inline: 'b' },
                { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
                { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
                { title: 'Example 1', inline: 'span', classes: 'example1' },
                { title: 'Example 2', inline: 'span', classes: 'example2' },
                { title: 'Table styles' },
                { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
            ],
            convert_urls: false
        }); 
    </script>
    <script src="{{asset('public/i-js/jquery-ui.js')}}"></script>

    <script>
        $(function () {
            $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>
    <script>

        $(function () {
            var clickedOnce = false;
            $("#products_sceren_next").click(function () {
                var user_type = $("#user_type").val();
                var regulator_rate = $("#regulator_rate").val();

                if (user_type == "") {
                    alert("Please Select User Type");
                    return false;
                }
                else if ($('.roles:checkbox:checked').length == 0) {
                    alert("please Select at least one Product");
                    return false;
                }
                else {
                   
                    var order_amount = 0;
                    var total_product = $('.roles:checkbox:checked').length;
                    
                    
                    for (i = 1; i <= total_product + 1; i++) {

                        if ($('input#product-' + i).is(':checked')) {
                            var amount = $("#total_amount_lb-" + i).html();
                            order_amount = parseFloat(order_amount) + parseFloat(amount);

                        }

                    }
                    

                    var cylinder_amount = $("#cylinder_rate").val();
                    if (cylinder_amount) {
                        order_amount = parseFloat(order_amount) + parseFloat(cylinder_amount);
                    }
                    var regulator_amount = $("#regulator_rate").val();
                    if (regulator_amount) {
                        order_amount = parseFloat(order_amount) + parseFloat(regulator_amount);
                    }

                    var order_discount = $("#discount").val();
                    if (order_discount) {
                        order_amount = parseFloat(order_amount) - parseFloat(order_discount);
                    }

                    order_amount = Math.round(order_amount);

                    $("#order_amounts").html(order_amount);
                    $("#total_amount").val(order_amount);


                    $("#row_container").hide();
                    $("#invoice_details_container").hide();
                    $("#userdetails_container").show();
                    document.body.scrollTop = document.documentElement.scrollTop = 0;

                }


            });

            $("#back_product_details").click(function () {
                $("#userdetails_container").hide();
                $("#invoice_details_container").hide();
                $("#row_container").show();
            });

            $("#back_user_details").click(function () {
                $("#userdetails_container").show();
                $("#invoice_details_container").hide();
                $("#row_container").hide();
            });



            $("#user_sceren_next").click(function () {
                var decider = $("#decider").val();
                var billing_name = $("#billing_name").val();
                var billing_number = $("#billing_number").val();
                var billing_address = $("#billing_address").val();
                var billing_state = $("#billing_state").val();

                if (billing_name == "") {
                    alert("please Provide Billing Name");
                    return false;
                }
                else if (billing_address == "") {
                    alert("please Provide Billing Address");
                    return false;
                }
                else if (billing_state == "") {
                    alert("please Provide Billing State");
                    return false;
                }
                else {
                    $("#userdetails_container").hide();
                    $("#row_container").hide();
                    $("#invoice_details_container").show();
                }



            });


            $("#final_done").click(function () {

                if (clickedOnce) {
                    return false;
                }

                var invoice_date = $("#invoice_date").val();
                var hdninvoice_date = $("#hdninvoice_date").val();
                var con_type = $("#con_type").val();
                var res = invoice_date.split("-");
                var change_invoice_formate = res[2] + "-" + res[1] + "-" + res[0];
                var res1 = hdninvoice_date.split("-");
                var change_max_date = res1[2] + "-" + res1[1] + "-" + res1[0];


                if (invoice_date == "" || invoice_date == "00-00-0000") {
                    alert("please Select Invoice Date");
                    return false;
                }
                else if ((new Date(change_max_date).getTime() > new Date(change_invoice_formate).getTime())) {

                    alert("You can not create invoice of date less than " + hdninvoice_date);
                    return false;

                }
                else if (con_type == "") {
                    alert("please Select Content Type");
                    return false;
                }
            

                if ($('.mode_control').is(":checked")) {
                    var mode = $('input[name=mode]:checked').val();
                    if (mode == "Both") {
                        var cash_amount = $("#cash_amount").val();
                        var bank_amount = $("#bank_amount").val();
                        if (cash_amount == "") {
                            alert("Please provide Cash Amount.");
                            return false;
                        }
                        else if (bank_amount == "") {
                            alert("Please provide Bank Amount.");
                            return false;
                        }
                    }

                }
                else {
                    alert("Please select Mode Of Payment");
                    return false;

                }

                clickedOnce = true;
                return true;

            });


            $(".mode_control").click(function () {
                if ($('.mode_control').is(":checked")) {
                    var mode = $('input[name=mode]:checked').val();
                    if (mode == "Both") {
                        $(".amount_block").show();
                    }
                    else {
                        $(".amount_block").hide();
                    }

                }

            });


            $("#invoice_date").change(function () {

                var invoice_date = $("#invoice_date").val();
                var hdninvoice_date = $("#hdninvoice_date").val();
                var res = invoice_date.split("-");
                var change_invoice_formate = res[2] + "-" + res[1] + "-" + res[0];
                var res1 = hdninvoice_date.split("-");
                var change_max_date = res1[2] + "-" + res1[1] + "-" + res1[0];
                if ((new Date(change_max_date).getTime() > new Date(change_invoice_formate).getTime())) {

                    alert("You can not create invoice of date less than " + hdninvoice_date);
                    $("#invoice_date").val(hdninvoice_date);
                    return false;

                }
            });

            $("#cash_amount").change(function () {
                var total_amount = $("#total_amount").val();
                var cash_amount = $("#cash_amount").val();
                if (total_amount != "" && cash_amount != "") {
                    var amount = parseInt(total_amount) - parseInt(cash_amount);

                    $("#bank_amount").val(amount);
                }

            });


            $("#allcheck").click(function () {
                //alert("here");

                if ($("#allcheck").is(":checked")) {
                    $(".contact_check").prop('checked', true);
                }
                else {
                    $(".contact_check").prop('checked', false);
                }

            });


            $(".total_pices").change(function () {

                var id_of_gm_qty = $(this).attr("id");
                var pices = $("#" + id_of_gm_qty).val();
                var get_id = id_of_gm_qty.split('-');
                var count = get_id[1];
                var product_id = $("#product-" + count).val();

                if (product_id != "") {
                    var data = 'pro_id=' + product_id + '&pcs=' + pices;
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        url:`{!! route('calculate_amount') !!}`,
                        type: "POST",
                        data: data,
                        cache: false,
                        success: function (html) {
                            
                            if (html) {
                                //alert(html);
                                var get_return_value = html.split('-');
                                //alert(get_return_value);
                                var rate = get_return_value[0];
                                var cgst = get_return_value[1];
                                var sgst = get_return_value[2];
                                var total = get_return_value[3];
                                //alert(sgst);
                                $("#price-" + count).val(rate);
                                $("#cgst-" + count).val(cgst);
                                $("#sgst-" + count).val(sgst);

                                $("#total_amount-" + count).val(total);

                                $("#price_lb-" + count).html(rate);
                                $("#cgst_lb-" + count).html(cgst);
                                $("#sgst_lb-" + count).html(sgst);
                                $("#total_amount_lb-" + count).html(total);
                            }
                        }
                    });//End Ajax
                }

            });


            /* change the quantity of the refill */

            $("#cylinder_pice").change(function () {
                var product_to_change = 1;
                var change = $(".total_pices-1").val();
                var qty = $("#cylinder_pice").val();         
                $(".total_pices-1").val(qty).change();
            });


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#user_type").change(function () {

                var user_type = $("#user_type").val();
                if (user_type != "") {
                    var data = 'type=' + user_type;
                    
                   

                    $.ajax({
                        //this is the php file that processes the data and send mail
                        url:`{!! route('get_max_date') !!}`,
                        type: "POST",
                        data: data,
                        cache: false,
                        success: function (html) {
                            
                            if (html) {

                                $("#hdninvoice_date").val(html);
                                $("#invoice_date").val(html);

                            }

                        }
                    });//End Ajax
                }

            });


        });

    </script>

@endpush
