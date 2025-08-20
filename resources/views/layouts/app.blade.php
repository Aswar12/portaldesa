
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Authentication - Website {{ $nm_desa }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $logo->logo) }}" />
  <link rel="stylesheet" href="admin/assets/css/styles.min.css" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">

              @yield('auth')
    
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    // Setup CSRF token for ajax requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Refresh CSRF token before form submission
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            // Refresh CSRF token before submitting
            fetch('/csrf-token')
                .then(response => response.json())
                .then(data => {
                    $('#csrf-token-input').val(data.token);
                    $('meta[name="csrf-token"]').attr('content', data.token);
                })
                .catch(error => {
                    console.log('CSRF refresh error:', error);
                })
                .finally(() => {
                    // Submit the form after token refresh (or error)
                    if (!$(this).data('submitted')) {
                        $(this).data('submitted', true);
                        this.submit();
                    }
                });
            
            // Prevent default submission on first attempt
            if (!$(this).data('submitted')) {
                e.preventDefault();
            }
        });
    });
  </script>
</body>

</html>