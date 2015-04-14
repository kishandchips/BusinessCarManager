<ul class="share-links">
	<li>
		<a class="facebook-btn share-popup-btn" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo urlencode($url); ?>&title=<?php echo urlencode($title); ?>"></a>
	</li>
	<li>
		<a class="twitter-btn share-popup-btn" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($title); ?>+<?php echo urlencode($url); ?>"></a>
	</li>
	<li>
		<a class="googleplus-btn share-popup-btn" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($title); ?>"></a>
	</li>
	<li>
		<a class="linkedin-btn share-popup-btn" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($title); ?>"></a>
	</li>
	<li>
		<a class="email-btn" href="mailto:?subject=<?php echo urlencode($title); ?>&amp;body=<?php echo urlencode($url); ?>" ></a>
	</li>
</ul>