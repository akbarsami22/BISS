<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information Storage System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Custom styles */
        .navbar-brand {
            font-size: 1.5rem;
        }

        .footer {
            background-color: #000;
            color: #fff;
            padding: 2rem 0;
            text-align: center;
        }

        .footer h5 {
            margin-bottom: 1rem;
        }

        .footer p {
            margin-bottom: 0;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            font-size: 1rem;
            line-height: 1;
        }

        .navbar-nav .nav-link {
            padding-right: 1rem;
            padding-left: 1rem;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-form input {
            width: 200px;
        }

        .search-form button {
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand fw-bold text-white" href="{{ route('books') }}">Book Information Storage System</a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <a class="nav-link text-white fw-semibold" href="{{ route('books') }}">Home</a>
                        <a class="nav-link text-white fw-semibold" href="{{ route('add_book') }}">Add Book</a>
                    @endauth
                </div>

                <div class="navbar-nav ms-auto d-flex align-items-center">
                    @php
                        $routesWithSearch = ['books', 'add_book', 'edit_book'];
                    @endphp

                    @if (in_array(Route::currentRouteName(), $routesWithSearch))
                        <form class="d-flex align-items-center me-3">
                            <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                class="form-control me-2" placeholder="Search here" style="max-width: 200px;">
                            <button class="btn btn-success" type="submit">Search</button>
                            <a class="btn btn-primary ms-2" href="{{ route('books') }}">Reset Search</a>
                        </form>
                    @endif

                    @guest
                        <!-- Links visible to guests -->
                        <a class="btn btn-primary mx-2" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-info mx-2" href="{{ route('register') }}">Register</a>
                    @endguest

                    @auth
                        <a class="btn btn-danger mx-2" href="{{ route('user_logout') }}">Logout</a>
                    @endauth
                </div>
            </div>

        </div>
    </nav>

    <!-- Main content -->
    @yield('section')

    <!-- Footer -->
        <footer class="footer bg-dark text-white py-5">
        <div class="container text-center">
            <h5 class="mb-3">Book Information Storage System</h5>
            <p class="mb-4">Providing comprehensive book information management solutions.</p>
            <p>&copy; <span id="currentYear"></span> All Rights Reserved.</p>
            <div class="mt-4">
                <a href="#" class="text-white me-3" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="text-white me-3" title="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="text-white" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- JavaScript for dynamic year -->
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>

    <!-- Your AJAX scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function deleteBook(id) {
            var url = '{{ route('delete_book', 'ID') }}';
            var newUrl = url.replace("ID", id);

            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: newUrl,
                    type: 'DELETE',
                    data: {},
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.location.href = "{{ route('books') }}";
                        }
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });
        })
    </script>

    @yield('custom_js')
</body>

</html>
