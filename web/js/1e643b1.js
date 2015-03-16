/**
 * Portions of this code are from the Google Closure Library,
 * received from the Closure Authors under the Apache 2.0 license.
 *
 * All other code is (C) FriendsOfSymfony and subject to the MIT license.
 */
(function() {var f=!1,i,k=this;function l(a,c){var b=a.split("."),d=k;!(b[0]in d)&&d.execScript&&d.execScript("var "+b[0]);for(var e;b.length&&(e=b.shift());)!b.length&&void 0!==c?d[e]=c:d=d[e]?d[e]:d[e]={}};var m=Array.prototype,n=m.forEach?function(a,c,b){m.forEach.call(a,c,b)}:function(a,c,b){for(var d=a.length,e="string"==typeof a?a.split(""):a,g=0;g<d;g++)g in e&&c.call(b,e[g],g,a)};function q(a,c){this.c={};this.a=[];var b=arguments.length;if(1<b){if(b%2)throw Error("Uneven number of arguments");for(var d=0;d<b;d+=2)this.set(arguments[d],arguments[d+1])}else if(a){var e;if(a instanceof q){r(a);d=a.a.concat();r(a);e=[];for(b=0;b<a.a.length;b++)e.push(a.c[a.a[b]])}else{var b=[],g=0;for(d in a)b[g++]=d;d=b;b=[];g=0;for(e in a)b[g++]=a[e];e=b}for(b=0;b<d.length;b++)this.set(d[b],e[b])}}q.prototype.f=0;q.prototype.p=0;
function r(a){if(a.f!=a.a.length){for(var c=0,b=0;c<a.a.length;){var d=a.a[c];t(a.c,d)&&(a.a[b++]=d);c++}a.a.length=b}if(a.f!=a.a.length){for(var e={},b=c=0;c<a.a.length;)d=a.a[c],t(e,d)||(a.a[b++]=d,e[d]=1),c++;a.a.length=b}}q.prototype.get=function(a,c){return t(this.c,a)?this.c[a]:c};q.prototype.set=function(a,c){t(this.c,a)||(this.f++,this.a.push(a),this.p++);this.c[a]=c};function t(a,c){return Object.prototype.hasOwnProperty.call(a,c)};var u,v,w,x;function y(){return k.navigator?k.navigator.userAgent:null}x=w=v=u=f;var C;if(C=y()){var D=k.navigator;u=0==C.indexOf("Opera");v=!u&&-1!=C.indexOf("MSIE");w=!u&&-1!=C.indexOf("WebKit");x=!u&&!w&&"Gecko"==D.product}var E=v,F=x,G=w;var I;if(u&&k.opera){var J=k.opera.version;"function"==typeof J&&J()}else F?I=/rv\:([^\);]+)(\)|;)/:E?I=/MSIE\s+([^\);]+)(\)|;)/:G&&(I=/WebKit\/(\S+)/),I&&I.exec(y());function K(a,c){this.b=a||{e:"",prefix:"",host:"",scheme:""};this.h(c||{})}K.g=function(){return K.j?K.j:K.j=new K};i=K.prototype;i.h=function(a){this.d=new q(a)};i.o=function(){return this.d};i.k=function(a){this.b.e=a};i.n=function(){return this.b.e};i.l=function(a){this.b.prefix=a};
function L(a,c,b,d){var e,g=RegExp(/\[\]$/);if(b instanceof Array)n(b,function(b,e){g.test(c)?d(c,b):L(a,c+"["+("object"===typeof b?e:"")+"]",b,d)});else if("object"===typeof b)for(e in b)L(a,c+"["+e+"]",b[e],d);else d(c,b)}i.i=function(a){var c=this.b.prefix+a;if(t(this.d.c,c))a=c;else if(!t(this.d.c,a))throw Error('The route "'+a+'" does not exist.');return this.d.get(a)};
i.m=function(a,c,b){var d=this.i(a),e=c||{},g={},z;for(z in e)g[z]=e[z];var h="",s=!0,j="";n(d.tokens,function(b){if("text"===b[0])h=b[1]+h,s=f;else if("variable"===b[0]){var c=b[3]in d.defaults;if(f===s||!c||b[3]in e&&e[b[3]]!=d.defaults[b[3]]){if(b[3]in e){var c=e[b[3]],p=b[3];p in g&&delete g[p]}else if(c)c=d.defaults[b[3]];else{if(s)return;throw Error('The route "'+a+'" requires the parameter "'+b[3]+'".');}if(!(!0===c||f===c||""===c)||!s)p=encodeURIComponent(c).replace(/%2F/g,"/"),"null"===p&&
null===c&&(p=""),h=b[1]+p+h;s=f}else c&&(b=b[3],b in g&&delete g[b])}else throw Error('The token type "'+b[0]+'" is not supported.');});""===h&&(h="/");n(d.hosttokens,function(a){var b;if("text"===a[0])j=a[1]+j;else if("variable"===a[0]){if(a[3]in e){b=e[a[3]];var c=a[3];c in g&&delete g[c]}else a[3]in d.defaults&&(b=d.defaults[a[3]]);j=a[1]+b+j}});h=this.b.e+h;"_scheme"in d.requirements&&this.b.scheme!=d.requirements._scheme?h=d.requirements._scheme+"://"+(j||this.b.host)+h:j&&this.b.host!==j?h=
this.b.scheme+"://"+j+h:!0===b&&(h=this.b.scheme+"://"+this.b.host+h);var c=0,A;for(A in g)c++;if(0<c){var B,H=[];A=function(a,b){b="function"===typeof b?b():b;H.push(encodeURIComponent(a)+"="+encodeURIComponent(null===b?"":b))};for(B in g)L(this,B,g[B],A);h=h+"?"+H.join("&").replace(/%20/g,"+")}return h};l("fos.Router",K);l("fos.Router.setData",function(a){var c=K.g();c.k(a.base_url);c.h(a.routes);"prefix"in a&&c.l(a.prefix);c.b.host=a.host;c.b.scheme=a.scheme});K.getInstance=K.g;K.prototype.setRoutes=K.prototype.h;K.prototype.getRoutes=K.prototype.o;K.prototype.setBaseUrl=K.prototype.k;K.prototype.getBaseUrl=K.prototype.n;K.prototype.generate=K.prototype.m;K.prototype.setPrefix=K.prototype.l;K.prototype.getRoute=K.prototype.i;window.Routing=K.g();})();
/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @version 2.9.0
 *
 * File input styled for Bootstrap 3.0 that utilizes HTML5 File Input's advanced 
 * features including the FileReader API. 
 * 
 * The plugin drastically enhances the HTML file input to preview multiple files on the client before
 * upload. In addition it provides the ability to preview content of images, text, videos, audio, html, 
 * flash and other objects.
 * 
 * Author: Kartik Visweswaran
 * Copyright: 2014, Kartik Visweswaran, Krajee.com
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
(function ($) {
    var STYLE_SETTING = 'style="width:{width};height:{height};"';
    var PREVIEW_LABEL = '   <div class="text-center"><small>{caption}</small></div>\n';
    var OBJECT_PARAMS = '      <param name="controller" value="true" />\n' +
        '      <param name="allowFullScreen" value="true" />\n' +
        '      <param name="allowScriptAccess" value="always" />\n' +
        '      <param name="autoPlay" value="false" />\n' +
        '      <param name="autoStart" value="false" />\n'+
        '      <param name="quality" value="high" />\n';

    var DEFAULT_PREVIEW = '<div class="file-preview-other" ' + STYLE_SETTING + '>\n' +
        '       <h2><i class="glyphicon glyphicon-file"></i></h2>\n' +
        '   </div>';
    var defaultLayoutTemplates = {
        main1: '{preview}\n' +
            '<div class="input-group {class}">\n' +
            '   {caption}\n' +
            '   <div class="input-group-btn">\n' +
            '       {remove}\n' +
            '       {upload}\n' +
            '       {browse}\n' +
            '   </div>\n' +
            '</div>',
        main2: '{preview}\n{remove}\n{upload}\n{browse}\n',
        preview: '<div class="file-preview {class}">\n' +
            '   <div class="close fileinput-remove text-right">&times;</div>\n' +
            '   <div class="file-preview-thumbnails"></div>\n' +
            '   <div class="clearfix"></div>' +
            '   <div class="file-preview-status text-center text-success"></div>\n' +
            '   <div class="kv-fileinput-error"></div>\n' +
            '</div>',
        icon: '<span class="glyphicon glyphicon-file kv-caption-icon"></span>', 
        caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' +
            '   <div class="file-caption-name"></div>\n' +
            '</div>',
        modal: '<div id="{id}" class="modal fade">\n' +
            '  <div class="modal-dialog modal-lg">\n' +
            '    <div class="modal-content">\n' +
            '      <div class="modal-header">\n' +
            '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n' +
            '        <h3 class="modal-title">Detailed Preview <small>{title}</small></h3>\n' +
            '      </div>\n' +
            '      <div class="modal-body">\n' +
            '        <textarea class="form-control" style="font-family:Monaco,Consolas,monospace; height: {height}px;" readonly>{body}</textarea>\n' +
            '      </div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n'    
    };
    var defaultPreviewTypes = ['image', 'html', 'text', 'video', 'audio', 'flash', 'object'];
    var defaultPreviewTemplates = {
        generic: '<div class="file-preview-frame" id="{previewId}">\n' +
            '   {content}\n' +
            '</div>\n',
        html: '<div class="file-preview-frame" id="{previewId}">\n' +
            '    <object data="{data}" type="{type}" width="{width}" height="{height}">\n' +
            '       ' + DEFAULT_PREVIEW + '\n' +
            '    </object>\n' + PREVIEW_LABEL + 
            '</div>',
        image: '<div class="file-preview-frame" id="{previewId}">\n' +
            '   <img src="../../bundles/rbsoftabmgenerador/fileupload//js/{data}" class="file-preview-image" title="{caption}" alt="{caption}" ' + STYLE_SETTING + '>\n' +
            '</div>\n',
        text: '<div class="file-preview-frame" id="{previewId}">\n' +
            '   <div class="file-preview-text" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '       {data}\n' + 
            '   </div>\n' + 
            '</div>\n',
        video: '<div class="file-preview-frame" id="{previewId}" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '   <video width="{width}" height="{height}" controls>\n' +
            '       <source src="../../bundles/rbsoftabmgenerador/fileupload//js/{data}" type="{type}">\n' +
            '       ' + DEFAULT_PREVIEW + '\n' +
            '   </video>\n' + PREVIEW_LABEL + 
            '</div>\n',
        audio: '<div class="file-preview-frame" id="{previewId}" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '   <audio controls>\n' +
            '       <source src="../../bundles/rbsoftabmgenerador/fileupload//js/{data}" type="{type}">\n' +
            '       ' + DEFAULT_PREVIEW + '\n' +
            '   </audio>\n' + PREVIEW_LABEL + 
            '</div>\n',
        flash: '<div class="file-preview-frame" id="{previewId}" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '   <object type="application/x-shockwave-flash" width="{width}" height="{height}" data="{data}">\n' +
            OBJECT_PARAMS + '       ' + DEFAULT_PREVIEW + '\n' +
            '   </object>\n' + PREVIEW_LABEL + 
            '</div>\n',
        object: '<div class="file-preview-frame" id="{previewId}" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '    <object data="{data}" type="{type}" width="{width}" height="{height}">\n' +
            '      <param name="movie" value="{caption}" />\n' +
            OBJECT_PARAMS + '           ' + DEFAULT_PREVIEW + '\n' +
            '   </object>\n' + PREVIEW_LABEL + 
            '</div>',
        other: '<div class="file-preview-frame" id="{previewId}" title="{caption}" ' + STYLE_SETTING + '>\n' +
            '   ' + DEFAULT_PREVIEW + '\n' + PREVIEW_LABEL + 
            '</div>',
    };
    var defaultPreviewSettings = {
        image: {width: "auto", height: "160px"},
        html: {width: "320px", height: "180px"},
        text: {width: "160px", height: "160px"},
        video: {width: "320px", height: "240px"},
        audio: {width: "320px", height: "80px"},
        flash: {width: "320px", height: "240px"},
        object: {width: "320px", height: "300px"},
        other: {width: "160px", height: "120px"}
    };
    var defaultFileTypeSettings = {
        image: function(vType, vName) {
            return (typeof vType !== "undefined") ? vType.match('image.*') : vName.match(/\.(gif|png|jpe?g)$/i);
        },
        html: function(vType, vName) {
            return (typeof vType !== "undefined") ? vType == 'text/html' : vName.match(/\.(htm|html)$/i);
        },
        text: function(vType, vName) {
            return typeof vType !== "undefined" && vType.match('text.*') || vName.match(/\.(txt|md|csv|nfo|php|ini)$/i);
        },
        video: function (vType, vName) {
            return typeof vType !== "undefined" && vType.match(/\.video\/(ogg|mp4|webm)$/i) || vName.match(/\.(og?|mp4|webm)$/i);
        },
        audio: function (vType, vName) {
            return typeof vType !== "undefined" && vType.match(/\.audio\/(ogg|mp3|wav)$/i) || vName.match(/\.(ogg|mp3|wav)$/i);
        },
        flash: function (vType, vName) {
            return typeof vType !== "undefined" && vType == 'application/x-shockwave-flash' || vName.match(/\.(swf)$/i);
        },
        object: function (vType, vName) {
            return true;
        },
        other: function (vType, vName) {
            return true;
        }
    };
    var isEmpty = function (value, trim) {
            return value === null || value === undefined || value == []
            || value === '' || trim && $.trim(value) === '';
        },
        isArray = function (a) {
            return Array.isArray(a) || Object.prototype.toString.call(a) === '[object Array]';
        },
        isSet = function (needle, haystack) {
            return (typeof haystack == 'object' && needle in haystack);
        },
        getValue = function (options, param, value) {
            return (isEmpty(options) || isEmpty(options[param])) ? value : options[param];
        },
        getElement = function (options, param, value) {
            return (isEmpty(options) || isEmpty(options[param])) ? value : $(options[param]);
        },
        uniqId = function () {
            return Math.round(new Date().getTime() + (Math.random() * 100));
        },
        hasFileAPISupport = function () {
            return window.File && window.FileReader && window.FileList && window.Blob;
        },
        htmlEncode = function(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        },
        vUrl = window.URL || window.webkitURL;

    var FileInput = function (element, options) {
        this.$element = $(element);
        if (hasFileAPISupport()) {
            this.init(options);
            this.listen();
        } else {
            this.$element.removeClass('file-loading');
        }
    };

    FileInput.prototype = {
        constructor: FileInput,
        init: function (options) {
            var self = this;
            self.reader = null;
            self.showCaption = options.showCaption;
            self.showPreview = options.showPreview;
            self.autoFitCaption = options.autoFitCaption;
            self.maxFileSize = options.maxFileSize;
            self.maxFileCount = options.maxFileCount;
            self.msgSizeTooLarge = options.msgSizeTooLarge;
            self.msgFilesTooMany = options.msgFilesTooMany;
            self.msgFileNotFound = options.msgFileNotFound;
            self.msgFileNotReadable = options.msgFileNotReadable;
            self.msgFilePreviewAborted = options.msgFilePreviewAborted;
            self.msgFilePreviewError = options.msgFilePreviewError;
            self.msgValidationError = options.msgValidationError;
            self.msgErrorClass = options.msgErrorClass;
            self.initialDelimiter = options.initialDelimiter;
            self.initialPreview = options.initialPreview;
            self.initialCaption = options.initialCaption;
            self.initialPreviewCount = options.initialPreviewCount;
            self.initialPreviewContent = options.initialPreviewContent;
            self.overwriteInitial = options.overwriteInitial;
            self.layoutTemplates = options.layoutTemplates;
            self.previewTemplates = options.previewTemplates;
            self.allowedPreviewTypes = isEmpty(options.allowedPreviewTypes) ? defaultPreviewTypes : options.allowedPreviewTypes;
            self.allowedPreviewMimeTypes = options.allowedPreviewMimeTypes;
            self.allowedFileTypes = options.allowedFileTypes;
            self.allowedFileExtensions = options.allowedFileExtensions;
            self.previewSettings = options.previewSettings;
            self.fileTypeSettings = options.fileTypeSettings;
            self.showRemove = options.showRemove;
            self.showUpload = options.showUpload;
            self.captionClass = options.captionClass;
            self.previewClass = options.previewClass;
            self.mainClass = options.mainClass;
            self.mainTemplate = self.showCaption ? self.getLayoutTemplate('main1') : self.getLayoutTemplate('main2');
            self.captionTemplate = self.getLayoutTemplate('caption');
            self.previewGenericTemplate = self.getPreviewTemplate('generic');
            self.browseLabel = options.browseLabel;
            self.browseIcon = options.browseIcon;
            self.browseClass = options.browseClass;
            self.removeLabel = options.removeLabel;
            self.removeIcon = options.removeIcon;
            self.removeClass = options.removeClass;
            self.uploadLabel = options.uploadLabel;
            self.uploadIcon = options.uploadIcon;
            self.uploadClass = options.uploadClass;
            self.uploadUrl = options.uploadUrl;
            self.msgLoading = options.msgLoading;
            self.msgProgress = options.msgProgress;
            self.msgSelected = options.msgSelected;
            self.msgInvalidFileType = options.msgInvalidFileType;
            self.msgInvalidFileExtension = options.msgInvalidFileExtension;
            self.previewFileType = options.previewFileType;
            self.wrapTextLength = options.wrapTextLength;
            self.wrapIndicator = options.wrapIndicator;
            self.isError = false;
            self.isDisabled = self.$element.attr('disabled') || self.$element.attr('readonly');
            if (isEmpty(self.$element.attr('id'))) {
                self.$element.attr('id', uniqId());
            }
            if (typeof self.$container == 'undefined') {
                self.$container = self.createContainer();
            } else {
                self.refreshContainer();
            }
            self.$captionContainer = getElement(options, 'elCaptionContainer', self.$container.find('.file-caption'));
            self.$caption = getElement(options, 'elCaptionText', self.$container.find('.file-caption-name'));
            self.$previewContainer = getElement(options, 'elPreviewContainer', self.$container.find('.file-preview'));
            self.$preview = getElement(options, 'elPreviewImage', self.$container.find('.file-preview-thumbnails'));
            self.$previewStatus = getElement(options, 'elPreviewStatus', self.$container.find('.file-preview-status'));
            self.$errorContainer = getElement(options, 'elErrorContainer', self.$previewContainer.find('.kv-fileinput-error'));
            if (!isEmpty(self.msgErrorClass)) { 
                self.$errorContainer.removeClass(self.msgErrorClass).addClass(self.msgErrorClass);
            }
            self.$errorContainer.hide();
            var content = self.initialPreview;
            self.initialPreviewCount = isArray(content) ? content.length : (content.length > 0 ? content.split(self.initialDelimiter).length : 0)
            self.initPreview();
            self.original = {
                preview: self.$preview.html(),
                caption: self.$caption.html()
            };
            self.options = options;
            self.autoSizeCaption();
            self.$element.removeClass('file-loading');
        },
        getLayoutTemplate: function(t) {
            var self = this;
            return isSet(t, self.layoutTemplates) ? self.layoutTemplates[t] : defaultLayoutTemplates[t];
        },
        getPreviewTemplate: function(t) {
            var self = this;
            return isSet(t, self.previewTemplates) ? self.previewTemplates[t] : defaultPreviewTemplates[t];
        },
        listen: function () {
            var self = this, $el = self.$element, $cap = self.$captionContainer, $btnFile = self.$btnFile;
            $el.on('change', $.proxy(self.change, self));
            $(window).on('resize', function() {
                setTimeout(function() {
                    self.autoSizeCaption();
                }, 100);  
            });
            $btnFile.on('click', function (ev) {
                self.$element.trigger('filebrowse');
                $cap.focus();
            });
            $el.closest('form').on('reset', $.proxy(self.reset, self));
            self.$container.on('click', '.fileinput-remove:not([disabled])', $.proxy(self.clear, self));
        },
        refresh: function (options) {
            var self = this, params = (arguments.length) ? $.extend(self.options, options) : self.options;
            self.$element.off();
            self.init(params);
        },
        initPreview: function () {
            var self = this, html = '', content = self.initialPreview, len = self.initialPreviewCount,
                cap = self.initialCaption.length, previewId = "preview-" + uniqId(),
                caption = (cap > 0) ? self.initialCaption : self.msgSelected.replace(/\{n\}/g, len);
            if (isArray(content) && len > 0) {
                for (var i = 0; i < len; i++) {
                    previewId += '-' + i;
                    html += self.previewGenericTemplate.replace(/\{previewId\}/g, previewId).replace(/\{content\}/g,
                        content[i]);
                }
                if (len > 1 && cap == 0) {
                    caption = self.msgSelected.replace(/\{n\}/g, len);
                }
            } else {
                if (len > 0) {
                    var fileList = content.split(self.initialDelimiter);
                    for (var i = 0; i < len; i++) {
                        previewId += '-' + i;
                        html += self.previewGenericTemplate.replace(/\{previewId\}/g, previewId).replace(/\{content\}/g,
                            fileList[i]);
                    }
                    if (len > 1 && cap == 0) {
                        caption = self.msgSelected.replace(/\{n\}/g, len);
                    }
                } else {
                    if (cap > 0) {
                        self.setCaption(caption);
                        return;
                    } else {
                        return;
                    }
                }
            }
            self.initialPreviewContent = html;
            self.$preview.html(html);
            self.setCaption(caption);
            self.$container.removeClass('file-input-new');
        },
        clearObjects: function() {
            var self = this, $preview = self.$preview;
            $preview.find('video audio').each(function() {
                 this.pause();
                 delete(this);
                 $(this).remove();
            });
            $preview.find('img object div').each(function() {
                delete(this);
                $(this).remove();
            });
        },
        clearFileInput: function() {
            var self = this, $el = self.$element;
            if (isEmpty($el.val())) {
                return;
            }
            // Fix for IE ver < 11, that does not clear file inputs
            // Requires a sequence of steps to prevent IE crashing but
            // still allow clearing of the file input.
            if (/MSIE/.test(navigator.userAgent)) {
                var $frm1 = $el.closest('form');
                if ($frm1.length) {
                    $el.wrap('<form>');
                    var $frm2 = $el.closest('form'), $tmpEl = $(document.createElement('div'));
                    $frm2.before($tmpEl).after($frm1).trigger('reset');
                    $el.unwrap().appendTo($tmpEl).unwrap();
                } else {
                    $el.wrap('<form>').closest('form').trigger('reset').unwrap();
                }   
            } else { // normal input clear behavior for other sane browsers
                $el.val('');
            }
        },
        clear: function () {
            var self = this, e = arguments.length && arguments[0];
            if (e) {
                e.preventDefault();
            }
            if (self.reader instanceof FileReader) {
                self.reader.abort();
            }
            self.autoSizeCaption();
            self.clearFileInput();
            self.resetErrors(true);
            
            if (e !== false) {
                self.$element.trigger('change');
                self.$element.trigger('fileclear');
            }
            if (self.overwriteInitial) {
                self.initialPreviewCount = 0;
            }
            if (!self.overwriteInitial && !isEmpty(self.initialPreviewContent)) {
                self.showFileIcon();
                self.$preview.html(self.original.preview);
                self.$caption.html(self.original.caption);
                self.$container.removeClass('file-input-new');
            } else {
                self.clearObjects();
                self.$preview.html('');
                var cap = (!self.overwriteInitial && self.initialCaption.length > 0) ?
                    self.original.caption : '';
                self.$caption.html(cap);
                self.$caption.attr('title', '');
                self.$container.removeClass('file-input-new').addClass('file-input-new');
            }
            self.hideFileIcon();
            self.$element.trigger('filecleared');
            self.$captionContainer.focus();
        },
        reset: function (e) {
            var self = this;
            self.clear(false);
            self.$preview.html(self.original.preview);
            self.$caption.html(self.original.caption);
            self.$container.find('.fileinput-filename').text('');
            self.$element.trigger('filereset');
            if (self.initialPreview.length > 0) {
                self.$container.removeClass('file-input-new');
            }
        },
        disable: function (e) {
            var self = this;
            self.isDisabled = true;
            self.$element.attr('disabled', 'disabled');
            self.$container.find(".kv-fileinput-caption").addClass("file-caption-disabled");
            self.$container.find(".btn-file, .fileinput-remove, .kv-fileinput-upload").attr("disabled", true);
        },
        enable: function (e) {
            var self = this;
            self.isDisabled = false;
            self.$element.removeAttr('disabled');
            self.$container.find(".kv-fileinput-caption").removeClass("file-caption-disabled");
            self.$container.find(".btn-file, .fileinput-remove, .kv-fileinput-upload").removeAttr("disabled");
        },
        hideFileIcon: function () {
            if (this.overwriteInitial) {
                this.$captionContainer.find('.kv-caption-icon').hide();
            }
        },
        showFileIcon: function () {
            this.$captionContainer.find('.kv-caption-icon').show();
        },
        resetErrors: function (fade) {
            var self = this, $error = self.$errorContainer;
            self.isError = false;
            self.$container.removeClass('has-error');
            if (fade) {
                $error.fadeOut('slow');
            } else {
                $error.hide();
            }
        },
        showError: function (msg, file, previewId, index) {
            var self = this, $error = self.$errorContainer, $el = self.$element;
            $error.html(msg);
            $error.fadeIn(800);
            $el.trigger('fileerror', [file, previewId, index]);
            self.clearFileInput();
            self.$container.removeClass('has-error').addClass('has-error');
            return true;
        },
        errorHandler: function (evt, caption) {
            var self = this;
            switch (evt.target.error.code) {
                case evt.target.error.NOT_FOUND_ERR:
                    self.addError(self.msgFileNotFound.replace(/\{name\}/g, caption));
                    break;
                case evt.target.error.NOT_READABLE_ERR:
                    self.addError(self.msgFileNotReadable.replace(/\{name\}/g, caption));
                    break;
                case evt.target.error.ABORT_ERR:
                    self.addError(self.msgFilePreviewAborted.replace(/\{name\}/g, caption));
                    break;
                default:
                    self.addError(self.msgFilePreviewError.replace(/\{name\}/g, caption));
            }
        },
        parseFileType: function(file) {
            var isValid, vType;
            for (var i = 0; i < defaultPreviewTypes.length; i++) {
                cat = defaultPreviewTypes[i];
                isValid = isSet(cat, self.fileTypeSettings) ? self.fileTypeSettings[cat] : defaultFileTypeSettings[cat];
                vType = isValid(file.type, file.name) ? cat : '';
                if (vType != '') {
                    return vType;
                }
            }
            return 'other';
        },
        previewDefault: function(file, previewId) {
            var self = this, data = vUrl.createObjectURL(file), $obj = $('#' + previewId),
                previewOtherTemplate = isSet('other', self.previewTemplates) ? self.previewTemplates['other'] : defaultPreviewTemplates['other'];

            self.$preview.append("\n" + previewOtherTemplate
                .replace(/\{previewId\}/g, previewId)
                .replace(/\{caption\}/g, self.slug(file.name))
                .replace(/\{type\}/g, file.type)
                .replace(/\{data\}/g, data));
            $obj.on('load', function(e) {
                vUrl.revokeObjectURL($obj.attr('data'));
            });
        },
        previewFile: function(file, theFile, previewId, data) {
            var self = this, i, cat = self.parseFileType(file), caption = self.slug(file.name), data, obj, content, 
                types = self.allowedPreviewTypes, mimes = self.allowedPreviewMimeTypes, fType = file.type, 
                template = isSet(cat, self.previewTemplates) ? self.previewTemplates[cat] : defaultPreviewTemplates[cat], 
                config = isSet(cat, self.previewSettings) ? self.previewSettings[cat] : defaultPreviewSettings[cat],
                wrapLen = parseInt(self.wrapTextLength), wrapInd = self.wrapIndicator, $preview = self.$preview, 
                chkTypes = types.indexOf(cat) >=0, chkMimes = isEmpty(mimes) || (!isEmpty(mimes) && isSet(file.type, mimes));

            if (chkTypes && chkMimes) {
                if (cat == 'text') {
                    var strText = htmlEncode(theFile.target.result);
                    vUrl.revokeObjectURL(data);
                    if (strText.length > wrapLen) {
                        var id = 'text-' + uniqId(), height = window.innerHeight * .75,
                            modal = self.getLayoutTemplate('modal')
                                .replace(/\{id\}/g, id)
                                .replace(/\{title\}/g, caption)
                                .replace(/\{height\}/g, height)
                                .replace(/\{body\}/g, strText);
                            wrapInd = wrapInd
                                .replace(/\{title\}/g, caption)
                                .replace(/\{dialog\}/g, "$('#" + id + "').modal('show')");
                            strText = strText.substring(0, (wrapLen - 1)) + wrapInd;
                    }
                    content = template
                        .replace(/\{previewId\}/g, previewId).replace(/\{caption\}/g, caption)
                        .replace(/\{type\}/g, file.type).replace(/\{width\}/g, config.width)
                        .replace(/\{height\}/g, config.height).replace(/\{data\}/g, strText) + modal;
                } else {
                    content = template
                        .replace(/\{previewId\}/g, previewId).replace(/\{caption\}/g, caption)
                        .replace(/\{type\}/g, file.type).replace(/\{data\}/g, data)
                        .replace(/\{width\}/g, config.width).replace(/\{height\}/g, config.height);
                }
                $preview.append("\n" + content);
                self.autoSizeImage(previewId);
            } else {
                self.previewDefault(file, previewId);
            }
        },
        readFiles: function (files) {
            this.reader = new FileReader();
            var self = this, $el = self.$element, $preview = self.$preview, reader = self.reader,
                $container = self.$previewContainer, $status = self.$previewStatus, msgLoading = self.msgLoading,
                msgProgress = self.msgProgress, msgSelected = self.msgSelected, fileType = self.previewFileType,
                wrapLen = parseInt(self.wrapTextLength), wrapInd = self.wrapIndicator,
                previewInitId = "preview-" + uniqId(), numFiles = files.length, settings = self.fileTypeSettings,
                isText = isSet('text', settings) ? settings['text'] : defaultFileTypeSettings['text'];

            function readFile(i) {
                if (i >= numFiles) {
                    $container.removeClass('loading');
                    $status.html('');
                    return;
                }
                var previewId = previewInitId + "-" + i, file = files[i], caption = self.slug(file.name), 
                    fileSize = (file.size ? file.size : 0) / 1000, checkFile, 
                    previewData = vUrl.createObjectURL(file), fileCount = 0, j, msg, typ, chk,
                    fileTypes = self.allowedFileTypes, strTypes = isEmpty(fileTypes) ? '' : fileTypes.join(', '), 
                    fileExt = self.allowedFileExtensions, strExt = isEmpty(fileExt) ? '' : fileExt.join(', '),
                    fileExtExpr = isEmpty(fileExt) ? '' : new RegExp('\\.(' + fileExt.join('|') + ')$', 'i');
                fileSize = fileSize.toFixed(2);
                if (self.maxFileSize > 0 && fileSize > self.maxFileSize) {
                    msg = self.msgSizeTooLarge.replace(/\{name\}/g, caption).replace(/\{size\}/g,
                        fileSize).replace(/\{maxSize\}/g, self.maxFileSize);
                    self.isError = self.showError(msg, file, previewId, i);
                    return;
                }
                if (!isEmpty(fileTypes) && isArray(fileTypes)) {
                    for (j = 0; j < fileTypes.length; j++) {
                        typ = fileTypes[j];
                        checkFile = settings[typ];
                        chk = (checkFile !== undefined && checkFile(file.type, caption));
                        fileCount += isEmpty(chk) ? 0 : chk.length;
                    }
                    if (fileCount == 0) {
                        msg = self.msgInvalidFileType.replace(/\{name\}/g, caption).replace(/\{types\}/g, strTypes);
                        self.isError = self.showError(msg, file, previewId, i);
                        return;
                    }
                }
                if (fileCount == 0 && !isEmpty(fileExt) && isArray(fileExt) && !isEmpty(fileExtExpr)) {
                    chk = caption.match(fileExtExpr);
                    fileCount += isEmpty(chk) ? 0 : chk.length;
                    if (fileCount == 0) {
                        msg = self.msgInvalidFileExtension.replace(/\{name\}/g, caption).replace(/\{extensions\}/g, strExt);
                        self.isError = self.showError(msg, file, previewId, i);
                        return;
                    }
                }
                if (!self.showPreview) {
                    $el.trigger('fileloaded', [file, previewId, i]);
                    setTimeout(readFile(i + 1), 1000);
                    return;
                }
                if ($preview.length > 0 && typeof FileReader !== "undefined") {
                    $status.html(msgLoading.replace(/\{index\}/g, i + 1).replace(/\{files\}/g, numFiles));
                    $container.addClass('loading');
                    reader.onerror = function (evt) {
                        self.errorHandler(evt, caption);
                    };
                    reader.onload = function (theFile) {
                        self.previewFile(file, theFile, previewId, previewData);
                    };
                    reader.onloadend = function (e) {
                        var msg = msgProgress
                            .replace(/\{index\}/g, i + 1).replace(/\{files\}/g, numFiles)
                            .replace(/\{percent\}/g, 100).replace(/\{name\}/g, caption);
                        setTimeout(function () {
                            $status.html(msg);
                            vUrl.revokeObjectURL(previewData);
                        }, 1000);
                        setTimeout(function () {
                            readFile(i + 1);
                        }, 1500);
                        $el.trigger('fileloaded', [file, previewId, i]);
                    };
                    reader.onprogress = function (data) {
                        if (data.lengthComputable) {
                            var progress = parseInt(((data.loaded / data.total) * 100), 10);
                            var msg = msgProgress
                                .replace(/\{index\}/g, i + 1).replace(/\{files\}/g, numFiles)
                                .replace(/\{percent\}/g, progress).replace(/\{name\}/g, caption);
                            setTimeout(function () {
                                $status.html(msg);
                            }, 1000);
                        }
                    };
                    if (isText(file.type, caption)) {
                        reader.readAsText(file);
                    } else {
                        reader.readAsArrayBuffer(file);
                    }
                } else {
                    self.previewDefault(file, previewId);
                    $el.trigger('fileloaded', [file, previewId, i]);
                    setTimeout(readFile(i + 1), 1000);
                }
            }
            readFile(0);
        },
        slug: function (text) {
            return isEmpty(text) ? '' : text.split(/(\\|\/)/g).pop().replace(/[^\w-.\\\/ ]+/g,'');
        },
        setCaption: function(content) {
            var self = this, title = $('<div>' + content + '</div>').text(),
                icon = self.layoutTemplates['icon'], 
                out = icon + title;
            if (self.$caption.length == 0) {
                return;
            }
            self.$caption.html(out);
            self.$caption.attr('title', title);
            self.autoSizeCaption();
        },
        autoSizeImage: function(previewId) {
            var self = this, $preview = self.$preview, 
                $thumb = $preview.find("#" + previewId), 
                $img = $thumb.find('img');
            if (!$img.length) {
                return;
            }
            $img.on('load', function() {
                var w1 = $thumb.width(), w2 = $preview.width();
                if (w1 > w2) {
                    $img.css('width', '100%');
                    $thumb.css('width', '97%');
                }
                self.$element.trigger('fileimageloaded', previewId);
            });
        },
        autoSizeCaption: function() {
            var self = this;
            if (self.$caption.length == 0 || !self.autoFitCaption) {
                return;
            }
            self.$caption.css('width', 0);
            setTimeout(function() {
                var w = self.$captionContainer.width();
                self.$caption.css('width', 0.98 * w);
            }, 100);
        },
        change: function (e) {
            var self = this, $el = self.$element, label = self.slug($el.val()),
                total = 0, $preview = self.$preview, files = $el.get(0).files, msgSelected = self.msgSelected,
                numFiles = !isEmpty(files) ? (files.length + self.initialPreviewCount) : 1, tfiles;
            self.hideFileIcon();
            if (e.target.files === undefined) {
                tfiles = e.target && e.target.value ? [
                    {name: e.target.value.replace(/^.+\\/, '')}
                ] : [];
            } else {
                tfiles = e.target.files;
            }
            if (isEmpty(tfiles) || tfiles.length === 0) {
                self.clear(false);
                $el.trigger('fileselectnone');
                return;
            }
            self.resetErrors();
            $preview.html('');
            if (!self.overwriteInitial) {
                $preview.html(self.initialPreviewContent);
            }
            var total = tfiles.length;
            if (self.maxFileCount > 0 && total > self.maxFileCount) {
                var msg = self.msgFilesTooMany.replace(/\{m\}/g, self.maxFileCount).replace(/\{n\}/g, total);
                self.isError = self.showError(msg, null, null, null);
                self.$captionContainer.find('.kv-caption-icon').hide();
                self.$caption.html(self.msgValidationError);
                self.$container.removeClass('file-input-new');
                return;
            }
            self.readFiles(files);
            self.reader = null;
            var log = numFiles > 1 ? msgSelected.replace(/\{n\}/g, numFiles) : label;
            if (self.isError) {
                self.$captionContainer.find('.kv-caption-icon').hide();
                log = self.msgValidationError;
            } else {
                self.showFileIcon();
            }
            self.setCaption(log);
            self.$container.removeClass('file-input-new');
            $el.trigger('fileselect', [numFiles, label]);
        },
        initBrowse: function ($container) {
            var self = this;
            self.$btnFile = $container.find('.btn-file');
            self.$btnFile.append(self.$element);
        },
        createContainer: function () {
            var self = this;
            var $container = $(document.createElement("span")).attr({"class": 'file-input file-input-new'}).html(self.renderMain());
            self.$element.before($container);
            self.initBrowse($container);
            return $container;
        },
        refreshContainer: function () {
            var self = this, $container = self.$container;
            $container.before(self.$element);
            $container.html(self.renderMain());
            self.initBrowse($container);
        },
        renderMain: function () {
            var self = this;
            var preview = self.showPreview ? self.getLayoutTemplate('preview').replace(/\{class\}/g, self.previewClass) : '';
            var css = self.isDisabled ? self.captionClass + ' file-caption-disabled' : self.captionClass;
            var caption = self.captionTemplate.replace(/\{class\}/g, css + ' kv-fileinput-caption');
            return self.mainTemplate.replace(/\{class\}/g, self.mainClass).
                replace(/\{preview\}/g, preview).
                replace(/\{caption\}/g, caption).
                replace(/\{upload\}/g, self.renderUpload()).
                replace(/\{remove\}/g, self.renderRemove()).
                replace(/\{browse\}/g, self.renderBrowse());
        },
        renderBrowse: function () {
            var self = this, css = self.browseClass + ' btn-file', status = '';
            if (self.isDisabled) {
                status = ' disabled ';
            }
            return '<div class="' + css + '"' + status + '> ' + self.browseIcon + self.browseLabel + ' </div>';
        },
        renderRemove: function () {
            var self = this, css = self.removeClass + ' fileinput-remove fileinput-remove-button', status = '';
            if (!self.showRemove) {
                return '';
            }
            if (self.isDisabled) {
                status = ' disabled ';
            }
            return '<button type="button" class="' + css + '"' + status + '>' + self.removeIcon + self.removeLabel + '</button>';
        },
        renderUpload: function () {
            var self = this, css = self.uploadClass + ' kv-fileinput-upload', content = '', status = '';
            if (!self.showUpload) {
                return '';
            }
            if (self.isDisabled) {
                status = ' disabled ';
            }
            if (isEmpty(self.uploadUrl)) {
                content = '<button type="submit" class="' + css + '"' + status + '>' + self.uploadIcon + self.uploadLabel + '</button>';
            } else {
                content = '<a href="' + self.uploadUrl + '" class="' + self.uploadClass + '"' + status + '>' + self.uploadIcon + self.uploadLabel + '</a>';
            }
            return content;
        }
    }

    //FileInput plugin definition
    $.fn.fileinput = function (option) {
        if (!hasFileAPISupport()) {
          return;
        }
        
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function () {
            var $this = $(this),
                data = $this.data('fileinput'),
                options = typeof option === 'object' && option;

            if (!data) {
                $this.data('fileinput',
                    (data = new FileInput(this, $.extend({}, $.fn.fileinput.defaults, options, $(this).data()))));
            }

            if (typeof option === 'string') {
                data[option].apply(data, args);
            }
        });
    };

    $.fn.fileinput.defaults = {
        showCaption: true,
        showPreview: true,
        showRemove: true,
        showUpload: true,
        autoFitCaption: true, 
        mainClass: '',
        previewClass: '',
        captionClass: '',
        mainTemplate: null,
        initialDelimiter: '*$$*',
        initialPreview: '',
        initialCaption: '',
        initialPreviewCount: 0,
        initialPreviewContent: '',
        overwriteInitial: true,
        layoutTemplates: defaultLayoutTemplates,
        previewTemplates: defaultPreviewTemplates,
        allowedPreviewTypes: defaultPreviewTypes,
        allowedPreviewMimeTypes: null,
        allowedFileTypes: null,
        allowedFileExtensions: null,
        previewSettings: defaultPreviewSettings,
        fileTypeSettings: defaultFileTypeSettings,
        browseLabel: 'Browse &hellip;',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i> &nbsp;',
        browseClass: 'btn btn-primary',
        removeLabel: 'Remove',
        removeIcon: '<i class="glyphicon glyphicon-ban-circle"></i> ',
        removeClass: 'btn btn-default',
        uploadLabel: 'Upload',
        uploadIcon: '<i class="glyphicon glyphicon-upload"></i> ',
        uploadClass: 'btn btn-default',
        uploadUrl: null,
        maxFileSize: 0,
        maxFileCount: 0,
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) exceeds maximum allowed upload size of <b>{maxSize} KB</b>. Please retry your upload!',
        msgFilesTooMany: 'Number of files selected for upload <b>({n})</b> exceeds maximum allowed limit of <b>{m}</b>. Please retry your upload!',
        msgFileNotFound: 'File "{name}" not found!',
        msgFileNotReadable: 'File "{name}" is not readable.',
        msgFilePreviewAborted: 'File preview aborted for "{name}".',
        msgFilePreviewError: 'An error occurred while reading the file "{name}".',
        msgInvalidFileType: 'Invalid type for file "{name}". Only "{types}" files are supported.',
        msgInvalidFileExtension: 'Invalid extension for file "{name}". Only "{extensions}" files are supported.',
        msgValidationError: '<span class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> File Upload Error</span>',
        msgErrorClass: 'file-error-message',
        msgLoading: 'Loading  file {index} of {files} &hellip;',
        msgProgress: 'Loading file {index} of {files} - {name} - {percent}% completed.',
        msgSelected: '{n} files selected',
        previewFileType: 'image',
        wrapTextLength: 250,
        wrapIndicator: ' <span class="wrap-indicator" title="{title}" onclick="{dialog}">[&hellip;]</span>',
        elCaptionContainer: null,
        elCaptionText: null,
        elPreviewContainer: null,
        elPreviewImage: null,
        elPreviewStatus: null,
        elErrorContainer: null        
    };

    /**
     * Convert automatically file inputs with class 'file'
     * into a bootstrap fileinput control.
     */
    $(document).ready(function () {
        var $input = $('input.file[type=file]'), count = $input.attr('type') != null ? $input.length : 0;
        if (count > 0) {
            $input.fileinput();
        }
    });

})(window.jQuery);