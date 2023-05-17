<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{$title}} &mdash; Laravel DataTables </title>
  <link rel="icon" href="{{ url('css/favicon.jpeg') }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="{{asset('')}}node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="{{asset('')}}node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="{{asset('')}}node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{asset('')}}node_modules/ionicons201/css/ionicons.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('')}}css/style.css">
  <link rel="stylesheet" href="{{asset('')}}css/components.css">
  <link rel="stylesheet" href="{{asset('')}}node_modules/cropperjs/dist/cropper.css">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
   --}}
  <link
   rel="stylesheet"
   href="{{asset('')}}node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css"/>
  <link
   rel="stylesheet"
   href="{{asset('')}}node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css" />

</head>