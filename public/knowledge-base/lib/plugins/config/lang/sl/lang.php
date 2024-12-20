<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * Slovenian language file
 *
 * @author Dejan Levec <webphp@gmail.com>
 * @author Boštjan Seničar <senicar@gmail.com>
 * @author Gregor Skumavc (grega.skumavc@gmail.com)
 * @author Matej Urbančič (mateju@svn.gnome.org)
 */
$lang['menu']                  = 'Splošne nastavitve';
$lang['error']                 = 'Nastavitve niso shranjene zaradi neveljavne vrednosti.<br />Neveljavna vrednost je označena z rdečim robom vnosnega polja.';
$lang['updated']               = 'Nastavitve so uspešno posodobljene.';
$lang['nochoice']              = '(ni drugih možnosti na voljo)';
$lang['locked']                = 'Nastavitvene datoteke ni mogoče posodobiti.<br />Preverite dovoljenja za spreminjanje in ime nastavitvene datoteke.';
$lang['danger']                = 'Opozorilo: spreminjanje te možnosti lahko povzroči težave v delovanju sistema wiki.';
$lang['warning']               = 'Opozorilo: spreminjanje te možnosti lahko vpliva na pravilno delovanje sistema wiki.';
$lang['security']              = 'Varnostno opozorilo: spreminjanje te možnosti lahko vpliva na varnost sistema.';
$lang['_configuration_manager'] = 'Upravljalnik nastavitev';
$lang['_header_dokuwiki']      = 'Nastavitve DokuWiki';
$lang['_header_plugin']        = 'Nastavitve vstavkov';
$lang['_header_template']      = 'Nastavitve predlog';
$lang['_header_undefined']     = 'Neopredeljene nastavitve';
$lang['_basic']                = 'Osnovne nastavitve';
$lang['_display']              = 'Nastavitve prikazovanja';
$lang['_authentication']       = 'Nastavitve overjanja';
$lang['_anti_spam']            = 'Nastavitve neželenih sporočil (Anti-Spam)';
$lang['_editing']              = 'Nastavitve urejanja';
$lang['_links']                = 'Nastavitve povezav';
$lang['_media']                = 'Predstavne nastavitve';
$lang['_advanced']             = 'Napredne nastavitve';
$lang['_network']              = 'Omrežne nastavitve';
$lang['_msg_setting_undefined'] = 'Ni nastavitvenih metapodatkov.';
$lang['_msg_setting_no_class'] = 'Ni nastavitvenega razreda.';
$lang['_msg_setting_no_default'] = 'Ni privzete vrednosti.';
$lang['title']                 = 'Naslov Wiki spletišča';
$lang['start']                 = 'Ime začetne strani wiki';
$lang['lang']                  = 'Jezik vmesnika';
$lang['template']              = 'Predloga';
$lang['tagline']               = 'Označna vrstica (ob podpori predloge)';
$lang['sidebar']               = 'Ime strani stranske vrstice (ob podpori predloge); prazno polje onemogoči stransko vrstico.';
$lang['license']               = 'Pod pogoji katerega dovoljenja je objavljena vsebina?';
$lang['savedir']               = 'Mapa za shranjevanje podatkov';
$lang['basedir']               = 'Pot do strežnika (npr. /dokuwiki/). Prazno polje določa samodejno zaznavanje';
$lang['baseurl']               = 'Naslov URL strežnika (npr. http://www.streznik.si). Prazno polje določa samodejno zaznavanje';
$lang['cookiedir']             = 'Pot do piškotka. Prazno polje določa uporabo osnovnega naslova (baseurl)';
$lang['dmode']                 = 'Način ustvarjanja map';
$lang['fmode']                 = 'Način ustvarjanja datotek';
$lang['allowdebug']            = 'Dovoli razhroščevanje (po potrebi!)';
$lang['recent']                = 'Nedavne spremembe';
$lang['recent_days']           = 'Koliko nedavnih sprememb naj se ohrani (v dnevih)';
$lang['breadcrumbs']           = 'Število drobtinic poti';
$lang['youarehere']            = 'Hierarhične drobtinice poti';
$lang['fullpath']              = 'Pokaži polno pot strani v nogi strani';
$lang['typography']            = 'Omogoči tipografske zamenjave';
$lang['dformat']               = 'Oblika zapisa časa (funkcija PHP <a href="http://php.net/strftime">strftime</a>)';
$lang['signature']             = 'Podpis';
$lang['showuseras']            = 'Kaj prikazati za prikaz uporabnika, ki je zadnji urejal stran';
$lang['toptoclevel']           = 'Vrhnja raven kazala';
$lang['tocminheads']           = 'Najmanjše število naslovov za izgradnjo kazala';
$lang['maxtoclevel']           = 'Najvišja raven kazala';
$lang['maxseclevel']           = 'Največja raven urejanja odseka';
$lang['camelcase']             = 'Uporabi EnoBesedni zapisa za povezave';
$lang['deaccent']              = 'Počisti imena strani';
$lang['useheading']            = 'Uporabi prvi naslov za ime strani';
$lang['sneaky_index']          = 'Privzeto pokaže sistem DokuWiki vse imenske prostore v pogledu kazala. Z omogočanjem te možnosti bodo skriti vsi imenski prostori, v katere prijavljen uporabnik nima dovoljenj dostopa. S tem je mogoče preprečiti dostop do podrejenih strani. Možnost lahko vpliva na uporabnost nastavitev nadzora dostopa ACL.';
$lang['hidepages']             = 'Skrij skladne strani (logični izraz)';
$lang['useacl']                = 'Uporabi seznam nadzora dostopa (ACL)';
$lang['autopasswd']            = 'Samodejno ustvari gesla';
$lang['authtype']              = 'Ozadnji način overitve';
$lang['passcrypt']             = 'Način šifriranja gesel';
$lang['defaultgroup']          = 'Privzeta skupina';
$lang['superuser']             = 'Skrbnik - skupina, uporabnik ali z vejico ločen seznam uporabnik1,@skupina1,uporabnik2 s polnim dostopom do vseh strani in možnosti, neodvisno od nastavitev nadzora dostopa ACL';
$lang['manager']               = 'Upravljavec - skupina, uporabnik ali z vejico ločen seznam uporabnik1,@skupina1,uporabnik2 z dovoljenji za dostop do nekaterih možnosti upravljanja';
$lang['profileconfirm']        = 'Potrdi spremembe profila z geslom';
$lang['rememberme']            = 'Dovoli trajne prijavne piškotke (trajno pomnenje prijave)';
$lang['disableactions']        = 'Onemogoči dejanja DokuWiki';
$lang['disableactions_check']  = 'Preveri';
$lang['disableactions_subscription'] = 'Naročanje/Preklic naročnine';
$lang['disableactions_wikicode'] = 'Pogled izvorne kode/Surovi izvoz';
$lang['disableactions_other']  = 'Druga dejanja (z vejico ločen seznam)';
$lang['auth_security_timeout'] = 'Varnostna časovna omejitev overitve (v sekundah)';
$lang['securecookie']          = 'Ali naj se piškotki poslani preko varne povezave HTTPS v brskalniku pošiljajo le preko HTTPS? Onemogočanje možnosti je priporočljivo le takrat, ko je prijava varovana s protokolom  SSL, brskanje po strani pa ni posebej zavarovano.';
$lang['usewordblock']          = 'Zaustavi neželeno besedilo glede na seznam besed';
$lang['relnofollow']           = 'Uporabni možnost rel="nofollow" pri zunanjih povezavah';
$lang['indexdelay']            = 'Časovni zamik pred ustvarjanjem kazala (v sekundah)';
$lang['mailguard']             = 'Šifriraj elektronske naslove';
$lang['iexssprotect']          = 'Preveri poslane datoteke za zlonamerno kodo JavaScript ali HTML';
$lang['usedraft']              = 'Samodejno shrani osnutek med urejanjem strani';
$lang['locktime']              = 'Največja dovoljena starost datotek zaklepa (v sekundah)';
$lang['cachetime']             = 'Največja dovoljena starost predpomnilnika (v sekundah)';
$lang['target____wiki']        = 'Ciljno okno za notranje povezave';
$lang['target____interwiki']   = 'Ciljno okno za notranje wiki povezave';
$lang['target____extern']      = 'Ciljno okno za zunanje povezave';
$lang['target____media']       = 'Ciljno okno za predstavne povezave';
$lang['target____windows']     = 'Ciljno okno za povezave oken';
$lang['mediarevisions']        = 'Ali naj se omogočijo objave predstavnih vsebin?';
$lang['refcheck']              = 'Preverjanje sklica predstavnih datotek';
$lang['gdlib']                 = 'Različica GD Lib';
$lang['im_convert']            = 'Pot do orodja za pretvarjanje slik ImageMagick';
$lang['jpg_quality']           = 'Kakovost stiskanja datotek JPG (0-100)';
$lang['fetchsize']             = 'največja dovoljena velikost zunanjega prejemanja z datoteko fetch.php (v bajtih)';
$lang['subscribers']           = 'Omogoči podporo naročanju na strani';
$lang['subscribe_time']        = 'Čas po katerem so poslani povzetki sprememb (v sekundah); Vrednost mora biti krajša od časa, ki je določen z nedavno_dni.';
$lang['notify']                = 'Pošlji obvestila o spremembah na določen elektronski naslov';
$lang['registernotify']        = 'Pošlji obvestila o novih vpisanih uporabnikih na določen elektronski naslov';
$lang['mailfrom']              = 'Elektronski naslov za samodejno poslana sporočila';
$lang['mailprefix']            = 'Predpona zadeve elektronskega sporočila za samodejna sporočila.';
$lang['sitemap']               = 'Ustvari Google kazalo strani (v dnevih)';
$lang['rss_type']              = 'Vrsta virov XML';
$lang['rss_linkto']            = 'XML viri so povezani z';
$lang['rss_content']           = 'Kaj prikazati med predmeti virov XML?';
$lang['rss_update']            = 'Časovni razmik posodobitve virov XML (v sekundah)';
$lang['rss_show_summary']      = 'Viri XML so povzeti v naslovu';
$lang['updatecheck']           = 'Ali naj sistem preveri za posodobitve in varnostna opozorila.';
$lang['userewrite']            = 'Uporabi olepšan zapis naslovov URL';
$lang['useslash']              = 'Uporabi poševnico kot ločilnik imenskih prostorov v naslovih URL';
$lang['sepchar']               = 'Ločilnik besed imen strani';
$lang['canonical']             = 'Uporabi polni kanonični zapis naslova URL';
$lang['fnencode']              = 'Način kodiranja ne-ASCII imen datotek.';
$lang['autoplural']            = 'Preveri množinske oblike povezav';
$lang['compression']           = 'Način stiskanja za arhivirane datoteke';
$lang['gzip_output']           = 'Uporabi stiskanje gzip vsebine za xhtml';
$lang['compress']              = 'Združi odvod CSS in JavaScript v brskalniku';
$lang['cssdatauri']            = 'Velikost sklicanih slik v bajtih, ki so navedene v datotekah CSS za zmanjšanje zahtev osveževanja strežnika HTTP. Ustrezne vrednosti so <code>400</code> do <code>600</code> bajtov. Vrednost <code>0</code> onemogoči možnost.';
$lang['send404']               = 'Pošlji "HTTP 404/Strani ni mogoče najti" pri dostopu do neobstoječih strani';
$lang['broken_iua']            = 'Ali je možnost ignore_user_abort okvarjena na sistemu? Napaka lahko vpliva na delovanje iskalnika. Napake so pogoste ob uporabi IIS+PHP/CGI. Več o tem si je mogoče prebrati v <a href="http://bugs.splitbrain.org/?do=details&amp;task_id=852">poročilu o hrošču 852</a>.';
$lang['xsendfile']             = 'Uporabi glavo X-Sendfile za prejemanje statičnih datotek. Spletni strežnik mora možnost podpirati.';
$lang['renderer_xhtml']        = 'Izrisovalnik za odvod Wiki strani (xhtml)';
$lang['renderer__core']        = '%s (jedro dokuwiki)';
$lang['renderer__plugin']      = '%s (vstavek)';
$lang['proxy____host']         = 'Ime posredniškega strežnika';
$lang['proxy____port']         = 'Vrata posredniškega strežnika';
$lang['proxy____user']         = 'Uporabniško ime posredniškega strežnika';
$lang['proxy____pass']         = 'Geslo posredniškega strežnika';
$lang['proxy____ssl']          = 'Uporabi varno povezavo SSL za povezavo z posredniškim strežnikom';
$lang['proxy____except']       = 'Logični izrazi morajo biti skladni z naslovi URL, ki gredo mimo posredniškega strežnika.';
$lang['license_o_']            = 'Ni izbranega dovoljenja';
$lang['typography_o_0']        = 'brez';
$lang['typography_o_1']        = 'izloči enojne narekovaje';
$lang['typography_o_2']        = 'z enojnimi narekovaji (lahko včasih ne deluje)';
$lang['userewrite_o_0']        = 'brez';
$lang['userewrite_o_1']        = '.htaccess';
$lang['userewrite_o_2']        = 'notranji DokuWiki';
$lang['deaccent_o_0']          = 'onemogočeno';
$lang['deaccent_o_1']          = 'odstrani naglasne oznake';
$lang['deaccent_o_2']          = 'pretvori v romanski zapis';
$lang['gdlib_o_0']             = 'Knjižnica GD Lib ni na voljo';
$lang['gdlib_o_1']             = 'Različica 1.x';
$lang['gdlib_o_2']             = 'Samodejno zaznavanje';
$lang['rss_type_o_rss']        = 'RSS 0.91';
$lang['rss_type_o_rss1']       = 'RSS 1.0';
$lang['rss_type_o_rss2']       = 'RSS 2.0';
$lang['rss_type_o_atom']       = 'Atom 0.3';
$lang['rss_type_o_atom1']      = 'Atom 1.0';
$lang['rss_content_o_abstract'] = 'Povzetek';
$lang['rss_content_o_diff']    = 'Poenotena primerjava';
$lang['rss_content_o_htmldiff'] = 'HTML oblikovana preglednica primerjave';
$lang['rss_content_o_html']    = 'Polna HTML vsebina strani';
$lang['rss_linkto_o_diff']     = 'primerjalni pogled';
$lang['rss_linkto_o_page']     = 'pregledana stran';
$lang['rss_linkto_o_rev']      = 'seznam pregledovanj';
$lang['rss_linkto_o_current']  = 'trenutna stran';
$lang['compression_o_0']       = 'brez';
$lang['compression_o_gz']      = 'gzip';
$lang['compression_o_bz2']     = 'bz2';
$lang['xsendfile_o_0']         = 'ne uporabi';
$lang['xsendfile_o_1']         = 'lastniška glava lighttpd (pred različico 1.5)';
$lang['xsendfile_o_2']         = 'običajna glava X-Sendfile';
$lang['xsendfile_o_3']         = 'lastniška glava Nginx X-Accel-Redirect';
$lang['showuseras_o_loginname'] = 'Prijavno ime';
$lang['showuseras_o_username'] = 'Polno ime uporabnika';
$lang['showuseras_o_email']    = 'Elektronski naslov uporabnika (šifriran po določilih varovanja)';
$lang['showuseras_o_email_link'] = 'Elektronski naslov uporabnika kot povezava mailto:';
$lang['useheading_o_0']        = 'nikoli';
$lang['useheading_o_navigation'] = 'le za krmarjenje';
$lang['useheading_o_content']  = 'le za vsebino Wiki';
$lang['useheading_o_1']        = 'vedno';
$lang['readdircache']          = 'Največja dovoljena starost predpomnilnika prebranih map (v sekundah)';
