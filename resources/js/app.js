import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import $ from 'jquery';
window.$ = window.jQuery = $;

import * as bootstrap from 'bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

/*
|--------------------------------------------------------------------------
| Bootstrap 5 jQuery bridge
|--------------------------------------------------------------------------
*/

$.fn.tooltip = function (config) {
    return this.each(function () {
        new bootstrap.Tooltip(this, config);
    });
};

$.fn.popover = function (config) {
    return this.each(function () {
        new bootstrap.Popover(this, config);
    });
};

import 'summernote/dist/summernote-bs5.js';
import 'summernote/dist/summernote-bs5.css';