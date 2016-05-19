<div class="form-group clearfix">
	<label class="control-label">Ингредиенты</label>
	<div class="sortable" id="ingredients">
		@foreach ($inputs as $input)
			<div class="form-group row ingredients">
		    	<div class="col-sm-3">
		    		<div class="input-group">
		    			<span class="input-group-addon"><i class="fa fa-sort"></i></span>
		    			<select class="form-control" name="ingredient[id][]">
		    				<option value="0">Выберите ингредиент</option>
		    				@foreach (App\Models\Ingredient::all() as $option)
								<option value="{{$option->id}}" @if($input['id']==$option->id) selected @endif>{{$option->name}}</option>
		    				@endforeach
		    			</select>
		    		</div>
		    	</div>
		    	
		    	<div class="col-sm-3">
		    		<div class="input-group">
		    			<input type="text" class="form-control" name="ingredient[weight][]" value="{{$input['weight']}}" placeholder="Вес">
		    			<span class="input-group-btn"><span style="cursor: pointer;" onclick="$(this).parents('.ingredients').remove()" class="btn btn-danger"><i class="fa fa-times"></i></span></span>
		    		</div>
		    	</div>
			</div>
		@endforeach
	</div>
	<span style="cursor: pointer;" class="btn btn-success" onclick="$('#ingredients').append(ingredients.clone())"><i class="fa fa-plus"></i> Добавить ингредиент</span>
</div>

<style>
	.sortable {
		overflow-y: auto;
		overflow-x: hidden;
	}
</style>

<script>
	ingredients = $('.ingredients').last().clone();
	$('#ingredients').sortable();
</script>