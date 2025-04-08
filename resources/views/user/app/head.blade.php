<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('User/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl-custom.css') }}">

    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

    <!-- Custom CSS -->
    <style>
        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 300px;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        
        .product-image {
            width: 250px !important;
            height: 250px !important;
            object-fit: contain !important;
            transition: transform 0.5s ease;
        }
        
        .favorite-btn {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .favorite-btn.active .favorite-icon {
            color: #6c757d !important;
            transform: scale(1.2);
        }
        
        .favorite-icon {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .product-item {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-5px);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-item:hover .product-overlay {
            opacity: 1;
        }
    </style>

  </head>