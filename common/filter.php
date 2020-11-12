<section class="sidebar" style="max-height: 689px; margin: 25px; padding: 15px; border-radius: 20px; background-color: lightgrey;">
	<form class="filter">
		<div>
			<h2>Filter</h2>
		</div><br>
		<div id="gender">
			<div>
				<h4>Gender</h4>
				<hr><br>
			</div>
			<label for="gender-men" class="label-filter">
				<input type="checkbox" name="gender[]" value="M" id="gender-men">
				Men
			</label>
			<label for="gender-women" class="label-filter">
				<input type="checkbox" name="gender[]" value="W" id="gender-women">
				Women
			</label>
		</div><br>
		<div id="type">
			<div>
				<h4>Type</h4>
				<hr><br>
			</div>

			<label for="category-RUN" class="label-filter">
				<input type="checkbox" name="category[]" value="RUN" class="input-checkbox" id="category-RUN">
				Running
			</label>

			<label for="category-BAS" class="label-filter">
				<input type="checkbox" name="category[]" value="BAS" class="input-checkbox" id="category-BAS">
				Basketball
			</label>

			<label for="category-CAS" class="label-filter">
				<input type="checkbox" name="category[]" value="CAS" class="input-checkbox" id="category-CAS">
				Casual
			</label>

			<label for="category-BRD" class="label-filter">
				<input type="checkbox" name="category[]" value="BRD" class="input-checkbox" id="category-BRD">
				Board
			</label>

			<label for="category-FOO" class="label-filter">
				<input type="checkbox" name="category[]" value="FOO" class="input-checkbox" id="category-FOO">
				Football
			</label>
		</div><br>

		<div id="size">
			<div>
				<h4>Size</h4>
				<hr><br>
			</div>
			<div class="row">
				<div class="onethird col">
					<label for="size-6" class="label-filter">
						<input type="checkbox" name="size[]" value="6" class="input-checkbox" id="size-6">
						6
					</label>
				</div>
				<div class="onethird col">
					<label for="size-7" class="label-filter">
						<input type="checkbox" name="size[]" value="7" class="input-checkbox" id="size-7">
						7
					</label>
				</div>
				<div class="onethird col">
					<label for="size-8" class="label-filter">
						<input type="checkbox" name="size[]" value="8" class="input-checkbox" id="size-8">
						8
					</label>
				</div>
				<div class="onethird col">
					<label for="size-9" class="label-filter">
						<input type="checkbox" name="size[]" value="9" class="input-checkbox" id="size-9">
						9
					</label>
				</div>

				<div class="onethird col">
					<label for="size-10" class="label-filter">
						<input type="checkbox" name="size[]" value="10" class="input-checkbox" id="size-10">
						10
					</label>
				</div>

				<div class="onethird col">
					<label for="size-11" class="label-filter">
						<input type="checkbox" name="size[]" value="11" class="input-checkbox" id="size-11">
						11
					</label>
				</div>

				<div class="onethird col">
					<label for="size-12" class="label-filter">
						<input type="checkbox" name="size[]" value="12" class="input-checkbox" id="size-12">
						12
					</label>
				</div>

				<div class="onethird col">
					<label for="size-13" class="label-filter">
						<input type="checkbox" name="size[]" value="13" class="input-checkbox" id="size-13">
						13
					</label>
				</div>
			</div>
		</div><br>
		<div id="color">
			<div>
				<h4>Color</h4>
				<hr><br>
			</div>
			<div class="row">

				<div class="onethird col">
					<label for="color-black" class="label-filter">
						<input type="checkbox" name="color[]" value="Black" class="input-checkbox" id="color-black">
						Black
					</label>
				</div>

				<div class="onethird col">
					<label for="color-blue" class="label-filter">
						<input type="checkbox" name="color[]" value="Blue" class="input-checkbox" id="color-blue">
						Blue
					</label>
				</div>

				<div class="onethird col">
					<label for="color-brown" class="label-filter">
						<input type="checkbox" name="color[]" value="Brown" class="input-checkbox" id="color-brown">
						Brown
					</label>
				</div>

				<div class="onethird col">
					<label for="color-orange" class="label-filter">
						<input type="checkbox" name="color[]" value="Orange" class="input-checkbox" id="color-orange">
						Orange
					</label>
				</div>

				<div class="onethird col">
					<label for="color-pink" class="label-filter">
						<input type="checkbox" name="color[]" value="Pink" class="input-checkbox" id="color-pink">
						Pink
					</label>
				</div>

				<div class="onethird col">
					<label for="color-white" class="label-filter">
						<input type="checkbox" name="color[]" value="White" class="input-checkbox" id="color-white">
						White
					</label>
				</div>
			</div>
		</div><br>
		<button type="submit" class="submitbutton">
			Apply Filters
		</button>
		<button type="reset" class="resetbutton">
			Clear All
		</button>
	</form>
</section>