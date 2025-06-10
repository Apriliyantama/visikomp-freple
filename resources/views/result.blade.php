<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hasil Deteksi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/result.css') }}">
</head>
<body>
  <div class="container">
    <div class="header">Hasil Deteksi</div>
    <div class="content">
      <div class="image-section">
        <img id="uploadedImage" src="{{ asset('storage/' . $image) }}" alt="Upload Image"/>
      </div>
      <div class="info-section">
        <p><strong>Prediksi</strong><br/><span id="label" class="label">-</span></p>
        <p><strong>Kepercayaan</strong><br/><span id="confidence" class="confidence">-</span></p>
        <div class="bar">
          <div id="confidenceBar" class="bar-fill"></div>
        </div>
        <p><strong>Deskripsi :</strong><br/>
          <span id="description">
            Menampilkan informasi tingkat kematangan buah berdasarkan model deteksi. Hasil ini membantu Anda menentukan kualitas buah secara visual dan cepat.
          </span>
        </p>
      </div>
    </div>
  </div>

  <!-- TensorFlow.js -->
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0/dist/tf.min.js"></script>
  <script>
    async function loadModelAndPredict() {
      const modelUrl = '/model/model.json';
      const labels = ['Busuk', 'Matang', 'Mentah'];
  
      // Deskripsi unik untuk setiap label
      const descriptions = {
        Busuk: "Buah dalam kondisi tidak layak konsumsi. Warna dan tekstur menunjukkan kerusakan yang signifikan.",
        Matang: "Buah berada pada tingkat kematangan optimal dan siap untuk dikonsumsi. Warna cerah dan tekstur sempurna.",
        Mentah: "Buah belum matang sepenuhnya. Disarankan untuk menyimpan lebih lama sebelum dikonsumsi."
      };
  
      try {
        const model = await tf.loadGraphModel(modelUrl);
        const img = document.getElementById('uploadedImage');
        await new Promise(resolve => {
          if (img.complete) resolve();
          else img.onload = () => resolve();
        });
  
        const tensor = tf.browser.fromPixels(img)
          .resizeNearestNeighbor([150, 150])
          .toFloat()
          .div(255.0)
          .expandDims();
  
        const prediction = await model.predict(tensor).data();
        const maxIndex = prediction.indexOf(Math.max(...prediction));
        const confidence = prediction[maxIndex];
        const percentage = (confidence * 100).toFixed(2);
  
        const label = labels[maxIndex];
        document.getElementById('label').textContent = label;
        document.getElementById('confidence').textContent = `${percentage} %`;
        document.getElementById('confidenceBar').style.width = `${percentage}%`;
  
        // Warna label
        const labelEl = document.getElementById('label');
        if (label === 'Matang') labelEl.style.color = 'green';
        else if (label === 'Mentah') labelEl.style.color = 'orange';
        else if (label === 'Busuk') labelEl.style.color = 'red';
  
        // Set deskripsi berdasarkan label
        document.getElementById('description').textContent = descriptions[label];
  
      } catch (error) {
        console.error("❌ Gagal melakukan prediksi:", error);
        document.getElementById('label').textContent = "Terjadi kesalahan";
        document.getElementById('confidence').textContent = "-";
        document.getElementById('description').textContent = "Tidak dapat menampilkan deskripsi karena terjadi kesalahan.";
      }
    }
  
    window.addEventListener('DOMContentLoaded', loadModelAndPredict);
  </script> 
</body>
</html>
