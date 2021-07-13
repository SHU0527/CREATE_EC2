@extends('layouts.app')
@section('content')
<h2>購入情報確認画面</h2>
<h4>お届け先住所</h4>
<table class="table table-striped table-hover table-centered">
<tr style="background-color:#e3f0fb">
<th>お届け先名</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>市区町村</th>
<th>番地以降住所</th>
<th>電話番号</th>
</tr>
<tr>
<td>{{ $shipping_target->shipping_name }}</td>
<td>{{ $shipping_target->post_number }}</td>
<td>{{ $shipping_target->prefectures }}</td>
<td>{{ $shipping_target->address1 }}</td>
<td>{{ $shipping_target->address2 }}</td>
<td>{{ $shipping_target->phone_number }}</td>
</tr>
</table>

@if (0 < $carts->count())
</div>
<table class="table table-striped table-hover table-centered">
<h4>カートの中身</h4>
<tr style="background-color:#e3f0fb">
<th>商品名</th>
<th>購入数</th>
<th>価格</th>
</tr>
@foreach ($carts as $cart)
<tr style="background-color:#f5f5f5">
<td>{{ $cart->item->name }}</td>
<td>{{ $cart->quantity }}</td>
<td>{{ $cart->item->price }}</td>
</tr>
@endforeach
</table>
<h4 class="text-center">合計金額：{{ $subtotals }}円</h4>
@else
<div style="padding:100px">
<h1 style="color:lightgray;text-align:center;">カートが空です</h1>
</div>
@endif

<div class="content">
<form action="{{ route('charge.confirm') }}" method="POST">
{{ csrf_field() }}
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="{{ env('STRIPE_KEY') }}"
data-amount={{ $subtotals }}
data-name="決済情報入力"
data-label="決済をする"
data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
data-locale="auto"
data-currency="JPY">
</script>
<input type="hidden" name="amount" value="{{ $subtotals }}">
<input type="hidden" name="shipping_name" value="{{ $shipping_target->shipping_name }}">
<input type="hidden" name="post_number" value="{{ $shipping_target->post_number }}">
<input type="hidden" name="prefectures" value="{{ $shipping_target->prefectures }}">
<input type="hidden" name="address1" value="{{ $shipping_target->address1 }}">
<input type="hidden" name="address2" value="{{ $shipping_target->address2 }}">
@foreach ($carts as $cart)
<input type="hidden" name="item_id[]" value="{{ $cart->item->id }}">
<input type="hidden" name="quantity[]" value="{{ $cart->quantity }}">
@endforeach
</form>
</div>
@endsection
