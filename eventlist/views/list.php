	<ul class="konvent-list">
		<?php foreach($apiData as $item) : ?>
	    <li>
		    <a href="<?php echo $item->link ?>"> <img src="<?php echo $item->banner ?>" alt="<?php echo $item->name ?>">
		            <strong><?php echo $item->name ?></strong> <span class="konvent-info"> <span class="konvent-time"><?php echo $item->readabledate ?></span>, <?php echo $item->city ?>
		        </span>
		    </a>
	    </li>
	    <?php endforeach; ?>
	</ul>