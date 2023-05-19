document.addEventListener('DOMContentLoaded', function () {
    var userRole = "{{ Auth::user()->role->name }}"; // Ambil peran pengguna dari Laravel

    var sidebar = document.querySelector('.sidebar');
    var requiredRole = sidebar.getAttribute('data-role');

    if (userRole !== requiredRole) {
        sidebar.style.display = 'none';
    }
});
