<h2>Filter</h2>
			<div id="option--gender">
				<h4>Gender</h4>
				<hr>
				<div class="row">
				<?php
				$gender = array(
					'men'   => 'Men',
					'women' => 'Women'
				);
				foreach ($gender as $gender => $gender_string) {
					echo '
						<label for="gender' . $gender . '"></label>
							<input type="checkbox" name="gender[]" value="' . $gender_string[0] . '" class="input-checkbox" id="gender' . $gender . '">
							' . $gender_string . '
					';
				}
				?>
				</div>
			</div>
			<div id="option--size">
				<div>
					<h4>Size</h4><hr>
				</div>
				<div class="row">
				<?php
				$size = array(
					'6' => '6',
					'7'  => '7',
					'8'   => '8',
					'9'   => '9',
					'10'   => '10',
					'11'   => '11',
					'12'   => '12',
					'13'   => '13',
				);
				
				foreach ($size as $size => $size_string) {
					echo '
							<label for="size' . $size . '"></label>
								<input type="checkbox" name="size[]" value="' . $size_string . '" id="size' . $size . '">
								' . $size_string .'';
				}
				?>
										</div>
			</div>
			<div id="option--type">
				<div>
					<h4>Category</h4><hr>
				</div>
				<?php
				$category = array(
					'RUN'     => 'Running',
					'BAS'   => 'Basketball',
					'CAS'   => 'Casual',
					'BRD'   => 'Board',
					'FOO'     => 'Football',
					'TRA'     => 'Training',
				);
				/**
				 * adjust key value pair and checkbox visibility
				 * depending on option--gender
				 */
				foreach ($category as $category => $category_string) {
					echo '
						<label for="category' . $category . '" class="label label--checkbox"></label>
							<input type="checkbox" name="category[]" value="' . $category . '" class="input--checkbox" id="category' . $category . '">
							' . $category_string . '
					';

				}
				?>
			</div>
			<div id="option--color">
				<div>
					<h4>Color</h4><hr>
				</div>
				<div class="row">
					<?php
					$color = array(
						'black'  => 'Black',
						'blue'   => 'Blue',
						'brown'   => 'Brown',
						'green'  => 'Green',
						'grey'   => 'Grey',
						'orange' => 'Orange',
						'pink'   => 'Pink',
						'red'    => 'Red',
						'white'  => 'White'
					);
					foreach ($color as $color => $color_string) {
						echo '
						<label for="color' . $color . '" class="label label--checkbox"></label>
							<input type="checkbox" name="color[]"  value="' . $color_string . '" class="input--checkbox" id="color' . $color . '">
							' . $color_string . '
							<br>';
					}
					?>
				</div>
			
			</div>
		</div>