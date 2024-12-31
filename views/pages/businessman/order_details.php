<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Document
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100 text-gray-800">
  <div class="container mx-auto p-4">
   <div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex flex-col lg:flex-row gap-6">
     <!-- Chat Section -->
     <div class="flex-1 bg-gray-50 p-4 rounded-lg shadow-md">
      <div class="flex items-center justify-between border-b pb-2 mb-4">
       <div class="flex items-center gap-3">
        <img alt="User avatar" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/tvVS3EK0kC7GFRT3AeucwmFew2yZr4G8rmf8W2n2PKMS2WfPB.jpg" width="40"/>
        <span class="text-lg font-semibold">
         Kavindya
        </span>
       </div>
      </div>
      <div class="flex flex-col gap-3 overflow-y-auto h-64 p-2 border rounded-lg bg-white">
       <div class="self-end bg-blue-100 text-blue-800 p-2 rounded-lg max-w-xs">
        Hello
       </div>
       <div class="self-start bg-green-100 text-green-800 p-2 rounded-lg max-w-xs">
        Hi
       </div>
       <div class="self-end bg-blue-100 text-blue-800 p-2 rounded-lg max-w-xs">
        I need to do a promotion
       </div>
       <div class="self-start bg-green-100 text-green-800 p-2 rounded-lg max-w-xs">
        Tell me more details
       </div>
       <div class="self-end bg-blue-100 text-blue-800 p-2 rounded-lg max-w-xs">
        ok
       </div>
      </div>
      <div class="flex gap-3 mt-4">
       <textarea class="flex-1 p-2 border rounded-lg resize-none" id="messageInput" placeholder="Type a message..."></textarea>
       <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700" id="sendMessage">
        Send
       </button>
      </div>
     </div>
     <!-- Order Section -->
     <div class="flex-1 bg-gray-50 p-4 rounded-lg shadow-md">
      <div class="mb-4">
       <h4 class="text-lg font-semibold mb-2">
        Time Left To Delivery
       </h4>
       <div class="text-red-600 font-bold" id="countdown">
       </div>
       <button class="mt-2 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700" id="deliverNow" onclick="openPopup()">
        Request Revision
       </button>
      </div>
      <div class="mb-4">
       <h4 class="text-lg font-semibold mb-2">
        Order Details
       </h4>
       <p>
        <strong>
         Ordered By:
        </strong>
        <span id="orderedBy">
         Me
        </span>
       </p>
       <p>
        <strong>
         Date:
        </strong>
        <span id="orderDate">
         Nov 27, 2024, 8:50 AM
        </span>
       </p>
       <p>
        <strong>
         Due:
        </strong>
        <span id="orderDue">
         Dec 8, 2024, 8:50 AM
        </span>
       </p>
      </div>
      <div>
       <h4 class="text-lg font-semibold mb-2">
        Support
       </h4>
       <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 mb-2" id="contactSupport" onclick="window.location.href='/BusinessViewController/makeComplaint'">
        Complaint
       </button>
       <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700" id="reviewButton" onclick="openReviewPopup()">
        Review
       </button>
      </div>
     </div>
    </div>
    <!-- Deliveries Section -->
    <div class="mt-6">
     <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold">
       Deliveries
      </h2>
     </div>
     <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
      <thead>
       <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
        <th class="py-3 px-6 text-left">
         Order
        </th>
        <th class="py-3 px-6 text-left">
         Influencer/Designer
        </th>
        <th class="py-3 px-6 text-left">
         Revision Count
        </th>
        <th class="py-3 px-6 text-left">
         File
        </th>
        <th class="py-3 px-6 text-left">
         Status
        </th>
       </tr>
      </thead>
      <tbody class="text-gray-600 text-sm font-light" id="ordersTableBody">
       <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-6 text-left">
         Promotional Video
        </td>
        <td class="py-3 px-6 text-left">
         Kavindya Adhikari
        </td>
        <td class="py-3 px-6 text-left">
         2
        </td>
        <td class="py-3 px-6 text-left">
         video2.mp4
         <button class="ml-2 bg-blue-600 text-white px-2 py-1 rounded-lg hover:bg-blue-700" onclick="downloadFile('video2.mp4')">
          Download
         </button>
        </td>
        <td class="py-3 px-6 text-left">
         <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">
          Accepted
         </span>
        </td>
       </tr>
       <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-6 text-left">
         Promotional Video
        </td>
        <td class="py-3 px-6 text-left">
         Kavindya Adhikari
        </td>
        <td class="py-3 px-6 text-left">
         1
        </td>
        <td class="py-3 px-6 text-left">
         video1.mp4
         <button class="ml-2 bg-blue-600 text-white px-2 py-1 rounded-lg hover:bg-blue-700" onclick="downloadFile('video1.mp4')">
          Download
         </button>
        </td>
        <td class="py-3 px-6 text-left">
         <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">
          Rejected
         </span>
        </td>
       </tr>
      </tbody>
     </table>
     <div class="flex justify-center mt-4">
      <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded-lg mx-1 hover:bg-gray-400">
       &lt;
      </button>
      <button class="bg-blue-600 text-white px-3 py-1 rounded-lg mx-1 hover:bg-blue-700">
       1
      </button>
      <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded-lg mx-1 hover:bg-gray-400">
       2
      </button>
      <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded-lg mx-1 hover:bg-gray-400">
       3
      </button>
      <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded-lg mx-1 hover:bg-gray-400">
       &gt;
      </button>
     </div>
    </div>
   </div>
  </div>
  <!-- Popup for Revision Request -->
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="revisionPopup">
   <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3">
    <span class="close-button text-gray-500 text-2xl cursor-pointer float-right" onclick="closePopup()">
     ×
    </span>
    <h2 class="text-xl font-semibold mb-4">
     Request Revision
    </h2>
    <textarea class="w-full p-2 border rounded-lg mb-4" id="revisionDescription" placeholder="Enter your description here..." rows="4"></textarea>
    <input accept="*/*" class="mb-4" id="revisionAttachment" type="file"/>
    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700" id="submitRevision" onclick="submitRevision()">
     Submit
    </button>
   </div>
  </div>
  <!-- Popup for Review -->
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="reviewPopup">
   <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3">
    <span class="close-button text-gray-500 text-2xl cursor-pointer float-right" onclick="closeReviewPopup()">
     ×
    </span>
    <h2 class="text-xl font-semibold mb-4">
     Review
    </h2>
    <div class="star-rating flex justify-center mb-4">
     <span class="star text-3xl text-gray-300 cursor-pointer" data-value="1">
      ★
     </span>
     <span class="star text-3xl text-gray-300 cursor-pointer" data-value="2">
      ★
     </span>
     <span class="star text-3xl text-gray-300 cursor-pointer" data-value="3">
      ★
     </span>
     <span class="star text-3xl text-gray-300 cursor-pointer" data-value="4">
      ★
     </span>
     <span class="star text-3xl text-gray-300 cursor-pointer" data-value="5">
      ★
     </span>
    </div>
    <input id="starRating" type="hidden" value="0"/>
    <textarea class="w-full p-2 border rounded-lg mb-4" id="reviewDescription" placeholder="Enter your review here..." rows="4"></textarea>
    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700" id="submitReview" onclick="submitReview()">
     Submit Review
    </button>
   </div>
  </div>
  <script>
   window.onload = function () {
            startCountdown();
        };

        const orderDetails = {
            orderedBy: "Me",
            orderDate: "Nov 27, 2024, 8:50 AM",
            orderDue: "Dec 8, 2024, 8:50 AM",
        };

        const messages = [
            { sender: "Me", text: "Hello" },
            { sender: "Kavindya", text: "Hi" },
            { sender: "Me", text: "I need to do a promotion" },
            { sender: "Kavindya", text: "Tell me more details" },
            { sender: "Me", text: "ok" },
        ];

        document.getElementById("orderedBy").innerText = orderDetails.orderedBy;
        document.getElementById("orderDate").innerText = orderDetails.orderDate;
        document.getElementById("orderDue").innerText = orderDetails.orderDue;

        const chatBox = document.getElementById("chatBox");
        messages.forEach((msg) => {
            const messageDiv = document.createElement("div");
            messageDiv.classList.add("message", msg.sender === "Me" ? "sent" : "received");
            messageDiv.innerText = msg.text;
            chatBox.appendChild(messageDiv);
        });

        document.getElementById("sendMessage").addEventListener("click", () => {
            const messageInput = document.getElementById("messageInput");
            if (messageInput.value.trim() !== "") {
                const newMessage = { sender: "Me", text: messageInput.value.trim() };
                messages.push(newMessage);

                const messageDiv = document.createElement("div");
                messageDiv.classList.add("message", "sent");
                messageDiv.innerText = newMessage.text;
                chatBox.appendChild(messageDiv);

                messageInput.value = "";
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });

        function startCountdown() {
            const countdownElement = document.getElementById("countdown");
            const dueDate = new Date(orderDetails.orderDue).getTime();
            const interval = setInterval(() => {
                const now = Date.now();
                const timeLeft = dueDate - now;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    countdownElement.innerText = "Delivery Time Reached!";
                    document.getElementById("deliverNow").disabled = false;
                } else {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    countdownElement.innerText = `${days} Days ${hours} Hours ${minutes} Minutes ${seconds} Seconds`;
                }
            }, 1000);
        }

        function openPopup() {
            document.getElementById('revisionPopup').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('revisionPopup').classList.add('hidden');
        }

        function submitRevision() {
            const description = document.getElementById('revisionDescription').value;
            const attachment = document.getElementById('revisionAttachment').files[0];

            console.log('Description:', description);
            console.log('Attachment:', attachment);

            closePopup();
        }

        function openReviewPopup() {
            document.getElementById('reviewPopup').classList.remove('hidden');
        }

        function closeReviewPopup() {
            document.getElementById('reviewPopup').classList.add('hidden');
            resetReviewForm();
        }

        function submitReview() {
            const reviewText = document.getElementById('reviewDescription').value;
            const starRating = document.getElementById('starRating').value;

            if (reviewText.trim() === "" || starRating === "0") {
                alert("Please enter a review and select a star rating before submitting.");
                return;
            }

            console.log("Review submitted:", reviewText, "Rating:", starRating);

            closeReviewPopup();
        }

        function resetReviewForm() {
            document.getElementById('reviewDescription').value = '';
            document.getElementById('starRating').value = '0';
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.classList.remove('selected');
            });
        }

        const stars = document.querySelectorAll('.star');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.getAttribute('data-value');
                document.getElementById('starRating').value = rating;

                stars.forEach(s => s.classList.remove('selected'));

                this.classList.add('selected');
                let prevStar = this;
                while (prevStar = prevStar.previousElementSibling) {
                    prevStar.classList.add('selected');
                }
            });
        });

        function downloadFile(fileName) {
            alert(`Downloading ${fileName}...`);
        }
  </script>
 </body>
</html>
