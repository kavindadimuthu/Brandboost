<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            max-width: 60%;
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
            max-height: 300px;
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
        padding: 20px;
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

        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .backdrop.active {
            display: block;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #6b7280;
        }

        .file-list {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
        }

        .file-item i {
            margin-right: 10px;
            color: #4f46e5;
        }

        /* Popups */
        .popup,
        .cancel-popup {
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
            max-width: 420px;
        }

        .popup.active,
        .cancel-popup.active {
            display: block;
        }

        .popup h4,
        .cancel-popup h4 {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 16px;
            color: #111827;
        }

        .popup p,
        .cancel-popup p {
            font-size: 0.95em;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .popup button,
        .cancel-popup button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .popup button:hover,
        .cancel-popup button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        .popup .close-btn,
        .cancel-popup .close-btn {
            position: absolute;
            top: 12px;
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
        .cancel-popup .close-btn:hover {
            color: #374151;
            transform: none;
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

        .timer-bar {
            height: 100%;
            background-color: #4f46e5;
            border-radius: 3px;
            transition: width 1s linear;
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

        .file-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.9em;
            transition: all 0.2s;
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
    max-width: 500px;
}

.complaint-popup.active {
    display: block;
    animation: popIn 0.3s forwards;
}

.complaint-dropdown {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95em;
    background-color: #ffffff;
    color: #1f2937;
    margin-bottom: 10px;
}

.complaint-dropdown:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
}

.complaintSupport {
    position: absolute;
    top: 12px;
    right: 16px;
    font-size: 1.2em;
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 4px;
    transition: all 0.2s;
}

.complaintSupport:hover {
    color: #374151;
}
.cancellation-request {
    margin-top: 20px;
    background-color: #fff5f5;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 16px;
}

.cancellation-request h4 {
    color: #dc2626;
    margin-top: 0;
    margin-bottom: 12px;
    font-size: 1.1em;
    font-weight: 600;
    border-bottom: 1px solid #fecaca;
    padding-bottom: 8px;
}

.cancellation-details {
    margin-bottom: 16px;
}

.cancellation-reason {
    white-space: pre-line;
    margin-bottom: 8px;
}

.cancellation-actions {
    display: flex;
    gap: 12px;
}

.accept-button {
    background-color: #dc2626 !important;
    color: #ffffff !important;
    border: none !important;
}

.accept-button:hover {
    background-color: #b91c1c !important;
}

.decline-button {
    background-color: #ffffff !important;
    color: #1f2937 !important;
    border: 1px solid #d1d5db !important;
}

.decline-button:hover {
    background-color: #f3f4f6 !important;
}
.file-thumbnail {
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 4px;
    margin-right: 12px;
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.file-thumbnail img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.file-item {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    background-color: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 0.9em;
    transition: all 0.2s;
    margin-bottom: 8px;
}
/* Add this to your existing style section */
.gig-preview {
    margin-top: 20px;
    background-color: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.gig-card {
    display: flex;
    gap: 16px;
    margin-top: 12px;
}

.gig-image {
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.gig-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gig-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.gig-info h5 {
    margin: 0 0 8px 0;
    font-size: 1.05em;
    font-weight: 600;
    color: #111827;
}

.gig-category {
    font-size: 0.85em;
    color: #6b7280;
    margin-bottom: 12px;
}

.gig-price {
    margin-top: auto;
    font-weight: 600;
    font-size: 1.1em;
    color: #111827;
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
                        <!-- <div id="countdown"></div> -->
                        <button id="deliverNow">Deliver Now</button>
                        <button class="cancel-button" id="cancelOrder" style="display: none;">Request order cancellation</button>
                    </div>
                    <div class="gig-preview">
                    <h4>Gig Details</h4>
                    <div class="gig-card">
                        <div class="gig-image">
                            <img id="gigImage" src="" alt="Gig image">
                        </div>
                        <div class="gig-info">
                            <h5 id="gigTitle">Loading gig title...</h5>
                            <!-- <p id="gigCategory" class="gig-category">Category</p> -->
                            <div class="gig-price">
                                <span id="gigPrice">LKR0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Add this right after the cancel-button -->
                <div class="cancellation-request" id="cancellationRequestSection" style="display: none;">
                    <h4>Order Cancellation Request</h4>
                    <div class="cancellation-details">
                        <p class="cancellation-reason"><strong>Reason:</strong> <span id="cancellationReason"></span></p>
                    </div>
                    <div class="cancellation-actions">
                        <button class="accept-button" id="acceptCancellation">Accept Cancellation</button>
                        <button class="decline-button" id="declineCancellation">Decline</button>
                    </div>
                </div>
                <div class="cancellation-request" id="cancellationRequestSectionSender" style="display: none;">
                    <h4>Order Cancellation Request</h4>
                    <div class="cancellation-details">
                        <p class="cancellation-reason"><strong>Reason:</strong> <span id="cancellationReasonSendert"></span></p>
                    </div>
                    <div class="cancellation-actions">
                        <button class="decline-button" id="declineCancellationSender">Cancel</button>
                    </div>
                </div>
                    <div class="order-details">
                        <h4>Order Details</h4>
                        <p><strong>Ordered By:</strong> <span id="orderedBy"></span></p>
                        <p><strong>Date:</strong> <span id="orderDate"></span></p>
                        <p><strong>Due:</strong> <span id="orderDue"></span></p>
                    </div>
                    <div class="support-section">
                        <h4>Support</h4>
                            <button id="Complaint">Complaint</button>
                        </a>
                        <button id="reviewOrder">Review</button>
                    </div>
                </div>
                
            </div>

                        <!-- Order Requirements Section -->
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

    <!-- Delivery Form Popup -->
    <div class="delivery-popup" id="deliveryPopup">
        <button class="close-btn" id="closeDeliveryPopup">&times;</button>
        <h4>Submit Delivery</h4>
        <div class="form-group">
            <label for="contentLink">Content Link</label>
            <input type="text" id="contentLink" placeholder="https://instagram.com/p/..." />
            <div class="note">Please provide the direct link to your Instagram post, YouTube video, TikTok, etc.</div>
        </div>
        <div class="form-group">
            <label for="deliveryNotes">Delivery Notes</label>
            <textarea id="deliveryNotes" placeholder="Any additional information about your delivery..."></textarea>
        </div>
        <div class="form-group">
            <label>Analytics Proof</label>
            <div class="screenshot-upload">
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Upload Analytics Screenshots</h4>
                    <p>Upload engagement metrics, reach, impressions, etc. (JPG, PNG up to 5MB)</p>
                    <input type="file" id="fileUpload" style="display: none;" multiple accept="image/*" />
                </div>
                <div class="preview-images" id="previewContainer">
                    <!-- Preview images will appear here -->
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <button class="cancel-btn" id="cancelDelivery">Cancel</button>
            <button class="submit-btn" id="submitDelivery">Submit Delivery</button>
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
        <div class="upload-area" id="complaintUploadArea">
            <i class="fas fa-file-upload"></i>
            <h4>Upload Proofs</h4>
            <p>Click or drag files here (JPG, PNG, MP4 up to 10MB)</p>
            <input type="file" id="complaintFileUpload" style="display: none;" multiple accept="image/*,video/mp4" />
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

    <!-- Image Preview Modal -->
    <div class="image-preview-modal" id="imagePreviewModal">
        <button class="close-preview" id="closeImagePreview">&times;</button>
        <img id="previewImage" src="" alt="Screenshot preview" />
    </div>

    <!-- Backdrop overlay -->
    <div class="backdrop" id="backdrop"></div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const username = document.getElementById('username');
    const chatBox = document.getElementById('chatBox');
    const orderedBy = document.getElementById('orderedBy');
    const orderDate = document.getElementById('orderDate');
    const orderDue = document.getElementById('orderDue');
    const countdown = document.getElementById('countdown');
    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    const progressBar = document.getElementById('progressBar');
    const deliverableCount = document.getElementById('deliverableCount');
    
    // Popups and Overlays
    const reviewPopup = document.getElementById('reviewPopup');
    const cancelPopup = document.getElementById('cancelPopup');
    const deliveryPopup = document.getElementById('deliveryPopup');
    const deliveryDetailsPopup = document.getElementById('deliveryDetailsPopup');
    const complaintPopup = document.getElementById('complaintPopup');
    const backdrop = document.getElementById('backdrop');
    const imagePreviewModal = document.getElementById('imagePreviewModal');
    const previewImage = document.getElementById('previewImage');

    // Extract orderId from the URL
    const pathSegments = window.location.pathname.split('/');
    const orderId = pathSegments[pathSegments.length - 1]; // Get the last segment of the URL

    // ==========================================
    // ORDER DATA FUNCTIONS
    // ==========================================
    
    // Fetch order details from API
    async function fetchOrderDetails() {
        try {
            const response = await fetch(`/api/order/${orderId}?order_id=${orderId}&include_user=true`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();

            console.log('Order details:', result);

            // Render order details
            username.textContent = result.data.user.name;
            orderedBy.textContent = result.data.user.name;
            orderDate.textContent = new Date(result.data.order.created_at.replace(' ', 'T')).toLocaleString();

            // Calculate due date
            const createdDate = new Date(result.data.order.created_at.replace(' ', 'T'));
            const deliveryDays = result.data.promise.delivery_days;
            const dueDate = new Date(createdDate.getTime() + deliveryDays * 24 * 60 * 60 * 1000);
            orderDue.textContent = dueDate.toLocaleString();

            // Check if order is already cancelled
            const isCancelled = result.data.order.status === 'cancelled' || 
                            result.data.order.cancellation_status === 'accepted';

            if (isCancelled) {
                // Hide time left section content
                document.querySelector('.timer-display').style.display = 'none';
                document.querySelector('.timer-progress').style.display = 'none';
                document.getElementById('deliverNow').style.display = 'none';
                
                // Show "Order Cancelled" message
                const timeLeftCard = document.querySelector('.time-card');
                timeLeftCard.innerHTML = '<div class="cancelled-order-message">Order Cancelled</div>';
                timeLeftCard.style.backgroundColor = '#fee2e2';
                
                // Hide cancellation request section if visible
                document.getElementById('cancellationRequestSection').style.display = 'none';
                
                // Hide cancel order button
                document.getElementById('cancelOrder').style.display = 'none';
            } else {
                // Start countdown for active orders
                startCountdown(dueDate, createdDate);
                
                // Check for cancellation request
                checkCancellationRequest(result.data);
                
                // Update cancel button visibility
                updateCancelButtonVisibility(result.data);
            }

            // Add CSS for cancelled message if it doesn't exist
            if (!document.querySelector('style').textContent.includes('.cancelled-order-message')) {
                const styleTag = document.createElement('style');
                styleTag.textContent = `
                    .cancelled-order-message {
                        color: #b91c1c;
                        font-size: 1.2em;
                        font-weight: 600;
                        padding: 20px;
                        text-align: center;
                    }
                `;
                document.head.appendChild(styleTag);
            }

            // Render chat messages (if applicable)
            if (result.data.messages) {
                // (existing chat message rendering code)
            }

        } catch (error) {
            console.error('Error fetching order details:', error);
        }
    }

    // Load order requirements and display files
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

    // ==========================================
    // DELIVERY FUNCTIONS
    // ==========================================

    // Load delivery data and set up the table
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

    // Show delivery details in popup
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
        if (data.revision_note) {
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
        } else {
            document.getElementById('revisionSection').style.display = 'none';
        }
    }

    // Submit new delivery
    async function submitDelivery() {
        const contentLink = document.getElementById('contentLink').value;
        const deliveryNotes = document.getElementById('deliveryNotes').value;
        const previewContainer = document.getElementById('previewContainer');
        
        // Validate form
        if (!contentLink) {
            alert('Please provide a content link');
            return;
        }
        
        // Get all preview images
        const screenshots = Array.from(previewContainer.querySelectorAll('.preview-image img')).map(img => img.src);
        
        if (screenshots.length === 0) {
            alert('Please upload at least one screenshot as proof');
            return;
        }
        
        try {
            // Show loading state
            const submitBtn = document.getElementById('submitDelivery');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            // Create FormData for file uploads
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('content_link', contentLink);
            formData.append('delivery_note', deliveryNotes);
            
            // Convert base64 screenshots to files and append them
            for (let i = 0; i < screenshots.length; i++) {
                // Skip the data URL prefix to get just the base64 data
                const base64Data = screenshots[i].split(',')[1];
                const blob = await fetch(screenshots[i]).then(r => r.blob());
                formData.append('deliveries[]', blob, `screenshot_${i+1}.png`);
            }
            
            // Send data to the server
            const response = await fetch('/api/createDelivery', {
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) {
                throw new Error(`Server responded with status: ${response.status}`);
            }
            
            const result = await response.json();
            
            // Close popup
            deliveryPopup.classList.remove('active');
            backdrop.classList.remove('active');
            
            // Reset form
            document.getElementById('contentLink').value = '';
            document.getElementById('deliveryNotes').value = '';
            previewContainer.innerHTML = '';
            
            // Show success message
            alert('Delivery submitted successfully!');
            
            // Refresh delivery data to show the new submission
            await loadDeliveryData();
            
        } catch (error) {
            console.error('Error submitting delivery:', error);
            alert(`Failed to submit delivery. Please try again. Error: ${error.message}`);
        } finally {
            // Reset button state
            const submitBtn = document.getElementById('submitDelivery');
            submitBtn.textContent = 'Submit Delivery';
            submitBtn.disabled = false;
        }
    }

    // ==========================================
    // CANCELLATION FUNCTIONS
    // ==========================================
    
    // Update cancel button visibility
    function updateCancelButtonVisibility(orderData) {
        const cancelButton = document.getElementById('cancelOrder');
        // Show the button only if there's no cancellation reason
        if (orderData && orderData.order && !orderData.order.order_cancellation_reason) {
            cancelButton.style.display = 'block';
        } else {
            cancelButton.style.display = 'none';
        }
    }

    // Check for cancellation requests
    function checkCancellationRequest(orderData) {
        // Get the cancellation section
        const cancellationSection = document.getElementById('cancellationRequestSection');
        const cancellationSectionSender = document.getElementById('cancellationRequestSectionSender');
        
        // Check if the order has already been cancelled and accepted
        if (orderData && orderData.order && orderData.order.cancellation_acceptancy === 'yes') {
            // Hide the cancellation section
            cancellationSection.style.display = 'none';
            
            // Hide time left section content
            document.querySelector('.timer-display').style.display = 'none';
            document.querySelector('.timer-progress').style.display = 'none';
            document.getElementById('deliverNow').style.display = 'none';
            
            // Show "Order Cancelled" message
            const timeLeftCard = document.querySelector('.time-card');
            timeLeftCard.innerHTML = '<div class="cancelled-order-message">Order Cancelled</div>';
            timeLeftCard.style.backgroundColor = '#fee2e2';
            
            // Hide cancel order button
            document.getElementById('cancelOrder').style.display = 'none';
            return;
        }
        
        // Check if there is an order cancellation reason
        if (orderData && orderData.order && orderData.order.order_cancellation_reason) {
            // Show the cancellation section       
            if (orderData.order.cancellation_requested_by === 'designer' || orderData.order.cancellation_requested_by === 'influencer') {
                cancellationSectionSender.style.display = 'block';
            } else {
                cancellationSection.style.display = 'block';
            }   
            
            // Set the reason
            document.getElementById('cancellationReason').textContent = orderData.order.order_cancellation_reason;
            document.getElementById('cancellationReasonSendert').textContent = orderData.order.order_cancellation_reason;
            
            // Set the time if available
            if (orderData.order.cancellation_requested_at) {
                document.getElementById('cancellationTime').textContent = 
                    new Date(orderData.order.cancellation_requested_at.replace(' ', 'T')).toLocaleString();
            } else {
                document.getElementById('cancellationTime').textContent = 'Unknown';
            }
        } else {
            // Hide the section if no cancellation reason
            cancellationSection.style.display = 'none';
            cancellationSectionSender.style.display = 'none'
        }
    }

    // Request cancellation
    async function requestCancellation() {
        const cancelReason = document.getElementById('cancelReason').value;
        
        // Validate input
        if (!cancelReason.trim()) {
            alert('Please provide a reason for cancellation');
            return;
        }
        
        try {
            // Create FormData to match the controller's expected format
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('order_cancellation_reason', cancelReason);
            
            console.log('FormData:', formData.get('order_id'), formData.get('order_cancellation_reason'));

            // Make sure this URL matches your backend route
            const response = await fetch('/api/order-cancellation', {
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) {
                throw new Error(`Server responded with status: ${response.status}`);
            }
            
            const result = await response.json();

            if (result.success) {
                alert('Cancellation request submitted successfully');
            } else {
                alert('Failed to submit cancellation request: ' + result.message);
            }
            
        } catch (error) {
            console.error('Error submitting cancellation:', error);
            alert('Failed to submit cancellation request. Please try again.');
        }
        
        cancelPopup.classList.remove('active');
        backdrop.classList.remove('active');
    }

    // Handle cancellation acceptance
    async function acceptCancellation() {
        if (confirm('Are you sure you want to accept this cancellation request? This action cannot be undone.')) {
            try {
                const formData = new FormData();
                formData.append('order_id', orderId);
                formData.append('status', 'accepted');
                
                // Log individual FormData entries for better debugging
                console.log('Form data:');
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }
                
                const response = await fetch('/api/respond-to-cancellation', {
                    method: 'POST',
                    body: formData
                });
                
                if (!response.ok) {
                    throw new Error(`Server responded with status: ${response.status}`);
                }
                
                const result = await response.json();
                console.log('Response:', result); // Log the response for debugging
                
                if (result.success) {
                    alert(result.message);
                    
                    // Hide cancellation request section
                    document.getElementById('cancellationRequestSection').style.display = 'none';
                    
                    // Hide time left section content
                    document.querySelector('.timer-display').style.display = 'none';
                    document.querySelector('.timer-progress').style.display = 'none';
                    document.getElementById('deliverNow').style.display = 'none';
                    
                    // Show "Order Cancelled" message
                    const timeLeftCard = document.querySelector('.time-card');
                    timeLeftCard.innerHTML = '<div class="cancelled-order-message">Order Cancelled</div>';
                    timeLeftCard.style.backgroundColor = '#fee2e2';
                    
                    // Add CSS for the cancelled message if it doesn't exist
                    if (!document.querySelector('style').textContent.includes('.cancelled-order-message')) {
                        const styleTag = document.createElement('style');
                        styleTag.textContent = `
                            .cancelled-order-message {
                                color: #b91c1c;
                                font-size: 1.2em;
                                font-weight: 600;
                                padding: 20px;
                                text-align: center;
                            }
                        `;
                        document.head.appendChild(styleTag);
                    }
                } else {
                    alert('Failed to accept cancellation request: ' + result.message);
                }
            } catch (error) {
                console.error('Error accepting cancellation:', error);
                alert('Failed to accept cancellation request. Please try again.');
            }
        }
    }

    // Handle cancellation declination
    async function declineCancellation() {
        if (confirm('Are you sure you want to decline this cancellation request?')) {
            try {
                const formData = new FormData();
                formData.append('order_id', orderId);
                formData.append('status', 'declined');
                
                const response = await fetch('/api/respond-to-cancellation', {
                    method: 'POST',
                    body: formData
                });
                
                if (!response.ok) {
                    throw new Error(`Server responded with status: ${response.status}`);
                }
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Cancellation request declined');
                    document.getElementById('cancellationRequestSection').style.display = 'none';
                } else {
                    alert('Failed to decline cancellation request: ' + result.message);
                }
            } catch (error) {
                console.error('Error declining cancellation:', error);
                alert('Failed to decline cancellation request. Please try again.');
            }
        }
    }

    // ==========================================
    // COMPLAINT FUNCTIONS
    // ==========================================
    
    // Submit complaint
    async function submitComplaint() {
        const complaintType = document.getElementById('complaintType');
        const complaintNotes = document.getElementById('complaintNotes');
        const fileInput = document.getElementById('complaintFileUpload');
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

    // ==========================================
    // UTILITY FUNCTIONS
    // ==========================================
    
    // Start countdown timer
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
                document.getElementById('deliverNow').disabled = false;
                
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
                
                // Update countdown text if the element exists
                if (countdownElement) {
                    countdownElement.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s remaining`;
                }
            }
        }, 1000);
    }

    // Handle file uploads for delivery
    function handleFiles(files) {
        const previewContainer = document.getElementById('previewContainer');
        
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

    // Handle file uploads for complaint
    function handleComplaintFiles(files) {
        const previewContainer = document.querySelector('#complaintPopup #previewContainer');
        
        for (let i = 0; i < files.length; i++) {
            if (files[i].type.startsWith('image/') || files[i].type === 'video/mp4') {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'preview-image';
                    
                    if (files[i].type.startsWith('image/')) {
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Proof preview">
                            <button class="remove-btn">&times;</button>
                        `;
                    } else {
                        // For video files
                        previewDiv.innerHTML = `
                            <video width="100" height="100" controls>
                                <source src="${e.target.result}" type="${files[i].type}">
                            </video>
                            <button class="remove-btn">&times;</button>
                        `;
                    }
                    
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

    async function loadGigDetails() {
    try {
        const response = await fetch(`/api/order/${orderId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch order details');
        }
        
        const result1 = await response.json();
        console.log('Order details:', result1);

        const id = result1.data.order.service_id;
        console.log('Service ID:', id);

        const response2 = await fetch(`/api/service/${id}`);
        if (!response2.ok) {
            throw new Error('Failed to fetch service details');
        }

        const result = await response2.json();
        console.log('Gig details:', result);
        
        // Update gig image
        const gigImage = document.getElementById('gigImage');
        if (result.cover_image) {
            let imageUrl;
            
            // Handle different possible formats of cover_image
            if (typeof result.cover_image === 'string') {
                // Direct string path
                if (result.cover_image.startsWith('[') || result.cover_image.startsWith('{')) {
                    // It's a JSON string, need to parse
                    try {
                        const parsed = JSON.parse(result.cover_image);
                        if (Array.isArray(parsed) && parsed.length > 0) {
                            imageUrl = parsed[0];
                        } else {
                            imageUrl = parsed.path || parsed.url || parsed;
                        }
                    } catch (e) {
                        console.error('Error parsing cover_image JSON:', e);
                        imageUrl = result.cover_image;
                    }
                } else {
                    // Simple string path
                    imageUrl = result.cover_image;
                }
            } else if (Array.isArray(result.cover_image) && result.cover_image.length > 0) {
                // Array format
                imageUrl = result.cover_image[0];
            } else if (typeof result.cover_image === 'object') {
                // Object format
                imageUrl = result.cover_image.path || result.cover_image.url;
            }
            
            // Ensure the path starts with a slash
            if (imageUrl && !imageUrl.startsWith('http') && !imageUrl.startsWith('/')) {
                imageUrl = '/' + imageUrl;
            }
            
            console.log('Setting gig image URL:', imageUrl);
            gigImage.src = imageUrl;
        } else {
            gigImage.src = '/assets/cover_image/default-gig.jpg';
        }
            
        // Update gig title
        // Create link to gig page
        const gigTitle = document.getElementById('gigTitle');
        const serviceLink = document.createElement('a');
        serviceLink.href = `/services/${id}`;
        serviceLink.textContent = result.title || 'No title available';
        serviceLink.style.textDecoration = 'none';
        serviceLink.style.color = '#111827';
        serviceLink.style.fontWeight = '600';
        serviceLink.style.display = 'block';
        serviceLink.target = '_blank'; // Open in new tab
        gigTitle.innerHTML = ''; // Clear existing content
        gigTitle.appendChild(serviceLink);
        
        document.getElementById('gigPrice').textContent = "LKR " + (result1.data.promise.price || 'Price not available');


            
    } catch (error) {
        console.error('Error loading gig details:', error);
        document.getElementById('gigTitle').textContent = 'Error loading gig details';
        document.getElementById('gigImage').src = '/assets/cover_image/default-gig.jpg';
    }
}

    // ==========================================
    // EVENT LISTENERS
    // ==========================================

    // Review popup
    document.getElementById('reviewOrder').addEventListener('click', () => {
        reviewPopup.classList.add('active');
        backdrop.classList.add('active');
    });

    document.getElementById('closePopup').addEventListener('click', () => {
        reviewPopup.classList.remove('active');
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

    // Submit review
    document.getElementById('submitReview').addEventListener('click', () => {
        const stars = document.querySelectorAll('.stars .fa-star.active');
        const rating = stars.length;
        // Send rating to the server
        console.log('Rating submitted:', rating);
        reviewPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    // Cancel order popup
    document.getElementById('cancelOrder').addEventListener('click', () => {
        cancelPopup.classList.add('active');
        backdrop.classList.add('active');
    });

    document.getElementById('closeCancelPopup').addEventListener('click', () => {
        cancelPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    // Request cancellation
    document.getElementById('requestCancel').addEventListener('click', () => {
        requestCancellation();
    });

    // Cancellation acceptance/decline
    document.getElementById('acceptCancellation').addEventListener('click', () => {
        acceptCancellation();
    });

    document.getElementById('declineCancellation').addEventListener('click', () => {
        declineCancellation();
    });

    document.getElementById('declineCancellationSender').addEventListener('click', () => {
        declineCancellation();
    });

    // Delivery popup
    document.getElementById('deliverNow').addEventListener('click', () => {
        deliveryPopup.classList.add('active');
        backdrop.classList.add('active');
    });

    document.getElementById('closeDeliveryPopup').addEventListener('click', () => {
        deliveryPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    document.getElementById('cancelDelivery').addEventListener('click', () => {
        deliveryPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    document.getElementById('submitDelivery').addEventListener('click', () => {
        submitDelivery();
    });

    // Complaint popup
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
        submitComplaint();
        complaintPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    // Delivery details popup
    document.getElementById('closeDetailsPopup').addEventListener('click', () => {
        deliveryDetailsPopup.classList.remove('active');
        backdrop.classList.remove('active');
    });

    // File upload handlers
    const uploadArea = document.getElementById('uploadArea');
    const fileUpload = document.getElementById('fileUpload');
    
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

    fileUpload.addEventListener('change', () => {
        if (fileUpload.files.length > 0) {
            handleFiles(fileUpload.files);
        }
    });

    // Complaint file upload handlers
    const complaintUploadArea = document.querySelector('#complaintPopup .upload-area');
    const complaintFileUpload = document.getElementById('complaintFileUpload');

    complaintUploadArea.addEventListener('click', () => {
        complaintFileUpload.click();
    });

    complaintUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        complaintUploadArea.style.borderColor = '#4f46e5';
        complaintUploadArea.style.backgroundColor = '#f5f5ff';
    });

    complaintUploadArea.addEventListener('dragleave', () => {
        complaintUploadArea.style.borderColor = '#d1d5db';
        complaintUploadArea.style.backgroundColor = '#f9fafb';
    });

    complaintUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        complaintUploadArea.style.borderColor = '#d1d5db';
        complaintUploadArea.style.backgroundColor = '#f9fafb';
        
        if (e.dataTransfer.files.length > 0) {
            handleComplaintFiles(e.dataTransfer.files);
        }
    });

    complaintFileUpload.addEventListener('change', () => {
        if (complaintFileUpload.files.length > 0) {
            handleComplaintFiles(complaintFileUpload.files);
        }
    });

    // Chat functionality
    document.getElementById('sendMessage').addEventListener('click', () => {
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();
        
        if (message) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'sent');
            messageElement.textContent = message;
            chatBox.appendChild(messageElement);
            
            // Clear input
            messageInput.value = '';
            
            // Scroll to bottom of chat
            chatBox.scrollTop = chatBox.scrollHeight;
            
            // Here you would also send the message to your backend
        }
    });

    // ==========================================
    // INITIALIZATION
    // ==========================================
    fetchOrderDetails();
    loadDeliveryData();
    loadGigDetails();
    loadOrderRequirements();
});
        </script>
    </body>
</html>