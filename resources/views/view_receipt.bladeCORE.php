<html>
	<head>
		<meta charset="utf-8">
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
		<link rel="icon" type="image/png" href="<?php echo ADMIN_THEME ?>images/favicon.png"> 
		<!-- Core CSS - Include with every page -->
		<link href="<?php echo ADMIN_THEME ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo ADMIN_THEME ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
		<link href="<?php echo ADMIN_THEME ?>css/plugins/timeline/timeline.css" rel="stylesheet">
		<link href="<?php echo ADMIN_THEME ?>css/sb-admin.css" rel="stylesheet">
		<link href="<?php echo ADMIN_THEME ?>css/style.css" rel="stylesheet">
        <style>
            *
            {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }

            /* content editable */

            *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

            *[contenteditable] { cursor: pointer; }

            *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

            span[contenteditable] { display: inline-block; }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; border: 1px solid #ddd;}
            th, td {  padding: 0.3em; position: relative; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            /* page */

            html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
            html { background: #999; cursor: default; }

            body { box-sizing: border-box;  margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            /*header { margin: 0 0 3em; }*/
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; font-size:12px; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 1em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; font-size:14px; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 60%; font-size:14px;}
            table.meta td { width: 80%; font-size:11px;}

            /* table items */

            table.inventory { clear: both; width: 100%; font-size:10px;}

            table.inventory th { font-weight: bold; text-align: center; font-size: 12px; border:1px solid black;}
            table.inventory td{border:1px solid black;}
            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) {  width: 12%; }
            table.inventory td:nth-child(4) { width: 12%; }
            table.inventory td:nth-child(5) { width: 12%; }
            /*table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }*/

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* javascript */

            .add, .cut
            {
                border-width: 1px;
                display: block;
                font-size: .8rem;
                padding: 0.25em 0.5em;	
                float: left;
                text-align: center;
                width: 0.6em;
            }

            .add, .cut
            {
                background: #9AF;
                box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                border-radius: 0.5em;
                border-color: #0076A3;
                color: #FFF;
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
            }

            .add { margin: -2.5em 0 0; }

            .add:hover { background: #00ADEE; }

            .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
            .cut { -webkit-transition: opacity 100ms ease-in; }

            tr:hover .cut { opacity: 1; }

            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
        </style>
        <script src="<?php echo ADMIN_THEME ?>js/jquery-1.10.2.js"></script>
        <script>

            function myFunction() {
                $("#print_link").hide();
                window.print();
                var count=0;
                var auto_refresh = setInterval(function() 
                { 
                    
                    if(count<1)
                    {
                        window.location.href = "<?php echo common::get_component_link(array("add_order","list")); ?>";
                        
                    }
                    count++;
                }, 3000);
            }
        </script>
    </head>

	<body>
		
		<header>
	
			<div style="width:200px; float:right;">
			<a onclick="myFunction()" class="btn btn-default" id="print_link" style="float:right; background:#001F46; color:white;">Print</a>
			</div>
			<address  style="margin-top:10px; border:4px solid; width: 100%;text-align: center;">
				<div style='width:15%; float:left;padding-left: 20px; padding-top: 10px;'>
				    <img alt="" style="float:left; height:80px;" src="<?php echo ADMIN_THEME ?>images/cylinderimage.png">
				</div>
				<div style='width:60%; float:left;'>
					<h4 class="semibold nm"><strong><?php echo $companyname;?></strong></h4>
                    
                    <p><?php echo $address;?>, <?php echo $city;?></p>
                    <p> Phone- <?php echo $phone;?>, Email- <?php echo $email_id;?> </p>
                    <p> GSTIN- <?php echo $gst_num;?></p>

				</div>
				<div style='width:15%; float:right; padding-top: 10px;'>
				<img alt="" style="float:left; height:80px;" src="<?php echo ADMIN_THEME ?>images/indianoil.png">
				</div>

			</address>
			
		</header>

		<article>
			<h1>Recipient</h1>
			
			<table class="inventory">
				
				<tr>
					<th colspan="2"><span>Invoice</span></th>
				</tr>
				<tr>
					<td><span>Invoice No: <?=$invice_number?></span></td>
					<td><span>Connection type: <?=$content_type?></span></td>
				</tr>
				<tr>
					<td><span id="prefix">Invoice date: <?=$invoice_formate?></span></td>
					<td><span id="prefix">SV No.: <?=$sv_number?></span></td>
				</tr>
				<tr>
					<td><span id="prefix">Reverse Charge (Y/N): <?=$reverse_charge?></span></td>
					<td><span id="prefix">Consumer No.: <?=$consumer_number?></span></td>
				</tr>
				<tr>
					<td><span>State: U.K</span></td>
					<td><span>Cust. GST : <?=$customer_gst?></span></td>
				</tr>
				
				<tr>
					<th><span>Billing Address</span></th>
					<th><span>Shipping Address</span></th>
				</tr>
				<tr>
					<td><span>Name: <?=$customer_name?></span></td>
					<td><span>Name: <?=$customer_name?></span></td>
				</tr>
				<tr>
					<td><span>Address: <?=$customer_billing_address?></span></td>
					<td><span>Address: <?=$customer_shipping_address?></span></td>
				</tr>
				<tr>
					<td><span>Mobile Number:- <?=$customer_number?></span></td>
					<td><span>Mobile Number:- <?=$customer_number?></span></td>
				</tr>
				<tr>
					<td><span>State: <?=$customer_state?></span></td>
					<td><span>State: <?=$customer_state?></span></td>
				</tr>
				
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th style='width: 29px;'><span>S.No.</span></th>
						<th style='width: 100px;'><span>Product Name</span></th>
						<th><span>HSN code</span></th>
						<th><span>Qty</span></th>
						<th><span>Rate</span></th>
						<th><span>Amount</span></th>
						<th><span>Taxable Value</span></th>
						<th><span>CGST Rate</span></th>
						<th><span>CGST Amount</span></th>
						<th><span>SGST Rate</span></th>
						<th><span>SGST Amount</span></th>
						<th><span>Total</span></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$total_qty=0;
					$sum_amount=0;
					$sum_cgst_amount=0;
					$sum_sgst_amount=0;
					$sum_total_amount=0;
					$taxable_amount=0;
					
					$count=1;
					
					foreach($data2 as $details)
					{
						
				?>	
						<tr class='even'>
							<td style='text-align: center;'><?php echo $count; ?></td>
							<td style='text-align: center;'><?php echo $details["product_name"]; ?></td>
							<td style='text-align: center;'></td>
							<td style='text-align: center;'><?php echo $details["pro_qty"]; ?></td>
							<td style='text-align: center;'><?php echo $details["rate"]; ?></td> 
							<td style='text-align: center;'><?php echo $details["amount"]; ?></td>
							<td colspan="5" style="text-align:center;"> Exempted for GST</td>
							<td style='text-align: center;'><?php echo $details["amount"]; ?></td> 
							 
						</tr>

                        <?php	
                    
                        $count++;
                        $sum_amount=$sum_amount+$details["amount"];
                        $sum_total_amount=$sum_total_amount+$details["amount"];
                        $total_qty=$total_qty+$details["pro_qty"];
				    }
					
					
					foreach($data1 as $d){
						
						$amount=$d["qty"]*$d["rate"];
						$total_amount=$amount+$d["cgst_amount"]+$d["sgst_amount"];
						
					?>
						<tr class="odd gradeX">
							<td style='text-align: center;'><?php echo $count; ?></td>
							<td style='text-align: center;'><?php echo $d["title"]; ?></td>
							<td style='text-align: center;'><?php echo $d["hsn_code"]; ?></td>
							<td style='text-align: center;'><?php echo $d["qty"]; ?></td>
							<td style='text-align: center;' ><?php echo $d["rate"]; ?></td> 
							<td style='text-align: center;'><?php echo $d["qty"]*$d["rate"]; ?></td>
							<td style='text-align: center;'><?php echo $d["qty"]*$d["rate"]; ?></td>
							<td style='text-align: center;'><?php echo $d["cgst_tax"];?>%</td>
							<td style='text-align: center;'><?php echo $d["cgst_amount"];?></td>
							<td style='text-align: center;'><?php echo $d["sgst_tax"];?>%</td>
							<td style='text-align: center;'><?php echo $d["sgst_amount"];?></td>
							<td style='text-align: center;'><?php echo $total_amount; ?></td> 
							 
						</tr>
					 <?php 
						$total_qty=$total_qty+$d["qty"];
						$sum_amount=$sum_amount+$amount;
						$taxable_amount=$taxable_amount+$amount;
						$sum_cgst_amount=$sum_cgst_amount+$d["cgst_amount"];
						$sum_sgst_amount=$sum_sgst_amount+$d["sgst_amount"];
						$sum_total_amount=$sum_total_amount+$total_amount;
						$count++;
						
						
					}

						
				?>
				<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total</b></td>
						<td style='text-align: center;'><b><?=$total_qty?></b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b><?=$sum_amount?></b></td>
						<td style='text-align: center;'><b><?=$taxable_amount?></b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b><?=$sum_cgst_amount?></b></td>
						<td style='text-align: center;'></td>
						<td style='text-align: center;'><b><?=$sum_sgst_amount?></b></td>
						<td style='text-align: center;'><b><?=$sum_total_amount?></b></td>
					</tr>
				</tbody>
			</table>
			<?php
				$total_tax_amount=$sum_sgst_amount+$sum_cgst_amount;
				$total_amount_after_tax=$sum_amount+$total_tax_amount;
                
				$net_amount_payable=$total_amount_after_tax-$discount;

				$net_amount_payable=round($net_amount_payable);

				$word_amount= getStringOfAmount($net_amount_payable);

			?>
			<div style="width:100%; height:184px;">
			<table class="meta" style="width:68%; height:180px;">
				<tr><td>Total Amount before Tax: <?=$sum_amount?></td></tr>
				<tr><td>Add CGST: <?=$sum_cgst_amount?></td></tr>
				<tr><td>Add SGST: <?=$sum_sgst_amount?></td></tr>
				<tr><td>Total Tax Amount: <?php echo $total_tax_amount;?></td></tr>
				<tr><td>Total Amount after Tax: <?php echo $total_amount_after_tax ?></td></tr>
				<tr><td>Discount: <?=$discount?></td></tr>

				<!--<tr><td>Net amount payable: <?=$total_amount_after_tax-$discount?></td></tr>-->

				<tr><td>Net amount payable: <?=$net_amount_payable?></td></tr>
				<tr><td>Amount in words: <?=$word_amount?></td></tr>
			</table>
			<table class="meta" style="width:30%; height:180px;">
							<tr><td>Schemes:</td></tr>
							<tr><td>Loan:</td></tr>
							<tr><td>Bank A/C: </td></tr>
							<tr><td>Terms & Conditions :</td></tr>
			</table>
			</div>			
			
			<div style="width:100%; height:90px; margin-top:10px;">
			<table class="meta" style="width:24%; height: 85px;">
				
				<tr style=" ">
				<td>Authorised Signatory</td>
				</tr>
			</table>
			<table class="meta" style="width:24%;  height: 85px;">
				<tr><td>Common Seal</td></tr>
			</table>
			<table class="meta" style="width:24%;  height: 85px;">
				<tr><td>Payment Type:-</td></tr>
				<?php
				if($payment_mode=="Both")
				{	
				?>
				<tr><td>Cash: <?=$cash_payment?></td></tr>
				<tr><td>Bank: <?=$bank_payment?></td></tr>
				<?php } else {?>
				<tr><td><?=ucfirst($payment_mode);?></td></tr>
				<?php }?>
			</table>
			<table class="meta" style="width:24%; height: 85px;">
				<tr><td>Customer's Signature</td></tr>
			</table>
			</div>			
			
		</article>
		
	</body>
</html>