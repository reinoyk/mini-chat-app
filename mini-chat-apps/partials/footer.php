<script>
if (localStorage.getItem("theme") === "dark") {
    document.documentElement.classList.add("dark");
}
document.getElementById("toggle-theme").onclick = function() {
    if(document.documentElement.classList.contains("dark")){
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme","light");
    }else{
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme","dark");
    }
};
</script>

</body>
</html>
