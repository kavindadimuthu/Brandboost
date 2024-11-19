<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/influencer/header.css">
    <link rel="stylesheet" href="../../styles/influencer/CreatePackage.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/influencer/header.php'; ?>

    <div class="container">
    <!-- Step 1: Select Service Type -->
    <div class="step active" id="step1">
      <h2>Select Service Type</h2>
      <label>
        <input type="radio" name="serviceType" value="promotionOnly" required> Promotion Only
      </label>
      <label>
        <input type="radio" name="serviceType" value="promotionDesign" required> Both Promotion and Design
      </label>
      <button id="nextStep1">Next</button>
    </div>

    <!-- Step 2: Add Packages -->
    <div class="step" id="step2">
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
      <button id="backStep2">Back</button>
      <button id="nextStep2">Next</button>
    </div>

    <!-- Step 3: Add Details -->
    <div class="step" id="step3">
      <h2>Finalize Package</h2>
      <label>Package Topic: <input type="text" name="packageTopic" required></label>
      <label>Description: <textarea name="packageDescription" required></textarea></label>
      
    <div style="padding:30px 0;">
        <label>Platform:</label>
        <div>
        <input type="checkbox" name="platform" value="facebook" id="facebook">
        <label for="facebook">Facebook</label>
        </div>
        <div>
        <input type="checkbox" name="platform" value="instagram" id="instagram">
        <label for="instagram">Instagram</label>
        </div>
        <div>
        <input type="checkbox" name="platform" value="tiktok" id="tiktok">
        <label for="tiktok">TikTok</label>
        </div>
    </div>
      <label>Upload Files: <input type="file" name="sampleFiles" multiple accept=".png,.jpg"></label>
      <button id="backStep3">Back</button>
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

  const updateDaysFields = (type) => {
    const basicContainer = document.getElementById("basicDaysContainer");
    const standardContainer = document.getElementById("standardDaysContainer");
    const premiumContainer = document.getElementById("premiumDaysContainer");

    if (type === "promotionDesign") {
      basicContainer.innerHTML = `
        <label>Design Days: <input type="number" name="basicDesignDays" required></label>
        <label>Promotion Days: <input type="number" name="basicPromotionDays" required></label>
      `;
      standardContainer.innerHTML = `
        <label>Design Days: <input type="number" name="standardDesignDays"></label>
        <label>Promotion Days: <input type="number" name="standardPromotionDays"></label>
      `;
      premiumContainer.innerHTML = `
        <label>Design Days: <input type="number" name="premiumDesignDays"></label>
        <label>Promotion Days: <input type="number" name="premiumPromotionDays"></label>
      `;
    } else {
      basicContainer.innerHTML = `<input type="number" name="basicDays" required>`;
      standardContainer.innerHTML = `<input type="number" name="standardDays" required>`;
      premiumContainer.innerHTML = `<input type="number" name="premiumDays" required>`;
    }
  };

  document.querySelectorAll('input[name="serviceType"]').forEach((input) => {
    input.addEventListener("change", (e) => {
      updateDaysFields(e.target.value);
    });
  });

  document.getElementById("nextStep1").addEventListener("click", () => {
    currentStep++;
    showStep(currentStep);
  });

  document.getElementById("backStep2").addEventListener("click", () => {
    currentStep--;
    showStep(currentStep);
  });

  document.getElementById("nextStep2").addEventListener("click", () => {
    currentStep++;
    showStep(currentStep);
  });

  document.getElementById("backStep3").addEventListener("click", () => {
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
</body>
</body>
</html>