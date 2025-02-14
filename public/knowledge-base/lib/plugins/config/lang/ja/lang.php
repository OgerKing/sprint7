<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author KAWASHIMA,Y <darknmatta@gmail.com>
 * @author HokkaidoPerson <dosankomali@yahoo.co.jp>
 * @author lempel <riverlempel@hotmail.com>
 * @author Yuji Takenaka <webmaster@davilin.com>
 * @author Christopher Smith <chris@jalakai.co.uk>
 * @author Ikuo Obataya <i.obataya@gmail.com>
 * @author Daniel Dupriest <kououken@gmail.com>
 * @author Kazutaka Miyasaka <kazmiya@gmail.com>
 * @author Taisuke Shimamoto <dentostar@gmail.com>
 * @author Satoshi Sahara <sahara.satoshi@gmail.com>
 * @author Hideaki SAWADA <chuno@live.jp>
 */
$lang['menu']                  = 'サイト設定';
$lang['error']                 = '不正な値が存在するため、設定は更新されませんでした。入力値を確認してから、再度更新してください。
                       <br />不正な値が入力されている項目は赤い線で囲まれています。';
$lang['updated']               = '設定は正しく更新されました。';
$lang['nochoice']              = '（他の選択肢はありません）';
$lang['locked']                = '設定用ファイルを更新できません。もし意図して変更不可にしているのでなければ、<br />
                       ローカル設定ファイルの名前と権限を確認して下さい。';
