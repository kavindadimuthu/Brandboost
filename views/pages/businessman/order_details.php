
<UPDATED_CODE><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', 'Arial', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }

        .container {
            display: flex;
            margin: 0px 300px;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            font-size: 14px;
        }

        .main-content {
            display: flex;
            gap: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Chat Section */
        .chat-section {
            flex: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .chat-header {
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .chat-header .user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-header .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 18px;
        }

        .chat-header .username {
            font-size: 1.1em;
            font-weight: 600;
            color: #111827;
        }

        .chat-box {
            flex: 1;
            max-height: 630px;
            overflow-y: auto;
            padding: 16px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 12px 16px;
            margin-bottom: 12px;
            border-radius: 14px;
            max-width: 70%;
            font-size: 0.95em;
            line-height: 1.5;
            position: relative;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sent {
            align-self: flex-end;
            background-color: #4f46e5;
            color: #ffffff;
            margin-left: auto;
        }

        .received {
            align-self: flex-start;
            background-color: #f3f4f6;
            color: #1f2937;
        }

        .chat-input {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }

        .chat-input textarea {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: none;
            font-size: 0.95em;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .chat-input textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .chat-input button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 0.95em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chat-input button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        /* Order Section */
        .order-section {
            flex: 1;
            max-width: 35%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-section > div {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .order-section h4 {
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 1.1em;
            font-weight: 600;
            color: #111827;
            padding-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
        }

        .order-section p {
            font-size: 0.95em;
            color: #4b5563;
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
        }

        .order-section p strong {
            font-weight: 600;
        }

        .time-left {
            position: relative;
        }

        .time-card {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
            text-align: center;
        }

        .timer-display {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 12px 0;
        }

        .timer-unit {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timer-value {
            font-size: 1.5em;
            font-weight: 700;
            color: #4f46e5;
            background-color: #ffffff;
            border-radius: 6px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .timer-label {
            font-size: 0.75em;
            color: #6b7280;
            margin-top: 4px;
            text-transform: uppercase;
        }

        #countdown {
            font-size: 1em;
            font-weight: 600;
            color: #dc2626;
            margin-top: 12px;
            text-align: center;
        }

        .timer-progress {
            height: 6px;
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 3px;
            margin: 16px 0;
            overflow: hidden;
        }

        .timer-bar {
            height: 100%;
            background-color: #4f46e5;
            border-radius: 3px;
            transition: width 1s linear;
        }

        .order-section button {
            margin-top: 12px;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 0.95em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .order-section button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        .cancel-button {
            background-color: #ffffff !important;
            color: #dc2626 !important;
            border: 1px solid #dc2626 !important;
        }

        .cancel-button:hover {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
        }

        /* Add CSS for Requirements Section */
        .requirements-section {
            margin-top: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .requirements-section h3 {
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            margin: 0 0 16px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .requirements-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .requirements-content {
                grid-template-columns: 1fr;
            }
        }

        .requirement-description, 
        .requirement-files {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            border: 1px solid #e5e7eb;
        }

        .requirement-description h4, 
        .requirement-files h4 {
            font-size: 1.1em;
            font-weight: 600;
            color: #111827;
            margin: 0 0 12px 0;
        }

        .description-content {
            white-space: pre-line;
            color: #4b5563;
            line-height: 1.5;
        }

        .files-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .files-list img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .files-list .file-item {
            position: relative;
            width: 120px;
            height: 120px;
            overflow: hidden;
        }

        .files-list .file-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 4px 8px;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* For non-image files */
        .files-list .file-icon {
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.9em;
            transition: all 0.2s;
        }

        .files-list .file-icon i {
            font-size: 36px;
            color: #6b7280;
        }

        .file-item:hover {
            border-color: #4f46e5;
            background-color: #f5f5ff;
        }

        .file-item i {
            margin-right: 8px;
            color: #4f46e5;
        }

        .file-item a {
            color: #4b5563;
            text-decoration: none;
        }

        .file-item a:hover {
            color: #4f46e5;
        }

        .no-files {
            color: #6b7280;
            font-style: italic;
        }

        /* Deliverables Section - Redesigned as Table */
        .deliverables-section {
            margin-top: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .deliverables-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .deliverables-header h3 {
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .deliverables-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .deliverables-table th,
        .deliverables-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .deliverables-table th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .deliverables-table tr:hover {
            background-color: #f9fafb;
            cursor: pointer;
        }

        .status-delivered {
            color: #065f46;
            background-color: #d1fae5;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85em;
        }

        .status-revision {
            color: #92400e;
            background-color: #fef3c7;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85em;
        }

        /* delivery details popup */
        .delivery-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 700px;
            width: 90%;
            z-index: 1000;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .delivery-popup.active {
            display: block;
            animation: popIn 0.3s forwards;
        }

        @keyframes popIn {
            0% { opacity: 0; transform: translate(-50%, -48%); }
            100% { opacity: 1; transform: translate(-50%, -50%); }
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .popup-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .close-btn:hover {
            color: #111827;
            background-color: #f3f4f6;
        }

        .popup-content {
            padding: 24px;
        }

        .popup-media {
            width: 100%;
            max-height: 100px;
            object-fit: contain;
            margin-bottom: 24px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .delivery-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 1rem;
            color: #111827;
        }

        .revision-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .revision-section h4 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-top: 0;
            margin-bottom: 16px;
        }

        .revision-item {
            background-color: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 3px solid #4f46e5;
        }

        .revision-item:last-child {
            margin-bottom: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-delivered {
            color: #065f46;
            background-color: #d1fae5;
        }

        .status-revision {
            color: #92400e;
            background-color: #fef3c7;
        }

        .status-pending {
            color: #1e40af;
            background-color: #dbeafe;
        }
        

        /* Delivery Form */
        .delivery-form {
            padding: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            margin-top: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid #4f46e5;
        }

        .delivery-form h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #111827;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95em;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group .note {
            font-size: 0.85em;
            color: #6b7280;
            margin-top: 6px;
        }

        .screenshot-upload {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 24px 16px;
            text-align: center;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .upload-area:hover {
            border-color: #4f46e5;
            background-color: #f5f5ff;
        }

        .upload-area i {
            font-size: 2em;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .upload-area h4 {
            margin: 0 0 8px 0;
            font-size: 1em;
            font-weight: 500;
            color: #111827;
        }

        .upload-area p {
            margin: 0;
            font-size: 0.85em;
            color: #6b7280;
        }

        .preview-images {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .preview-image {
            width: 100px;
            height: 100px;
            border-radius: 6px;
            overflow: hidden;
            position: relative;
            border: 1px solid #e5e7eb;
        }

        .preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-image .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.8em;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .form-buttons button {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn {
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
        }

        .submit-btn:hover {
            background-color: #4338ca;
        }

        .cancel-btn {
            background-color: #ffffff;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .cancel-btn:hover {
            background-color: #f3f4f6;
        }

        /* Popups */
        .popup,
        .cancel-popup,
        .delivery-popup,
        .accept-popup,
        .complaint-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 100%;
            max-width: 600px;
        }

        .delivery-popup {
            max-width: 720px;
        }

        .complaint-popup {
            max-width: 720px;
        }

        .popup.active,
        .cancel-popup.active,
        .delivery-popup.active,
        .accept-popup.active,
        .complaint-popup.active {
            display: block;
        }

        .popup h4,
        .cancel-popup h4,
        .delivery-popup h4,
        .accept-popup h4,
        .complaint-popup h4 {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 16px;
            color: #111827;
        }

        .popup p,
        .cancel-popup p,
        .delivery-popup p,
        .accept-popup p,
        .complaint-popup p {
            font-size: 0.95em;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .popup button,
        .cancel-popup button,
        .delivery-popup button,
        .accept-popup button,
        .complaint-popup button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .popup button:hover,
        .cancel-popup button:hover,
        .delivery-popup button:hover,
        .accept-popup button:hover,
        .complaint-popup button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        .popup .close-btn,
        .cancel-popup .close-btn,
        .delivery-popup .close-btn,
        .accept-popup .close-btn,
        .complaint-popup.close-btn {
            position: absolute;
            height: 36px;
            width: 36px;
            top: 16px;
            right: 16px;
            font-size: 1.2em;
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            transition: all 0.2s;
        }

        .popup .close-btn:hover,
        .cancel-popup .close-btn:hover,
        .delivery-popup .close-btn:hover,
        .accept-popup .close-btn:hover
        .complaint-popup .close-btn:hover {
            color:rgb(84, 118, 174);
            transform: none;
        }

        .complaint-dropdown {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .complaint-dropdown:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .stars {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .stars i {
            font-size: 1.8em;
            color: #e5e7eb;
            cursor: pointer;
            transition: all 0.2s;
        }

        .stars i:hover {
            transform: scale(1.1);
        }

        .stars i.active {
            color: #fbbf24;
        }

        .popup textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            padding: 12px;
            border-radius: 8px;
            resize: none;
            font-size: 0.95em;
            font-family: inherit;
            margin-bottom: 20px;
            min-height: 120px;
        }

        .popup textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .cancel-popup textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            padding: 12px;
            border-radius: 8px;
            resize: none;
            font-size: 0.95em;
            font-family: inherit;
            margin-bottom: 20px;
            min-height: 120px;
        }

        .cancel-popup textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        /* Backdrop overlay */
        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .backdrop.active {
            display: block;
        }

        /* Image preview modal */
        .image-preview-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
        }

        .image-preview-modal.active {
            display: block;
        }

        .image-preview-modal img {
            max-width: 100%;
            border-radius: 8px;
        }

        .image-preview-modal .close-preview {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="chat-section">
                    <div class="chat-header">
                        <div class="user">
                            <div class="avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="username" id="username"></span>
                        </div>
                    </div>
                    <div class="chat-box" id="chatBox">
                        <div class="message received">Hello</div>
                        <div class="message received">Hi</div>
                    </div>
                    <div class="chat-input">
                        <textarea id="messageInput" placeholder="Type a message..."></textarea>
                        <button id="sendMessage">Send</button>
                    </div>
                </div>

                <div class="order-section">
                    <div class="time-left">
                        <h4>Time Left To Delivery</h4>
                        <div class="time-card">
                            <div class="timer-display">
                                <div class="timer-unit">
                                    <div class="timer-value" id="days">0</div>
                                    <div class="timer-label">Days</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="hours">0</div>
                                    <div class="timer-label">Hours</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="minutes">0</div>
                                    <div class="timer-label">Mins</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="seconds">0</div>
                                    <div class="timer-label">Secs</div>
                                </div>
                            </div>
                            <div class="timer-progress">
                                <div class="timer-bar" id="progressBar"></div>
                            </div>
                        </div>
                        <div id="countdown"></div>
                        <button id="request-revision">Request Rivision</button>
                        <button class="accept-button" id="acceptOrder">Accept</button>
                        <button class="cancel-button" id="cancelOrder">Request order cancellation</button>
                    </div>
                    <div class="order-details">
                        <h4>Order Details</h4>
                        <p><strong>Seller:</strong> <span id="sellerName"></span></p>
                        <p><strong>Date:</strong> <span id="orderDate"></span></p>
                        <p><strong>Due:</strong> <span id="orderDue"></span></p>
                    </div>
                    <div class="support-section">
                        <h4>Support</h4>
                        <button id="Complaint">Complaint</button>
                        <button id="reviewOrder">Review</button>

                    </div>
                </div>
            </div>

            <!-- Modified Deliverables Section -->
            <!-- Deliveries Section -->
            <div class="requirements-section">
                <h3>Order Requirements</h3>
                <div class="requirements-content">
                    <div class="requirement-description">
                        <h4>Description</h4>
                        <div class="description-content" id="orderDescription">Loading...</div>
                    </div>
                    
                    <div class="requirement-files">
                        <h4>Attached Files</h4>
                        <div class="files-list" id="orderFiles">
                            <div class="loading-files">Loading files...</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Redesigned Deliverables Section -->
            <div class="deliverables-section">
                <div class="deliverables-header">
                    <h3>Deliverables</h3>
                    <span id="deliverableCount">2 items</span>
                </div>
                <table class="deliverables-table">
                    <thead>
                        <tr>
                            <th>Delivery #</th>
                            <th>Delivery Note</th>
                            <th>Delivered Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delivery Details Popup -->
    <div class="delivery-popup" id="deliveryDetailsPopup">
            <div class="popup-header">
                <h3>Delivery Details</h3>
                <button class="close-btn" id="closeDetailsPopup">&times;</button>
            </div>
            <div class="popup-content">
                <img class="popup-media" id="popupMedia" src="" alt="Delivery Media">
                
                <div class="delivery-details">
                    <div class="detail-item">
                        <div class="detail-label">Delivery Number</div>
                        <div class="detail-value" id="popupNumber">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge" id="popupStatusBadge">
                                <span id="popupStatus">-</span>
                            </span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Delivered Time</div>
                        <div class="detail-value" id="popupTime">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Content Link</div>
                        <div class="detail-value" id="popupLink">-</div>
                    </div>
                </div>
                
                <div class="detail-item" style="grid-column: 1 / span 2;">
                    <div class="detail-label">Delivery Note</div>
                    <div class="detail-value" id="popupNote">-</div>
                </div>
                
                <div class="revision-section" id="revisionSection">
                    <h4>Revision Requests</h4>
                    <img class="popup-media" id="popupRevisionMedia" src="" alt="Delivery Media">
                    <div id="revisionList">
                        <div class="revision-item">
                            <div class="detail-item">
                                <div class="detail-label">Revision Number</div>
                                <div class="detail-value" id="popupRevisionNumber">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Requested On</div>
                                <div class="detail-value" id="popupRevisionTime">-</div>
                            </div>
                            <div class="detail-item" style="margin-top: 12px;">
                                <div class="detail-label">Revision Note</div>
                                <div class="detail-value" id="popupRevisionNote">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Complain Popup -->
    <div class="complaint-popup" id="complaintPopup">
        <button class="complaintSupport" id="closeComplaintPopup">&times;</button>
        <h4>Complaint</h4>
        <div class="form-group">
            <label for="complaintType">Complaint Type</label>
            <select id="complaintType" class="complaint-dropdown">
                <option value="" disabled selected>Select complaint type...</option>
                <option value="order_cancellation">Order Cancellation</option>
                <option value="payment_problem">Payment Problem</option>
                <option value="service_quality">Service Quality</option>
                <option value="delivery_issue">Delivery Issue</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="complaintNotes">Notes</label>
            <textarea id="complaintNotes" placeholder="Description about your complaint..."></textarea>
        </div>
        <div class="form-group">
            <label>Proofs</label>
            <div class="screenshot-upload">
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Upload Screenshots and videos</h4>
                    <p>Upload Evidences..... (JPG, PNG, up to 10MB)</p>
                    <input type="file" id="fileUpload" style="display: none;" multiple accept="image/*,video/mp4" />
                </div>
                <div class="preview-images" id="previewContainer">
                    <!-- Preview images will appear here -->
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <button class="cancel-btn" id="cancelComplaint">Cancel</button>
            <button class="submit-btn" id="submitComplaint">Submit</button>
        </div>
    </div>

    <!-- Review Popup -->
    <div class="popup" id="reviewPopup">
        <button class="close-btn" id="closePopup">&times;</button>
        <h4>Review Order</h4>
        <p>Please rate your experience with this order:</p>
        <div class="stars" id="stars">
            <i class="fas fa-star" data-rating="1"></i>
            <i class="fas fa-star" data-rating="2"></i>
            <i class="fas fa-star" data-rating="3"></i>
            <i class="fas fa-star" data-rating="4"></i>
            <i class="fas fa-star" data-rating="5"></i>
        </div>
        <p>Please provide some ideas about review:</p>
        <textarea id="reviewComment" placeholder="Type your ideas..."></textarea>
        <button id="submitReview">Submit Review</button>
    </div>

    <!-- Cancel Order Popup -->
    <div class="cancel-popup" id="cancelPopup">
        <button class="close-btn" id="closeCancelPopup">&times;</button>
        <h4>Cancel Order</h4>
        <p>Please provide a reason for cancellation:</p>
        <textarea id="cancelReason" placeholder="Type your reason..."></textarea>
        <button id="requestCancel">Request Cancel</button>
    </div>

    <!-- Accept Popup -->
    <div class="accept-popup" id="acceptPopup">
        <button class="close-btn" id="closeAcceptPopup" align="right">&times;</button>
        <p>Are you sure you want to accept the last rivision?.</p>
        <button id="cancelAccept">No</button>
        <button id="yesAccept">Yes</button>
        
    </div>

    <!-- Request Rivision Popup -->
    <div class="delivery-popup" id="deliveryPopup">
        <button class="close-btn" id="closeDeliveryPopup">&times;</button>
        <h4>Request Rivision</h4>
        <div class="form-group">
            <label for="revisionNotes">Notes</label>
            <textarea id="revisionNotes" placeholder="Any additional information about your previous rivision..."></textarea>
        </div>
        <div class="form-group">
            <label>Proofs</label>
            <div class="screenshot-upload">
                <div class="upload-area" id="uploadSection">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Upload Screenshots and videos</h4>
                    <p>Upload engagement metrics, reach, impressions, etc. (JPG, PNG)</p>
                    <input type="file" id="fileUploadSection" style="display: none;" multiple accept="image/*" />
                </div>
                <div class="preview-images" id="previewContainer">
                    <!-- Preview images will appear here -->
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <button class="cancel-btn" id="cancelDelivery">Cancel</button>
            <button class="submit-btn" id="request">Request</button>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="image-preview-modal" id="imagePreviewModal">
        <button class="close-preview" id="closeImagePreview">&times;</button>
        <img id="previewImage" src="" alt="Screenshot preview" />
    </div>

    <!-- Backdrop overlay -->
    <div class="backdrop" id="backdrop"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const username = document.getElementById('username');
        const chatBox = document.getElementById('chatBox');
        const sellerName = document.getElementById('sellerName');
        const orderDate = document.getElementById('orderDate');
        const orderDue = document.getElementById('orderDue');
        const countdown = document.getElementById('countdown');
        const acceptPopup = document.getElementById('acceptPopup');
        const reviewPopup = document.getElementById('reviewPopup');
        // const stars = document.getElementById('stars');
        const reviewComment = document.getElementById('reviewComment');
        const cancelPopup = document.getElementById('cancelPopup');
        const deliveryPopup = document.getElementById('deliveryPopup');
        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minutesEl = document.getElementById('minutes');
        const secondsEl = document.getElementById('seconds');
        const progressBar = document.getElementById('progressBar');
        const deliverablesList = document.getElementById('deliverablesList');
        const deliverableCount = document.getElementById('deliverableCount');
        const backdrop = document.getElementById('backdrop');
        const imagePreviewModal = document.getElementById('imagePreviewModal');
        const previewImage = document.getElementById('previewImage');

        // Extract orderId from the URL
        const pathSegments = window.location.pathname.split('/');
        const orderId = pathSegments[pathSegments.length - 1];
        let serviceId = null;
        // Get the last segment of the URL

        // Show image preview modal
        function showImagePreview(imgUrl) {
            previewImage.src = imgUrl;
            imagePreviewModal.classList.add('active');
            backdrop.classList.add('active');
        }
        
        // Close image preview
        document.getElementById('closeImagePreview').addEventListener('click', function() {
            imagePreviewModal.classList.remove('active');
            backdrop.classList.remove('active');
        });

        // Fetch order details
        async function fetchOrderDetails() {
            try {
                const response = await fetch(`/api/order/${orderId}?order_id=${orderId}&include_user=true`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();

                console.log('Order details:', result);
                
                serviceId = result.data.order.service_id;
                console.log(serviceId);
                

                // Render order details
                username.textContent = result.data.user.name;
                sellerName.textContent = result.data.user.name;
                orderDate.textContent = new Date(result.data.order.created_at.replace(' ', 'T')).toLocaleString();

                // Calculate due date
                const createdDate = new Date(result.data.order.created_at.replace(' ', 'T'));
                const deliveryDays = result.data.promise.delivery_days;
                const dueDate = new Date(createdDate.getTime() + deliveryDays * 24 * 60 * 60 * 1000);
                orderDue.textContent = dueDate.toLocaleString();

                // Start countdown
                startCountdown(dueDate, createdDate);

                // Render chat messages (if applicable)
                if (result.data.messages) {
                    result.data.messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('message', message.type);
                        messageElement.textContent = message.text;
                        chatBox.appendChild(messageElement);
                    });
                }

                // For demo purposes, also fetch deliverables here
                // In production, replace with real API call
                //renderDeliverables(mockDeliverables);

            } catch (error) {
                console.error('Error fetching order details:', error);
                // For demo purposes, show mock deliverables even if API fails
                //renderDeliverables(mockDeliverables);
            }
        }

        // Updated function to load order requirements and display files properly
        async function loadOrderRequirements() {
            try {
                // Use the same API endpoint as fetchOrderDetails
                const response = await fetch(`/api/order/${orderId}?order_id=${orderId}&include_user=true`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const result = await response.json();
                console.log('Requirements data from order details:', result);
                
                // Check if we have the promise and requested_service data
                if (result.data?.promise?.requested_service) {
                    let serviceData = {};
                    
                    try {
                        // Parse the JSON string from requested_service
                        if (typeof result.data.promise.requested_service === 'string') {
                            serviceData = JSON.parse(result.data.promise.requested_service);
                        } else {
                            serviceData = result.data.promise.requested_service;
                        }
                        
                        // Update description section with the parsed description
                        const descElement = document.getElementById('orderDescription');
                        if (serviceData.description) {
                            descElement.textContent = serviceData.description;
                        } else if (serviceData.requirements) {
                            descElement.textContent = serviceData.requirements;
                        } else {
                            descElement.textContent = 'No description provided';
                            descElement.classList.add('no-files');
                        }
                        descElement.style.whiteSpace = 'pre-line'; // Preserve line breaks
                        
                        // Update files section
                        const filesContainer = document.getElementById('orderFiles');
                        filesContainer.innerHTML = ''; // Clear loading state
                        
                        // Check for project_documents in promise data (primary source for files)
                        let filesList = [];
                        
                        if (result.data.promise && result.data.promise.project_documents) {
                            try {
                                if (typeof result.data.promise.project_documents === 'string') {
                                    filesList = JSON.parse(result.data.promise.project_documents);
                                } else if (Array.isArray(result.data.promise.project_documents)) {
                                    filesList = result.data.promise.project_documents;
                                }
                            } catch (e) {
                                console.error('Error parsing project_documents JSON:', e);
                            }
                        }
                        
                        // Display files if we have any
        if (Array.isArray(filesList) && filesList.length > 0) {
            console.log('Files from database:', filesList);
            
            filesList.forEach((file, index) => {
                // Handle different file data structures, including JSON string representation
                let fileUrl = '';
                
                if (typeof file === 'string') {
                    // If it's a simple string, use it directly
                    if (file.startsWith('[') && file.endsWith(']')) {
                        // This is a stringified array with a single element
                        try {
                            const parsed = JSON.parse(file);
                            fileUrl = parsed[0];
                        } catch (e) {
                            // If parsing fails, use the string as is but remove brackets
                            fileUrl = file.substring(1, file.length - 1);
                        }
                    } else {
                        fileUrl = file;
                    }
                    
                    // Handle escaped slashes in the URL
                    fileUrl = fileUrl.replace(/\\\//g, '/');
                } else if (file && (file.url || file.path)) {
                    // If it's an object with url or path property
                    fileUrl = file.url || file.path;
                }
                
                // Handle final path formatting
                if (fileUrl && !fileUrl.startsWith('http') && !fileUrl.startsWith('/')) {
                    fileUrl = '/' + fileUrl;
                }
                
                const fileName = (file && file.name) ? file.name : `File ${index + 1}`;
                
                if (fileUrl) {
                    console.log(`Processing file ${index}: ${fileUrl}`);
                    
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    // Check if it's an image file by extension
                    const isImage = /\.(jpg|jpeg|png|gif|webp|bmp|svg)$/i.test(fileUrl);
                    
                    if (isImage) {
                        // For images, show a thumbnail with a link to the full image
                        fileItem.innerHTML = `
                            <div class="file-thumbnail">
                                <img src="${fileUrl}" alt="${fileName}" onclick="window.open('${fileUrl}', '_blank')">
                            </div>
                            <a href="${fileUrl}" target="_blank">${fileName}</a>
                        `;
                    } else {
                        // For non-image files, show the regular file icon
                        fileItem.innerHTML = `
                            <i class="fas fa-file-alt"></i>
                            <a href="${fileUrl}" target="_blank">${fileName}</a>
                        `;
                    }
                    
                    filesContainer.appendChild(fileItem);
                }
            });
        } else {
            filesContainer.innerHTML = '<div class="no-files">No files attached to this order</div>';
        }
                        
                    } catch (error) {
                        console.error('Error parsing requested_service JSON:', error);
                        document.getElementById('orderDescription').textContent = 'Error loading requirements';
                        document.getElementById('orderFiles').innerHTML = '<div class="no-files">Error parsing requirements data</div>';
                    }
                } else {
                    console.log('No requested_service data found in promise');
                    document.getElementById('orderDescription').textContent = 'No requirements found';
                    document.getElementById('orderFiles').innerHTML = '<div class="no-files">No files attached</div>';
                }
                
            } catch (error) {
                console.error('Error loading requirements:', error);
                document.getElementById('orderDescription').textContent = 'Error loading requirements';
                document.getElementById('orderFiles').innerHTML = '<div class="no-files">Error loading files</div>';
            }
        }

        async function loadDeliveryData() {
    try {
        const url = `/api/delivery/${orderId}`;
        console.log('Fetching delivery data from:', url);
        
        const response = await fetch(url);
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('API error response:', errorText);
            throw new Error(`Network response was not ok: ${response.status} ${response.statusText}`);
        }
        
        let data = await response.json();
        console.log('Delivery data received:', data);
        
        // Handle different response formats
        let deliveries = Array.isArray(data) ? data : (data.data || []);
        
        const tbody = document.querySelector(".deliverables-table tbody");
        tbody.innerHTML = ''; // Clear existing rows
        
        if (deliveries.length === 0) {
            const tr = document.createElement("tr");
            tr.innerHTML = '<td colspan="4">No deliveries found</td>';
            tbody.appendChild(tr);
            
            // Update the deliverable count
            document.getElementById('deliverableCount').textContent = '0 items';
            return;
        }
        
        deliveries.forEach((delivery, index) => {
            // Process delivery files to ensure data structure is consistent
            if (delivery.deliveries && typeof delivery.deliveries === 'string') {
                try {
                    if (delivery.deliveries.startsWith('[') || delivery.deliveries.startsWith('{')) {
                        delivery.files = JSON.parse(delivery.deliveries);
                    } else {
                        delivery.files = [{ path: delivery.deliveries }];
                    }
                } catch (e) {
                    console.error('Error parsing deliveries JSON:', e);
                    delivery.files = [{ path: delivery.deliveries }];
                }
            }
            
            const tr = document.createElement("tr");
            tr.className = "delivery-row";
            tr.dataset.delivery = JSON.stringify(delivery);
            
            tr.innerHTML = `
                <td>${delivery.delivery_id || delivery['Delivery #'] || index + 1}</td>
                <td>${delivery.delivery_note || delivery.description || delivery['Delivery Note'] || 'No note provided'}</td>
                <td>${delivery.delivered_at || delivery.deliveredTime || delivery['Delivered Time'] || 'N/A'}</td>
                <td>
                <span class="${delivery.status === 'Delivered' || delivery.status === 'delivered' ? 'status-delivered' : 'status-revision'}">
                    ${delivery.status || 'Pending'}
                </span>
                </td>
            `;
            
            // Add event listener for showing delivery details
            tr.addEventListener('click', function() {
                const deliveryData = JSON.parse(this.dataset.delivery);
                showDeliveryDetails(deliveryData);
                
                // Make sure to show the popup and backdrop
                document.getElementById('deliveryDetailsPopup').classList.add('active');
                document.getElementById('backdrop').classList.add('active');
            });
            
            tbody.appendChild(tr);
        });
        
        // Update the deliverable count
        document.getElementById('deliverableCount').textContent = `${deliveries.length} item${deliveries.length !== 1 ? 's' : ''}`;

    } catch (error) {
        console.error('Fetch error:', error);
        
        // Show more user-friendly error message in the table
        const tbody = document.querySelector(".deliverables-table tbody");
        if (tbody) {
            tbody.innerHTML = `<tr><td colspan="4">Error loading deliveries: ${error.message}</td></tr>`;
        }
    }
}

function showDeliveryDetails(data) {
    console.log('Showing delivery details:', data);
    
    // Populate main details with fallbacks for missing data
    document.getElementById('popupNumber').textContent = data.delivery_id || 'N/A';
    document.getElementById('popupNote').textContent = data.delivery_note || 'No notes provided';
    document.getElementById('popupTime').textContent = data.delivered_at || 'N/A';
    
    // Set status and appropriate class
    const statusElement = document.getElementById('popupStatus');
    const statusBadge = document.getElementById('popupStatusBadge');
    const status = data.status || 'Pending';
    
    statusElement.textContent = status;
    
    // Remove all existing status classes and add the appropriate one
    statusBadge.className = 'status-badge';
    if (status.toLowerCase() === 'delivered') {
        statusBadge.classList.add('status-delivered');
    } else if (status.toLowerCase().includes('revision')) {
        statusBadge.classList.add('status-revision');
    } else {
        statusBadge.classList.add('status-pending');
    }
    
    // Set content link if available
    const linkElement = document.getElementById('popupLink');
if (data.content_link) {
    // Check if the URL already has http:// or https:// prefix
    let url = data.content_link;
    if (!url.match(/^https?:\/\//i)) {
        // If no protocol is specified, prepend https://
        url = 'https://' + url;
    }
    linkElement.innerHTML = `<a href="${url}" target="_blank">${data.content_link}</a>`;
} else {
    linkElement.textContent = 'Not provided';
}
    
    // Handle file display
    const mediaElement = document.getElementById('popupMedia');
    
    try {
        // Try to get files from data structure
        let filePath = null;
        
        // Check if we have files property with array
        if (data.files && Array.isArray(data.files) && data.files.length > 0) {
            const fileObj = data.files[0];
            filePath = fileObj.url || fileObj.path || null;
            console.log('Found file in files array:', filePath);
        }
        // Check if we have deliveries as JSON string that needs parsing
        else if (typeof data.deliveries === 'string') {
            try {
                // First try to parse as JSON
                if (data.deliveries.startsWith('[') || data.deliveries.startsWith('{')) {
                    const parsedFiles = JSON.parse(data.deliveries);
                    if (Array.isArray(parsedFiles) && parsedFiles.length > 0) {
                        const fileObj = parsedFiles[0];
                        filePath = fileObj.url || fileObj.path || parsedFiles[0];
                        console.log('Parsed deliveries JSON successfully:', filePath);
                    }
                } else {
                    // Treat as a direct file path
                    filePath = data.deliveries;
                    console.log('Using deliveries as direct path:', filePath);
                }
            } catch (e) {
                console.error('Failed to parse deliveries JSON:', e);
                // Use as a direct path
                filePath = data.deliveries;
            }
        }
        
        // If we found a file path, display it
        if (filePath) {
            // Format the path properly
            if (filePath.startsWith('http://') || filePath.startsWith('https://')) {
                // External URL - use as is
                mediaElement.src = filePath;
            } else {
                // Internal path - ensure proper formatting
                if (!filePath.startsWith('/')) {
                    filePath = '/' + filePath;
                }
                mediaElement.src = filePath;
            }
            mediaElement.style.display = 'block';
            console.log('Displaying file:', mediaElement.src);
        } else {
            // Fallback to screenshots if available
            if (data.screenshots && data.screenshots.length > 0) {
                mediaElement.src = data.screenshots[0];
                mediaElement.style.display = 'block';
                console.log('Displaying screenshot:', data.screenshots[0]);
            } else {
                mediaElement.style.display = 'none';
                console.log('No media found to display');
            }
        }
    } catch (error) {
        console.error('Error handling media display:', error);
        mediaElement.style.display = 'none';
    }
        

        // Handle revision media
if(data.revision_note){
        console.log('Showing revision details:', data);
    
    // Populate main details with fallbacks for missing data
    document.getElementById('popupRevisionNumber').textContent = data.revision_number || 'N/A';
    document.getElementById('popupRevisionNote').textContent = data.revision_note || 'No notes provided';
    document.getElementById('popupRevisionTime').textContent = data.delivered_at || 'N/A';

    
    

    // Handle revision file display
    const revisionMediaElement = document.getElementById('popupRevisionMedia');
    
    try {
        // Try to get files from data structure
        let revisionFilePath = null;
        
        // Check if we have files property with array
        if (data.revision_files && Array.isArray(data.revision_files) && data.revision_files.length > 0) {
            const fileObj = data.revision_files[0];
            revisionFilePath = fileObj.url || fileObj.path || null;
            console.log('Found file in revision_files array:', revisionFilePath);
        }
        // Check if we have revision_files as JSON string that needs parsing
        else if (typeof data.revision_files === 'string') {
            try {
                // First try to parse as JSON
                if (data.revision_files.startsWith('[') || data.revision_files.startsWith('{')) {
                    const parsedFiles = JSON.parse(data.revision_files);
                    if (Array.isArray(parsedFiles) && parsedFiles.length > 0) {
                        const fileObj = parsedFiles[0];
                        revisionFilePath = fileObj.url || fileObj.path || parsedFiles[0];
                        console.log('Parsed revision_files JSON successfully:', revisionFilePath);
                    }
                } else {
                    // Treat as a direct file path
                    revisionFilePath = data.revision_files;
                    console.log('Using revision_files as direct path:', revisionFilePath);
                }
            } catch (e) {
                console.error('Failed to parse revision_files JSON:', e);
                // Use as a direct path
                revisionFilePath = data.revision_files;
            }
        }
        
        // If we found a file path, display it
        if (revisionFilePath) {
            // Format the path properly
            if (revisionFilePath.startsWith('http://') || revisionFilePath.startsWith('https://')) {
                // External URL - use as is
                revisionMediaElement.src = revisionFilePath;
            } else {
                // Internal path - ensure proper formatting
                if (!revisionFilePath.startsWith('/')) {
                    revisionFilePath = '/' + revisionFilePath;
                }
                revisionMediaElement.src = revisionFilePath;
            }
            revisionMediaElement.style.display = 'block';
            console.log('Displaying revision file:', revisionMediaElement.src);
        } else {
            // Fallback to revision screenshots if available
            if (data.revision_screenshots && data.revision_screenshots.length > 0) {
                revisionMediaElement.src = data.revision_screenshots[0];
                revisionMediaElement.style.display = 'block';
                console.log('Displaying revision screenshot:', data.revision_screenshots[0]);
            } else {
                revisionMediaElement.style.display = 'none';
                console.log('No revision media found to display');
            }
        }
    } catch (error) {
        console.error('Error handling revision media display:', error);
        revisionMediaElement.style.display = 'none';
    }

    }else{
        document.getElementById('revisionSection').style.display = 'none';
    }
}

        async function submitReview() {
        // Get star rating by counting the number of active stars
        const activeStars = document.querySelectorAll('.stars i.active');
        const rating = activeStars.length;
        console.log('rating', rating);
        
        
        const response = await fetch('/api/create-review', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                order_id: orderId, 
                reviewText: reviewComment.value,
                rating: rating  // Adding the star rating to the request
            }),
        });

        if (response.success) {
            console.log('Review Created Successfully.');
        } else {
            console.error('Failed to create review:', response.statusText);
        }
    }

        //Countdown Starts

        function startCountdown(dueDate, createdDate) {
            const countdownElement = document.getElementById('countdown');
            const totalDuration = dueDate - createdDate;
            
            const interval = setInterval(() => {
                const now = new Date().getTime();
                const timeLeft = dueDate - now;
                
                // Update progress bar
                const progressPercentage = 100 - Math.min(100, Math.max(0, (timeLeft / totalDuration) * 100));
                progressBar.style.width = `${progressPercentage}%`;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    countdownElement.innerText = 'Delivery Time Reached!';
                    // document.getElementById('deliverNow').disabled = false;
                    
                    daysEl.textContent = '0';
                    hoursEl.textContent = '0';
                    minutesEl.textContent = '0';
                    secondsEl.textContent = '0';
                } else {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    // Update timer values
                    daysEl.textContent = days;
                    hoursEl.textContent = hours;
                    minutesEl.textContent = minutes;
                    secondsEl.textContent = seconds;
                    
                    countdownElement.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s remaining`;
                }
            }, 1000);
        }

        //Request Revision
        
        async function requestRevision() {
            const deliveryNotes = document.getElementById('revisionNotes');
            const fileInput = document.getElementById('fileUploadSection');
            const formData = new FormData();
            
            // Make sure orderId is defined
            if (typeof orderId === 'undefined' || !orderId) {
                console.error('Order ID is not defined');
                return;
            }

            // Validate input
            if (!revisionNotes.value.trim()) {
                alert('Please enter notes of previous revision');
                return;
            }

            // Append text fields
            formData.append('order_id', orderId);
            formData.append('revision_notes', revisionNotes.value);

            // Append files
            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append('revision_photos[]', fileInput.files[i]);
            }

            try {
                // Make sure this URL matches your backend route
                const response = await fetch('/api/request-revision', {
                    method: 'POST',
                    body: formData,
                    // No Content-Type header needed for FormData
                });

                console.log(response);                

                // Check if the response is valid JSON
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Server didn't return JSON. Got: " + await response.text());
                }

                const result = await response.json();
                
                if (result.success) {
                    alert('Revision Requested successfully');
                    // Close popup and reset form
                    document.getElementById('complaintPopup').style.display = 'none';
                    complaintNotes.value = '';
                    fileInput.value = '';
                    document.getElementById('previewContainer').innerHTML = '';
                } else {
                    alert('Failed to submit complaint: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error submitting complaint:', error);
                alert('Error submitting complaint: ' + error.message);
            }
        }

        // Deliver Now button
        document.getElementById('request-revision').addEventListener('click', () => {
            deliveryPopup.classList.add('active');
            backdrop.classList.add('active');
        });

        document.getElementById('request').addEventListener('click', () => {
            requestRevision();
            deliveryPopup.classList.remove('active');
            backdrop.classList.rempve('active');
        });

        // Close delivery popup
        document.getElementById('closeDeliveryPopup').addEventListener('click', () => {
            deliveryPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('cancelDelivery').addEventListener('click', () => {
            deliveryPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        // Event listeners for review and cancel popups
        document.getElementById('reviewOrder').addEventListener('click', () => {
            reviewPopup.classList.add('active');
            backdrop.classList.add('active');
        });

        document.getElementById('submitReview').addEventListener('click', () => {
            submitReview();
            reviewPopup.classList.remove('active'); 
            backdrop.classList.remove('active');
        });

        document.getElementById('closePopup').addEventListener('click', () => {
            reviewPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        // Event listeners for accept and cancel popups
        document.getElementById('acceptOrder').addEventListener('click', () => {
            acceptPopup.classList.add('active');
            backdrop.classList.add('active');
        });

        document.getElementById('closeAcceptPopup').addEventListener('click', () => {
            acceptPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('cancelAccept').addEventListener('click', () => {
            acceptPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('yesAccept').addEventListener('click', () => {
            yesAccept();
            acceptPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        // Event listeners for order cancellation popups
        document.getElementById('cancelOrder').addEventListener('click', () => {
            cancelPopup.classList.add('active');
            backdrop.classList.add('active');
        });

        document.getElementById('closeCancelPopup').addEventListener('click', () => {
            cancelPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });


        // Event listeners for complaint popups
        document.getElementById('Complaint').addEventListener('click', () => {
            complaintPopup.classList.add('active');
            backdrop.classList.add('active');
        });

        document.getElementById('closeComplaintPopup').addEventListener('click', () => {
            complaintPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('cancelComplaint').addEventListener('click', () => {
            complaintPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('submitComplaint').addEventListener('click', () => {
            submitComplaint()
            complaintPopup.classList.remove('active');
            backdrop.classList.remove('active');
        });

        document.getElementById('closeDetailsPopup').addEventListener('click', () => {
            deliveryDetailsPopup.classList.remove('active');
            backdrop.classList.remove('active');
            });

        // Star rating functionality
        const stars = document.querySelectorAll('.stars i');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-rating');
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
        

        // File upload area
        const uploadArea = document.getElementById('uploadArea');
        const uploadSection = document.getElementById('uploadSection');
        const fileUploadSection = document.getElementById('fileUploadSection');
        
        uploadArea.addEventListener('click', () => {
            fileUpload.click();
        });

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#4f46e5';
            uploadArea.style.backgroundColor = '#f5f5ff';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#d1d5db';
            uploadArea.style.backgroundColor = '#f9fafb';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#d1d5db';
            uploadArea.style.backgroundColor = '#f9fafb';
            
            if (e.dataTransfer.files.length > 0) {
                handleFiles(e.dataTransfer.files);
            }
        });

        uploadSection.addEventListener('click', () => {
            fileUploadSection.click();
        });

        uploadSection.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadSection.style.borderColor = '#4f46e5';
            uploadSection.style.backgroundColor = '#f5f5ff';
        });

        uploadSection.addEventListener('dragleave', () => {
            uploadSection.style.borderColor = '#d1d5db';
            uploadSection.style.backgroundColor = '#f9fafb';
        });

        uploadSection.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadSection.style.borderColor = '#d1d5db';
            uploadSection.style.backgroundColor = '#f9fafb';
            
            if (e.dataTransfer.files.length > 0) {
                handleFiles(e.dataTransfer.files);
            }
        });

        fileUploadSection.addEventListener('change', () => {
            if (fileUploadSection.files.length > 0) {
                handleFiles(fileUploadSection.files);
            }
        });

        async function submitComplaint() {
            const complaintType = document.getElementById('complaintType');
            const complaintNotes = document.getElementById('complaintNotes');
            const fileInput = document.getElementById('fileUpload');
            const formData = new FormData();
            
            // Make sure orderId is defined
            if (typeof orderId === 'undefined' || !orderId) {
                console.error('Order ID is not defined');
                return;
            }

            // Validate input
            if (!complaintNotes.value.trim()) {
                alert('Please enter complaint details');
                return;
            }

            // Append text fields
            formData.append('order_id', orderId);
            formData.append('complaint_type', complaintType.value);
            formData.append('content', complaintNotes.value);

            // Append files
            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append('proofs[]', fileInput.files[i]);
            }

            try {
                // Make sure this URL matches your backend route
                const response = await fetch('/api/create-complaint', {
                    method: 'POST',
                    body: formData,
                    // No Content-Type header needed for FormData
                });

                console.log(response);                

                // Check if the response is valid JSON
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Server didn't return JSON. Got: " + await response.text());
                }

                const result = await response.json();
                
                if (result.success) {
                    alert('Complaint submitted successfully');
                    // Close popup and reset form
                    document.getElementById('complaintPopup').style.display = 'none';
                    complaintNotes.value = '';
                    fileInput.value = '';
                    document.getElementById('previewContainer').innerHTML = '';
                } else {
                    alert('Failed to submit complaint: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error submitting complaint:', error);
                alert('Error submitting complaint: ' + error.message);
            }
        }

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                if (files[i].type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'preview-image';
                        
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Screenshot preview">
                            <button class="remove-btn">&times;</button>
                        `;
                        
                        previewContainer.appendChild(previewDiv);
                        
                        // Add event listener to remove button
                        previewDiv.querySelector('.remove-btn').addEventListener('click', function() {
                            previewDiv.remove();
                        });
                    }
                    
                    reader.readAsDataURL(files[i]);
                }
            }
        }

        // Initialize
        fetchOrderDetails();
        loadOrderRequirements();
        loadDeliveryData();
        showDeliveryDetails(data);
    });
    </script>
</body>

</html>

