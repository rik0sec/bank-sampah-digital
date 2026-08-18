</div><!-- /.main-content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark ? '1' : '0');
    document.getElementById('darkModeToggle').innerHTML = isDark ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
}
if (localStorage.getItem('darkMode') === '1') {
    document.body.classList.add('dark-mode');
    document.getElementById('darkModeToggle').innerHTML = '<i class="bi bi-sun"></i>';
}
function confirmDelete(url) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = url;
    }
}
</script>
</body>
</html>