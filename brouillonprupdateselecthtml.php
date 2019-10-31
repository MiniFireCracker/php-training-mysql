	<!--<option value='<?= $selectedTrack['difficulty']?>' selected='selected'> <?= $selectedTrack['difficulty'] ?> </option>
				<?php $possibleOptionValue=["très facile", "facile", "moyen","difficile","très difficile"];
					function findAllValuesExceptTheOneInUse($val){
						return $val !== $selectedTrack['difficulty'];
					}

					$otherValues= array_filter($possibleOptionValue, findAllValuesExceptTheOneInUse);
					print_r($otherValues);

					foreach($otherValues as $otherValue):
				 ?>
				 <option value=<?= $otherValue ?> > <?= $otherValue  ?> </option>
				

				<?php endforeach; ?>
			-->