��    /      �  C           e             �  
   �  f  �  �    �  �     �  5   �  �     T   �     �            5        N     c     g     �     �     �     �     �     �  	             #     9     J     `     q     �     �     �  
   �     �     �     �  
   �     �  (   �                &     2  	   ;  �  E  t   �     Y  
   i     t  �  }  ?    J  F     �  C   �  k   �  T   ^  #   �     �     �  C   �     1      I   0   L      }      �      �      �      �      �      !     !     )!     >!     N!     f!     y!     �!     �!  	   �!     �!     �!     �!     �!     �!     "  )   "  	   5"     ?"     D"     Q"     X"     "                         (                  %       !   .   *          '                          #             &   /       -                            
            	                       +                        $       ,   )         <span style="color:#ff0000">[ A T T E N T I O N ] NextGEN Gallery core modification required!</span> %1$s, at %2$s %s months ago 1 hour ago <p><strong>NextGEN Gallery Date: * * A T T E N T I O N * *</strong><br />This first release require a (little and simple) NextGen GALLERY core modification in order to work.</p><p><a href="admin.php?page=nggdate#nggcoremod">Click here to read instructions</a> and <a href="admin.php?page=nggdate&action=remove-notice">click here to remove this alert.</a></p> <p>This plugin, born as an add-on for the n.1 Wordpress Gallery Plugin <a href="http://wordpress.org/extend/plugins/nextgen-gallery/" target="_blank">NextGEN Gallery</a> (by <a href="http://alexrabe.de" target="_blank">Alex Rabe</a>), is developed by me (<a href="http://www.cantarano.com" target="_blank">check my website</a>), but it is only with your help that i can improve it, fix bugs, add some enhancements, etc...</p><p><strong>If you need to report bugs / errors / suggestions or any plugin related questions</strong>, you can leave me a message <a href="http://wordpress.org/tags/nextgen-gallery-date?forum_id=10" target="_blank">in the plugin forum</a>.</p><p style="font-size:20px;margin-top:20px">Enjoy the web ;)</p> <p>To use this plugin, you need to make a simple change to a NextGEN Gallery file(tested with version 1.8.3).<br />This will be necessary until the change will not be integrated (I have already sent the request to Alex Rabe).</p>To make the change, follow the instructions:<br /><br /><ol><li>Open the following file: <code>/wp-content/plugins/nextgen-gallery/<strong>nggfunctions.php</strong></code>;</li><li>The changes affect the function <strong>nggCreateAlbum</strong>, go to row <strong>580</strong>, just before the<br /><code>-----------------------<br />// check for page navigation<br />if ($maxElement > 0) {<br />------------------------</code></li><li>Enter the following filter:<br /><code>-----------------------<br /><strong>$galleries = apply_filters('ngg_album_galleries_before_paging', $galleries, $album);</strong><br />------------------------</code>;</li><li>To check if you have done correctly, <a href="/wp-content/plugins/nextgen-gallery-date/date/admin/images/ngg-new-filter.png" target="_blank"><strong>check this screenshot</strong></a>;</li><li>That's it :), <a href="admin.php?page=nggdate&action=remove-notice"><strong>Click here to remove the notice at the top</strong></a> if it is still visible.</li></ol></p> About NextGEN Gallery Date Enable the option to sort the galleries by date added If the above option is set to YES, this will define the default value for the order option you will find when you edit an album. If you choose YES, you will find the option to set the order when you edit an album. NextGEN Gallery Date Options No Save Changes Set the default value for the "sort galleries" option Successfully updated Yes Yes, sort by default settings Yes, sort by newest to oldest Yes, sort by oldest to newest a few minutes ago a week of %s by the end of this month earlier this month hours ago in %s months in the last half hour in the last hour in the next half hour in the next hour in the next minutes invalid date just now last %s last month more than a week ago more than a year ago next %s next month now sets the order of the galleries by date: this %s today today at %s tomorrow yesterday Project-Id-Version: NEXTGEN Date
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2011-08-28 19:04+0100
PO-Revision-Date: 2011-08-28 19:04+0100
Last-Translator: Roberto Cantarano <roberto@cantarano.com>
Language-Team: rcwd <roberto@cantarano.com>
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Poedit-KeywordsList: translate;__;_;_e;_n:1,2;_n;_x;_ex;_nx;esc_attr__;esc_attr_e;esc_attr_x;esc_html__;esc_html_e;esc_html_x;_n_noop;_n_nx_noop;translate_nooped_plural
X-Poedit-Basepath: .
X-Poedit-Language: Italian
X-Poedit-Country: ITALY
X-Poedit-SourceCharset: utf-8
Plural-Forms: nplurals=2; plural=n != 1;
X-Poedit-SearchPath-0: ..
  <span style="color:#ff0000">[ A T T E N Z I O N E ] è richiesta una modifica ad un file di NextGEN Gallery!</span> %1$s, alle %2$s %s mesi fa 1 ora fa <p><strong>NextGEN Gallery Date: * * A T T E N Z I O N E * *</strong><br />Questa prima release richiede una (piccola e semplice) modifica ad un file di NextGen GALLERY in modo da poter funzionare.</p><p><a href="admin.php?page=nggdate#nggcoremod">Clicca qui per leggere le istruzioni</a> e <a href="admin.php?page=nggdate&action=remove-notice">clicca qui per rimuovere questo avviso.</a></p> <p>Questo plugin, nato come un add-on per il plugin delle gallerie fotografiche di Wordpress n.1 <a href="http://wordpress.org/extend/plugins/nextgen-gallery/" target="_blank">NextGEN Gallery</a> (realizzato da <a href="http://alexrabe.de" target="_blank">Alex Rabe</a>), è sviluppato da me (<a href="http://www.cantarano.com" target="_blank">visita il mio sito web</a>), ma è solamente con il tuo aiuto che potrò continuare a migliorarlo, correggere eventuali bug, aggiungere nuove opzioni, ecc...</p><p><strong>Se hai bisogno di segnalare bug / errori / suggerimenti o qualunque altra domanda relativa al plugin</strong>, puoi lasciarmi un messaggio <a href="http://wordpress.org/tags/nextgen-gallery-date?forum_id=10" target="_blank">nel forum del plugin</a>.</p><p style="font-size:20px;margin-top:20px">Enjoy the web ;)</p> <p>Per usare questo plugin, devi effettuare una semplice modifica ad un file di NextGEN Gallery (testato con versione 1.8.3).<br />Questa operazione sarà necessaria fino a quando la modifica non verrà integrata (ho già inviato richiesta ad Alex Rabe).</p><p>Per eseguire la modifica, seguite le istruzioni:<br />    <ol>    <li>Apri il seguente file: <code>/wp-content/plugins/nextgen-gallery/<strong>nggfunctions.php</strong></code>;</li>    <li>La modifica riguarderà la funzione <strong>nggCreateAlbum</strong>, vai alla riga <strong>580</strong>, subito prima di<br />    <code>-----------------------<br />    // check for page navigation<br />     if ($maxElement > 0) {<br />     ------------------------</code></li>    <li>Inserisci il seguente filtro:<br /><code>-----------------------<br /><strong>$galleries = apply_filters('ngg_album_galleries_before_paging', $galleries, $album);</strong><br />     ------------------------</code>;    </li><li>Per controllare se hai fatto correttamente, <a href="/wp-content/plugins/nextgen-gallery-date/date/admin/images/ngg-new-filter.png" target="_blank"><strong>guarda questo screenshot</strong></a>;</li><li>Tutto qui :) Se hai completato, <a href="admin.php?page=nggdate&action=remove-notice"><strong>clicca qui per rimuovere l'avviso in alto</strong></a> se è ancora presente.</li>    </ol></p> Info su NextGEN Gallery Date Attivare l'opzione per ordinare le gallerie per data di inserimento Se l'opzione precedente è impostata su SI, questo definirà il valore predefinito per l'opzione di ordine. Se si sceglie Sì, troverete l'opzione di scelta ordine quando si modifica un album. NextGEN Gallery Date &rarr; Opzioni No Salva le modifiche Imposta il valore predefinito per l'opzione di ordinamento gallerie Aggiornato con successo Si Si, ordina in base alle impostazioni predefinite Si, ordina dalla più recente Si, ordina dalla più vecchia pochi minuti fa una settimana di %s entro la fine di questo mese all'inizio di questo mese ore fa entro %s mesi nell'ultima mezz'ora nell'ultima ora nella prossima mezz'ora nella prossima ora nei prossimi minuti data invalida adesso ultimo %s il mese scorso più di una settimana fa più di un anno fa il prossimo %s prossimo mese adesso imposta l'ordine delle gallerie per data: questo %s oggi oggi alle %s domani ieri 