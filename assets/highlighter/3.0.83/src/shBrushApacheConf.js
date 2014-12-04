/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/SyntaxHighlighter
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/SyntaxHighlighter/donate.html
 *
 * @version
 * 3.0.83 (July 02 2010)
 * 
 * @SyntaxHighlighter copyright
 * Copyright (C) 2004-2010 Alex Gorbatchev.
 *
 * @ApacheConf copyright
 * Copyright (C) 2010-2011 Sandro Bilbeisi.
 *
 * @license
 * Dual licensed under the MIT and GPL licenses.
 */
;(function()
{
	// CommonJS
	typeof(require) != 'undefined' ? SyntaxHighlighter = require('shCore').SyntaxHighlighter : null;

	function Brush()
	{

		var apacheDirectives =	'/AuthnProviderAlias /Directory /DirectoryMatch /Files /FilesMatch /IfDefine /IfModule /IfVersion /Limit /LimitExcept /Location /LocationMatch /Proxy /ProxyMatch /VirtualHost AcceptFilter AcceptMutex AcceptPathInfo AccessConfig AccessFileName Action AddAlt AddAltByEncoding AddAltByType AddCharset AddDefaultCharset AddDescription AddEncoding AddHandler AddIcon AddIconByEncoding AddIconByType AddInputFilter AddLanguage AddModule AddModuleInfo AddOutputFilter AddOutputFilterByType AddType AgentLog Alias AliasMatch Allow AllowCONNECT AllowEncodedSlashes AllowOverride Anonymous Anonymous_Authoritative Anonymous_LogEmail Anonymous_MustGiveEmail Anonymous_NoUserID Anonymous_VerifyEmail AssignUserID AuthAuthoritative AuthBasicAuthoritative AuthBasicProvider AuthDBAuthoritative AuthDBDUserPWQuery AuthDBDUserRealmQuery AuthDBGroupFile AuthDBMAuthoritative AuthDBMGroupFile AuthDBMType AuthDBMUserFile AuthDBUserFile AuthDefaultAuthoritative AuthDigestAlgorithm AuthDigestDomain AuthDigestFile AuthDigestGroupFile AuthDigestNcCheck AuthDigestNonceFormat AuthDigestNonceLifetime AuthDigestProvider AuthDigestQop AuthDigestShmemSize AuthGroupFile AuthLDAPAuthoritative AuthLDAPBindDN AuthLDAPBindPassword AuthLDAPCharsetConfig AuthLDAPCompareDNOnServer AuthLDAPDereferenceAliases AuthLDAPEnabled AuthLDAPFrontPageHack AuthLDAPGroupAttribute AuthLDAPGroupAttributeIsDN AuthLDAPRemoteUserAttribute AuthLDAPRemoteUserIsDN AuthLDAPUrl AuthName AuthnProviderAlias AuthTokenLimitByIp AuthTokenPrefix AuthTokenSecret AuthTokenTimeout AuthType AuthUserFile AuthzDBMAuthoritative AuthzDBMType AuthzDefaultAuthoritative AuthzGroupFileAuthoritative AuthzLDAPAuthoritative AuthzOwnerAuthoritative AuthzUserAuthoritative BalancerMember BindAddress BrowserMatch BrowserMatchNoCase BS2000Account BufferedLogs CacheDefaultExpire CacheDirLength CacheDirLevels CacheDisable CacheEnable CacheExpiryCheck CacheFile CacheForceCompletion CacheGcClean CacheGcDaily CacheGcInterval CacheGcMemUsage CacheGcUnused CacheIgnoreCacheControl CacheIgnoreHeaders CacheIgnoreNoLastMod CacheIgnoreQueryString CacheLastModifiedFactor CacheMaxExpire CacheMaxFileSize CacheMinFileSize CacheNegotiatedDocs CacheRoot CacheSize CacheStoreNoStore CacheStorePrivate CacheTimeMargin CGICommandArgs CGIMapExtension CharsetDefault CharsetOptions CharsetSourceEnc CheckCaseOnly CheckSpelling ChildPerUserID ClearModuleList ContentDigest CookieDomain CookieExpires CookieFormat CookieLog CookieLogCookieLog CookieName CookiePrefix CookieStyle CookieTracking CoreDumpDirectory CustomLog Dav DavDepthInfinity DavGenericLockDB DavLockDB DavMinTimeout DBDExptime DBDKeep DBDMax DBDMin DBDParams DBDPersist DBDPrepareSQL DBDriver DefaultIcon DefaultLanguage DefaultType DeflateBufferSize DeflateCompressionLevel DeflateFilterNote DeflateMemLevel DeflateWindowSize Deny Directory DirectoryIndex DirectoryMatch DirectorySlash DocumentRoot DumpIOInput DumpIOLogLevel DumpIOOutput EBCDICConvert EBCDICConvertByType EBCDICKludge EnableExceptionHook EnableMMAP EnableSendfile ErrorDocument ErrorHeader ErrorLog Example ExpiresActive ExpiresByType ExpiresDefault ExtendedStatus ExtFilterDefine ExtFilterOptions FancyIndexing FileETag FilterChain FilterDeclare FilterProtocol FilterProvider FilterTrace ForceLanguagePriority ForceType ForensicLog GracefulShutdownTimeout Group Header HeaderName HostnameLookups IdentityCheck IdentityCheckTimeout IfDefine IfVersion ImapBase ImapDefault ImapMenu Include IndexIgnore IndexOptions IndexOrderDefault IndexStyleSheet ISAPIAppendLogToErrors ISAPIAppendLogToQuery ISAPICacheFile ISAPIFakeAsync ISAPILogNotSupported ISAPIReadAheadBuffer KeepAlive KeepAliveTimeout LanguagePriority LDAPCacheEntries LDAPCacheTTL LDAPConnectionTimeout LDAPOpCacheEntries LDAPOpCacheTTL LDAPSharedCacheFile LDAPSharedCacheSize LDAPTrustedCA LDAPTrustedCAType LDAPTrustedClientCert LDAPTrustedGlobalCert LDAPTrustedMode LDAPVerifyServerCert Limit LimitExcept LimitInternalRecursion LimitRequestBody LimitRequestFields LimitRequestFieldsize LimitRequestLine LimitXMLRequestBody Listen ListenBacklog LoadFile LoadModule Location LocationMatch LockFile LogFormat LogLevel MaxClients MaxKeepAliveRequests MaxMemFree MaxRequestsPerChild MaxRequestsPerThread MaxSpareServers MaxSpareThreads MaxThreads MaxThreadsPerChild MCacheMaxObjectCount MCacheMaxObjectSize MCacheMaxStreamingBuffer MCacheMinObjectSize MCacheRemovalAlgorithm MCacheSize MetaDir MetaFiles MetaSuffix MimeMagicFile MIMEMagicFile MinSpareServers MinSpareThreads MMapFile ModMimeUsePathInfo MultiviewsMatch NameVirtualHost NoCache NoProxy NumServers NWSSLTrustedCerts NWSSLUpgradeable Options Order PassEnv PidFile Port Prefer ProtocolEcho ProtocolReqCheck Proxy ProxyBadHeader ProxyBlock ProxyDomain ProxyErrorOverride ProxyHTMLURLMap ProxyIOBufferSize ProxyMatch ProxyMaxForwards ProxyPass ProxyPassReverse ProxyPassReverseCookieDomain ProxyPassReverseCookiePath ProxyPreserveHost ProxyReceiveBufferSize ProxyRemote ProxyRemoteMatch ProxyRequests ProxyTimeout ProxyVia ReadmeName ReceiveBufferSize Redirect RedirectMatch RedirectPermanent RedirectTemp RefererIgnore RefererLog RegisterUserSite RemoveCharset RemoveEncoding RemoveHandler RemoveInputFilter RemoveLanguage RemoveOutputFilter RemoveType RequestHeader Require ResourceConfig RewriteBase RewriteCond RewriteEngine RewriteLock RewriteLog RewriteLogLevel RewriteMap RewriteOptions RewriteRule RLimitCPU RLimitMEM RLimitNPROC Satisfy ScoreBoardFile Script ScriptAlias ScriptAliasMatch ScriptInterpreterSource ScriptLog ScriptLogBuffer ScriptLogLength ScriptSock Scriptsock SecureListen SendBufferSize ServerAdmin ServerAlias ServerLimit ServerName ServerPath ServerRoot ServerSignature ServerTokens ServerType SetEnv SetEnvIf SetEnvIfNoCase SetHandler SetInputFilter SetOutputFilter ShmemUIDisUser SSIEndTag SSIErrorMsg SSIStartTag SSITimeFormat SSIUndefinedEcho SSLCACertificateFile SSLCACertificatePath SSLCADNRequestFile SSLCADNRequestPath SSLCARevocationFile SSLCARevocationPath SSLCertificateChainFile SSLCertificateFile SSLCertificateKeyFile SSLCipherSuite SSLCryptoDevice SSLEngine SSLHonorCipherOrder SSLMutex SSLOptions SSLPassPhraseDialog SSLProtocol SSLProxyCACertificateFile SSLProxyCACertificatePath SSLProxyCARevocationFile SSLProxyCARevocationPath SSLProxyCipherSuite SSLProxyEngine SSLProxyMachineCertificateFile SSLProxyMachineCertificatePath SSLProxyProtocol SSLProxyVerify SSLProxyVerifyDepth SSLRandomSeed SSLRequire SSLRequireSSL SSLSessionCache SSLSessionCacheTimeout SSLUserName SSLVerifyClient SSLVerifyDepth StartServers StartThreads SuexecUserGroup ThreadLimit ThreadsPerChild ThreadStackSize Timeout TraceEnable TransferLog TypesConfig UnsetEnv UseCanonicalName UseCanonicalPhysicalPort User UserDir VirtualDocumentRoot VirtualDocumentRootIP VirtualHost VirtualScriptAlias VirtualScriptAliasIP Win32DisableAcceptEx XBitHack set unset php_admin_flag php_admin_value php_flag php_value mod_gzip_on mod_gzip_dechunk mod_gzip_item_include mod_gzip_item_exclude';

		var apacheAttributes =	'agent All all allow Any Ascending asis AuthConfig Basic block Cache-Control cgi-script combined combinedio common CONNECT COPY crit Date debug DEFLATE DELETE deny Descending Description Digest dns double downgrade-1.0 EMail emerg error ExecCGI Expires Fallback file FileInfo FollowSymLinks force-response-1.0 formatted from Full GET handler Host imap-file INCLUDES Includes IncludesNOEXEC IncludesNoExec Indexes inetd info isapi-isa Last-Modified Limit LOCK map max mime Minimal MKCOL MOVE MultiViews Name nocontent No nokeepalive None notice Off off On on OPTIONS OS PATCH POST Pragma prefer-language ProductOnly PROPFIND PROPPATCH PUT redirect-carefully referer Remote_Addr Remote_Host Remote_User REQUEST_FILENAME Request_Method Request_Protocol Request_URI semiformatted rspheader send-as-is server-parsed server-status Size standalone SymLinksIfOwnerMatch TRACE type-map unformatted UNLOCK valid-user var VersionSort warn Yes'; 

		//var specialModules =	'SSL';

		var specialValues =	'ISO-8859-1 iso8859-1 latin1 ISO-8859-2 iso8859-2 latin2 cen ISO-8859-3 iso8859-3 latin3 ISO-8859-4 iso8859-4 latin4 ISO-8859-5 iso8859-5 latin5 cyr iso-ru ISO-8859-6 iso8859-6 latin6 arb ISO-8859-7 iso8859-7 latin7 grk ISO-8859-8 iso8859-8 latin8 heb ISO-8859-9 iso8859-9 latin9 trk ISO-2022-JP iso2022-jp jis ISO-2022-KR iso2022-kr kis ISO-2022-CN iso2022-cn cis Big5 Big5 big5 WINDOWS-1251 cp-1251 win-1251 CP866 cp866 KOI8-r koi8-r koi8-ru KOI8-ru koi8-uk ua ISO-10646-UCS-2 ucs2 ISO-10646-UCS-4 ucs4 UTF-8 utf8 GB2312 gb2312 gb utf-7 utf7 utf-8 utf8 big5 big5 b5 EUC-TW euc-tw EUC-JP euc-jp EUC-KR euc-kr shift_jis sjis';


		this.regexList = [
			{ regex: SyntaxHighlighter.regexLib.singleLinePerlComments,	css: 'comments' },			// one line comments
			{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },			// double quoted strings
			/* Block Directives*/
			{ regex: /(&lt;IfDefine\s)/gm, 			css: 'script' },
			{ regex: /(&lt;\/IfDefine&gt;)/gm, 				css: 'script' },			{ regex: /(&lt;IfModule\s)/gm, 			css: 'script' },
			{ regex: /(&lt;\/IfModule&gt;)/gm, 				css: 'script' },
			{ regex: /(&lt;Files\s)/gm, 				css: 'script' },
			{ regex: /(&lt;\/Files&gt;)/gm, 			css: 'script' },
			{ regex: /(&lt;FilesMatch\s)/gm, 		css: 'script' },
			{ regex: /(&lt;\/FilesMatch&gt;)/gm, 	css: 'script' },
			{ regex: /(&lt;Directory\s)/gm, 			css: 'script' },
			{ regex: /(&lt;\/Directory&gt;)/gm, 		css: 'script' },
			{ regex: /(&lt;DirectoryMatch\s)/gm, 	css: 'script' },
			{ regex: /(&lt;\/DirectoryMatch&gt;)/gm, css: 'script' },
			{ regex: /(&lt;Limit\s)/gm, 				css: 'script' },
			{ regex: /(&lt;\/Limit&gt;)/gm, 			css: 'script' },
			{ regex: /(&lt;LimitExcept\s)/gm, 		css: 'script' },
			{ regex: /(&lt;\/LimitExcept&gt;)/gm, 	css: 'script' },
			{ regex: /(&lt;Location\s)/gm, 			css: 'script' },
			{ regex: /(&lt;\/Location&gt;)/gm, 		css: 'script' },
			{ regex: /(&lt;LocationExcept\s)/gm, 	css: 'script' },
			{ regex: /(&lt;\/LocationExcept&gt;)/gm, css: 'script' },
			{ regex: /(&lt;VirtualHost\s)/gm, 		css: 'script' },
			{ regex: /(&lt;\/VirtualHost&gt;)/gm, 	css: 'script' },
			{ regex: /(&gt;)/gm, 	css: 'script' },

			{ regex: /([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/gm, 	css: 'variable' }, // email
			{ regex: /([^\s]*-handler)/gm, 	css: 'functions' }, //for addhandler
			{ regex: /([^\s]*_module)/gm, 	css: 'functions' }, //for LoadModule alias
			{ regex: /([^\s]*\.c)/gm, 	css: 'functions' }, // for IfModule mo_rewrite.c and others
			/*{ regex: /([^\s]*\.php)/gm, 	css: 'functions' },*/ //for Files wp-login.php
			/*{ regex: /^ (\[o\]*)(?=\.c)>$/gm, 	css: 'functions' },*/
			{ regex: /([^\s]*\.so)/gm, 	css: 'variable' }, // for Loadmodule path
			/*{ regex: new RegExp(this.getKeywords(specialModules), 'gm'),	css: 'functions' },			// reserved keywords*/
			{ regex: new RegExp(this.getKeywords(specialValues), 'gm'),	css: 'variable' },			// special values
			{ regex: /\b\d+\.?\w*/g, 						css: 'variable' },
			
			{ regex: new RegExp(this.getKeywords(apacheDirectives), 'gm'),	css: 'constants' },			// apache directives
			{ regex: new RegExp(this.getKeywords(apacheAttributes), 'gm'),	css: 'variable' }			// apache attributes
		];

	};

	Brush.prototype	= new SyntaxHighlighter.Highlighter();
	Brush.aliases	= ['apacheconf'];

	SyntaxHighlighter.brushes.ApacheConf = Brush;

	// CommonJS
	typeof(exports) != 'undefined' ? exports.Brush = Brush : null;
})();
