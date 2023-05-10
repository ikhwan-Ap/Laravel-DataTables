<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

    <!-- General CSS Files -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="icon" href="{{ url('css/favicon.jpeg') }}">

          
    
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />

    <!-- CSS Libraries -->
    <link
      rel="stylesheet"
      href="{{asset('')}}/node_modules/bootstrap-social/bootstrap-social.css"
    />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('')}}css/style.css">
    <link rel="stylesheet" href="{{asset('')}}css/components.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

  </head>
  <style>
    .toast-info {
      background-color: #2F96B4 !important;
    }
  
    .toast-error {
      background-color: #BD362F !important
    }
  
    .toast-warning {
      background-color: #F89406 !important
    }
  
    .toast-success {
      background-color: #51A351 !important
    }
    #toast-container > .toast:before {
        position: fixed;
        font-family: FontAwesome;
        font-size: 24px;
        line-height: 18px;
        float: left;
        color: #FFF;
        padding-right: 0.5em;
        margin: auto 0.5em auto -1.5em;
    }        
    #toast-container > .toast-warning:before {
        content: "\f003";
    }
    #toast-container > .toast-error:before {
        content: "\f001";
    }
    #toast-container > .toast-info:before {
        content: "\f005";
    }
    #toast-container > .toast-success:before {
        content: "\f002";
    }

  </style>