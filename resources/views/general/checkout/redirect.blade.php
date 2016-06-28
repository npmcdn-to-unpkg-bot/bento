<div style="display: none;">
	{!!$payment->cnb_form([
	    'version'        => 3,
	    'action'         => 'pay',
	    'amount'         => $order->total(),
	    'currency'       => 'UAH',
	    'sandbox'        => '1',
	    'description'    => $order->products->implode('name',', '),
	    'order_id'       => $order->id,
	    'result_url'     => url('account'),
	    'server_url'     => url('pay')
	])!!}
</div>

<script>
	document.getElementsByTagName('form')[0].submit()
</script>