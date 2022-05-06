<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">

        <title>Nihongo Trainer</title>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Klee+One:wght@400;600&display=swap');
        </style>

        <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">-->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet">  -->

        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400&display=swap" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Open+Sans:700&display=swap" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Open+Sans:700i,&display=swap" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Open+Sans:800&display=swap" rel="stylesheet"> -->

        <!-- Styles -->
        <link href="assets/styles.min.css" rel="stylesheet">
        <script src="assets/scripts.min.js"></script>

    </head>
    <body class="">

      @include('nav')

      @yield('content')





     </body>
</html>
