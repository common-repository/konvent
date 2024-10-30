	<ul class="konvent-tickettypes">
		<?php //print_r($apiData) ?>
		
		<?php foreach($apiData->tickettypes as $item) : ?>
		<li class="konvent-tickettypes-wrap">
			<span><a href="<?php echo $apiData->link ?>"><?php echo $item->name ?></a></span>
			<span><?php echo $item->max-$item->sold ?>/<?php echo $item->max ?> kvar</span>
		</li>
	    <?php endforeach; ?>
	    
	</ul>