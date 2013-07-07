/**
 * Part of the Data Grid package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Data Grid
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */
;(function($, window, document, undefined){

    'use strict';

    var defaults = {
        source: null,
        dividend: 1,
        threshold: 100,
        throttle: 100,
        type: 'multiple',
        loader: undefined,
        sort: {},
        tempoOptions: {
            var_braces: '\\[\\[\\]\\]',
            tag_braces: '\\[\\?\\?\\]',
            escape: true
        },
        searchThreshold: 800,
        callback: undefined
    };

    var helpers = {
        appliedFilters: [],
        tmpl: {},
        pageIdx: 1,
        nextIdx: null,
        prevIdx: null,
        totalPages: null,
        isActive: false,
        pagiThrottle: null,
        totalCount: null,
        filterCount: null
    };

    function DataGrid(grid, results, pagination, filters, options){

        this.opt = $.extend({}, defaults, options, helpers);

        //Binding Key
        this.grid = '[data-grid='+grid+']';

        //Cache Our Selectors
        this.$results = $(results + this.grid);
        this.$pagination = $(pagination + this.grid);
        this.$filters = $(filters + this.grid);
        this.$body = $(document.body);

        //Get Our Source
        this.opt.source = this.$results.data('source') || this.opt.source;

        //Default Throttle
        this.opt.pagiThrottle = this.opt.throttle;

        this._init();


    }

    DataGrid.prototype = {

        _init: function(){

            this._checkDeps();

            this._prepTemplates();

            this._events();

            if(!$.isEmptyObject(this.opt.sort)){

                this.$body.find('[data-sort='+this.opt.sort.column+']'+this.grid).addClass(this.opt.sort.direction);

            }

            this._ajaxFetch();
        },

        _checkDeps: function(){

            if(typeof Tempo === 'undefined'){
                this._logError('Tempo is not defined. DataGrid requires TempoJS v2.0.0 or later to run!', this);
            }

            if(!this.$results.length){
                this._logError('Missing a results container, make sure you have data-grid set!', this);
            }

            if(!this.$pagination.length){
                this._logError('Missing a pagination container, make sure you have data-grid set!', this);
            }

            if(!this.$filters.length){
                this._logError('Missing a applied filters container, make sure you have data-grid set!', this);
            }

        },

        _prepTemplates: function(){

            this.opt.tmpl.results = Tempo.prepare(this.$results, this.opt.tempoOptions);
            this.opt.tmpl.pagination = Tempo.prepare(this.$pagination, this.opt.tempoOptions);
            this.opt.tmpl.appliedFilters = Tempo.prepare(this.$filters, this.opt.tempoOptions);

        },

        _events: function(){

            var self = this;

            this.$body.on('click', '[data-sort]'+this.grid, function(e){

                self._setSortDirection($(this));
                self._setSort($(this).data('sort'));
                self._clearResults();
                self._ajaxFetch();

            });

            this.$body.on('click', '[data-filter]'+this.grid, function(e){

                self._setFilter($(this).data('filter'), $(this).data('label'));
                self._clearResults();
                self._goToPage(1);
                self._ajaxFetch();

            });

            this.$pagination.on('click', '[data-page]', function(e){

                e.preventDefault();

                var pageIdx;

                if(self.opt.type === 'single' || self.opt.type === 'multiple'){

                    pageIdx = $(this).data('page');
                    self.opt.tmpl.pagination.clear();
                    self._clearResults();

                }

                if(self.opt.type === 'infinite'){

                    pageIdx = $(this).data('page');
                    $(this).data('page', ++pageIdx);

                }

                self._goToPage(pageIdx);
                self._ajaxFetch();

            });

            this.$pagination.on('click', '[data-throttle]', function(e){

                self.opt.throttle += self.opt.pagiThrottle;
                self.opt.tmpl.pagination.clear();
                self._clearResults();
                self._ajaxFetch();

            });

            this.$filters.on('click', '[data-template]', function(e){

                self._removeFilter($(this).index());
                self._ajaxFetch();

            });

            var timeout;
            this.$body.on('submit keyup', '[data-search]'+this.grid, function(e){

                e.preventDefault();

                var $input = $(this).find('input');
                var $select = $(this).find('select');

                if(e.type === 'submit'){

                    if(!$.trim($input.val()).length){
                        return;
                    }

                    self.isActive = true;

                    clearTimeout(timeout);

                    self._setFilter($select.val()+':'+$input.val());
                    self._clearResults();
                    self._goToPage(1);
                    self._ajaxFetch();

                    $input.val('').data('old', '');
                    $select.prop('selectedIndex',0);

                    return false;

                }

                if(e.type === 'keyup' && e.keyCode !== 13){

                    if(self.opt.isActive){
                        return;
                    }

                    clearTimeout(timeout);

                    timeout = setTimeout(function(){

                        self._liveSearch($input.val(), $input.data('old'), $select.val());
                        $input.data('old', $input.val());

                        self._goToPage(1);
                        self._ajaxFetch();

                    }, self.opt.searchThreshold);

                }


            });

            this.$body.on('click', '[data-reset]'+this.grid, function(e){
                e.preventDefault();
                self._reset();
                self._fetch();
            });

        },

        _liveSearch: function(curr, old, column){

            this.opt.throttle = this.opt.pagiThrottle;

            if(curr !== old){

                for(var i = 0; i < this.opt.appliedFilters.length; i++){

                    if(this.opt.appliedFilters[i].value === old){

                        this.opt.appliedFilters.splice(i, 1);

                    }

                }

                if(curr.length){

                    this.opt.appliedFilters.push({
                        column: column === 'all' ? undefined : column,
                        columnLabel: column === 'all' ? undefined : column,
                        value: curr,
                        valueLabel: curr,
                        type: 'live'
                    });

                }

                this._clearResults();

            }

        },

        _setFilter: function(filter, label){

            this.opt.throttle = this.opt.pagiThrottle;

            var arr = filter.split(', ');

            for(var i = 0; i < arr.length; i++){

                var values = arr[i].split(':');

                //Check to See if its appled
                for(var j = 0; j < this.opt.appliedFilters.length; j++){

                    if(this.opt.appliedFilters[j].value === values[1]){

                        if(this.opt.appliedFilters[j].type === 'live'){
                            this.opt.appliedFilters.splice(j, 1);
                        }else{
                            values.splice(j, 2);
                        }

                    }

                }

                if(typeof label !== 'undefined'){

                    var larr = label.split(', ');

                    for(var k = 0; k < larr.length; k++){

                        var labels = larr[k].split(':');

                        if(values[0] === labels[0]){
                            values[2] = labels[1];
                        }

                        if(values[1] === labels[0]){
                            values[3] = labels[1];
                        }

                    }

                }


                if(values.length){

                    this.opt.appliedFilters.push({
                        column: values[0] === 'all' ? undefined : values[0],
                        columnLabel: typeof values[2] === 'undefined' ? values[0] : values[2],
                        value: values[1],
                        valueLabel: typeof values[3] === 'undefined' ? values[1] : values[3],
                        type: 'normal'
                    });


                    this.opt.tmpl.appliedFilters.render(this.opt.appliedFilters);

                }

            }

        },

        _setSort: function(sort){

            var arr = sort.split(':'),
                direction = typeof arr[1] !== 'undefined' ? arr[1] : 'asc';

            if(arr[0] === this.opt.sort.column){

                this.opt.sort.direction = (this.opt.sort.direction === 'asc') ? 'desc' : 'asc';

            }else{

                this.opt.sort.column = arr[0];
                this.opt.sort.direction = direction;

            }

        },

        _setSortDirection: function(el){

            $('[data-sort]'+this.grid).not(el).removeClass('asc desc');

            if(el.hasClass('asc')){
                el.removeClass('asc').addClass('desc');
            }else{
                el.removeClass('desc').addClass('asc');
            }

        },

        _ajaxFetch: function(){

            this._loading();

            var self = this;

            $.ajax({
                url: this.opt.source,
                dataType: 'json',
                data: this._buildFetchData()
            })
                .done(function(json){

                    self.opt.isActive = false;

                    self.opt.totalCount = json.total_count;
                    self.opt.filterCount = json.filtered_count;
                    self.opt.nextIdx = json.next_page;
                    self.opt.prevIdx = json.previous_page;
                    self.opt.totalPages = json.pages_count;

                    if(self.opt.type !== 'infinite'){
                        self.opt.tmpl.results.clear();
                    }

                    if(self.opt.type === 'single' || self.opt.type === 'multiple'){
                        self.opt.tmpl.results.render(json.results);
                    }else{
                        self.opt.tmpl.results.append(json.results);
                    }

                    self.opt.tmpl.pagination.render(self._buildPagination(json.page, json.next_page, json.previous_page, json.pages_count));

                    if(json.pages_count <= 1 && self.opt.type === 'infinite'){
                        self.opt.tmpl.pagination.clear();
                    }

                    if(!json.results.length){
                        self.$results.find('[data-results-fallback]').show();
                    }else{
                        self.$results.find('[data-results-fallback]').hide();
                    }

                    self._loading();
                    self._callback();

                })
                .error(function(jqXHR, textStatus, errorThrown) {
                    self._logError('ajaxFetch '+jqXHR.status ,errorThrown);
                });

        },

        _clearResults: function(){

            if(this.opt.type === 'infinite'){
                this.opt.tmpl.results.clear();
            }

        },

        _buildFetchData: function(){

            var params = {};

            params.page = this.opt.pageIdx;
            params.dividend = this.opt.dividend;
            params.threshold = this.opt.threshold;
            params.throttle = this.opt.throttle;
            params.filters = [];

            for(var i = 0; i < this.opt.appliedFilters.length; i++){

                if(typeof this.opt.appliedFilters[i].column === 'undefined'){

                    params.filters.push(this.opt.appliedFilters[i].value);

                }else{

                    var filter = {};
                    filter[this.opt.appliedFilters[i].column] = this.opt.appliedFilters[i].value;
                    params.filters.push(filter);

                }

            }

            if(typeof this.opt.sort.column !== 'undefined' && typeof this.opt.sort.direction !== 'undefined'){
                params.sort = this.opt.sort.column;
                params.direction = this.opt.sort.direction;
            }

            return $.param(params);

        },

        _buildPagination: function(page, next, prev, total){

            var paginationNav = [],
                params,
                perPage,
                i;

            if(this.opt.type === 'single'){

                if(this.opt.filterCount !== this.opt.totalCount){
                    perPage = this._resultsPerPage(this.opt.filterCount, total);
                }else{
                    perPage = this._resultsPerPage(this.opt.totalCount, total);
                }

                params = {
                    pageStart: perPage === 0 ? 0 : (this.opt.pageIdx === 1 ? 1 : (perPage * (this.opt.pageIdx - 1) + 1)),
                    pageLimit: this.opt.pageIdx === 1 ? perPage : (this.opt.totalCount < (perPage * this.opt.pageIdx)) ? this.opt.totalCount : perPage * this.opt.pageIdx,
                    prevPage: prev,
                    nextPage: next,
                    page: page,
                    active: true,
                    totalPages: total,
                    single: true
                };

                paginationNav.push(params);


            }

            if(this.opt.type === 'multiple'){

                if( (this.opt.totalCount > this.opt.throttle) && (this.opt.filterCount > this.opt.throttle) ){

                    perPage = this._resultsPerPage(this.opt.throttle, this.opt.dividend);

                    for(i = 1; i <= this.opt.dividend; i++){

                        params = {
                            pageStart: perPage === 0 ? 0 : ( i === 1 ? 1 : (perPage * (i - 1) + 1)),
                            pageLimit: i === 1 ? perPage : (this.opt.totalCount < this.opt.throttle && i === this.opt.dividend) ? this.opt.totalCount : perPage * i,
                            prevPage: prev,
                            nextPage: next,
                            page: i,
                            active: this.opt.pageIdx === i ? true : false,
                            throttle: false
                        };

                        paginationNav.push(params);

                    }

                    if(this.opt.totalCount > this.opt.throttle){

                        params = {
                            throttle: true
                        };

                        paginationNav.push(params);

                    }

                }else{

                    if(this.opt.filterCount !== this.opt.totalCount){
                        perPage = this._resultsPerPage(this.opt.filterCount, total);
                    }else{
                        perPage = this._resultsPerPage(this.opt.totalCount, total);
                    }

                    for(i = 1; i <= total; i++){

                        params = {
                            pageStart: perPage === 0 ? 0 : ( i === 1 ? 1 : (perPage * (i - 1) + 1)),
                            pageLimit: i === 1 ? perPage : (this.opt.totalCount < (perPage * i)) ? this.opt.totalCount : perPage * i,
                            prevPage: prev,
                            nextPage: next,
                            page: i,
                            active: this.opt.pageIdx === i ? true : false
                        };

                        paginationNav.push(params);

                    }

                }

            }

            if(this.opt.type === 'infinite'){

                params = {
                    page: page,
                    infinite: true
                };

                paginationNav.push(params);

            }

            return paginationNav;

        },

        _goToPage: function(idx){

            if(isNaN(idx = parseInt(idx, 10))){
                idx = 1;
            }

            this.opt.pageIdx = idx;

        },

        _removeFilter: function(idx){

            this.opt.tmpl.appliedFilters.clear();
            this._clearResults();
            this.opt.appliedFilters.splice(idx, 1);

            for(var i = 0; i < this.opt.appliedFilters.length; i++){

                if(this.opt.appliedFilters[i].type === 'normal'){

                    this.opt.tmpl.appliedFilters.append(this.opt.appliedFilters[i]);

                }

            }

        },

        _resultsPerPage: function(dividend, divisor){
            return Math.ceil(dividend / divisor);
        },

        _reset: function(){

            this.$body.find('[data-sort]').removeClass('asc desc');
            this.$body.find('[data-search]').find('input').val('');
            this.$body.find('[data-search]').find('select').prop('selectedIndex', 0);

            this.opt.appliedFilters = [];
            this.opt.sort = {};
            this.opt.pageIdx = 1;

            this.opt.tmpl.appliedFilters.clear();
            this.opt.tmpl.results.clear();
        },

        _loading: function(){

            if ($(this.opt.loader).is(':visible')){
                $(this.opt.loader).fadeOut();
            }else{
                $(this.opt.loader).fadeIn();
            }

        },

        _log: function(msg, type, args){
            if(window.console && console[type]){
                console[type]('DataGrid :: ' + type, args);
            }
        },

        _logDebug: function(msg){

            if(this.debug){
                this._log(msg, 'log', arguments);
            }

        },

        _logError: function(msg){

            this._log(msg, 'error', arguments);

        },

        _logWarn: function(msg){

            this._log(msg, 'warn', arguments);

        },

        _callback: function(){

            if(this.opt.callback !== undefined && $.isFunction(this.opt.callback)){

                this.opt.callback(this.opt);

            }

        }

    };

    $.datagrid = function(grid, results, pagination, filters, options){
        return new DataGrid(grid, results, pagination, filters, options);
    };

})(jQuery, window, document);
