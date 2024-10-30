<?php
/*
Plugin Name: Better-Wiki-Link
Plugin URI: http://www.bass-blogger.de/wordpress-wikipedia-plugin/
Description: This Plug-in links every [[text]] or [[alt.text|link]] with the the appropriate wiki-system. (Option-page in english, german, spanish, norway, portugues and hebrew)
Version: 1.7.5
Author: Bass-Blogger
Author URI: http://www.bass-blogger.de/

License:

    Copyright 2008 Tim Charzinski  (email : tim@bass-blogger.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
$better_link_version="1.7.5";

////////////////////////////////////////////////////////////////////////////////////////////////////////

/* Bedingungen ermitteln*/
if ("blank" == get_option("betterwiki_link_target")){$betterwiki_target="_blank";};
if ("top" == get_option("betterwiki_link_target")){$betterwiki_target="_top";};

if ("wiki-de" == get_option("betterwiki_link_wiki")){$betterwiki_url='de.wikipedia.org/wiki/';};
if ("wiki-en" == get_option("betterwiki_link_wiki")){$betterwiki_url='en.wikipedia.org/wiki/';};
if ("wiki-nl" == get_option("betterwiki_link_wiki")){$betterwiki_url='nl.wikipedia.org/wiki/';};
if ("wiki-fr" == get_option("betterwiki_link_wiki")){$betterwiki_url='fr.wikipedia.org/wiki/';};
if ("wiki-it" == get_option("betterwiki_link_wiki")){$betterwiki_url='it.wikipedia.org/wiki/';};
if ("wiki-ja" == get_option("betterwiki_link_wiki")){$betterwiki_url='ja.wikipedia.org/wiki/';};
if ("wiki-nl" == get_option("betterwiki_link_wiki")){$betterwiki_url='nl.wikipedia.org/wiki/';};
if ("wiki-pl" == get_option("betterwiki_link_wiki")){$betterwiki_url='pl.wikipedia.org/wiki/';};
if ("wiki-pt" == get_option("betterwiki_link_wiki")){$betterwiki_url='pt.wikipedia.org/wiki/';};
if ("wiki-ru" == get_option("betterwiki_link_wiki")){$betterwiki_url='ru.wikipedia.org/wiki/';};
if ("wiki-sv" == get_option("betterwiki_link_wiki")){$betterwiki_url='sv.wikipedia.org/wiki/';};
if ("wiki-es" == get_option("betterwiki_link_wiki")){$betterwiki_url='es.wikipedia.org/wiki/';};
if ("wiki-no" == get_option("betterwiki_link_wiki")){$betterwiki_url='no.wikipedia.org/wiki/';};
if ("google" == get_option("betterwiki_link_wiki")){$betterwiki_url='www.google.com/search?q=';};

$betterwiki_css =get_option(betterwiki_link_css_style);

if ("1"  == get_option("betterwiki_link_alt_wiki_opt")){
$betterwiki_url =get_option(betterwiki_link_alt_wiki_url);
};

if ("1"  == get_option("betterwiki_link_alt")){
$betterwiki_link_attributs ="alt=\"$1\" ";
};

if ("1"  == get_option("betterwiki_link_title")){
$betterwiki_link_attributs = $betterwiki_link_attributs." title=\"$1\" ";
};

if ("nofollow" == get_option("betterwiki_link_follow")){
$betterwiki_link_attributs = $betterwiki_link_attributs." rel=\"nofollow\" ";};

if ("1" == get_option("betterwiki_link_css_opt")){
$betterwiki_link_attributs = $betterwiki_link_attributs."style=\"$betterwiki_css \" ";};



////////////////////////////////////////////////////////////////////////////////////////////////////////


class basswikilink {

  function basswikilink() {
     add_filter('the_content', array(&$this, 'basswiki'));
  }



