<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../styles/common/header.css">
  <link rel="stylesheet" href="../../styles/influencer/CreatePackage.css">
</head>

<body>
  <?php include __DIR__ . '/../../components/common/header.php'; ?>

  <div class="container">
    <!-- Step 1: Add Packages -->
    <div class="step active" id="step1">
      <h2>Add Packages</h2>
      <div class="package">
        <h3>Basic Package</h3>
        <label>Description: <input type="text" name="basicDescription" required></label>
        <label>
          <span id="basicDaysContainer">
            <input type="number" name="basicDays" required>
          </span>
        </label>
        <label>Price: <input type="number" name="basicPrice" required></label>
      </div>
      <div class="package">
        <h3>Standard Package</h3>
        <label>Description: <input type="text" name="standardDescription" required></label>
        <label>
          <span id="standardDaysContainer">
            <input type="number" name="standardDays" required>
          </span>
        </label>
        <label>Price: <input type="number" name="standardPrice" required></label>
      </div>
      <div class="package">
        <h3>Premium Package</h3>
        <label>Description: <input type="text" name="premiumDescription" required></label>
        <label>
          <span id="premiumDaysContainer">
            <input type="number" name="premiumDays" required>
          </span>
        </label>
        <label>Price: <input type="number" name="premiumPrice" required></label>
      </div>
      <button id="nextStep1">Next</button>
    </div>

    <!-- Step 2: Finalize Package -->
    <div class="step" id="step2">
      <h2>Finalize Package</h2>
      <label>Package Topic: <input type="text" name="packageTopic" required></label>
      <label>Description: <textarea name="packageDescription" required></textarea></label>

      <div style="padding:30px 0;">
        <label>Delivery Formats:</label>
        <div>
          <input type="checkbox" name="delivery_formats" value="jpg" id="jpg">
          <label for="jpg">JPG</label>
        </div>
        <div>
          <input type="checkbox" name="delivery_formats" value="png" id="png">
          <label for="png">PNG</label>
        </div>
        <div>
          <input type="checkbox" name="delivery_formats" value="mp4" id="mp4">
          <label for="mp4">MP4</label>
        </div>
        <div>
          <input type="checkbox" name="delivery_formats" value="psd" id="psd">
          <label for="psd">PSD</label>
        </div>
      </div>
      <label>Upload Files: <input type="file" name="sampleFiles" multiple accept=".png,.jpg"></label>
      <button id="backStep2">Back</button>
      <button type="submit" id="submitPackage">Submit</button>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      let currentStep = 1;

      const steps = document.querySelectorAll(".step");
      const showStep = (step) => {
        steps.forEach((el, index) => {
          el.classList.toggle("active", index + 1 === step);
        });
      };

      document.getElementById("nextStep1").addEventListener("click", () => {
        currentStep++;
        showStep(currentStep);
      });

      document.getElementById("backStep2").addEventListener("click", () => {
        currentStep--;
        showStep(currentStep);
      });

      document.getElementById("submitPackage").addEventListener("click", (e) => {
        e.preventDefault();

        const formData = new FormData(document.querySelector("form"));
        const data = Object.fromEntries(formData.entries());

        console.log(data);

        alert("Package submitted successfully!");
      });

      showStep(currentStep);
    });

  </script>
  <script src="../scripts/common/header.js"></script>
</body>

</html>