!function(a){"use strict";var b=function(b,c){this.element=a(b),this.options=a.extend(!0,{},a.fn.tag.defaults,c),this.values=a.grep(a.map(this.element.val().split(","),a.trim),function(a){return a.length>0}),this.show()};b.prototype={constructor:b,show:function(){var b=this;b.element.parent().prepend(b.element.detach().hide()),b.element.wrap(a('<div class="tags">')).parent().on("click",function(){b.input.focus()}),b.values.length&&a.each(b.values,function(){b.createBadge(this)}),b.input=a('<input type="text">').attr("placeholder",b.options.placeholder).insertAfter(b.element).on("focus",function(){b.element.parent().addClass("tags-hover")}).on("blur",function(){b.skip||(b.process(),b.element.parent().removeClass("tags-hover"),b.element.siblings(".tag").removeClass("tag-important")),b.skip=!1}).on("keydown",function(c){if(188==c.keyCode||13==c.keyCode||9==c.keyCode)!a.trim(a(this).val())||b.element.siblings(".typeahead").length&&!b.element.siblings(".typeahead").is(":hidden")?188==c.keyCode&&(!b.element.siblings(".typeahead").length||b.element.siblings(".typeahead").is(":hidden")?c.preventDefault():(b.input.data("typeahead").select(),c.stopPropagation(),c.preventDefault())):(9!=c.keyCode&&c.preventDefault(),b.process());else if(a.trim(a(this).val())||8!=c.keyCode)b.element.siblings(".tag").removeClass("tag-important");else{var d=b.element.siblings(".tag").length;if(d){var e=b.element.siblings(".tag:eq("+(d-1)+")");e.hasClass("tag-important")?b.remove(d-1):e.addClass("tag-important")}}}).bs_typeahead({source:b.options.source,matcher:function(a){return~a.toLowerCase().indexOf(this.query.toLowerCase())&&(-1==b.inValues(a)||b.options.allowDuplicates)},updater:a.proxy(b.add,b)}),a(b.input.data("bs_typeahead").$menu).on("mousedown",function(){b.skip=!0}),this.element.trigger("shown")},inValues:function(b){if(this.options.caseInsensitive){var c=-1;return a.each(this.values,function(a,d){return d.toLowerCase()==b.toLowerCase()?(c=a,!1):void 0}),c}return a.inArray(b,this.values)},createBadge:function(b){var c=this;a("<span/>",{"class":"tag"}).text(b).append(a('<button type="button" class="close">&times;</button>').on("click",function(){c.remove(c.element.siblings(".tag").index(a(this).closest(".tag")))})).insertBefore(c.element)},add:function(b){var c=this;if(!c.options.allowDuplicates){var d=c.inValues(b);if(-1!=d){var e=c.element.siblings(".tag:eq("+d+")");return e.addClass("tag-warning"),void setTimeout(function(){a(e).removeClass("tag-warning")},500)}}this.values.push(b),this.createBadge(b),this.element.val(this.values.join(", ")),this.element.trigger("added",[b])},remove:function(a){if(a>=0){var b=this.values.splice(a,1);this.element.siblings(".tag:eq("+a+")").remove(),this.element.val(this.values.join(", ")),this.element.trigger("removed",[b])}},process:function(){var b=a.grep(a.map(this.input.val().split(","),a.trim),function(a){return a.length>0}),c=this;a.each(b,function(){c.add(this)}),this.input.val("")},skip:!1};var c=a.fn.tag;a.fn.tag=function(c){return this.each(function(){var d=a(this),e=d.data("tag"),f="object"==typeof c&&c;e||d.data("tag",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.tag.defaults={allowDuplicates:!1,caseInsensitive:!0,placeholder:"",source:[]},a.fn.tag.Constructor=b,a.fn.tag.noConflict=function(){return a.fn.tag=c,this},a(window).on("load",function(){a('[data-provide="tag"]').each(function(){var b=a(this);b.data("tag")||b.tag(b.data())})})}(window.jQuery);