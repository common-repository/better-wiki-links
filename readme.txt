=== Better-Wiki-Links ===
Contributors: Bass-Blogger
Donate link: http://amazon.de/gp/registry/wishlist/PCQGMRMPPNLJ
Tags: wiki, links, ebay, amazon, wikipedia, google, english, german, hebrew, norway, spanish, portugues, dutch, russian
Requires at least: 2.0.2
Tested up to: 2.8.0
Stable tag: 1.7.5

=======

This PlugIn will link every [[text]] or [[alt.text|link]] with the the appropriate wiki-system or searchsystems. (Option-page in english, german, dutch, spanish, french, portugues, norway, russian, chinese, and hebrew)

== Description ==

This PlugIn will link every [[text]] or [[alt.text|link]] with the the appropriate wiki-system or searchsystems. (Option-page in english, german, dutch, spanish, french, portugues, norway, russian, chinese, and hebrew).


Better-Wiki-Links supports every bigger wikipedia (more than 250.000 articles) and via alternate-URL every other Wiki-system, even searchfunctions.

* simple settings for Wiki-links
* using both Wiki-schemes ([[text]] and [[link|text]])
* every Wiki usable, without knowledge in HTML or PHP
* could use many other searchfunctions (Google, Ebay, Amazon,...)
* global controls for all links from one single page
* flexible linking-options (target, follow or nofollow)
* optional use of ALT and/or TITLE-attributs
* individual CSS-styles for the [[link]]
* every options in English and German, Dutch, Norsk, Spanish, Portugues, Russian and Hebrew

New in 1.6.0

* [[tooltip||link]] (two pipes) will show "link" in Blog AND wiki, but with "tooltip" for tooltip/title/alt. (only with activate tooltip-option!)


New in 1.6.0

* Alternative Pattern (( )), << >>, {{ }}


== Installation ==

1. Unpack the download-package
1. Upload the files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Got to 'Options' menu and configure the plugin


== Frequently Asked Questions ==
=How do I use alternate wiki-systems or searchfunctions?=

Thats quite simple. Just click use the alternate wiki-URL-field (option-page). Enter the wiki-url without 'http://'
e.g.: 
Wiki:

* 'www.wiki-aventurica.de/index.php?title='

searchfunctions:

* 'www.google.com/search?q='
* 'http://www.amazon.de/gp/search?index=blended&keywords='
* 'search.ebay.com/search/search.dll?from=R40&_trksid=m37&satitle='
* 'www.youtube.com/results?search_query='
* 'wordpress.org/extend/plugins/search.php?q='


=Are there any known bug?=

All **known** problems are solved.


=Could I use a WYSIWYG-Button for the surrounding [[ ]]?=

Not in the recent version, but thats a planned feature!
But you could edit the /wp-includes/js/quicktags.js
Just add the following lines:
'edButtons[edButtons.length] =
new edButton('ed_wiki'
,'[[wiki]]'
,'[['
,']]'
,'p'
,-1
);'



== Screenshots ==

1. options-area
2. plugin-usage

== Help wanted ==

* translater wanted for the optionspages.
