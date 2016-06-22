<div style="display: none;">
	{!!$payment->cnb_form([
	    'version'        => 3,
	    'action'         => 'pay',
	    'amount'         => $order->sum(),
	    'currency'       => 'UAH',
	    'sandbox'        => '1',
	    'description'    => $order->products->implode('name',', '),
	    'order_id'       => $order->id,
	    'result_url'     => url('account'),
	])!!}
</div>

<script>
	document.getElementsByTagName('form')[0].submit()
</script>