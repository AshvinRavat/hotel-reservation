
import './bootstrap';
import $ from "jquery";

import Alert from 'bootstrap/js/dist/alert';

import { Tooltip, Toast, Popover } from 'bootstrap';
import { createPopper } from '@popperjs/core';

import '@fortawesome/fontawesome-free/js/all.js';

import "../../node_modules/@googlemaps/js-api-loader/dist/index.min";

import DataTable from 'datatables.net-bs5';

$(document).ready( function () {
    $('#myTable').DataTable();
});