$lang['danger']                = '危険：この設定を変更するとウィキや設定管理画面にアクセスできなくなる恐れがあります。';
$lang['warning']               = '注意：この設定を変更すると意図しない動作につながる可能性があります。';
$lang['security']              = 'セキュリティ警告：この設定を変更するとセキュリティに悪影響する恐れがあります。';
$lang['_configuration_manager'] = '設定管理';
$lang['_header_dokuwiki']      = 'DokuWiki';
$lang['_header_plugin']        = 'プラグイン';
$lang['_header_template']      = 'テンプレート';
$lang['_header_undefined']     = 'その他';
$lang['_basic']                = '基本';
$lang['_display']              = '表示';
$lang['_authentication']       = '認証';
$lang['_anti_spam']            = 'スパム対策';
$lang['_editing']              = '編集';
$lang['_links']                = 'リンク';
$lang['_media']                = 'メディア';
$lang['_notifications']        = '通知設定';
$lang['_syndication']          = '配信設定（RSS）';
$lang['_advanced']             = '高度な設定';
$lang['_network']              = 'ネットワーク';
$lang['_msg_setting_undefined'] = '設定のためのメタデータがありません。';
$lang['_msg_setting_no_class'] = '設定クラスがありません。';
$lang['_msg_setting_no_known_class'] = 'クラス設定が利用出来ません。';
$lang['_msg_setting_no_default'] = '初期値が設定されていません。';
$lang['title']                 = 'Wikiタイトル（あなたのWikiの名前）';
$lang['start']                 = 'スタートページ名（各名前空間の始点として使われるページ名）';
$lang['lang']                  = '使用言語';
$lang['template']              = 'テンプレート（Wikiのデザイン）';
$lang['tagline']               = 'キャッチフレーズ（テンプレートが対応している場合に有効）';
$lang['sidebar']               = 'サイドバー用ページ名（テンプレートが対応している場合に有効。空欄でサイドバーを無効化します。）';
$lang['license']               = '作成した内容をどのライセンスでリリースするか';
$lang['savedir']               = 'データ保存用のディレクトリ';
$lang['basedir']               = 'サーバのパス (例: <code>/dokuwiki/</code>)<br>空欄にすると自動的に検出します。';
$lang['baseurl']               = 'サーバの URL (例: <code>http://www.yourserver.com</code>)<br>空欄にすると自動的に検出します。';
$lang['cookiedir']             = 'Cookie のパス（空欄にすると baseurl を使用します。）';
$lang['dmode']                 = 'フォルダ作成マスク';
$lang['fmode']                 = 'ファイル作成マスク';
$lang['allowdebug']            = 'デバッグモード（<b>必要で無いときは無効にしてください</b>）';
$lang['recent']                = '最近の変更で1ページごとに表示する数';
$lang['recent_days']           = '最近の変更とする期間（日数）';
$lang['breadcrumbs']           = 'トレース（パンくず）表示数（0で無効化します）';
$lang['youarehere']            = '現在位置を表示（こちらをオンにする場合、恐らく、上のオプションをオフにしたいとも思うでしょう）';
$lang['fullpath']              = 'ページのフッターに絶対パスを表示';
$lang['typography']            = 'タイポグラフィー変換';
$lang['dformat']               = '日付フォーマット（PHPの<a href="http://php.net/strftime">strftime</a>関数を参照）';
$lang['signature']             = 'エディターの署名ボタンで挿入する内容';
$lang['showuseras']            = '最終編集者の情報として表示する内容';
$lang['toptoclevel']           = '目次のトップレベル見出し';
$lang['tocminheads']           = '目次を生成する最小見出し数';
$lang['maxtoclevel']           = '目次に表示する最大レベルの見出し';
$lang['maxseclevel']           = '部分編集を有効にする最大レベルの見出し';
$lang['camelcase']             = 'キャメルケースリンクを使う';
$lang['deaccent']              = 'ページ名の変換方法';
$lang['useheading']            = '最初の見出しをページ名とする';
$lang['sneaky_index']          = 'デフォルトでは索引にすべての名前空間を表示しますが、このオプションを有効にすると、ユーザーに閲覧権限のない名前空間を非表示にします。ただし、閲覧が可能な副名前空間まで表示されなくなるため、ACLの設定が適正でない場合は索引機能が使えなくなる場合があります。';
$lang['hidepages']             = '検索、サイトマップ、その他の自動インデックスの結果に表示しないページ';
$lang['useacl']                = 'アクセス管理（ACL）を行う';
$lang['autopasswd']            = 'パスワードの自動生成';
$lang['authtype']              = '認証方法';
$lang['passcrypt']             = '暗号化方法';
$lang['defaultgroup']          = 'デフォルトグループ（全てのユーザーがこのグループに属します。）';
$lang['superuser']             = 'スーパーユーザー（ACL設定に関わらず全てのページと機能へのアクセス権を有します。グループ、ユーザー、もしくはそれらをカンマ区切りしたリスト（例：user1,@group1,user2）を入力して下さい。）';
$lang['manager']               = 'マネージャー（特定の管理機能へのアクセス権を有します。グループ、ユーザー、もしくはそれらをカンマ区切りしたリスト（例：user1,@group1,user2）を入力して下さい。）';
$lang['profileconfirm']        = 'プロフィール変更時に現在のパスワードを要求';
$lang['rememberme']            = 'ログイン用クッキーを永久に保持することを許可（ログインを保持）';
$lang['disableactions']        = 'DokuWiki の動作を無効にする';
$lang['disableactions_check']  = 'チェック';
$lang['disableactions_subscription'] = '変更履歴配信の登録・解除';
$lang['disableactions_wikicode'] = 'ソース閲覧 / 生データ出力';
$lang['disableactions_profile_delete'] = '自分のアカウントの抹消';
$lang['disableactions_other']  = 'その他の動作（カンマ区切り）';
$lang['disableactions_rss']    = 'XML 配信（RSS）';
$lang['auth_security_timeout'] = '認証タイムアウト設定（秒）';
$lang['securecookie']          = 'クッキーをHTTPSにてセットする場合は、ブラウザよりHTTPS経由で送信された場合にみに制限する（ログインのみをSSLで行う場合は、この機能を無効にしてください。）';
$lang['remote']                = 'リモートAPIを有効化（有効化するとXML-RPCまたは他の手段でwikiにアプリケーションがアクセスすることを許可します。）';
$lang['remoteuser']            = 'リモートAPIへのアクセス許可（カンマ区切りで指定されたグループ、またはユーザーに対してのみ許可します。空白の場合は、すべてのユーザにアクセスを許可します。）';
$lang['usewordblock']          = '単語リストに基づくスパムブロック';
$lang['relnofollow']           = '外部リンクにrel="ugc nofollow"を付加';
$lang['indexdelay']            = 'インデックスを許可（何秒後）';
$lang['mailguard']             = 'メールアドレス保護';
$lang['iexssprotect']          = 'アップロードファイルに悪意のあるJavaScriptやHTMLが含まれていないかチェックする';
$lang['usedraft']              = '編集中の自動保存（ドラフト）機能を使用';
$lang['locktime']              = 'ファイルロック期限（秒）';
$lang['cachetime']             = 'キャッシュ保持時間（秒）';
$lang['target____wiki']        = '内部リンクのtarget属性';
$lang['target____interwiki']   = 'InterWikiリンクのtarget属性';
$lang['target____extern']      = '外部リンクのtarget属性';
$lang['target____media']       = 'メディアリンクのtarget属性';
$lang['target____windows']     = 'Windowsリンクのtarget属性';
$lang['mediarevisions']        = 'メディアファイルの履歴を有効にする';
$lang['refcheck']              = 'メディアファイルを削除する前に、それがまだ使われているかどうかチェックする';
$lang['gdlib']                 = 'GDlibバージョン';
$lang['im_convert']            = 'ImageMagick変換ツールへのパス';
$lang['jpg_quality']           = 'JPG圧縮品質（0-100）';
$lang['fetchsize']             = 'fetch.phpが外部URLからダウンロードする内容（キャッシュ保存や、外部イメージのリサイズなど）の最大サイズ（バイト数指定）';
$lang['subscribers']           = 'ユーザーがEメールで更新通知を受ける機能を有効にする';
$lang['subscribe_time']        = '購読リストと概要を送信する期間（秒）<br>「最近の変更とする期間（recent_days）」で指定した期間より小さくしてください。';
$lang['notify']                = '変更を常に通知する送信先メールアドレス';
$lang['registernotify']        = '新規ユーザー登録を常に通知する送信先メールアドレス';
$lang['mailfrom']              = 'メール自動送信時の送信元アドレス';
$lang['mailreturnpath']        = '不届き通知を受け取るメールアドレス';
$lang['mailprefix']            = '自動メールの題名に使用する接頭語（空欄の場合、Wikiタイトルが使用されます。）';
$lang['htmlmail']              = 'メールをテキスト形式ではなく、HTML形式で送信する（見た目は良くなりますが、サイズは大きくなります。このオプションを無効にすると、プレーンテキストのみのメールを送信します。）';
$lang['sitemap']               = 'Googleサイトマップ作成頻度（日数。0で無効化します。）';
$lang['rss_type']              = 'XMLフィード形式';
$lang['rss_linkto']            = 'XMLフィード内リンク先';
$lang['rss_content']           = 'XMLフィードに表示する内容';
$lang['rss_update']            = 'XMLフィードの更新間隔（秒）';
$lang['rss_show_summary']      = 'XMLフィードのタイトルに概要を表示';
$lang['rss_show_deleted']      = '削除されたフィードを含める';
$lang['rss_media']             = 'XMLフィードで、どんな種類の変更を記載するか';
$lang['rss_media_o_both']      = '両方';
$lang['rss_media_o_pages']     = 'ページ';
$lang['rss_media_o_media']     = 'メディア';
$lang['updatecheck']           = 'DokuWikiの更新とセキュリティに関する情報をチェックする（この機能は update.dokuwiki.org への接続が必要です。）';
$lang['userewrite']            = 'URLの書き換え';
$lang['useslash']              = 'URL上の名前空間の区切りにスラッシュを使用';
$lang['sepchar']               = 'ページ名の単語区切り文字';
$lang['canonical']             = 'canonical URL（正準URL）を使用';
$lang['fnencode']              = '非アスキーファイル名のエンコーディング方法';
$lang['autoplural']            = 'リンク内での自動複数形処理';
$lang['compression']           = 'アーカイブファイルの圧縮方法';
$lang['gzip_output']           = 'xhtmlに対するコンテンツ圧縮（gzip）を使用';
$lang['compress']              = 'CSSとJavaScriptを圧縮';
$lang['cssdatauri']            = 'HTTP リクエスト数によるオーバーヘッドを減らすため、CSS ファイルから参照される画像ファイルのサイズがここで指定するバイト数以内の場合は CSS ファイル内に Data URI として埋め込みます。 <code>400</code> から <code>600</code> バイトがちょうどよい値です。<code>0</code> を指定すると埋め込み処理は行われません。';
$lang['send404']               = '文書が存在しないページに"HTTP404/Page Not Found"を使用';
$lang['broken_iua']            = 'お使いのシステムのignore_user_abort関数が故障している場合、このオプションを有効にして下さい。そのままだと、検索インデックスが動作しない可能性があります。IIS+PHP/CGIの組み合わせで破損することが判明しています。詳しくは<a href="http://bugs.splitbrain.org/?do=details&amp;task_id=852">Bug 852</a>を参照してください。';
$lang['xsendfile']             = 'ウェブサーバーが静的ファイルを生成する際に X-Sendfile ヘッダーを使用する（お使いのウェブサーバーがこの機能をサポートしている必要があります。）';
$lang['renderer_xhtml']        = 'Wikiの出力（xhtml）に使用するレンダラー';
$lang['renderer__core']        = '%s （Dokuwikiコア）';
$lang['renderer__plugin']      = '%s （プラグイン）';
$lang['search_nslimit']        = '現在の名前空間 X 内のみ検索する<br>より下層の名前空間から検索が実行された場合、最初の名前空間 X がフィルターとして追加されます。';
$lang['search_fragment']       = '部分検索の規定の動作を指定する';
$lang['search_fragment_o_exact'] = '完全一致';
$lang['search_fragment_o_starts_with'] = '前方一致';
$lang['search_fragment_o_ends_with'] = '後方一致';
$lang['search_fragment_o_contains'] = '部分一致';
$lang['trustedproxy']          = '報告される真のクライアントIPに関して、ここで指定する正規表現に合う転送プロキシを信頼します。あらゆるプロキシを信頼する場合は、何も入力しないでおいて下さい。';
$lang['_feature_flags']        = '機能フラグ';
$lang['defer_js']              = 'ページのHTMLが解析されるまでJavascriptの実行を延期する（ページの読み込み速度が向上しますが、一部のプラグインが正常に動作しない可能性があります）';
$lang['dnslookups']            = 'ページを編集しているユーザーのIPアドレスからホスト名を逆引きする（利用できるDNSサーバーがない、あるいはこの機能が不要な場合にはオフにします。）';
$lang['jquerycdn']             = 'コンテンツ・デリバリー・ネットワーク (CDN) の選択（jQuery と jQuery UI スクリプトを CDN からロードさせる場合には、追加的な HTTP リクエストが発生しますが、ブラウザキャッシュが使用されるため、表示速度の向上が期待できます。）';
$lang['jquerycdn_o_0']         = 'CDN を使用せず、ローカルデリバリーのみ使用する';
$lang['jquerycdn_o_jquery']    = 'CDN: code.jquery.com を使用';
$lang['jquerycdn_o_cdnjs']     = 'CDN: cdnjs.com を使用';
$lang['proxy____host']         = 'プロキシ - サーバー名';
$lang['proxy____port']         = 'プロキシ - ポート';
$lang['proxy____user']         = 'プロキシ - ユーザー名';
$lang['proxy____pass']         = 'プロキシ - パスワード';
$lang['proxy____ssl']          = 'プロキシへの接続にsslを使用';
$lang['proxy____except']       = 'スキップするプロキシのURL正規表現';
$lang['license_o_']            = '選択されていません';
$lang['typography_o_0']        = '変換しない';
$lang['typography_o_1']        = '二重引用符（ダブルクオート）のみ';
$lang['typography_o_2']        = 'すべての引用符（動作しない場合があります）';
$lang['userewrite_o_0']        = '使用しない';
$lang['userewrite_o_1']        = '.htaccess';
$lang['userewrite_o_2']        = 'DokuWikiによる設定';
$lang['deaccent_o_0']          = '変換しない';
$lang['deaccent_o_1']          = 'アクセント付きの文字からアクセントを取り除く';
$lang['deaccent_o_2']          = 'ローマ字化';
$lang['gdlib_o_0']             = 'GD Libが利用不可';
$lang['gdlib_o_1']             = 'バージョン 1.x';
$lang['gdlib_o_2']             = '自動検出';
$lang['rss_type_o_rss']        = 'RSS 0.91';
$lang['rss_type_o_rss1']       = 'RSS 1.0';
$lang['rss_type_o_rss2']       = 'RSS 2.0';
$lang['rss_type_o_atom']       = 'Atom 0.3';
$lang['rss_type_o_atom1']      = 'Atom 1.0';
$lang['rss_content_o_abstract'] = '概要';
$lang['rss_content_o_diff']    = '差分（Unified Diff）';
$lang['rss_content_o_htmldiff'] = '差分（HTML形式）';
$lang['rss_content_o_html']    = '完全なHTMLページ';
$lang['rss_linkto_o_diff']     = '変更点のリスト';
$lang['rss_linkto_o_page']     = '変更されたページ';
$lang['rss_linkto_o_rev']      = 'リビジョンのリスト';
$lang['rss_linkto_o_current']  = '現在のページ';
$lang['compression_o_0']       = '圧縮しない';
$lang['compression_o_gz']      = 'gzip';
$lang['compression_o_bz2']     = 'bz2';
$lang['xsendfile_o_0']         = '使用しない';
$lang['xsendfile_o_1']         = 'lighttpd ヘッダー（リリース1.5以前）';
$lang['xsendfile_o_2']         = '標準 X-Sendfile ヘッダー';
$lang['xsendfile_o_3']         = 'Nginx X-Accel-Redirect ヘッダー';
$lang['showuseras_o_loginname'] = 'ログイン名';
$lang['showuseras_o_username'] = 'ユーザーのフルネーム';
$lang['showuseras_o_username_link'] = 'user という InterWiki リンクになったユーザーのフルネーム';
$lang['showuseras_o_email']    = 'ユーザーのメールアドレス（メールガード設定による難読化）';
$lang['showuseras_o_email_link'] = 'ユーザーのメールアドレスをmailtoリンクにする';
$lang['useheading_o_0']        = '使用しない';
$lang['useheading_o_navigation'] = 'ナビゲーションのみ';
$lang['useheading_o_content']  = 'Wikiの内容のみ';
$lang['useheading_o_1']        = '常に使用する';
$lang['readdircache']          = 'readdir キャッシュの最大保持期間（秒）';
