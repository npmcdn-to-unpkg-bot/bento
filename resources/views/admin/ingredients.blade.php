<div class="form-group clearfix">
	<label class="control-label">Ингредиенты</label>
	<div class="sortable" id="ingredients">
		@foreach ($ingredients->push('') as $ingredient)
			<div class="form-group input-group ingredients">
			    <span class="input-group-addon"><i class="fa fa-sort"></i></span>
				<input type="text" class="form-control" name="" value="">
			    <span class="input-group-btn"><span style="cursor: pointer;" onclick="$(this).parents('.ingredients').remove()" class="btn btn-danger"><i class="fa fa-times"></i></span></span>
			</div>
		@endforeach
	</div>
	<div class="pull-right">
		<span style="cursor: pointer;" class="btn btn-success" onclick="$('#ingredients').append(ingredients.clone())"><i class="fa fa-plus"></i></span>
	</div>
</div>

<style>
	.sortable {
		overflow: auto;
	}
</style>

<script>
	ingredients = $('.ingredients').last().clone();
	$('#ingredients').sortable();
</script>