document.getElementById("role").addEventListener("change", function() {
    var selectedValue = this.value;
    var paragraph1 = document.getElementById("clientProfile");
  
    paragraph1.style.display = "none";

    if (selectedValue === "client") {
        paragraph1.style.display = "block";
    }
  });