document.getElementById("generate-button").addEventListener("click", function() {
    const inputText = document.getElementById("input-text").value;

    if (inputText.trim().length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("generated-title").textContent = this.responseText;
            }
        };
        xhr.open("POST", "generate-title.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("input_text=" + encodeURIComponent(inputText));
    } else {
        document.getElementById("generated-title").textContent = "";
    }
});
