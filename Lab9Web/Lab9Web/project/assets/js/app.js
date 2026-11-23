// Hilangkan pesan flash secara otomatis setelah 4 detik
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert').forEach(function (el) {
        setTimeout(function () { el.style.display = 'none'; }, 4000);
    });
});
