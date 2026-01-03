document.addEventListener("DOMContentLoaded", () => {
  const resultContainer = document.getElementById("result");

  const html5QrCode = new Html5Qrcode("reader");

  const config = { fps: 10, qrbox: { width: 250, height: 250 } };

  function onScanSuccess(decodedText) {
    resultContainer.innerHTML = `
      <div class="alert alert-success mt-3" style="max-width:300px;">
        <strong>✅ QR Code Terdeteksi!</strong><br>${decodedText}
      </div>
    `;
    html5QrCode.stop(); // stop kamera setelah berhasil scan
    if (decodedText.startsWith("http")) {
      setTimeout(() => (window.location.href = decodedText), 1500);
    }
  }

  Html5Qrcode.getCameras()
    .then((devices) => {
      if (devices && devices.length) {
        const backCam =
          devices.find((d) => d.label.toLowerCase().includes("back"))?.id ||
          devices[0].id;
        html5QrCode.start(backCam, config, onScanSuccess);
      }
    })
    .catch((err) => {
      console.error("Tidak dapat membuka kamera:", err);
      alert("Gagal mengakses kamera. Pastikan izin sudah diberikan.");
    });
});
