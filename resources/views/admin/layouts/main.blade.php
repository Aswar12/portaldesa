
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Admin - Website Portal Desa Kragilan</title>
  <link rel="shortcut icon" type="image/png" href="/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="/admin/assets/css/styles.min.css" />

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Datatable CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap Icon-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <!-- Ck Editor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

  <!-- Appex -->
  <script src="/admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
      @include('admin.partials.header')
        <div class="container-fluid">
        @yield('content')
      @include('admin.partials.footer')
      </div>
    </div>
  </div>
  <script src="/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="/admin/assets/js/sidebarmenu.js"></script>
  <script src="/admin/assets/js/app.min.js"></script>
  <script src="/admin/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="/admin/assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @include('sweetalert::alert')
  <script>
    // Setup CSRF token global
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Global CSRF and session handler
    $(document).ready(function() {
        // Handle 419 errors globally
        $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
            if (jqxhr.status === 419) {
                Swal.fire({
                    title: 'Session Expired',
                    text: 'Your session has expired. Please refresh the page.',
                    icon: 'warning',
                    confirmButtonText: 'Refresh Page'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        });

        // Refresh CSRF token every 30 minutes
        setInterval(function() {
            fetch('/csrf-token')
                .then(response => response.json())
                .then(data => {
                    $('meta[name="csrf-token"]').attr('content', data.token);
                    $('input[name="_token"]').val(data.token);
                })
                .catch(error => {
                    console.log('CSRF refresh error:', error);
                });
        }, 1800000); // 30 minutes
    });

		$(".swal-confirm").click(function(e) {
			e.preventDefault();
			var form = $(this).attr('data-form');
			Swal.fire({
				title: 'Hapus Data Ini ?',
				text: "Anda tidak akan dapat mengembalikan data yang dihapus !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#' + form).submit();
				}
			})
		});
	</script>
</body>

</html>