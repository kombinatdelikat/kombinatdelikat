AjaxRequest.updateContentElements = function(el, pid) {
	if (!el || !pid) {
		return false;
	}

	new Request.Contao({
		onRequest: AjaxRequest.displayBox(Contao.lang.loading + ' …'),
		onSuccess:function(txt) {
			var id = el.get('id');
			console.log(id, el)

			new Element('div', { 'html':txt }).getElement('.tl_listing_container > ul#' + id).replaces(el);
			Backend.limitPreviewHeight();
			Backend.makeParentViewSortable(id);

			AjaxRequest.hideBox();
		}
	}).get();
	//.post({'action':'updateContentElements', 'pid':pid, 'load':1, 'REQUEST_TOKEN':Contao.request_token});

	return false;
}

Backend.makeParentViewSortable = function(ul) {
	var ds = new Scroller(document.getElement('body'), {
		onChange: function(x, y) {
			this.element.scrollTo(this.element.getScroll().x, y);
		}
	});

	var list = new Sortables(ul, {
		contstrain: true,
		opacity: 0.6,
		onStart: function() {
			ds.start();
		},
		onComplete: function() {
			ds.stop();
		},
		onSort: function(el) {
			var div = el.getFirst('div'),
				prev, next, first;

			if (!div) return;

			if (div.hasClass('wrapper_start')) {
				if ((prev = el.getPrevious('li')) && (first = prev.getFirst('div'))) {
					first.removeClass('indent');
				}
				if ((next = el.getNext('li')) && (first = next.getFirst('div'))) {
					first.addClass('indent');
				}
			} else if (div.hasClass('wrapper_stop')) {
				if ((prev = el.getPrevious('li')) && (first = prev.getFirst('div'))) {
					first.addClass('indent');
				}
				if ((next = el.getNext('li')) && (first = next.getFirst('div'))) {
					first.removeClass('indent');
				}
			} else if (div.hasClass('indent')) {
				if ((prev = el.getPrevious('li')) && (first = prev.getFirst('div')) && first.hasClass('wrapper_stop')) {
					div.removeClass('indent');
				} else if ((next = el.getNext('li')) && (first = next.getFirst('div')) && first.hasClass('wrapper_start')) {
					div.removeClass('indent');
				}
			} else {
				if ((prev = el.getPrevious('li')) && (first = prev.getFirst('div')) && first.hasClass('wrapper_start')) {
					div.addClass('indent');
				} else if ((next = el.getNext('li')) && (first = next.getFirst('div')) && first.hasClass('wrapper_stop')) {
					div.addClass('indent');
				}
			}
		},
		handle: '.drag-handle'
	});

	list.active = false;

	list.addEvent('start', function() {
		list.active = true;
	});

	list.addEvent('complete', function(el) {
		if (!list.active) return;
		var id, pid, req, href, p = el.getParent('ul');

		if (el.getPrevious('li')) {
			id = el.get('id').replace(/li_/, '');
			pid = el.getPrevious('li').get('id').replace(/li_/, '');
			req = window.location.search.replace(/id=[0-9]*/, 'id=' + id) + '&act=cut&mode=1&pid=' + pid;
			href = window.location.href.replace(/\?.*$/, '');
			new Request.Contao({'url':href+req, 'followRedirects':false}).get();
			AjaxRequest.updateContentElements(p, pid);
		} else if (el.getParent('ul')) {
			id = el.get('id').replace(/li_/, '');
			pid = el.getParent('ul').get('id').replace(/ul_/, '');
			req = window.location.search.replace(/id=[0-9]*/, 'id=' + id) + '&act=cut&mode=2&pid=' + pid;
			href = window.location.href.replace(/\?.*$/, '');
			new Request.Contao({'url':href+req, 'followRedirects':false}).get();
			AjaxRequest.updateContentElements(p, pid);
		}
	});
}
