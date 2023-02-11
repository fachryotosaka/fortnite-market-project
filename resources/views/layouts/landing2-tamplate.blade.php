<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>

    <link rel="stylesheet" href="{{ asset('book/style.css') }}">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />


    @vite('resources/css/app.css')
</head>
<body>

    @include('layouts.landing-navbar')
    @yield('detail')
    @include('layouts.landing2-footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

     $('.show_alert').click(function(event) {
          var form =  $(this).closest("form");
          event.preventDefault();
          Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#FF006B',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, rent it!'
        }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Your Rent Has Been Success',
            showConfirmButton: false,
            timer: 1500,

        })
        form.submit();
        }})
      });

</script>
</body>
</html>

