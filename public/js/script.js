$(function () {
  // Mendapatkan URL saat ini
  var currentURL = window.location.href;

  // Mendapatkan semua elemen <a> di dalam navbar
  var navLinks = document.querySelectorAll(".navbar-nav .nav-link");

  // Meloop melalui setiap elemen <a>
  navLinks.forEach(function (link) {
    // Memeriksa jika URL elemen <a> sesuai dengan URL saat ini
    if (link.href === currentURL) {
      // Menghapus kelas "active" dari elemen <li> sebelumnya
      var previousActiveLi = document.querySelector(".navbar-nav .active");
      if (previousActiveLi) {
        previousActiveLi.classList.remove("active");
      }

      // Menambahkan kelas "active" pada elemen <li> yang merupakan elemen induk dari elemen <a>
      var liElement = link.parentNode;
      liElement.classList.add("active");
    } 
  });

  if ($("#tableKeeping").length) {
    $("#tableKeeping").DataTable({
      searching: true,
      order: [[1, "DESC"]],
      paging: true,
      ordering: true,
      responsive: true,
      select: true,
    });
  }
});