  function basswiki($content) { 
global $betterwiki_target,$betterwiki_rel,$betterwiki_url,$betterwiki_alt_url,$betterwiki_link_attributs,$betterwiki_link_brackets;

$betterwiki_link_brackets = get_option("betterwiki_link_brackets");

		switch ($betterwiki_link_brackets) {
		    case "1":
				$pattern3 = "!\[\[([^\]]*)\|\|(.*)\]\]!isU";
				$pattern2 = "!\[\[([^\]]*)\|(.*)\]\]!isU";	
				$pattern = "!\[\[(.*)\]\]!isU";
				break;	
		    case "2":
				$pattern3 = "!\(\(([^\)]*)\|\|(.*)\)\)!isU";
				$pattern2 = "!\(\(([^\)]*)\|(.*)\)\)!isU";	
				$pattern = "!\(\((.*)\)\)!isU";
				break;	
		    case "3":
				$pattern3 = "!\{\{([^\}]*)\|\|(.*)\}\}!isU";
				$pattern2 = "!\{\{([^\}]*)\|(.*)\}\}!isU";	
				$pattern = "!\{\{(.*)\}\}!isU";
				break;	
		    default:
				$pattern3 = "!\[\[([^\]]*)\|\|(.*)\]\]!isU";
				$pattern2 = "!\[\[([^\]]*)\|(.*)\]\]!isU";	
				$pattern = "!\[\[(.*)\]\]!isU";
				break;	
			}

	$content = preg_replace($pattern3,"<a href=\"http://$betterwiki_url$2\" target=\"$betterwiki_target\" $betterwiki_link_attributs>$2</a>",$content);
	
	$content = preg_replace($pattern2,"<a href=\"http://$betterwiki_url$1\" target=\"$betterwiki_target\" $betterwiki_link_attributs>$2</a>",$content);
	
	$content = preg_replace($pattern,"<a href=\"http://$betterwiki_url$1\" target=\"$betterwiki_target\" $betterwiki_link_attributs>$1</a>",$content);

	return $content;
  }

}

$sign &= new basswikilink();
////////////////////////////////////////////////////////////////////////////////////////////////////////

