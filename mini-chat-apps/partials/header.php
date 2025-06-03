<!DOCTYPE html>
<html>
<head>
    <title>Mini Chat App</title>
    <link rel="stylesheet" href="../public/assets/style.css">
</head>
<script>
if (localStorage.getItem("theme") === "dark") {
    document.documentElement.classList.add("dark");
}
</script>

<body>
    <button id="toggle-theme" class="theme-toggle-btn" style="position:fixed;top:18px;left:30px;z-index:10;" aria-label="Toggle Theme">
        <!-- Ikon bulan warna biru -->
        <svg width="26" height="26" viewBox="0 0 24 24" fill="#2673e4" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 12.79A9 9 0 0111.21 3a7 7 0 108.05 8.05A8.92 8.92 0 0121 12.79z"/>
        </svg>
    </button>


