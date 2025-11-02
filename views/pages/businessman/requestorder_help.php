
<!-- 1.1 dropdown for complaint type Varcha POST-->
<div class="form-group">
            <label for="complaintType">Complaint Type</label>
            <select id="complaintType" class="complaint-dropdown">
                <option value="disabled selected">Select complaint type...</option>
                <option value="order_cancellation">Order Cancellation</option>
                <option value="payment_problem">Payment Problem</option>
                <option value="service_quality">Service Quality</option>
                <option value="delivery_issue">Delivery Issue</option>
                <option value="other">Other</option>
            </select>
</div>

<!-- 1.2 complaint type dropdown GET (complaints_list) -->
<th>Type</th>

<!-- 1.3 complaint type dropdown Script GET (complaints_list) -->
 <td>
    <span class="badge badge-${complaint.complaint_type}">${complaint.complaint_type}</span>
</td>

<!-- complaint format ekat uncomment krnna oni complaint controller eke-->

<!-- 1.4 complaint reason textfield  varchar POST 1404-->
<div class="form-group">
    <label for="complaintReason">Reason</label>
    <textarea id="complaintReason" placeholder="Reason about your complaint..."></textarea>
</div> 

<!-- 1.5 complaint reason textfield GET (Complaints_list) 770, 1032-->
<th>Reason</th> 
<td>${complaint.complaint_reason}</td>

<!-- complaint format ekat uncomment krnna oni complaint controller eke-->

<!-- 2.1 textfield for review reason POST (1436)-->
<p>Review Reason:</p>
        <textarea id="reviewReason" placeholder="Type your reason..."></textarea>

<!-- 2.2 reviewcontroller eke textfield kalla POST        -->
|| empty($requestData['Reason'])

<!-- 2.3 review reason css part GET (service_details) -->
.review-reason {
      font-weight: 500;
      color: #4a5568;
      margin-bottom: 0.75rem;
    }

<!-- 2.4 review reason eke fetch krna kalla GET (service_details /1112) -->
<div class="review-reason">${review.reason}</div>


<!-- 2.5 adding a review type dropdown for review POST 1436-->
<div class="form-group">
            <label for="reviewType">Review Type</label>
            <select id="reviewType" class="complaint-dropdown">
                <option value="disabled selected">Select review type...</option>
                <option value="order_cancellation">Order</option>
                <option value="payment_problem">Payment</option>
                <option value="service_quality">Service Quality</option>
                <option value="delivery_issue">Delivery</option>
                <option value="other">Other</option>
            </select>
</div>

<!-- 2.6 ReviewController eke review type kalla POST-->
|| empty($requestData['reviewType'])

<!-- 2.7 review type fetch css part GET (435) -->
 .review-type {
      font-weight: 500;
      color: #4a5568;
      margin-bottom: 0.75rem;
    }

<!-- 2.8 review type fetch GET (service_details /1113) -->

<div class="review-type">Type: ${review.type.charAt(0).toUpperCase() + review.type.slice(1)}</div>