function betterwiki_link_option_page() {
global $betterwiki_target,$betterwiki_rel,$betterwiki_url,$betterwiki_alt_url,$better_link_version,$betterwiki_css,$betterwiki_link_brackets;


$betterwiki_alt_url =get_option(betterwiki_link_alt_wiki_url);

if ("en"  == get_option("betterwiki_link_language")){include('language/en_en.mo');};
if ("de"  == get_option("betterwiki_link_language")){include('language/de_de.mo');};
if ("nl"  == get_option("betterwiki_link_language")){include('language/nl_nl.mo');};
if ("fr"  == get_option("betterwiki_link_language")){include('language/fr_fr.mo');};
if ("es"  == get_option("betterwiki_link_language")){include('language/es_es.mo');};
if ("ch"  == get_option("betterwiki_link_language")){include('language/ch_ch.mo');};
if ("he"  == get_option("betterwiki_link_language")){include('language/he_he.mo');};
if ("no"  == get_option("betterwiki_link_language")){include('language/nb_no.mo');};
if ("pt"  == get_option("betterwiki_link_language")){include('language/pt_pt.mo');};
if ("ru"  == get_option("betterwiki_link_language")){include('language/ru_ru.mo');};
?>

<!-- Start Optionen im Adminbereich (xhtml, außerhalb PHP) -->
        <div class="wrap">
          <h2>Better-[[Wiki]]-Links Options Ver. <?=$better_link_version;?></h2>
<p><?=$better_link_text_opening;?></p>
<hr>
<form name="better_wiki_form" method="post" action="<?=$location ?>">
<input name="better_wiki_links_action" value="insert" type="hidden" />
          <p class=submit>
            <input type="submit" value="<?=$better_link_text_save;?>" />
	  </p>

<p>
<form name="better_wiki_form" method="post" action="<?=$location ?>">
<input name="better_wiki_links_action" value="insert" type="hidden" />
<table width="100%" border="0" cellspacing="0" cellpadding="6">

   	<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_language;?>:</b>
	</td><td align="left"><select name="betterwiki_link_language">
            <option value="en" <?php if ("en" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>English</option>
            <option value="de" <?php if ("de" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Deutsch / German</option>
            <option value="nl" <?php if ("no" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Nederlands / Dutch</option>
            <option value="no" <?php if ("no" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Norsk / Norway</option>
            <option value="he" <?php if ("he" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>עברית / Hebrew</option>
            <option value="es" <?php if ("es" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Español / Spanish</option>
            <option value="pt" <?php if ("pt" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Portugues / Portugues</option>
            <option value="fr" <?php if ("fr" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Francés (incomplet) / French</option>
            <option value="ch" <?php if ("ch" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>中國的 (不全的) / Chinese</option>
            <option value="ru" <?php if ("ru" == get_option("betterwiki_link_language")) { echo "selected";}; ?>>Русский / Russia</option>
          </select></td></tr>


   	<tr valign="top"><td width="25%" align="right">
	<b>Markierung:</b>
	</td><td align="left">
<input type="radio" name="betterwiki_link_brackets" value="1" <?php if ("1" == get_option("betterwiki_link_brackets")) { echo "checked";}; ?>>[[ ]] <br>
<input type="radio" name="betterwiki_link_brackets" value="2" <?php if ("2" == get_option("betterwiki_link_brackets")) { echo "checked";}; ?>>(( )) <br>
<input type="radio" name="betterwiki_link_brackets" value="3" <?php if ("3" == get_option("betterwiki_link_brackets")) { echo "checked";}; ?>>{{ }} 
          </td></tr>

       
<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_targetwiki;?>:</b>
	</td><td align="left"><select name="betterwiki_link_wiki">
<option value="google" <?php if ("google" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Google-Search</option>
            <option value="wiki-en" <?php if ("wiki-en" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (EN)</option>
            <option value="wiki-de" <?php if ("wiki-de" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (DE)</option>
            <option value="wiki-fr" <?php if ("wiki-fr" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Français)</option>
            <option value="wiki-ja" <?php if ("wiki-ja" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (日本語)</option>
            <option value="wiki-nl" <?php if ("wiki-nl" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Nederlands)</option>
            <option value="wiki-pl" <?php if ("wiki-pl" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Polski)</option>
            <option value="wiki-pt" <?php if ("wiki-pt" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Português)</option>
            <option value="wiki-ru" <?php if ("wiki-ru" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Русский)</option>
            <option value="wiki-sv" <?php if ("wiki-sv" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Svenska)</option>
            <option value="wiki-es" <?php if ("wiki-es" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Español)</option>
            <option value="wiki-no" <?php if ("wiki-no" == get_option("betterwiki_link_wiki")) { echo "selected";}; ?>>Wikipedia (Norsk)</option>
          </select></td></tr>          

<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_altwiki;?>:</b>
	</td><td align="left">
<input type="radio" name="betterwiki_link_alt_wiki_opt" value="1" <?php if ("1" == get_option("betterwiki_link_alt_wiki_opt")) { echo "checked";}; ?>><?=$better_link_text_yes;?> 
<input type="radio" name="betterwiki_link_alt_wiki_opt" value="0" <?php if ("0" == get_option("betterwiki_link_alt_wiki_opt")) { echo "checked";}; ?>><?=$better_link_text_no;?> 
<br>
            <INPUT type="text" name="betterwiki_link_alt_wiki_url" SIZE=60 value="<?php echo $betterwiki_alt_url;?>"><br>

<?=$better_link_link_target_example;?>
            </td></tr> 

<tr><td colspan=2><hr></td></tr>

   	<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_link;?>:</b>
	</td><td align="left"><select name="betterwiki_link_follow">
            <option value="follow" <?php if ("follow" == get_option("betterwiki_link_follow")) { echo "selected";}; ?>><?=$better_link_link_link_follow;?> (follow)</option>
            <option value="nofollow" <?php if ("nofollow" == get_option("betterwiki_link_follow")) { echo "selected";}; ?>><?=$better_link_link_link_nofollow;?> (nofollow)</option>
          </select></td></tr>

<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_target;?>:</b>
	</td><td align="left"><select name="betterwiki_link_target">
            <option value="top" <?php if ("top" == get_option("betterwiki_link_target")) { echo "selected";}; ?>><?=$better_link_link_target_top;?></option>
            <option value="blank" <?php if ("blank" == get_option("betterwiki_link_target")) { echo "selected";}; ?>><?=$better_link_link_target_blank;?></option>
          </select></td></tr> 
        
<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_tooltip;?>:</b>
	</td><td align="left">
<?=$better_link_tooltip_alt;?><br><input type="radio" name="betterwiki_link_alt" value="1" <?php if ("1" == get_option("betterwiki_link_alt")) { echo "checked";}; ?>><?=$better_link_text_yes;?> 
<input type="radio" name="betterwiki_link_alt" value="0" <?php if ("0" == get_option("betterwiki_link_alt")) { echo "checked";}; ?>><?=$better_link_text_no;?> 
<br><br>
<?=$better_link_tooltip_title;?><br><input type="radio" name="betterwiki_link_title" value="1" <?php if ("1" == get_option("betterwiki_link_title")) { echo "checked";}; ?>><?=$better_link_text_yes;?> 
<input type="radio" name="betterwiki_link_title" value="0" <?php if ("0" == get_option("betterwiki_link_title")) { echo "checked";}; ?>><?=$better_link_text_no;?> 
            </td></tr> 

<tr><td colspan=2><hr></td></tr>

<tr valign="top"><td width="25%" align="right">
	<b><?=$better_link_text_css;?>:</b>
	</td><td align="left">
<input type="radio" name="betterwiki_link_css_opt" value="1" <?php if ("1" == get_option("betterwiki_link_css_opt")) { echo "checked";}; ?>><?=$better_link_text_yes;?> 
<input type="radio" name="betterwiki_link_css_opt" value="0" <?php if ("0" == get_option("betterwiki_link_css_opt")) { echo "checked";}; ?>><?=$better_link_text_no;?> 
<br>
            <INPUT type="text" name="betterwiki_link_css_style" SIZE=60 value="<?php echo $betterwiki_css;?>"><br>

<?=$better_link_css_example;?>
            </td></tr> 

        </table>
          <p class=submit>
            <input type="submit" value="<?=$better_link_text_save;?>" />
	  </p>

</form>

</div>
<div class="wrap">
<p>
<hr>
<p>
<a href="http://www.amazon.de/gp/registry/PCQGMRMPPNLJ" target=_blank rel=nofollow><img src="http://www.bass-blogger.de/images/<?=$better_link_text_donate_pic;?>" border=0 align=right></a>
<?=$better_link_text_donate;?>
<br><br>
<p>
<hr>
<p>
Mein spezieller Dank  geht an <a href="http://www.bdsa.de">Olaf Felten</a> und <a href="http://www.interessante-zeiten.de/">Henning Rosenhagen</a> für Ihr wertvolles Wissen um Wordpress-PlugIns. Und natürlich Delta, der mich mit seinem Wikipedia-PlugIn auf die Idee gebracht hat, sowie <a href="http://www.bassic.de">Sam</a>, dem Macher von www.basserwisser.de.
</p>
<p>
Special thanks to:
<ul>
<li> <strong>Esti & Dan</strong> for their translation (hebrew, french & spanish) and for improving my english skills! :)
</li>
<li><strong>Herman</strong> for the norwegian translation</li>
<li><strong>Dmitry Bezgodov </strong> for the russian translation</li>
<li><strong><a href="http://www.planeta-informatica.com" target="_blank">Alyen</a></strong> for the spanish and portugues translation</li>
<li><strong><a href="http://pinkdot.nl" target="_blank">Martin Smit</a></strong> for the dutch translation</li>
</ul>
</p>
<hr>          
        <p class="copyright">Better-Wiki-Link &copy; by <a href="http://www.bass-blogger.de/wordpress-wikipedia-plugin/">Tim Charzinski</a> 2009</p>
        </div>

<?php
} // Ende Funktion betterwiki_link_option_page()


// Adminmenu Optionen erweitern

function betterwiki_link_add_menu() {
        add_option("betterwiki_link_follow","follow"); 
        add_option("betterwiki_link_wiki","wiki-de"); 
        add_option("betterwiki_link_target","blank"); 
        add_option("betterwiki_link_alt_wiki_opt","0"); 
        add_option("betterwiki_link_alt","0"); 
        add_option("betterwiki_link_title","0"); 
        add_option("betterwiki_link_alt_wiki_url","-"); 
        add_option("betterwiki_link_language","en"); 
        add_option("betterwiki_link_alt","0");
        add_option("betterwiki_link_title","0");
        add_option("betterwiki_link_css_opt","0");
        add_option("betterwiki_link_css_style","");
        add_option("betterwiki_link_brackets","1");
//optionenseite hinzufügen
        add_options_page('Better-Wiki Optionen', 'Better-Wiki-Link', 9, __FILE__, 'betterwiki_link_option_page'); 
}

if ('insert' == $HTTP_POST_VARS['better_wiki_links_action'])
{
    update_option("betterwiki_link_follow",$HTTP_POST_VARS['betterwiki_link_follow']);
    update_option("betterwiki_link_wiki",$HTTP_POST_VARS['betterwiki_link_wiki']);
    update_option("betterwiki_link_target",$HTTP_POST_VARS['betterwiki_link_target']);
    update_option("betterwiki_link_alt_wiki_opt",$HTTP_POST_VARS['betterwiki_link_alt_wiki_opt']);
    update_option("betterwiki_link_alt_wiki_url",$HTTP_POST_VARS['betterwiki_link_alt_wiki_url']);
    update_option("betterwiki_link_language",$HTTP_POST_VARS['betterwiki_link_language']);
    update_option("betterwiki_link_alt",$HTTP_POST_VARS['betterwiki_link_alt']);
    update_option("betterwiki_link_title",$HTTP_POST_VARS['betterwiki_link_title']);
    update_option("betterwiki_link_css_opt",$HTTP_POST_VARS['betterwiki_link_css_opt']);
    update_option("betterwiki_link_css_style",$HTTP_POST_VARS['betterwiki_link_css_style']);
    update_option("betterwiki_link_brackets",$HTTP_POST_VARS['betterwiki_link_brackets']);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////
# Registrieren der WordPress-Hooks
add_action('admin_menu', 'betterwiki_link_add_menu');
?>