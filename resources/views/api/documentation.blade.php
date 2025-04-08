<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/api.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="api-wrapper">
        <!-- Header -->
        <header class="api-header">
            <div class="container">
                <h1 class="api-title">E-Commerce API Documentation</h1>
                <p class="api-description">Welcome to our API documentation. Here you'll find comprehensive guides and documentation to help you start working with our API as quickly as possible.</p>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <!-- Navigation -->
                <div class="col-md-3">
                    <nav class="api-nav">
                        <h5 class="mb-3">Contents</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#authentication">Authentication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#products">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#orders">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#users">Users</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Content -->
                <div class="col-md-9">
                    <!-- Authentication Section -->
                    <section id="authentication" class="mb-5">
                        <h2>Authentication</h2>
                        <p>All API requests require authentication using a Bearer token. Include the token in the Authorization header of your requests.</p>
                        
                        <div class="auth-section">
                            <h4>Get Access Token</h4>
                            <div class="endpoint">
                                <span class="endpoint-method method-post">POST</span>
                                <span class="endpoint-path">/api/login</span>
                                <p class="endpoint-description">Authenticate user and get access token</p>
                                
                                <h5>Request Body</h5>
                                <div class="response-example">
                                    <pre><code>{
    "email": "user@example.com",
    "password": "password"
}</code></pre>
                                </div>
                                
                                <h5>Response</h5>
                                <div class="response-example">
                                    <pre><code>{
    "access_token": "your-access-token",
    "token_type": "Bearer",
    "expires_in": 3600
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Products Section -->
                    <section id="products" class="mb-5">
                        <h2>Products</h2>
                        
                        <!-- List Products -->
                        <div class="endpoint">
                            <span class="endpoint-method method-get">GET</span>
                            <span class="endpoint-path">/api/products</span>
                            <p class="endpoint-description">Get a list of all products</p>
                            
                            <h5>Response</h5>
                            <div class="response-example">
                                <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "Product Name",
            "price": 99.99,
            "description": "Product description",
            "image": "product-image.jpg",
            "quantity": 10
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "total": 100
    }
}</code></pre>
                            </div>
                        </div>

                        <!-- Get Single Product -->
                        <div class="endpoint">
                            <span class="endpoint-method method-get">GET</span>
                            <span class="endpoint-path">/api/products/{id}</span>
                            <p class="endpoint-description">Get details of a specific product</p>
                            
                            <h5>Response</h5>
                            <div class="response-example">
                                <pre><code>{
    "data": {
        "id": 1,
        "name": "Product Name",
        "price": 99.99,
        "description": "Product description",
        "image": "product-image.jpg",
        "quantity": 10
    }
}</code></pre>
                            </div>
                        </div>
                    </section>

                    <!-- Orders Section -->
                    <section id="orders" class="mb-5">
                        <h2>Orders</h2>
                        
                        <!-- Create Order -->
                        <div class="endpoint">
                            <span class="endpoint-method method-post">POST</span>
                            <span class="endpoint-path">/api/orders</span>
                            <p class="endpoint-description">Create a new order</p>
                            
                            <h5>Request Body</h5>
                            <div class="response-example">
                                <pre><code>{
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        }
    ],
    "shipping_address": {
        "street": "123 Main St",
        "city": "New York",
        "state": "NY",
        "zip": "10001",
        "country": "USA"
    }
}</code></pre>
                            </div>
                            
                            <h5>Response</h5>
                            <div class="response-example">
                                <pre><code>{
    "data": {
        "id": 1,
        "user_id": 1,
        "total_amount": 199.98,
        "status": "pending",
        "created_at": "2024-02-24T12:00:00Z"
    }
}</code></pre>
                            </div>
                        </div>
                    </section>

                    <!-- Users Section -->
                    <section id="users" class="mb-5">
                        <h2>Users</h2>
                        
                        <!-- Register User -->
                        <div class="endpoint">
                            <span class="endpoint-method method-post">POST</span>
                            <span class="endpoint-path">/api/register</span>
                            <p class="endpoint-description">Register a new user</p>
                            
                            <h5>Request Body</h5>
                            <div class="response-example">
                                <pre><code>{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}</code></pre>
                            </div>
                            
                            <h5>Response</h5>
                            <div class="response-example">
                                <pre><code>{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-02-24T12:00:00Z"
    }
}</code></pre>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 