<?php
function changeToReverseDate($date)
{
    if($date=="0000-00-00" || $date=="")
    {
        return "0000-00-00";
    }
    $date = explode("-",$date);
    $reverse_date = $date[2]."-".$date[1]."-".$date[0];
    return $reverse_date;
}

function isPresent($id, $orderItem) {
    foreach ($orderItem as $product) {
        if ($product->product_id === $id) {
            return true;
        }
    }
    return false;
}

function totalProducts()
{
    $ids = DB::table('products')->where('admin_id',Auth::user()->id)->where('status','1')->pluck('id');
    $numberOfIds = $ids->count();
    return $numberOfIds;
}

function commonloop($val, $str1 = '', $str2 = '') 
{
    global $ones, $tens;
    $string = '';
    if ($val == 0)
      $string .= $ones[$val];
    else if ($val < 20)
      $string .= $str1.$ones[$val] . $str2;  
    else
      $string .= $str1 . $tens[(int) ($val / 10)] . $ones[$val % 10] . $str2;
    return $string;
}

function convertTri($num, $tri) 
{
    global $ones, $tens, $triplets, $count1;
    $test = $num;
    //echo $test;die();
     //echo $count;die();
    $count1++;
   
    // chunk the number, ...rxyy
    // init the output string
    $str = '';
    // to display hundred & digits
    if ($count1 == 1) {
        //echo "here";die();
      $r = (int) ($num / 1000);
      $x = ($num / 100) % 10;
      $y = $num % 100;
      // do hundreds
      if ($x > 0) {
        $str = $ones[$x] . ' Hundred';
        // do ones and tens
        $str .= commonloop($y, ' ', '');
      }
      else if ($r > 0) {
        // do ones and tens
        $str .= commonloop($y, ' ', '');
      }
      else {
        // do ones and tens
        $str .= commonloop($y);
      }
    }
    // To display lakh and thousands
    else if($count1 == 2) {
        // echo "here";die();
      $r = (int) ($num / 10000);
      $x = ($num / 100) % 100;
      $y = $num % 100;
      $str .= commonloop($x, '', ' Lakh ');
      $str .= commonloop($y);
      if ($str != '')
        $str .= $triplets[$tri];
    }
    // to display till hundred crore
    else if($count1 == 3) {
      $r = (int) ($num / 1000);
      $x = ($num / 100) % 10;
      $y = $num % 100;
      // do hundreds
      if ($x > 0) {
        $str = $ones[$x] . ' Hundred';
        // do ones and tens
        $str .= commonloop($y,' ',' Crore ');
      }
      else if ($r > 0) {
        // do ones and tens
        $str .= commonloop($y,' ',' Crore ');
      }
      else {
        // do ones and tens
        $str .= commonloop($y);
      }
    }
    else {
      $r = (int) ($num / 1000);
    }
    // add triplet modifier only if there
    // is some output to be modified...
    // continue recursing?
    if ($r > 0)
      return convertTri($r, $tri+1) . $str;
    else
      return $str;
}

function convertNum($num) 
{
    $num = (int) $num;    // make sure it's an integer
  
    if ($num < 0)
      return 'negative' . convertTri(-$num, 0);
  
    if ($num == 0)
      return 'Zero';
    return convertTri($num, 0);
    //$res=convertTri($num, 0);
    //echo $res;die();
}

function getStringOfAmount($num) {
    $count1 = 0;
    //echo"here";die();
    global $ones, $tens, $triplets;
    $ones = array(
      '',
      ' One',
      ' Two',
      ' Three',
      ' Four',
      ' Five',
      ' Six',
      ' Seven',
      ' Eight',
      ' Nine',
      ' Ten',
      ' Eleven',
      ' Twelve',
      ' Thirteen',
      ' Fourteen',
      ' Fifteen',
      ' Sixteen',
      ' Seventeen',
      ' Eighteen',
      ' Nineteen'
    );
    $tens = array(
      '',
      '',
      ' Twenty',
      ' Thirty',
      ' Forty',
      ' Fifty',
      ' Sixty',
      ' Seventy',
      ' Eighty',
      ' Ninety'
    );
  
    $triplets = array(
      '',
      ' Thousand',
      ' Million',
      ' Billion',
      ' Trillion',
      ' Quadrillion',
      ' Quintillion',
      ' Sextillion',
      ' Septillion',
      ' Octillion',
      ' Nonillion'
    );
    return convertNum($num);
  }


?>

