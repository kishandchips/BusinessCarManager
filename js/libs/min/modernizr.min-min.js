window.Modernizr=function(e,t,n){function r(e){v.cssText=e}function o(e,t){return r(E.join(e+";")+(t||""))}function i(e,t){return typeof e===t}function a(e,t){return!!~(""+e).indexOf(t)}function c(e,t){for(var r in e){var o=e[r];if(!a(o,"-")&&v[o]!==n)return"pfx"==t?o:!0}return!1}function s(e,t,r){for(var o in e){var a=t[e[o]];if(a!==n)return r===!1?e[o]:i(a,"function")?a.bind(r||t):a}return!1}function u(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),o=(e+" "+S.join(r+" ")+r).split(" ");return i(t,"string")||i(t,"undefined")?c(o,t):(o=(e+" "+C.join(r+" ")+r).split(" "),s(o,t,n))}var l="2.8.3",f={},d=!0,p=t.documentElement,m="modernizr",h=t.createElement(m),v=h.style,y,g=":)",b={}.toString,E=" -webkit- -moz- -o- -ms- ".split(" "),x="Webkit Moz O ms",S=x.split(" "),C=x.toLowerCase().split(" "),w={},j={},M={},z=[],T=z.slice,N,k=function(e,n,r,o){var i,a,c,s,u=t.createElement("div"),l=t.body,f=l||t.createElement("body");if(parseInt(r,10))for(;r--;)c=t.createElement("div"),c.id=o?o[r]:m+(r+1),u.appendChild(c);return i=["&#173;",'<style id="s',m,'">',e,"</style>"].join(""),u.id=m,(l?u:f).innerHTML+=i,f.appendChild(u),l||(f.style.background="",f.style.overflow="hidden",s=p.style.overflow,p.style.overflow="hidden",p.appendChild(f)),a=n(u,e),l?u.parentNode.removeChild(u):(f.parentNode.removeChild(f),p.style.overflow=s),!!a},F=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t)&&n(t).matches||!1;var r;return k("@media "+t+" { #"+m+" { position: absolute; } }",function(t){r="absolute"==(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle).position}),r},A=function(){function e(e,o){o=o||t.createElement(r[e]||"div"),e="on"+e;var a=e in o;return a||(o.setAttribute||(o=t.createElement("div")),o.setAttribute&&o.removeAttribute&&(o.setAttribute(e,""),a=i(o[e],"function"),i(o[e],"undefined")||(o[e]=n),o.removeAttribute(e))),o=null,a}var r={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return e}(),O={}.hasOwnProperty,D;D=i(O,"undefined")||i(O.call,"undefined")?function(e,t){return t in e&&i(e.constructor.prototype[t],"undefined")}:function(e,t){return O.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=T.call(arguments,1),r=function(){if(this instanceof r){var o=function(){};o.prototype=t.prototype;var i=new o,a=t.apply(i,n.concat(T.call(arguments)));return Object(a)===a?a:i}return t.apply(e,n.concat(T.call(arguments)))};return r}),w.flexbox=function(){return u("flexWrap")},w.touch=function(){var n;return"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:k(["@media (",E.join("touch-enabled),("),m,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(e){n=9===e.offsetTop}),n},w.rgba=function(){return r("background-color:rgba(150,255,150,.5)"),a(v.backgroundColor,"rgba")},w.backgroundsize=function(){return u("backgroundSize")},w.textshadow=function(){return""===t.createElement("div").style.textShadow},w.opacity=function(){return o("opacity:.55"),/^0.55$/.test(v.opacity)},w.csstransforms=function(){return!!u("transform")},w.csstransitions=function(){return u("transition")},w.fontface=function(){var e;return k('@font-face {font-family:"font";src:url("https://")}',function(n,r){var o=t.getElementById("smodernizr"),i=o.sheet||o.styleSheet,a=i?i.cssRules&&i.cssRules[0]?i.cssRules[0].cssText:i.cssText||"":"";e=/src/i.test(a)&&0===a.indexOf(r.split(" ")[0])}),e},w.generatedcontent=function(){var e;return k(["#",m,"{font:0/0 a}#",m,':after{content:"',g,'";visibility:hidden;font:3px/1 a}'].join(""),function(t){e=t.offsetHeight>=3}),e};for(var L in w)D(w,L)&&(N=L.toLowerCase(),f[N]=w[L](),z.push((f[N]?"":"no-")+N));return f.addTest=function(e,t){if("object"==typeof e)for(var r in e)D(e,r)&&f.addTest(r,e[r]);else{if(e=e.toLowerCase(),f[e]!==n)return f;t="function"==typeof t?t():t,"undefined"!=typeof d&&d&&(p.className+=" "+(t?"":"no-")+e),f[e]=t}return f},r(""),h=y=null,function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=g.elements;return"string"==typeof e?e.split(" "):e}function o(e){var t=v[e[m]];return t||(t={},h++,e[m]=h,v[h]=t),t}function i(e,n,r){if(n||(n=t),y)return n.createElement(e);r||(r=o(n));var i;return i=r.cache[e]?r.cache[e].cloneNode():d.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!i.canHaveChildren||f.test(e)||i.tagUrn?i:r.frag.appendChild(i)}function a(e,n){if(e||(e=t),y)return e.createDocumentFragment();n=n||o(e);for(var i=n.frag.cloneNode(),a=0,c=r(),s=c.length;s>a;a++)i.createElement(c[a]);return i}function c(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return g.shivMethods?i(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(g,t.frag)}function s(e){e||(e=t);var r=o(e);return g.shivCSS&&!p&&!r.hasCSS&&(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),y||c(e,r),e}var u="3.7.0",l=e.html5||{},f=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,d=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,p,m="_html5shiv",h=0,v={},y;!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",p="hidden"in e,y=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){p=!0,y=!0}}();var g={elements:l.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:u,shivCSS:l.shivCSS!==!1,supportsUnknownElements:y,shivMethods:l.shivMethods!==!1,type:"default",shivDocument:s,createElement:i,createDocumentFragment:a};e.html5=g,s(t)}(this,t),f._version=l,f._prefixes=E,f._domPrefixes=C,f._cssomPrefixes=S,f.mq=F,f.hasEvent=A,f.testProp=function(e){return c([e])},f.testAllProps=u,f.testStyles=k,f.prefixed=function(e,t,n){return t?u(e,t,n):u(e,"pfx")},p.className=p.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(d?" js "+z.join(" "):""),f}(this,this.document),function(e,t,n){function r(e){return"[object Function]"==m.call(e)}function o(e){return"string"==typeof e}function i(){}function a(e){return!e||"loaded"==e||"complete"==e||"uninitialized"==e}function c(){var e=h.shift();v=1,e?e.t?d(function(){("c"==e.t?z.injectCss:z.injectJs)(e.s,0,e.a,e.x,e.e,1)},0):(e(),c()):v=0}function s(e,n,r,o,i,s,u){function l(t){if(!m&&a(f.readyState)&&(E.r=m=1,!v&&c(),f.onload=f.onreadystatechange=null,t)){"img"!=e&&d(function(){b.removeChild(f)},50);for(var r in w[n])w[n].hasOwnProperty(r)&&w[n][r].onload()}}var u=u||z.errorTimeout,f=t.createElement(e),m=0,y=0,E={t:r,s:n,e:i,a:s,x:u};1===w[n]&&(y=1,w[n]=[]),"object"==e?f.data=n:(f.src=n,f.type=e),f.width=f.height="0",f.onerror=f.onload=f.onreadystatechange=function(){l.call(this,y)},h.splice(o,0,E),"img"!=e&&(y||2===w[n]?(b.insertBefore(f,g?null:p),d(l,u)):w[n].push(f))}function u(e,t,n,r,i){return v=0,t=t||"j",o(e)?s("c"==t?x:E,e,t,this.i++,n,r,i):(h.splice(this.i++,0,e),1==h.length&&c()),this}function l(){var e=z;return e.loader={load:u,i:0},e}var f=t.documentElement,d=e.setTimeout,p=t.getElementsByTagName("script")[0],m={}.toString,h=[],v=0,y="MozAppearance"in f.style,g=y&&!!t.createRange().compareNode,b=g?f:p.parentNode,f=e.opera&&"[object Opera]"==m.call(e.opera),f=!!t.attachEvent&&!f,E=y?"object":f?"script":"img",x=f?"script":E,S=Array.isArray||function(e){return"[object Array]"==m.call(e)},C=[],w={},j={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}},M,z;z=function(e){function t(e){var e=e.split("!"),t=C.length,n=e.pop(),r=e.length,n={url:n,origUrl:n,prefixes:e},o,i,a;for(i=0;r>i;i++)a=e[i].split("="),(o=j[a.shift()])&&(n=o(n,a));for(i=0;t>i;i++)n=C[i](n);return n}function a(e,o,i,a,c){var s=t(e),u=s.autoCallback;s.url.split(".").pop().split("?").shift(),s.bypass||(o&&(o=r(o)?o:o[e]||o[a]||o[e.split("/").pop().split("?")[0]]),s.instead?s.instead(e,o,i,a,c):(w[s.url]?s.noexec=!0:w[s.url]=1,i.load(s.url,s.forceCSS||!s.forceJS&&"css"==s.url.split(".").pop().split("?").shift()?"c":n,s.noexec,s.attrs,s.timeout),(r(o)||r(u))&&i.load(function(){l(),o&&o(s.origUrl,c,a),u&&u(s.origUrl,c,a),w[s.url]=2})))}function c(e,t){function n(e,n){if(e){if(o(e))n||(u=function(){var e=[].slice.call(arguments);l.apply(this,e),f()}),a(e,u,t,0,c);else if(Object(e)===e)for(p in d=function(){var t=0,n;for(n in e)e.hasOwnProperty(n)&&t++;return t}(),e)e.hasOwnProperty(p)&&(!n&&!--d&&(r(u)?u=function(){var e=[].slice.call(arguments);l.apply(this,e),f()}:u[p]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),f()}}(l[p])),a(e[p],u,t,p,c))}else!n&&f()}var c=!!e.test,s=e.load||e.both,u=e.callback||i,l=u,f=e.complete||i,d,p;n(c?e.yep:e.nope,!!s),s&&n(s)}var s,u,f=this.yepnope.loader;if(o(e))a(e,0,f,0);else if(S(e))for(s=0;s<e.length;s++)u=e[s],o(u)?a(u,0,f,0):S(u)?z(u):Object(u)===u&&c(u,f);else Object(e)===e&&c(e,f)},z.addPrefix=function(e,t){j[e]=t},z.addFilter=function(e){C.push(e)},z.errorTimeout=1e4,null==t.readyState&&t.addEventListener&&(t.readyState="loading",t.addEventListener("DOMContentLoaded",M=function(){t.removeEventListener("DOMContentLoaded",M,0),t.readyState="complete"},0)),e.yepnope=l(),e.yepnope.executeStack=c,e.yepnope.injectJs=function(e,n,r,o,s,u){var l=t.createElement("script"),f,m,o=o||z.errorTimeout;l.src=e;for(m in r)l.setAttribute(m,r[m]);n=u?c:n||i,l.onreadystatechange=l.onload=function(){!f&&a(l.readyState)&&(f=1,n(),l.onload=l.onreadystatechange=null)},d(function(){f||(f=1,n(1))},o),s?l.onload():p.parentNode.insertBefore(l,p)},e.yepnope.injectCss=function(e,n,r,o,a,s){var o=t.createElement("link"),u,n=s?c:n||i;o.href=e,o.rel="stylesheet",o.type="text/css";for(u in r)o.setAttribute(u,r[u]);a||(p.parentNode.insertBefore(o,p),d(n,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))},Modernizr.addTest("boxsizing",function(){return Modernizr.testAllProps("boxSizing")&&(void 0===document.documentMode||document.documentMode>7)}),Modernizr.addTest("cssvhunit",function(){var e;return Modernizr.testStyles("#modernizr { height: 50vh; }",function(t,n){var r=parseInt(window.innerHeight/2,10),o=parseInt((window.getComputedStyle?getComputedStyle(t,null):t.currentStyle).height,10);e=o==r}),e}),Modernizr.addTest("csscalc",function(){var e="width:",t="calc(10px);",n=document.createElement("div");return n.style.cssText=e+Modernizr._prefixes.join(t+e),!!n.style.length});