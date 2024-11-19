// Default Laravel bootstrapper, installs axios
import './bootstrap';

// Added: Actual Bootstrap JavaScript dependency
import 'bootstrap';

// Added: Popper.js dependency for popover support in Bootstrap
import '@popperjs/core';

import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

//powergrid
import './../../vendor/power-components/livewire-powergrid/dist/powergrid';
import './../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

import TomSelect from 'tom-select';
window.TomSelect = TomSelect;

import SlimSelect from 'slim-select';
window.SlimSelect = SlimSelect;

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

//listeners for section modal
document.addEventListener('DOMContentLoaded', function () {
  window.addEventListener('hide-sections-modal', (event) => {
    var myModalEl = document.getElementById('adjudicationSectionsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-courts-modal', (event) => {
    var myModalEl = document.getElementById('courtsAndJudgesModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-global-docs-modal', (event) => {
    var myModalEl = document.getElementById('globalDocumentsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-subfile-watch-modal', (event) => {
    var myModalEl = document.getElementById('subfilesRecordsWatchModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-subfile-status-bulk-action-modal', (event) => {
    var myModalEl = document.getElementById('subfilesRecordsStatusModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-subfile-documents-modal', (event) => {
    var myModalEl = document.getElementById('subfilesRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-persons-documents-modal', (event) => {
    var myModalEl = document.getElementById('personsRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-persons-documents-modal', (event) => {
    var myModalEl = document.getElementById('personsRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-water-rights-documents-modal', (event) => {
    var myModalEl = document.getElementById('waterRightsRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-places-of-use-documents-modal', (event) => {
    var myModalEl = document.getElementById('placesOfUseRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-points-of-diversion-documents-modal', (event) => {
    var myModalEl = document.getElementById('pointsOfDiversionRecordsBulkAssignDocsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-pod-water-rights-bulk-action-modal', (event) => {
    var myModalEl = document.getElementById('pointsOfDiversionBulkAssignRightsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

    window.addEventListener('hide-pou-water-rights-bulk-action-modal', (event) => {
    var myModalEl = document.getElementById('placesOfUseBulkAssignRightsModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });

   window.addEventListener('hide-subfile-attorney-bulk-action-modal', (event) => {
    var myModalEl = document.getElementById('subfilesRecordsAttorneyModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    modal.hide();
  });
});






