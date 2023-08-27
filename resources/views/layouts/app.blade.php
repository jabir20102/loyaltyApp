<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loyalty App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #samples-table_length select{
            /*     style   for show entries field */
            width: 100px;
        }
    </style>
    <!-- Include the custom styles section -->
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
    <div class="container">

        @include('layouts.navbar')

        @include('layouts.flashMessages')

        @yield('content')
    </div>

    {{-- //    for date formatting in tables --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>



</body>

</html>
