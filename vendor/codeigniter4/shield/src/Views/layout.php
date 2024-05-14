<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $this->renderSection('title') ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css'); ?>">

    <?= $this->renderSection('pageStyles') ?>
</head>
<style type="text/css">
    .react-grid-checkbox,
    .radio-custom {
      opacity: 0;
      position: absolute;
    }

    .react-grid-checkbox,
    .react-grid-checkbox-label,
    .radio-custom,
    .radio-custom-label {
      display: inline-block;
      vertical-align: middle;
      cursor: pointer;
    }

    .react-grid-checkbox-label,
    .radio-custom-label {
      position: relative;
    }

    .react-grid-checkbox+.react-grid-checkbox-label:before,
    .radio-custom+.radio-custom-label:before {
      content: '';
      background: #fff;
      border: 2px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      width: 20px;
      height: 20px;
      text-align: center;
    }

    .react-grid-checkbox:checked+.react-grid-checkbox-label:before {
      background: #005295;
      box-shadow: inset 0px 0px 0px 4px #fff;
    }

    .react-grid-checkbox:focus+.react-grid-checkbox-label,
    .radio-custom:focus+.radio-custom-label {
      outline: 1px solid #ddd;
      /* focus style */
    }

    .react-grid-HeaderCell input[type='checkbox'] {
      z-index: 99999;
    }

    .react-grid-HeaderCell>.react-grid-checkbox-container {
      padding: 0px 10px;
      height: 100%
    }


    .react-grid-HeaderCell>.react-grid-checkbox-container>.react-grid-checkbox-label {
      margin: 0;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    .radio-custom+.radio-custom-label:before {
      border-radius: 50%;
    }

    .radio-custom:checked+.radio-custom-label:before {
      background: #ccc;
      box-shadow: inset 0px 0px 0px 4px #fff;
    }

    .checkbox-align {
      text-align: center;
    }
  </style>

<style type="text/css">
    .react-autocomplete-Autocomplete__search {
      display: block;
      width: 100%;
      height: 36px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.6;
      color: #555555;
      background-color: white;
      background-image: none;
      border: 1px solid #cccccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .react-autocomplete-Autocomplete__search:focus {
      border-color: #a21618;
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(162, 22, 24, 0.6);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(162, 22, 24, 0.6);
    }

    .react-autocomplete-Autocomplete__search::-moz-placeholder {
      color: #777777;
      opacity: 1;
    }

    .react-autocomplete-Autocomplete__search:-ms-input-placeholder {
      color: #777777;
    }

    .react-autocomplete-Autocomplete__search::-webkit-input-placeholder {
      color: #777777;
    }

    .react-autocomplete-Autocomplete__search[disabled],
    .react-autocomplete-Autocomplete__search[readonly],
    fieldset[disabled] .react-autocomplete-Autocomplete__search {
      cursor: not-allowed;
      background-color: #eeeeee;
      opacity: 1;
    }

    textarea.react-autocomplete-Autocomplete__search {
      height: auto;
    }

    .react-autocomplete-Autocomplete__results {
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 1000;
      display: none;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      margin: 2px 0 0;
      list-style: none;
      font-size: 14px;
      text-align: left;
      background-color: white;
      border: 1px solid #cccccc;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 4px;
      -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      background-clip: padding-box;
      min-width: 250px;
      width: 100%;
      max-height: 200px;
      overflow: auto;
    }

    .react-autocomplete-Autocomplete__results.pull-right {
      right: 0;
      left: auto;
    }

    .react-autocomplete-Autocomplete__results .divider {
      height: 1px;
      margin: 10px 0;
      overflow: hidden;
      background-color: #e5e5e5;
    }

    .react-autocomplete-Autocomplete__results>li>a {
      display: block;
      padding: 3px 20px;
      clear: both;
      font-weight: normal;
      line-height: 1.6;
      color: #333333;
      white-space: nowrap;
    }

    .react-autocomplete-Autocomplete__results div.action-button {
      display: block !important;
      padding: 4px;
    }

    .react-autocomplete-Result {
      cursor: pointer;
    }

    .react-autocomplete-Result>a {
      text-decoration: none;
    }

    .react-autocomplete-Result--active {
      color: #262626;
      background-color: whitesmoke;
    }
  </style>
  <style type="text/css">
    .react-grid-image {
      background: #efefef;
      background-size: 100%;
      display: inline-block;
      height: 40px;
      width: 40px;
    }
  </style>
  <style type="text/css">
    .react-grid-Toolbar {
      background-color: #ffffff;
      border-color: #e7eaec;
      border-image: none;
      border-style: solid solid none;
      border-width: 1px 1px 1px 1px;
      color: inherit;
      margin-bottom: 0;
      padding: 14px 15px 7px;
      height: 48px;
    }

    .react-grid-Toolbar .btn {
      display: inline-block;
      padding: 6px 12px;
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 400;
      line-height: 1.42857143;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      cursor: pointer;
      -webkit-user-select: none;
      color: inherit;
      background: white;
      border: 1px solid #e7eaec;
    }

    .react-grid-Toolbar .btn:hover {
      color: inherit;
      border: 1px solid #d2d2d2;
    }

    .react-grid-Toolbar .grouped-col-btn {
      background-color: #428bca;
      color: white;
      border-color: #2b669a;
    }

    .react-grid-Toolbar .grouped-col-btn:hover {
      color: white;
      border-color: #2b669a;
    }

    .react-grid-Toolbar .grouped-col-btn+.grouped-col-btn {
      margin-left: 5px;
    }

    .react-grid-Toolbar .grouped-col-btn__remove {
      margin-left: 5px;
    }

    .react-grid-Toolbar .tools {
      display: inline-block;
      float: right;
      margin-top: 0;
      position: relative;
      padding: 0;
      margin-top: -6px;
    }
  </style>
  <style type="text/css">
    .react-grid-Cell {
      background-color: #ffffff;
      padding-left: 8px;
      padding-right: 8px;
      border-right: 1px solid #eee;
      border-bottom: 1px solid #dddddd;
    }

    .rdg-selected {
      border: 2px solid #66afe9;
    }

    .rdg-selected-range {
      border: 1px solid #66afe9;
      background-color: #66afe930;
    }

    .moving-element {
      will-change: transform;
    }

    .react-grid-Cell--frozen {
      /* Should have a higher value than 1 to show in front of cell masks */
      z-index: 2;
    }

    .rdg-last--frozen {
      border-right: 1px solid #dddddd;
      box-shadow: 2px 0 5px -2px rgba(136, 136, 136, .3) !important;
    }

    /* cell which have tooltips need to have a higher z-index on hover so that the tooltip appears above the other cells*/
    .react-grid-Cell.has-tooltip:hover {
      z-index: 1;
    }

    .react-grid-Cell.react-grid-Cell--frozen.has-tooltip:hover {
      z-index: 3
    }

    .react-contextmenu--visible {
      z-index: 1000;
    }

    .react-grid-Cell:not(.editing) .react-grid-Cell__value {
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
      height: inherit;
    }

    .react-grid-Cell.readonly {
      background-color: black;
    }


    .react-grid-Cell:hover {
      background: #eee;
    }

    .react-grid-cell .form-control-feedback {
      color: #a94442;
      position: absolute;
      top: 0px;
      right: 10px;
      z-index: 1000000;
      display: block;
      width: 34px;
      height: 34px;
    }

    .react-grid-Row.row-selected .react-grid-Cell {
      background-color: #DBECFA;
    }

    .react-grid-Cell.editing {
      padding: 0;
      overflow: visible !important;
    }

    .react-grid-Cell.editing .has-error input {
      border: 2px red solid !important;
      border-radius: 2px !important;
    }

    .react-grid-Cell__value ul {
      margin-top: 0;
      margin-bottom: 0;
      display: inline-block;
    }

    .react-grid-Cell__value .btn-sm {
      padding: 0;
    }

    .cell-tooltip .cell-tooltip-text {
      white-space: normal;
      visibility: hidden;
      width: 150px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      position: absolute;
      top: 50%;
      bottom: initial;
      left: 50%;
      margin-top: 15px;
      margin-left: -75px
    }

    .cell-tooltip:hover .cell-tooltip-text {
      visibility: visible;
      opacity: 0.8;
    }

    .cell-tooltip .cell-tooltip-text::after {
      content: " ";
      position: absolute;
      bottom: 100%;
      /* At the top of the tooltip */
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: transparent transparent black transparent;
    }

    .react-grid-Canvas.opaque .react-grid-Cell.cell-tooltip:hover .cell-tooltip-text {
      visibility: hidden;
    }

    .rdg-cell-expand {
      float: right;
      display: table;
      height: 100%;
    }

    .rdg-cell-expand>span {
      display: table-cell;
      vertical-align: middle;
      cursor: pointer;
    }

    .rdg-child-row-action-cross:before,
    rdg-child-row-action-cross:after,
    .rdg-child-row-action-cross-last:before,
    rdg-child-row-action-cross-last:after {
      content: "";
      position: absolute;
      background: grey;
      height: 50%;
    }

    .rdg-child-row-action-cross:before {
      left: 21px;
      width: 1px;
      height: 100%;
    }

    .rdg-child-row-action-cross-last:before {
      left: 21px;
      width: 1px;
    }

    .rdg-child-row-action-cross:after,
    .rdg-child-row-action-cross-last:after {
      top: 50%;
      left: 20px;
      height: 1px;
      width: 15px;
      content: "";
      position: absolute;
      background: grey;
    }

    .rdg-child-row-action-cross:hover {
      background: red;
    }

    .rdg-child-row-btn {
      position: absolute;
      cursor: pointer;
      border: 1px solid grey;
      border-radius: 14px;
      z-index: 2;
      background: white;
    }

    .rdg-child-row-btn div {
      font-size: 12px;
      text-align: center;
      line-height: 19px;
      color: grey;
      height: 20px;
      width: 20px;
      position: absolute;
      top: 60%;
      left: 53%;
      margin-top: -10px;
      margin-left: -10px;

    }

    .rdg-empty-child-row:hover .glyphicon-plus-sign {
      color: green;
    }

    .rdg-empty-child-row:hover a {
      color: green;
    }

    .rdg-child-row-btn .glyphicon-remove-sign:hover {
      color: red;
    }

    .last-column .cell-tooltip-text {
      right: 100%;
      left: 0% !important;
    }

    .rdg-cell-action {
      float: right;
      height: 100%;
    }

    .rdg-cell-action-last {
      margin-right: -8px;
    }

    .rdg-cell-action-button {
      width: 35px;
      height: 100%;
      text-align: center;
      position: relative;
      display: table;
      color: #4a9de2;
    }

    .rdg-cell-action-button>span {
      display: table-cell;
      vertical-align: middle;
    }

    .rdg-cell-action-button:hover,
    .rdg-cell-action-button-toggled {
      color: #447bbb;
    }

    .rdg-cell-action-menu {
      position: absolute;
      top: 100%;
      z-index: 1000;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      text-align: left;
      list-style: none;
      background-color: #fff;
      -webkit-background-clip: padding-box;
      background-clip: padding-box;
      border: 1px solid #ccc;
      box-shadow: 0 0 3px 0 #ccc;
    }

    .rdg-cell-action-menu>span {
      display: block;
      padding: 3px 10px;
      clear: both;
      font-weight: 400;
      line-height: 1.42857143;
      color: #333;
      white-space: nowrap;
    }

    .rdg-cell-action-menu>span:hover {
      color: #262626;
      text-decoration: none;
      background-color: #f5f5f5;
    }
  </style>
  <style type="text/css">
    .react-grid-Row:hover .react-grid-Cell,
    .react-grid-Row.row-context-menu .react-grid-Cell {
      background-color: #f9f9f9;
    }

    .react-grid-Row:hover .rdg-row-index {
      display: none;
    }

    .react-grid-Row:hover .rdg-actions-checkbox {
      display: block;
    }

    .react-grid-Row:hover .rdg-drag-row-handle {
      cursor: move;
      /* fallback if grab cursor is unsupported */
      cursor: grab;
      cursor: -moz-grab;
      cursor: -webkit-grab;
      width: 12px;
      height: 30px;
      margin-left: 0px;
      background-image: url("data:image/svg+xml;base64, PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjlweCIgaGVpZ2h0PSIyOXB4IiB2aWV3Qm94PSIwIDAgOSAyOSIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDwhLS0gR2VuZXJhdG9yOiBTa2V0Y2ggMzkgKDMxNjY3KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5kcmFnIGljb248L3RpdGxlPgogICAgPGRlc2M+Q3JlYXRlZCB3aXRoIFNrZXRjaC48L2Rlc2M+CiAgICA8ZGVmcz48L2RlZnM+CiAgICA8ZyBpZD0iQWN0dWFsaXNhdGlvbi12MiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgaWQ9IkRlc2t0b3AiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xNS4wMDAwMDAsIC0yNjIuMDAwMDAwKSIgZmlsbD0iI0Q4RDhEOCI+CiAgICAgICAgICAgIDxnIGlkPSJJbnRlcmFjdGlvbnMiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE1LjAwMDAwMCwgMjU4LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9IlJvdy1Db250cm9scyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsIDIuMDAwMDAwKSI+CiAgICAgICAgICAgICAgICAgICAgPGcgaWQ9ImRyYWctaWNvbiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsIDIuMDAwMDAwKSI+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMTIiIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iNyIgY3k9IjEyIiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC0zMCIgY3g9IjIiIGN5PSIxNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iMTciIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iMiIgY3k9IjIyIiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC0zMCIgY3g9IjciIGN5PSIyMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMjciIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iNyIgY3k9IjI3IiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==");
      background-repeat: no-repeat;
    }

    .react-grid-Row.row-selected {
      background-color: #DBECFA;
    }

    .react-grid-Row .row-selected {
      background-color: #DBECFA;
    }

    .react-grid-row-group .row-expand-icon:hover {
      color: #777777;
    }

    .react-grid-row-index {
      padding: 0 18px;
    }

    .rdg-row-index {
      display: block;
      text-align: center;
    }

    .rdg-row-actions-cell {
      padding: 0px;
    }

    .rdg-actions-checkbox {
      display: none;
      text-align: center;
    }

    .rdg-actions-checkbox.selected {
      display: block;
    }

    .rdg-dragging {
      /*cursor: url(http://www.google.com/intl/en_ALL/mapfiles/closedhand.cur);*/
      cursor: -webkit-grabbing;
      cursor: -moz-grabbing;
      cursor: grabbing;
    }

    .rdg-dragged-row {
      border-bottom: 1px solid black
    }

    .rdg-scrolling {
      pointer-events: none;
    }
  </style>
  <style type="text/css">
    .slideUp {
      -webkit-animation-name: slideUp;
      animation-name: slideUp;
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-timing-function: ease;
      animation-timing-function: ease;

      visibility: visible !important;
    }

    @keyframes slideUp {
      0% {
        transform: translateY(100%);
      }

      50% {
        transform: translateY(-8%);
      }

      65% {
        transform: translateY(4%);
      }

      80% {
        transform: translateY(-4%);
      }

      95% {
        transform: translateY(2%);
      }

      100% {
        transform: translateY(0%);
      }
    }


    @-webkit-keyframes slideUp {
      0% {
        -webkit-transform: translateY(100%);
      }

      50% {
        -webkit-transform: translateY(-8%);
      }

      65% {
        -webkit-transform: translateY(4%);
      }

      80% {
        -webkit-transform: translateY(-4%);
      }

      95% {
        -webkit-transform: translateY(2%);
      }

      100% {
        -webkit-transform: translateY(0%);
      }
    }

    .rowDropTarget {
      position: absolute;
      left: 0;
      width: 100%;
      z-index: 1;
      border-bottom: 1px solid black;
    }
  </style>
  <style type="text/css">
    /**
 * React Select
 * ============
 * Created by Jed Watson and Joss Mackison for KeystoneJS, http://www.keystonejs.com/
 * https://twitter.com/jedwatson https://twitter.com/jossmackison https://twitter.com/keystonejs
 * MIT License: https://github.com/JedWatson/react-select
*/
    .Select {
      position: relative;
    }

    .Select input::-webkit-contacts-auto-fill-button,
    .Select input::-webkit-credentials-auto-fill-button {
      display: none !important;
    }

    .Select input::-ms-clear {
      display: none !important;
    }

    .Select input::-ms-reveal {
      display: none !important;
    }

    .Select,
    .Select div,
    .Select input,
    .Select span {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }

    .Select.is-disabled .Select-arrow-zone {
      cursor: default;
      pointer-events: none;
      opacity: 0.35;
    }

    .Select.is-disabled>.Select-control {
      background-color: #f9f9f9;
    }

    .Select.is-disabled>.Select-control:hover {
      box-shadow: none;
    }

    .Select.is-open>.Select-control {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      background: #fff;
      border-color: #b3b3b3 #ccc #d9d9d9;
    }

    .Select.is-open>.Select-control .Select-arrow {
      top: -2px;
      border-color: transparent transparent #999;
      border-width: 0 5px 5px;
    }

    .Select.is-searchable.is-open>.Select-control {
      cursor: text;
    }

    .Select.is-searchable.is-focused:not(.is-open)>.Select-control {
      cursor: text;
    }

    .Select.is-focused>.Select-control {
      background: #fff;
    }

    .Select.is-focused:not(.is-open)>.Select-control {
      border-color: #007eff;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 0 3px rgba(0, 126, 255, 0.1);
      background: #fff;
    }

    .Select.has-value.is-clearable.Select--single>.Select-control .Select-value {
      padding-right: 42px;
    }

    .Select.has-value.Select--single>.Select-control .Select-value .Select-value-label,
    .Select.has-value.is-pseudo-focused.Select--single>.Select-control .Select-value .Select-value-label {
      color: #333;
    }

    .Select.has-value.Select--single>.Select-control .Select-value a.Select-value-label,
    .Select.has-value.is-pseudo-focused.Select--single>.Select-control .Select-value a.Select-value-label {
      cursor: pointer;
      text-decoration: none;
    }

    .Select.has-value.Select--single>.Select-control .Select-value a.Select-value-label:hover,
    .Select.has-value.is-pseudo-focused.Select--single>.Select-control .Select-value a.Select-value-label:hover,
    .Select.has-value.Select--single>.Select-control .Select-value a.Select-value-label:focus,
    .Select.has-value.is-pseudo-focused.Select--single>.Select-control .Select-value a.Select-value-label:focus {
      color: #007eff;
      outline: none;
      text-decoration: underline;
    }

    .Select.has-value.Select--single>.Select-control .Select-value a.Select-value-label:focus,
    .Select.has-value.is-pseudo-focused.Select--single>.Select-control .Select-value a.Select-value-label:focus {
      background: #fff;
    }

    .Select.has-value.is-pseudo-focused .Select-input {
      opacity: 0;
    }

    .Select.is-open .Select-arrow,
    .Select .Select-arrow-zone:hover>.Select-arrow {
      border-top-color: #666;
    }

    .Select.Select--rtl {
      direction: rtl;
      text-align: right;
    }

    .Select-control {
      background-color: #fff;
      border-color: #d9d9d9 #ccc #b3b3b3;
      border-radius: 4px;
      border: 1px solid #ccc;
      color: #333;
      cursor: default;
      display: table;
      border-spacing: 0;
      border-collapse: separate;
      height: 36px;
      outline: none;
      overflow: hidden;
      position: relative;
      width: 100%;
    }

    .Select-control:hover {
      box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
    }

    .Select-control .Select-input:focus {
      outline: none;
      background: #fff;
    }

    .Select-placeholder,
    .Select--single>.Select-control .Select-value {
      bottom: 0;
      color: #aaa;
      left: 0;
      line-height: 34px;
      padding-left: 10px;
      padding-right: 10px;
      position: absolute;
      right: 0;
      top: 0;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .Select-input {
      height: 34px;
      padding-left: 10px;
      padding-right: 10px;
      vertical-align: middle;
    }

    .Select-input>input {
      width: 100%;
      background: none transparent;
      border: 0 none;
      box-shadow: none;
      cursor: default;
      display: inline-block;
      font-family: inherit;
      font-size: inherit;
      margin: 0;
      outline: none;
      line-height: 17px;
      /* For IE 8 compatibility */
      padding: 8px 0 12px;
      /* For IE 8 compatibility */
      -webkit-appearance: none;
    }

    .is-focused .Select-input>input {
      cursor: text;
    }

    .has-value.is-pseudo-focused .Select-input {
      opacity: 0;
    }

    .Select-control:not(.is-searchable)>.Select-input {
      outline: none;
    }

    .Select-loading-zone {
      cursor: pointer;
      display: table-cell;
      position: relative;
      text-align: center;
      vertical-align: middle;
      width: 16px;
    }

    .Select-loading {
      -webkit-animation: Select-animation-spin 400ms infinite linear;
      -o-animation: Select-animation-spin 400ms infinite linear;
      animation: Select-animation-spin 400ms infinite linear;
      width: 16px;
      height: 16px;
      box-sizing: border-box;
      border-radius: 50%;
      border: 2px solid #ccc;
      border-right-color: #333;
      display: inline-block;
      position: relative;
      vertical-align: middle;
    }

    .Select-clear-zone {
      -webkit-animation: Select-animation-fadeIn 200ms;
      -o-animation: Select-animation-fadeIn 200ms;
      animation: Select-animation-fadeIn 200ms;
      color: #999;
      cursor: pointer;
      display: table-cell;
      position: relative;
      text-align: center;
      vertical-align: middle;
      width: 17px;
    }

    .Select-clear-zone:hover {
      color: #D0021B;
    }

    .Select-clear {
      display: inline-block;
      font-size: 18px;
      line-height: 1;
    }

    .Select--multi .Select-clear-zone {
      width: 17px;
    }

    .Select-arrow-zone {
      cursor: pointer;
      display: table-cell;
      position: relative;
      text-align: center;
      vertical-align: middle;
      width: 25px;
      padding-right: 5px;
    }

    .Select--rtl .Select-arrow-zone {
      padding-right: 0;
      padding-left: 5px;
    }

    .Select-arrow {
      border-color: #999 transparent transparent;
      border-style: solid;
      border-width: 5px 5px 2.5px;
      display: inline-block;
      height: 0;
      width: 0;
      position: relative;
    }

    .Select-control>*:last-child {
      padding-right: 5px;
    }

    .Select--multi .Select-multi-value-wrapper {
      display: inline-block;
    }

    .Select .Select-aria-only {
      position: absolute;
      display: inline-block;
      height: 1px;
      width: 1px;
      margin: -1px;
      clip: rect(0, 0, 0, 0);
      overflow: hidden;
      float: left;
    }

    @-webkit-keyframes Select-animation-fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes Select-animation-fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .Select-menu-outer {
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-top-color: #e6e6e6;
      box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
      box-sizing: border-box;
      margin-top: -1px;
      max-height: 200px;
      position: absolute;
      left: 0;
      top: 100%;
      width: 100%;
      z-index: 1;
      -webkit-overflow-scrolling: touch;
    }

    .Select-menu {
      max-height: 198px;
      overflow-y: auto;
    }

    .Select-option {
      box-sizing: border-box;
      background-color: #fff;
      color: #666666;
      cursor: pointer;
      display: block;
      padding: 8px 10px;
    }

    .Select-option:last-child {
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
    }

    .Select-option.is-selected {
      background-color: #f5faff;
      /* Fallback color for IE 8 */
      background-color: rgba(0, 126, 255, 0.04);
      color: #333;
    }

    .Select-option.is-focused {
      background-color: #ebf5ff;
      /* Fallback color for IE 8 */
      background-color: rgba(0, 126, 255, 0.08);
      color: #333;
    }

    .Select-option.is-disabled {
      color: #cccccc;
      cursor: default;
    }

    .Select-noresults {
      box-sizing: border-box;
      color: #999999;
      cursor: default;
      display: block;
      padding: 8px 10px;
    }

    .Select--multi .Select-input {
      vertical-align: middle;
      margin-left: 10px;
      padding: 0;
    }

    .Select--multi.Select--rtl .Select-input {
      margin-left: 0;
      margin-right: 10px;
    }

    .Select--multi.has-value .Select-input {
      margin-left: 5px;
    }

    .Select--multi .Select-value {
      background-color: #ebf5ff;
      /* Fallback color for IE 8 */
      background-color: rgba(0, 126, 255, 0.08);
      border-radius: 2px;
      border: 1px solid #c2e0ff;
      /* Fallback color for IE 8 */
      border: 1px solid rgba(0, 126, 255, 0.24);
      color: #007eff;
      display: inline-block;
      font-size: 0.9em;
      line-height: 1.4;
      margin-left: 5px;
      margin-top: 5px;
      vertical-align: top;
    }

    .Select--multi .Select-value-icon,
    .Select--multi .Select-value-label {
      display: inline-block;
      vertical-align: middle;
    }

    .Select--multi .Select-value-label {
      border-bottom-right-radius: 2px;
      border-top-right-radius: 2px;
      cursor: default;
      padding: 2px 5px;
    }

    .Select--multi a.Select-value-label {
      color: #007eff;
      cursor: pointer;
      text-decoration: none;
    }

    .Select--multi a.Select-value-label:hover {
      text-decoration: underline;
    }

    .Select--multi .Select-value-icon {
      cursor: pointer;
      border-bottom-left-radius: 2px;
      border-top-left-radius: 2px;
      border-right: 1px solid #c2e0ff;
      /* Fallback color for IE 8 */
      border-right: 1px solid rgba(0, 126, 255, 0.24);
      padding: 1px 5px 3px;
    }

    .Select--multi .Select-value-icon:hover,
    .Select--multi .Select-value-icon:focus {
      background-color: #d8eafd;
      /* Fallback color for IE 8 */
      background-color: rgba(0, 113, 230, 0.08);
      color: #0071e6;
    }

    .Select--multi .Select-value-icon:active {
      background-color: #c2e0ff;
      /* Fallback color for IE 8 */
      background-color: rgba(0, 126, 255, 0.24);
    }

    .Select--multi.Select--rtl .Select-value {
      margin-left: 0;
      margin-right: 5px;
    }

    .Select--multi.Select--rtl .Select-value-icon {
      border-right: none;
      border-left: 1px solid #c2e0ff;
      /* Fallback color for IE 8 */
      border-left: 1px solid rgba(0, 126, 255, 0.24);
    }

    .Select--multi.is-disabled .Select-value {
      background-color: #fcfcfc;
      border: 1px solid #e3e3e3;
      color: #333;
    }

    .Select--multi.is-disabled .Select-value-icon {
      cursor: not-allowed;
      border-right: 1px solid #e3e3e3;
    }

    .Select--multi.is-disabled .Select-value-icon:hover,
    .Select--multi.is-disabled .Select-value-icon:focus,
    .Select--multi.is-disabled .Select-value-icon:active {
      background-color: #fcfcfc;
    }

    @keyframes Select-animation-spin {
      to {
        transform: rotate(1turn);
      }
    }

    @-webkit-keyframes Select-animation-spin {
      to {
        -webkit-transform: rotate(1turn);
      }
    }
  </style>
  <style data-emotion=""></style>
  <style type="text/css">
    .react-grid-Header {
      box-shadow: 0px 0px 4px 0px #dddddd;
      background: #f9f9f9;
    }

    .react-grid-Header--resizing {
      cursor: ew-resize;
    }

    .react-grid-HeaderRow {
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .react-grid-HeaderCell {
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      background: #f9f9f9;
      padding: 8px;
      font-weight: bold;
      border-right: 1px solid #dddddd;
      border-bottom: 1px solid #dddddd;
    }

    .react-grid-HeaderCell__value {
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    .react-grid-HeaderCell__resizeHandle:hover {
      cursor: ew-resize;
      background: #dddddd;
    }

    .react-grid-HeaderCell--frozen:last-of-type {
      box-shadow: 2px 0 5px -2px rgba(136, 136, 136, .3);
    }

    .react-grid-HeaderCell--resizing .react-grid-HeaderCell__resizeHandle {
      background: #dddddd;
    }

    .react-grid-HeaderCell__draggable {
      cursor: col-resize
    }

    .rdg-can-drop>.react-grid-HeaderCell {
      background: #ececec;
    }

    .react-grid-HeaderCell .Select {
      max-height: 30px;
      font-size: 12px;
      font-weight: normal;
    }

    .react-grid-HeaderCell .Select-control {
      max-height: 30px;
      border: 1px solid #cccccc;
      color: #555;
      border-radius: 3px;
    }

    .react-grid-HeaderCell .is-focused:not(.is-open)>.Select-control {
      border-color: #66afe9;
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
    }

    .react-grid-HeaderCell .Select-control .Select-placeholder {
      line-height: 20px;
      color: #999;
      padding: 4px;
    }

    .react-grid-HeaderCell .Select-control .Select-input {
      max-height: 28px;
      padding: 4px;
      margin-left: 0px
    }

    .react-grid-HeaderCell .Select-control .Select-input input {
      padding: 0px;
      height: 100%;
    }

    .react-grid-HeaderCell .Select-control .Select-arrow-zone .Select-arrow {
      border-color: gray transparent transparent;
      border-width: 4px 4px 2.5px;
    }


    .react-grid-HeaderCell .Select-control .Select-value {
      padding: 4px;
      line-height: 20px !important;
    }

    .react-grid-HeaderCell .Select--multi .Select-control .Select-value {
      padding: 0px;
      line-height: 16px !important;
      max-height: 20px;
    }

    .react-grid-HeaderCell .Select--multi .Select-control .Select-value .Select-value-icon {
      max-height: 20px;
    }

    .react-grid-HeaderCell .Select--multi .Select-control .Select-value .Select-value-label {
      max-height: 20px;
    }

    .react-grid-HeaderCell .Select-control .Select-value .Select-value-label {
      color: #555555 !important;
    }

    .react-grid-HeaderCell .Select-menu-outer {
      z-index: 2;
    }

    .react-grid-HeaderCell .Select-menu-outer .Select-option {
      padding: 4px;
      line-height: 20px;
    }

    .react-grid-HeaderCell .Select-menu-outer .Select-menu .Select-option.is-selected {
      color: #555555;
    }

    .react-grid-HeaderCell .Select-menu-outer .Select-menu .Select-option.is-focused {
      color: #555555;
    }
  </style>
  <style type="text/css">
    .react-grid-Cell {
      background-color: #ffffff;
      padding-left: 8px;
      padding-right: 8px;
      border-right: 1px solid #eee;
      border-bottom: 1px solid #dddddd;
    }

    .rdg-selected {
      border: 2px solid #66afe9;
    }

    .rdg-selected-range {
      border: 1px solid #66afe9;
      background-color: #66afe930;
    }

    .moving-element {
      will-change: transform;
    }

    .react-grid-Cell--frozen {
      /* Should have a higher value than 1 to show in front of cell masks */
      z-index: 2;
    }

    .rdg-last--frozen {
      border-right: 1px solid #dddddd;
      box-shadow: 2px 0 5px -2px rgba(136, 136, 136, .3) !important;
    }

    /* cell which have tooltips need to have a higher z-index on hover so that the tooltip appears above the other cells*/
    .react-grid-Cell.has-tooltip:hover {
      z-index: 1;
    }

    .react-grid-Cell.react-grid-Cell--frozen.has-tooltip:hover {
      z-index: 3
    }

    .react-contextmenu--visible {
      z-index: 1000;
    }

    .react-grid-Cell:not(.editing) .react-grid-Cell__value {
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
      height: inherit;
    }

    .react-grid-Cell.readonly {
      background-color: black;
    }


    .react-grid-Cell:hover {
      background: #eee;
    }

    .react-grid-cell .form-control-feedback {
      color: #a94442;
      position: absolute;
      top: 0px;
      right: 10px;
      z-index: 1000000;
      display: block;
      width: 34px;
      height: 34px;
    }

    .react-grid-Row.row-selected .react-grid-Cell {
      background-color: #DBECFA;
    }

    .react-grid-Cell.editing {
      padding: 0;
      overflow: visible !important;
    }

    .react-grid-Cell.editing .has-error input {
      border: 2px red solid !important;
      border-radius: 2px !important;
    }

    .react-grid-Cell__value ul {
      margin-top: 0;
      margin-bottom: 0;
      display: inline-block;
    }

    .react-grid-Cell__value .btn-sm {
      padding: 0;
    }

    .cell-tooltip .cell-tooltip-text {
      white-space: normal;
      visibility: hidden;
      width: 150px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      position: absolute;
      top: 50%;
      bottom: initial;
      left: 50%;
      margin-top: 15px;
      margin-left: -75px
    }

    .cell-tooltip:hover .cell-tooltip-text {
      visibility: visible;
      opacity: 0.8;
    }

    .cell-tooltip .cell-tooltip-text::after {
      content: " ";
      position: absolute;
      bottom: 100%;
      /* At the top of the tooltip */
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: transparent transparent black transparent;
    }

    .react-grid-Canvas.opaque .react-grid-Cell.cell-tooltip:hover .cell-tooltip-text {
      visibility: hidden;
    }

    .rdg-cell-expand {
      float: right;
      display: table;
      height: 100%;
    }

    .rdg-cell-expand>span {
      display: table-cell;
      vertical-align: middle;
      cursor: pointer;
    }

    .rdg-child-row-action-cross:before,
    rdg-child-row-action-cross:after,
    .rdg-child-row-action-cross-last:before,
    rdg-child-row-action-cross-last:after {
      content: "";
      position: absolute;
      background: grey;
      height: 50%;
    }

    .rdg-child-row-action-cross:before {
      left: 21px;
      width: 1px;
      height: 100%;
    }

    .rdg-child-row-action-cross-last:before {
      left: 21px;
      width: 1px;
    }

    .rdg-child-row-action-cross:after,
    .rdg-child-row-action-cross-last:after {
      top: 50%;
      left: 20px;
      height: 1px;
      width: 15px;
      content: "";
      position: absolute;
      background: grey;
    }

    .rdg-child-row-action-cross:hover {
      background: red;
    }

    .rdg-child-row-btn {
      position: absolute;
      cursor: pointer;
      border: 1px solid grey;
      border-radius: 14px;
      z-index: 2;
      background: white;
    }

    .rdg-child-row-btn div {
      font-size: 12px;
      text-align: center;
      line-height: 19px;
      color: grey;
      height: 20px;
      width: 20px;
      position: absolute;
      top: 60%;
      left: 53%;
      margin-top: -10px;
      margin-left: -10px;

    }

    .rdg-empty-child-row:hover .glyphicon-plus-sign {
      color: green;
    }

    .rdg-empty-child-row:hover a {
      color: green;
    }

    .rdg-child-row-btn .glyphicon-remove-sign:hover {
      color: red;
    }

    .last-column .cell-tooltip-text {
      right: 100%;
      left: 0% !important;
    }

    .rdg-cell-action {
      float: right;
      height: 100%;
    }

    .rdg-cell-action-last {
      margin-right: -8px;
    }

    .rdg-cell-action-button {
      width: 35px;
      height: 100%;
      text-align: center;
      position: relative;
      display: table;
      color: #4a9de2;
    }

    .rdg-cell-action-button>span {
      display: table-cell;
      vertical-align: middle;
    }

    .rdg-cell-action-button:hover,
    .rdg-cell-action-button-toggled {
      color: #447bbb;
    }

    .rdg-cell-action-menu {
      position: absolute;
      top: 100%;
      z-index: 1000;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      text-align: left;
      list-style: none;
      background-color: #fff;
      -webkit-background-clip: padding-box;
      background-clip: padding-box;
      border: 1px solid #ccc;
      box-shadow: 0 0 3px 0 #ccc;
    }

    .rdg-cell-action-menu>span {
      display: block;
      padding: 3px 10px;
      clear: both;
      font-weight: 400;
      line-height: 1.42857143;
      color: #333;
      white-space: nowrap;
    }

    .rdg-cell-action-menu>span:hover {
      color: #262626;
      text-decoration: none;
      background-color: #f5f5f5;
    }
  </style>
  <style type="text/css">
    .react-grid-Row:hover .react-grid-Cell,
    .react-grid-Row.row-context-menu .react-grid-Cell {
      background-color: #f9f9f9;
    }

    .react-grid-Row:hover .rdg-row-index {
      display: none;
    }

    .react-grid-Row:hover .rdg-actions-checkbox {
      display: block;
    }

    .react-grid-Row:hover .rdg-drag-row-handle {
      cursor: move;
      /* fallback if grab cursor is unsupported */
      cursor: grab;
      cursor: -moz-grab;
      cursor: -webkit-grab;
      width: 12px;
      height: 30px;
      margin-left: 0px;
      background-image: url("data:image/svg+xml;base64, PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjlweCIgaGVpZ2h0PSIyOXB4IiB2aWV3Qm94PSIwIDAgOSAyOSIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDwhLS0gR2VuZXJhdG9yOiBTa2V0Y2ggMzkgKDMxNjY3KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5kcmFnIGljb248L3RpdGxlPgogICAgPGRlc2M+Q3JlYXRlZCB3aXRoIFNrZXRjaC48L2Rlc2M+CiAgICA8ZGVmcz48L2RlZnM+CiAgICA8ZyBpZD0iQWN0dWFsaXNhdGlvbi12MiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgaWQ9IkRlc2t0b3AiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xNS4wMDAwMDAsIC0yNjIuMDAwMDAwKSIgZmlsbD0iI0Q4RDhEOCI+CiAgICAgICAgICAgIDxnIGlkPSJJbnRlcmFjdGlvbnMiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE1LjAwMDAwMCwgMjU4LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9IlJvdy1Db250cm9scyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsIDIuMDAwMDAwKSI+CiAgICAgICAgICAgICAgICAgICAgPGcgaWQ9ImRyYWctaWNvbiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsIDIuMDAwMDAwKSI+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMTIiIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iNyIgY3k9IjEyIiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC0zMCIgY3g9IjIiIGN5PSIxNyIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSI3IiBjeT0iMTciIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iMiIgY3k9IjIyIiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbC0zMCIgY3g9IjciIGN5PSIyMiIgcj0iMiI+PC9jaXJjbGU+CiAgICAgICAgICAgICAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtMzAiIGN4PSIyIiBjeT0iMjciIHI9IjIiPjwvY2lyY2xlPgogICAgICAgICAgICAgICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsLTMwIiBjeD0iNyIgY3k9IjI3IiByPSIyIj48L2NpcmNsZT4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==");
      background-repeat: no-repeat;
    }

    .react-grid-Row.row-selected {
      background-color: #DBECFA;
    }

    .react-grid-Row .row-selected {
      background-color: #DBECFA;
    }

    .react-grid-row-group .row-expand-icon:hover {
      color: #777777;
    }

    .react-grid-row-index {
      padding: 0 18px;
    }

    .rdg-row-index {
      display: block;
      text-align: center;
    }

    .rdg-row-actions-cell {
      padding: 0px;
    }

    .rdg-actions-checkbox {
      display: none;
      text-align: center;
    }

    .rdg-actions-checkbox.selected {
      display: block;
    }

    .rdg-dragging {
      /*cursor: url(http://www.google.com/intl/en_ALL/mapfiles/closedhand.cur);*/
      cursor: -webkit-grabbing;
      cursor: -moz-grabbing;
      cursor: grabbing;
    }

    .rdg-dragged-row {
      border-bottom: 1px solid black
    }

    .rdg-scrolling {
      pointer-events: none;
    }
  </style>
  <style type="text/css">
    .react-grid-Container {
      clear: both;
      margin-top: 0;
      padding: 0;
    }

    .react-grid-Main {
      background-color: #ffffff;
      color: inherit;
      padding: 0px;
      outline: 1px solid #e7eaec;
      clear: both;
    }

    .react-grid-Grid {
      background-color: #ffffff;
      border: 1px solid #dddddd;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .react-grid-Canvas {
      background-color: #ffffff;
    }
  </style>
  <style type="text/css">
    .rdg-selected {
      border: 2px solid #66afe9;
    }

    .rdg-selected .drag-handle {
      pointer-events: auto;
      position: absolute;
      bottom: -5px;
      right: -4px;
      background: #66afe9;
      width: 8px;
      height: 8px;
      border: 1px solid #fff;
      border-right: 0px;
      border-bottom: 0px;
      cursor: crosshair;
      cursor: -moz-grab;
      cursor: -webkit-grab;
      cursor: grab;
    }

    .rdg-selected:hover .drag-handle {
      bottom: -8px;
      right: -7px;
      background: white;
      width: 16px;
      height: 16px;
      border: 1px solid #66afe9;
    }

    .rdg-selected:hover .drag-handle .glyphicon-arrow-down {
      display: 'block'
    }

    .react-grid-cell-dragged-over-up,
    .react-grid-cell-dragged-over-down {
      border: 1px dashed black;
      background: rgba(0, 0, 255, 0.2) !important;
    }

    .react-grid-cell-dragged-over-up {
      border-bottom-width: 0;
    }

    .react-grid-cell-dragged-over-down {
      border-top-width: 0;
    }

    .react-grid-cell-copied {
      background: rgba(0, 0, 255, 0.2) !important;
    }

    .rdg-editor-container input.editor-main,
    select.editor-main {
      display: block;
      width: 100%;
      height: 34px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
      color: #555555;
      background-color: #ffffff;
      background-image: none;
      border: 1px solid #cccccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    input.editor-main:focus,
    select.editor-main:focus {
      border-color: #66afe9;
      border: 2px solid #66afe9;
      background: #eee;
      border-radius: 4px;
    }

    .rdg-editor-container input.editor-main::-moz-placeholder,
    select.editor-main::-moz-placeholder {
      color: #999999;
      opacity: 1;
    }

    .rdg-editor-container input.editor-main:-ms-input-placeholder,
    select.editor-main:-ms-input-placeholder {
      color: #999999;
    }

    .rdg-editor-container input.editor-main::-webkit-input-placeholder,
    select.editor-main::-webkit-input-placeholder {
      color: #999999;
    }

    .rdg-editor-container input.editor-main[disabled],
    select.editor-main[disabled],
    .rdg-editor-container input.editor-main[readonly],
    select.editor-main[readonly],
    fieldset[disabled] .rdg-editor-container input.editor-main,
    fieldset[disabled] select.editor-main {
      cursor: not-allowed;
      background-color: #eeeeee;
      opacity: 1;
    }

    textarea.rdg-editor-container input.editor-main,
    textareaselect.editor-main {
      height: auto;
    }
  </style>
  <style type="text/css">
    .react-grid-checkbox,
    .radio-custom {
      opacity: 0;
      position: absolute;
    }

    .react-grid-checkbox,
    .react-grid-checkbox-label,
    .radio-custom,
    .radio-custom-label {
      display: inline-block;
      vertical-align: middle;
      cursor: pointer;
    }

    .react-grid-checkbox-label,
    .radio-custom-label {
      position: relative;
    }

    .react-grid-checkbox+.react-grid-checkbox-label:before,
    .radio-custom+.radio-custom-label:before {
      content: '';
      background: #fff;
      border: 2px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      width: 20px;
      height: 20px;
      text-align: center;
    }

    .react-grid-checkbox:checked+.react-grid-checkbox-label:before {
      background: #005295;
      box-shadow: inset 0px 0px 0px 4px #fff;
    }

    .react-grid-checkbox:focus+.react-grid-checkbox-label,
    .radio-custom:focus+.radio-custom-label {
      outline: 1px solid #ddd;
      /* focus style */
    }

    .react-grid-HeaderCell input[type='checkbox'] {
      z-index: 99999;
    }

    .react-grid-HeaderCell>.react-grid-checkbox-container {
      padding: 0px 10px;
      height: 100%
    }


    .react-grid-HeaderCell>.react-grid-checkbox-container>.react-grid-checkbox-label {
      margin: 0;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    .radio-custom+.radio-custom-label:before {
      border-radius: 50%;
    }

    .radio-custom:checked+.radio-custom-label:before {
      background: #ccc;
      box-shadow: inset 0px 0px 0px 4px #fff;
    }

    .checkbox-align {
      text-align: center;
    }
  </style>
<body class="bg-light">

    <main role="main" class="container">
        <?= $this->renderSection('main') ?>
    </main>

<?= $this->renderSection('pageScripts') ?>
</body>
</html>
