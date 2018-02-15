---
title: Carbon Helper
slug: A quick helper function for Carbon dates
url: carbon-helper
date: 2017-10-05
image: curtis-macnewton-317636.jpg
image_link: https://unsplash.com/photos/vVIwtmqsIuk
photographer: Curtis MacNewton
---

I use the <a href="http://carbon.nesbot.com/" target="_blank" rel="nofollow">nesbot/carbon</a> class in my projects nearly 100% of the time. It offers some incredible functionality for handling and formatting dates. If you've not used it, I highly recommend checking it out.

One thing that gets tiring though is having `use Carbon\Carbon` at the top of all my PHP files and having to write out `Carbon::parse()` any time I want to use the package. Instead, I like to use a little helper function that I include in my applications:

```php
if ( ! function_exists('carbon') )
{
	function carbon($date)
	{
		return \Carbon\Carbon::parse($date);
	}
}
```

Now, instead of this:

```php
use Carbon\Carbon;
// ...
$date = Carbon::parse('tomorrow');
```

You can do this:

```php
$date = carbon('tomorrow');
```

Much more simple and clean.