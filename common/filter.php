<section class="sidebar">
	<form class="filter">
		<div class="user-m-medium--bottom">
			<h2 class="header">Filter</h2>
		</div>
		<div id="option--gender" class="option-group">
			<div class="option__header">
				<h4>Gender</h4>
			</div>
			<?php
			$gender = array(
				'men'   => 'Men',
				'women' => 'Women'
			);
			foreach ($gender as $gender => $gender_string) {
				echo '
						<label for="gender--' . $gender . '" class="label label--checkbox">
							<input type="checkbox" name="gender[]" value="' . $gender_string[0] . '" class="input--checkbox" id="gender--' . $gender . '">
							' . $gender_string . '
						</label>
					';
			}
			?>
		</div>
		<div id="option--gender" class="option-group">
			<div class="option__header">
				<h4>Size</h4>
			</div>
			<div class="row">
				<?php
				$size = array(
					'6' => '6',
					'6.5' => '6.5',
					'7'  => '7',
					'7.5'  => '7.5',
					'8'   => '8',
					'8.5'   => '8.5',
					'9'   => '9',
					'9.5'   => '9.5',
					'10.5'   => '10.5',
					'10.5'   => '10.5',
					'11'   => '11',
					'11.5'   => '11.5',
					'12'   => '12',
					'13.5'   => '13.5'
				);
				foreach ($size as $size => $size_string) {
					echo '
							<div class="three column user-p-zero">
								<label for="size--' . $size . '" class="label label--checkbox">
									<input type="checkbox" name="size[]" value="' . $size_string . '" class="input--checkbox" id="size--' . $size . '">
									' . $size_string . '
								</label>
							</div>
						';
				}
				?>
			</div>
        </div>
        <div id="option--type" class="option-group">
			<div class="option__header">
				<h4>Catefory</h4>
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
						<label for="category--' . $category . '" class="label label--checkbox">
							<input type="checkbox" name="category[]" value="' . $category . '" class="input--checkbox" id="category--' . $category . '">
							' . $category_string . '
						</label>
					';
			}
			?>
		</div>
		<div id="option--color" class="option-group">
			<div class="option__header">
				<h4>Color</h4>
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
							<div class="six column user-p-zero">
								<label for="color--' . $color . '" class="label label--checkbox">
									<input type="checkbox" name="color[]"  value="' . $color_string . '" class="input--checkbox" id="color--' . $color . '">
									' . $color_string . '
								</label>
							</div>
						';
				}
				?>
			</div>
		</div>
		<button type="submit" class="button button--primary option__button">
			Apply Filters
		</button>
		<button type="reset" class="button button--secondary option__button">
			Clear All
		</button>
	</form>
</section>