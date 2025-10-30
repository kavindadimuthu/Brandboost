
<!-- 1. dropdown for complaint type -->
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

<!-- 2.1 textfield for review reason -->
<p>Review Reason:</p>
        <textarea id="reviewReason" placeholder="Type your reason..."></textarea>

<!-- 2.2 reviewcontroller eke textfield kalla         -->
|| empty($requestData['Reason'])


<!-- 3.1 adding a review type dropdown for review -->
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

<!-- 3.2 ReviewController eke review type kalla -->
|| empty($requestData['reviewType'])

