/*!
 * MUA v1.0.0 (http://mua.asthis.net)
 * Copyright 2014-2014 AsThis
 * Licensed under MIT (http://mua.asthis.net/LICENSE)
 */
if("undefined"==typeof jQuery)throw new Error("MUA's JavaScript requires jQuery");!function(a,b,c){"use strict";var d=b.MUA||{},e=b("html"),f=b(window);d.version="1.0.0",d.langdirection="rtl"===e.attr("dir")?"right":"left",d.support={},d.support.touch="ontouchstart"in window&&navigator.userAgent.toLowerCase().match(/mobile|tablet/)||a.DocumentTouch&&document instanceof a.DocumentTouch||a.navigator.msPointerEnabled&&a.navigator.msMaxTouchPoints>0||a.navigator.pointerEnabled&&a.navigator.maxTouchPoints>0||!1,d.support.transition=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.support.animation=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.utils={},d.utils.options=function(a){if(b.isPlainObject(a))return a;var c=a?a.indexOf("{"):-1,d={};if(-1!==c)try{d=new Function("","var json = "+a.substr(c)+';if ("undefined" == typeof(JSON)) { return json; }else { return JSON.parse(JSON.stringify(json)); }')()}catch(e){}return d},d.utils.isInView=function(a,c){var d=a;if(!d.is(":visible"))return!1;var e=f.scrollLeft(),g=f.scrollTop(),h=d.offset(),i=h.left,j=h.top;return c=b.extend({topoffset:0,leftoffset:0},c),j+d.height()>=g&&j-c.topoffset<=g+f.height()&&i+d.width()>=e&&i-c.leftoffset<=e+f.width()?!0:!1},b.MUA=d}(window,jQuery,window.document),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d);var e=this;this.element.on("click",this.options.trigger,function(a){e.close(),a.preventDefault()})};c.defaults={fade:!0,duration:200,trigger:".alert-close"},c.prototype.close=function(){function a(){b.remove()}var b=this.element;this.options.fade?b.css("overflow","hidden").css("max-height",b.height()).animate({height:0,opacity:0,"padding-top":0,"padding-bottom":0,"margin-top":0,"margin-bottom":0},this.options.duration,a):a()},a(document).ready(function(){a("[data-alert]").each(function(){var d=a(this);new c(d,b.utils.options(d.data("alert")))})})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=a(b),this.target=this.element.find(".dropdown"),this.options=a.extend({},c.defaults,d),this.centered=this.target.hasClass("dropdown-center"),this.justified=this.options.justify?a(this.options.justify):!1;var e=this,f=!1;"click"===this.options.mode?this.element.on("click",function(a){e.show(),a.preventDefault()}):f=setTimeout(function(){e.show()},e.options.remaintime),this.element.on("mouseleave",function(){clearTimeout(f),f=setTimeout(function(){e.target.hide()},e.options.remaintime)}).children().on("mouseenter",function(){clearTimeout(f)})};c.defaults={mode:"hover",remaintime:200,justify:!1},c.prototype.show=function(){var a=this.target.css("margin-left","").css("min-width",""),b=a.show().offset(),c=a.outerWidth();if(this.centered&&(a.css("margin-left",-1*(parseFloat(c)/2-a.parent().width()/2)),b=a.offset(),b.left<0&&(a.css("margin-left",""),b=a.offset())),this.justified&&this.justified.length){var d=this.justified.outerWidth();a.css("min-width",d),a.css("margin-left",this.justified.offset().left-b.left),b=a.offset()}};var d=a.fn.dropdown;a.fn.dropdown=function(){return this.each(function(){a(this).on("mouseenter.dropdown.MUA",function(){var d=a(this);new c(d,b.utils.options(d.data("dropdown")))})})},a.fn.dropdown.noConflict=function(){return a.fn.dropdown=d,this},a(document).on("mouseenter.dropdown.MUA","[data-dropdown]",function(){var d=a(this);new c(d,b.utils.options(d.data("dropdown")))})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=a("html"),d=function(b,c){var d=this;this.element=b,this.options=a.extend({target:this.element.is("a")?this.element.attr("href"):!1},c),d.show(),a(this.options.target).on("click",".close",function(a){d.hide(),a.preventDefault()}),a(document).on("keydown",function(a){27===a.keyCode&&(d.hide(),a.preventDefault())})};d.prototype.show=function(){var b=a(this.options.target);b.length&&(b.removeClass("open").show(),c.addClass("modal-page").height(),b.addClass("open"))},d.prototype.hide=function(){var d=a(this.options.target);c.removeClass("modal-page").css("padding-"+("left"===b.langdirection?"right":"left"),""),d.hide().removeClass("open")},a(document).on("click.modal.MUA","[data-modal]",function(c){c.preventDefault();var e=a(this);new d(e,b.utils.options(e.data("modal")))})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d);var e=this;this.element.on("click",'> li.nav-parent > a[href="#"]',function(b){var c=a(this).parent(),d=c.hasClass("open");e.options.multiple||e.element.find("> li.nav-parent").removeClass("open"),d?c.removeClass("open"):c.addClass("open"),b.preventDefault()})};c.defaults={multiple:!1},a(document).ready(function(){a("[data-nav]").each(function(){var d=a(this);new c(d,b.utils.options(d.data("nav")))})})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c,d=a(window),e=a(document),f=function(b,c){this.element=b,this.options=a.extend({target:this.element.is("a")?this.element.attr("href"):!1},c),f.show(this.options.target),e.on("keydown.offcanvas.MUA",function(a){27===a.keyCode&&f.hide()})};f.show=function(b){var e=a(b);if(e.length){var g=a("html"),h=e.find(".offcanvas-bar:first"),i="right"===a.MUA.langdirection,j=(h.hasClass("offcanvas-bar-flip")?-1:1)*(i?-1:1),k=-1===j&&d.width()<window.innerWidth?window.innerWidth-d.width():0;c={x:window.scrollX,y:window.scrollY},e.addClass("active"),g.css({width:window.innerWidth,height:window.innerHeight}).addClass("offcanvas-page"),g.css(i?"margin-right":"margin-left",(i?-1:1)*(h.outerWidth()-k)*j).width(),h.addClass("offcanvas-bar-show").width(),e.off(".offcanvas").on("click.offcanvas swipeRight.offcanvas swipeLeft.offcanvas",function(b){var c=a(b.target);if(!b.type.match(/swipe/)&&!c.hasClass("offcanvas-close")){if(c.hasClass("offcanvas-bar"))return;if(c.parents(".offcanvas-bar:first").length)return}b.stopImmediatePropagation(),f.hide()})}},f.hide=function(b){var d=a("html"),e=a(".offcanvas.active"),f="right"===a.MUA.langdirection,g=e.find(".offcanvas-bar:first");e.length&&(a.MUA.support.transition&&!b?(d.one(a.MUA.support.transition.end,function(){d.removeClass("offcanvas-page").attr("style",""),e.removeClass("active"),window.scrollTo(c.x,c.y)}).css(f?"margin-right":"margin-left",""),setTimeout(function(){g.removeClass("offcanvas-bar-show")},50)):(d.removeClass("offcanvas-page").attr("style",""),e.removeClass("active"),g.removeClass("offcanvas-bar-show"),window.scrollTo(c.x,c.y)))},a(document).on("click.offcanvas.MUA","[data-offcanvas]",function(c){c.preventDefault();var d=a(this);new f(d,b.utils.options(d.data("offcanvas")))})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d);var e=this,f=a(window);this.element.on("scroll.scrollspy.MUA",function(){e.process()}),f.on("scroll.scrollspy.MUA",function(){e.process()})};c.defaults={activeClass:"active",target:!1,closest:"li",offset:10},c.prototype.process=function(){var c=[],d=a(this.options.target).find('a[href^="#"]').each(function(){c.push(a(this).attr("href"))}),e=a(c.join(","));if(e.length){for(var f=[],g=0;g<e.length;g++)b.utils.isInView(e.eq(g))&&f.push(e.eq(g));if(f.length){var h=this,i=a(window),j=i.scrollTop(),k=function(){for(var a=0;a<f.length;a++)if(f[a].offset().top+h.options.offset>=j)return f[a]}();k&&(h.options.closest?d.closest(h.options.closest).removeClass(h.options.activeClass).end().filter('a[href="#'+k.attr("id")+'"]').closest(h.options.closest).addClass(h.options.activeClass):d.removeClass(h.options.activeClass).filter('a[href="#'+k.attr("id")+'"]').addClass(h.options.activeClass))}}},a(document).ready(function(){a("[data-scrollspy]").each(function(){var d=a(this);new c(d,b.utils.options(d.data("scrollspy")))})})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d);var e=this;this.element.on("click",function(){var b=a(a(this.hash).length?this.hash:"body"),c=b.offset().top-e.options.offset,d=a(document).height(),f=a(window).height();return c+f>d&&(c=d-f),a("html,body").stop().animate({scrollTop:c},e.options.duration,e.options.transition),!1}),this.element.trigger("click")};c.defaults={duration:1e3,transition:"easeOutExpo",offset:0},a.easing.easeOutExpo||(a.easing.easeOutExpo=function(a,b,c,d,e){return b===e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c}),a(document).on("click.smooth-scroll.MUA","[data-smooth-scroll]",function(){var d=a(this);new c(d,b.utils.options(d.data("smoothScroll")))})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c={zindex:1015,top:0,bottom:0,clsactive:"active",clswrapper:"sticky",getWidthFrom:""},d=a(window),e=a(document),f=[],g=d.height(),h=function(){for(var b=d.scrollTop(),c=e.height(),h=c-g,i=b>h?h-b:0,j=0;j<f.length;j++)if(f[j].stickyElement.is(":visible")){var k=f[j],l=k.stickyWrapper.offset().top,m=l-k.top-i;if(m>=b)null!==k.currentTop&&(k.stickyElement.css({position:"",top:"",width:""}).parent().removeClass(k.clsactive),k.currentTop=null);else{var n=c-k.stickyElement.outerHeight()-k.top-k.bottom-b-i;n=0>n?n+k.top:k.top,k.currentTop!==n&&(k.stickyElement.css({position:"fixed",top:n,width:k.stickyElement.width()}),"undefined"!=typeof k.getWidthFrom&&k.stickyElement.css("width",a(k.getWidthFrom).width()),k.stickyElement.parent().addClass(k.clsactive),k.currentTop=n)}}},i=function(){g=d.height()},j={init:function(b){var d=a.extend({},c,b);return this.each(function(){var b=a(this),c=b.attr("id")||"s"+Math.ceil(1e4*Math.random()),e=a("<div></div>").attr("id","sticky-"+c).addClass(d.clswrapper).css({"z-index":d.zindex});b.css({"z-index":d.zindex+1}).wrapAll(e),"right"===b.css("float")&&b.css({"float":"none"}).parent().css({"float":"right"});var g=b.parent();g.css("height",b.outerHeight()),f.push({top:d.top,bottom:d.bottom,stickyElement:b,currentTop:null,stickyWrapper:g,clsactive:d.clsactive,getWidthFrom:d.getWidthFrom})})},update:h};window.addEventListener?(window.addEventListener("scroll",h,!1),window.addEventListener("resize",i,!1)):window.attachEvent&&(window.attachEvent("onscroll",h),window.attachEvent("onresize",i));var k=a.fn.temp;a.fn.sticky=function(b){return j[b]?j[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?void a.error("Method "+b+" does not exist on jQuery.sticky"):j.init.apply(this,arguments)},a.fn.sticky.noConflict=function(){return a.fn.sticky=k,this},a(document).ready(function(){setTimeout(function(){h(),a("[data-sticky]").each(function(){var c=a(this);c.sticky(b.utils.options(c.data("sticky")))})},0)})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d);var e,f,g=this;window.location.hash?(e=this.element.children().filter(window.location.hash),e.length&&g.show(e)):(f=this.element.find(this.options.toggle),e=this.element.find(this.options.toggle).filter("active"),e.length?g.show(e):(e=f.eq(this.options.active),g.show(e.length?e:f.eq(0)))),this.element.on("click",this.options.toggle,function(b){var c=a(this).hasClass("disabled");c||g.show(a(this)),b.preventDefault()})};c.defaults={connect:!1,toggle:">*",active:0},c.prototype.show=function(b){if(b.addClass("active").siblings().removeClass("active"),this.options.connect){var c=b.index();a(this.options.connect).children().eq(c).addClass("active").siblings().removeClass("active")}},a(document).ready(function(){a("[data-switcher]").each(function(){var d=a(this);new c(d,b.utils.options(d.data("switcher")))})})}(jQuery,jQuery.MUA),function(a,b){"use strict";var c=function(b,d){this.element=b,this.options=a.extend({},c.defaults,d),this.totoggle=this.options.target?a(this.options.target):[];var e=this;this.element.on("click",function(a){e.toggle(),a.preventDefault()})};c.defaults={target:!1,toggleClass:"hide"},c.prototype.toggle=function(){this.totoggle.length&&this.totoggle.toggleClass(this.options.toggleClass)},a(document).ready(function(){a("[data-toggle]").each(function(){var d=a(this);new c(d,b.utils.options(d.data("toggle")))})})}(jQuery,jQuery.MUA);