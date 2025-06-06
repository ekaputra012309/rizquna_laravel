<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $data['pageTitle'] ?? 'Dashboard - KitaCodinginAja' }}</title>

    <link rel="shortcut icon" href={{ asset('./assets/compiled/png/favicon.png') }} type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href={{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}>
    <link rel="stylesheet" href={{ asset('./assets/compiled/css/table-datatable-jquery.css') }}>
    <link rel="stylesheet" href={{ asset('./assets/compiled/css/app.css') }} />
    <link rel="stylesheet" href={{ asset('./assets/compiled/css/app-dark.css') }} />
    <link rel="stylesheet" href={{ asset('./assets/compiled/css/iconly.css') }} />

    <script src={{ asset('assets/extensions/jquery/jquery.min.js') }}></script>
    <script src={{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}></script>
    <script src={{ asset('assets/static/js/pages/datatables.js') }}></script>

    {{-- datatable button export --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    {{-- end datatable button export --}}

    <script>
        $(document).ready(function() {
            // Check session status every 60 seconds (adjust as needed)
            setInterval(function() {
                // Make an AJAX request to a route that checks session status
                $.ajax({
                    url: '/check-session',
                    method: 'GET',
                    success: function(response) {
                        // If session is expired, redirect to login page
                        if (response.sessionExpired) {
                            window.location.href = '/';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error checking session status:', error);
                    }
                });
            }, 1800000); // 1800 seconds or 1 hours
        });
    </script>

    <style>
        .header-profile {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <script src={{ asset('assets/static/js/initTheme.js') }}></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ route('p.dash') }}"><img src={{ asset('./assets/compiled/png/logo3.png') }}
                                    alt="Logo" style="height: 50px" /> </a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                {{-- @include('layouts.sidebar.superadmin') --}}
                <div id="superadmin-sidebar">
                    @include('layouts.sidebar.superadmin')
                </div>
                <div id="admin-sidebar">
                    @include('layouts.sidebar.admin')
                </div>
                <div id="visa-sidebar">
                    @include('layouts.sidebar.visa')
                </div>
                <div id="marketing-sidebar">
                    @include('layouts.sidebar.marketing')
                </div>
                <div id="finance-sidebar">
                    @include('layouts.sidebar.finance')
                </div>
                <div id="cabang-sidebar">
                    @include('layouts.sidebar.cabang')
                </div>
                <div id="guest-sidebar">
                    @include('layouts.sidebar.guest')
                </div>


            </div>
        </div>
        <div id="main">
            <header class="mb-3 d-flex justify-content-end">
                <div class="dropdown">
                    <a href="#" role="button" id="profileDropdownTrigger" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span id="emailUser">PT Rizquna</span> <img src={{ asset('./assets/compiled/png/logo.png') }}
                            alt="Profile Picture" class="profile-picture">
                        <input type="hidden" id="id_user">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdownTrigger">
                        <li>
                            <a class="dropdown-item" href="#" id="changePasswordTrigger">
                                <i class="bi bi-shield-lock"></i> Change Password
                            </a>
                        </li>
                        <li><a class="dropdown-item" id="logoutButton" href="#"><i
                                    class="bi bi-box-arrow-right"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- for content --}}
            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; KitaCodinginAja</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi - Mazer</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
        {{-- modal notif --}}
        <div id="myModalNotif" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>This is the modal body content.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal notif --}}

        {{-- modal change password --}}
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="changePasswordForm">
                        <div class="modal-body">
                            <!-- Add input fields for the new password and confirm password -->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <!-- Add toggle for password visibility -->
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label class="form-check-label" for="showPassword">Show Password</label>
                            </div>
                            <!-- Add any other necessary fields -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal change password --}}
    </div>
    <script src={{ asset('assets/static/js/components/dark.js') }}></script>
    <script src={{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}></script>

    <script src={{ asset('assets/compiled/js/app.js') }}></script>
    <script src={{ asset('assets/compiled/js/tokenExpired.js') }}></script>

    <!-- Need: Apexcharts -->
    {{-- <script src={{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}></script> --}}
    <script src={{ asset('assets/static/js/pages/dashboard.js') }}></script>


    <script src={{ asset('assets/extensions/parsleyjs/parsley.min.js') }}></script>
    <script src={{ asset('assets/static/js/pages/parsley.js') }}></script>

    <!-- Include FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script>
        $(document).ready(function() {
            var jwtToken = localStorage.getItem('jwtToken');
            checkTokenExpiration();
            getUser();

            function getUser() {

                $.ajax({
                    url: "{{ route('userProfile') }}",
                    type: "GET",
                    headers: {
                        // Include authorization header with JWT token
                        'Authorization': 'Bearer ' + jwtToken
                    },
                    success: function(response) {
                        $('#emailUser').html(response.name);
                        $('#user_id').val(response.id);
                        $('#user_id_d').val(response.id);
                        $('#id_user').val(response.id);
                        var role = response.privilage[0].role_id;
                        getRole(role);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            }

            function getRole($id) {

                $.ajax({
                    url: "{{ route('role') }}/" + $id,
                    type: "GET",
                    headers: {
                        // Include authorization header with JWT token
                        'Authorization': 'Bearer ' + jwtToken
                    },
                    success: function(response) {
                        $('#superadmin-sidebar').hide();
                        $('#admin-sidebar').hide();
                        $('#visa-sidebar').hide();
                        $('#marketing-sidebar').hide();
                        $('#finance-sidebar').hide();
                        $('#cabang-sidebar').hide();
                        $('#guest-sidebar').hide();

                        // Show the appropriate sidebar based on response.kode_role
                        if (response.kode_role === 'superadmin') {
                            $('#superadmin-sidebar').show();
                        } else if (response.kode_role === 'admin') {
                            $('#admin-sidebar').show();
                        } else if (response.kode_role === 'visa') {
                            $('#visa-sidebar').show();
                        } else if (response.kode_role === 'marketing') {
                            $('#marketing-sidebar').show();
                        } else if (response.kode_role === 'finance') {
                            $('#finance-sidebar').show();
                        } else if (response.kode_role === 'cabang') {
                            $('#cabang-sidebar').show();
                        } else {
                            $('#guest-sidebar').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            }
            // logout button
            $('#logoutButton').click(function() {
                // Retrieve JWT token from localStorage


                // Check if JWT token exists
                if (jwtToken) {
                    $.ajax({
                        url: "{{ route('logout') }}", // Assuming your logout endpoint is at /api/logout
                        type: "POST", // Logout typically involves sending a POST request
                        headers: {
                            // Include authorization header with JWT token
                            'Authorization': 'Bearer ' + jwtToken
                        },
                        success: function(response) {
                            // Handle successful logout
                            localStorage.removeItem('jwtToken');
                            window.location.href =
                                "{{ url('/') }}"; // Redirect to login page
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(error);
                        }
                    });
                } else {
                    // Handle case where JWT token is not found in localStorage
                    console.error('JWT token not found in localStorage.');
                }
            });

            $("#changePasswordTrigger").click(function() {
                $("#changePasswordModal").modal("show");
            });

            // Toggle password visibility
            $("#showPassword").change(function() {
                var newPasswordInput = $("#password");
                var confirmPasswordInput = $("#confirmPassword");
                if ($(this).is(":checked")) {
                    newPasswordInput.attr("type", "text");
                    confirmPasswordInput.attr("type", "text");
                } else {
                    newPasswordInput.attr("type", "password");
                    confirmPasswordInput.attr("type", "password");
                }
            });

            // Form submission
            $("#changePasswordForm").submit(function(event) {
                var userId = $('#id_user').val();
                event.preventDefault();
                var newPassword = $("#password").val();
                var confirmPassword = $("#confirmPassword").val();

                // Ensure both passwords match
                if (newPassword !== confirmPassword) {
                    alert("Passwords do not match.");
                    return;
                }

                // Your AJAX submission code here
                $.ajax({
                    url: "{{ route('user.change', ['id' => ':id']) }}"
                        .replace(':id', userId),
                    type: "POST",
                    headers: {
                        // Include authorization header with JWT token
                        'Authorization': 'Bearer ' + jwtToken
                    },
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Password changed successfully.");
                        $("#changePasswordModal").modal("hide");
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while changing the password.");
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>
