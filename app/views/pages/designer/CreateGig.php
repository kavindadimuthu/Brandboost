<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Gig</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/CreatePackage.css">
</head>
<body>
<?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="container">
        <form action="/DesignerDataController/createGig" method="POST">
            <!-- Common Gig Details -->
            <div class="step active" id="step1">
                <h2>Common Gig Details</h2>
                <label>Gig Title: <input type="text" name="title" required></label>
                <label>Description: <textarea name="description" required></textarea></label>
                <label>Delivery Formats:</label>
                <div>
                    <input type="checkbox" name="delivery_formats[]" value="jpg" id="jpg">
                    <label for="jpg">JPG</label>
                </div>
                <div>
                    <input type="checkbox" name="delivery_formats[]" value="png" id="png">
                    <label for="png">PNG</label>
                </div>
                <div>
                    <input type="checkbox" name="delivery_formats[]" value="mp4" id="mp4">
                    <label for="mp4">MP4</label>
                </div>
                <label>Tags: <input type="text" name="tags" placeholder="Comma-separated tags" required></label>
                <button type="button" id="nextStep1">Next</button>
            </div>

            <!-- Package Details -->
            <div class="step" id="step2">
                <h2>Package Details</h2>
                <div class="package">
                    <h3>Basic Package</h3>
                    <label>Benefits: <textarea name="basic[benefits]" required></textarea></label>
                    <label>Delivery Days: <input type="number" name="basic[delivery_days]" required></label>
                    <label>Revisions: <input type="number" name="basic[revisions]" required></label>
                    <label>Price: <input type="number" name="basic[price]" step="0.01" required></label>
                </div>
                <div class="package">
                    <h3>Premium Package</h3>
                    <label>Benefits: <textarea name="premium[benefits]" required></textarea></label>
                    <label>Delivery Days: <input type="number" name="premium[delivery_days]" required></label>
                    <label>Revisions: <input type="number" name="premium[revisions]" required></label>
                    <label>Price: <input type="number" name="premium[price]" step="0.01" required></label>
                </div>
                <button type="button" id="backStep2">Back</button>
                <button type="submit" id="submitGig">Submit</button>
            </div>
        </form>
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

          showStep(currentStep);
      });

    </script>
</body>
</html>