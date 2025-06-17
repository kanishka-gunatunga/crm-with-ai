<!DOCTYPE html>
<?php
use App\Models\QuoteProduct;
use App\Models\UserDetails;
use App\Models\Product;
use App\Models\Service;
use App\Models\Configuration;

$config = Configuration::first();
$products = QuoteProduct::where('quote_id', $quote->id)->get();
$owner_name = UserDetails::where('id', $quote->owner)->value('name');
?>
<html lang="en">
<style type="text/css">
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
    }
</style>

<div style="text-align:center;margin-bottom:25px;">
<?php if($config && $config->quote_logo != null){ 
?> 
<img src="{{ public_path('uploads/'.$config->quote_logo) }}" style="width:150px;"> 
<?php } ?>

</div>

<h2 style="text-align:center;">Quotation</h2>
<p style="margin-bottom:0px;margin-top:25px;"><b>Quote Id -</b> #{{$quote->id}}</p>
<p style="margin-bottom:0px;margin-top:0px;"><b>Quote Date -</b> {{ \Carbon\Carbon::parse($quote->created_at)->format('d-m-Y') }}</p>
<p style="margin-bottom:0px;margin-top:0px;"><b>Valid Until -</b> {{ \Carbon\Carbon::parse($quote->expired_at)->format('d-m-Y') }}</p>
<p style="margin-bottom:0px;margin-top:0px;"><b>Sales Person -</b> {{ $owner_name }}</p>

<table style="width:100%; margin-top: 20px;">
    <tr>
        <th style="width:50%; text-align:center;">Bill To</th>
        <th style="width:50%; text-align:center;">Ship To</th>
    </tr>
    <tr>
        <td>
            <p>{{$quote->address}}<br>{{$quote->country}}<br>{{$quote->state}}<br>{{$quote->city}}<br>{{$quote->post_code}}</p>
        </td>
        <td>
            <p>{{$quote->shipping_address}}<br>{{$quote->shipping_country}}<br>{{$quote->shipping_state}}<br>{{$quote->shipping_city}}<br>{{$quote->shipping_post_code}}</p>
        </td>
    </tr>
</table>

<br>

<table style="width:100%;">
    <tr>
        <th>SKU</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Discount</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    <?php
    $sub_total = 0;
    foreach($products as $product){
        if($product->type == "product"){
            $product_name = Product::where('id', $product->product_id)->value('name');
            $sku = Product::where('id', $product->product_id)->value('sku');
        }
        else{
            $product_name = Service::where('id', $product->product_id)->value('name');
            $sku = '-';
        }

        $amount = $product->price * $product->quantity;
        $discount_amount = ($amount * $product->discount) / 100;
        $tax_amount = ($amount - $discount_amount) * ($product->tax / 100);
        $total = $amount - $discount_amount + $tax_amount;

        $sub_total += $amount;
    ?>
    <tr>
        <td>{{$sku}}</td>
        <td>
            {{ $product_name }}
            @if(!empty($product->note))
                <br> ({{ $product->note }})
            @endif
        </td>
        <td>${{number_format($product->price, 2)}}</td>
        <td>{{$product->quantity}}</td>
        <td>${{number_format($amount, 2)}}</td>
        <td>${{number_format($discount_amount, 2)}} ({{$product->discount ?? 0}}%)</td>
        <td>${{number_format($tax_amount, 2)}} ({{$product->tax ?? 0}}%)</td>
        <td>${{number_format($total, 2)}}</td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="7" style="text-align:right;"><b>Sub Total</b></td>
        <td style="text-align:right;">${{number_format($sub_total, 2)}}</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align:right;">Tax</td>
        <td style="text-align:right;">${{number_format($quote->tax_total_amount, 2)}}</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align:right;">Discount</td>
        <td style="text-align:right;">${{number_format($quote->discount_total_amount, 2)}}</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align:right;"><b>Grand Total</b></td>
        <td style="text-align:right;"><b>${{number_format($quote->order_total_input, 2)}}</b></td>
    </tr>
</table>

<?php if($config && $config->terms != null){ 
?> 
<h6 style="margin-top:25px;font-size:16px;margin-bottom:0px;">Terms & Conditions</h6>
<p  style="margin-top:10px;margin-bottom:0px;">{{$config->terms}}</p>
<?php } ?>
