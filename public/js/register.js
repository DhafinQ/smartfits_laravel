document.getElementById("tipe_aktivitas").addEventListener("change", function() {
    var selectedValue = this.value;
    var paragraph1 = document.getElementById("text_aktivitas1");
    var paragraph2 = document.getElementById("text_aktivitas2");
    var paragraph3 = document.getElementById("text_aktivitas3");
  
    paragraph1.style.display = "none";
    paragraph2.style.display = "none";
    paragraph3.style.display = "none";

    if (selectedValue === "Sedikit Aktif") {
        paragraph1.style.display = "block";
    } if (selectedValue === "Aktif") {
      paragraph2.style.display = "block";
    } if (selectedValue === "Sangat Aktif") {
        paragraph3.style.display = "block";
    }
  });