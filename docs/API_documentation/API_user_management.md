# API Documentation

## Endpoints

### 1. Get User List
**Endpoint:** `/users/list`

**Method:** `GET`

**Description:** Fetches a list of users based on search, filters, and query parameters.

**Query Parameters:**
- `search` (optional): A search term to filter users by name or email.
- `role` (optional): Filter users by role (e.g., "businessman", "influencer", "designer").
- `status` (optional): Filter users by account status.
- `limit` (optional, default: 10): Number of users to retrieve.
- `offset` (optional, default: 0): Number of users to skip.
- `order_by` (optional, default: "name"): Column to sort by.
- `order_dir` (optional, default: "asc"): Sort direction ("asc" or "desc").

**Response:**
- `200 OK`: Returns a JSON object with a list of users.
- `400 Bad Request`: Invalid query parameters.
- `500 Internal Server Error`: Failed to fetch the user list.

**Example Response:**
```json
{
  "users": [
    {
      "user_id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "role": "businessman",
      "status": "active"
    }
  ]
}
```

---

### 2. Get User Profile
**Endpoint:** `/users/profile`

**Method:** `GET`

**Description:** Fetches detailed information about a user based on their role.

**Query Parameters:**
- `id` (required): The ID of the user.

**Response:**
- `200 OK`: Returns detailed user profile information.
- `400 Bad Request`: Missing or invalid user ID.
- `404 Not Found`: User not found.

**Example Response:**
```json
{
  "user_id": 1,
  "name": "John Doe",
  "email": "john.doe@example.com",
  "role": "businessman",
  "profile_picture": "profile.jpg",
  "bio": "Entrepreneur",
  "br_details": {
    "business_name": "Doe Enterprises",
    "br_document": "doc123.pdf"
  }
}
```

---

### 3. Update User Profile
**Endpoint:** `/users/profile/update`

**Method:** `POST`

**Description:** Updates user profile details, including creating, updating, or deleting user-specific details.

**Request Body:**
- `user_id` (required): The ID of the user.
- `name` (optional): Updated name.
- `email` (optional): Updated email.
- `profile_picture` (optional): Updated profile picture.
- `bio` (optional): Updated bio.
- Additional role-specific details based on the user role:
  - **Businessman:**
    - `business_name`
    - `br_document`
    - `delete_businessman` (boolean): Whether to delete businessman details.
  - **Influencer:**
    - `influencer_accounts` (array): Array of influencer account details, each with:
      - `platform`, `username`, `link`, and `account_id` (for updates).
      - `delete` (boolean): Whether to delete the account.
  - **Designer:**
    - `designer_projects` (array): Array of project details, each with:
      - `title`, `description`, `image_1`, `image_2`, `image_3`, and `project_id` (for updates).
      - `delete` (boolean): Whether to delete the project.

**Response:**
- `200 OK`: Successfully updated the user profile.
- `400 Bad Request`: Missing or invalid data.
- `404 Not Found`: User not found.
- `500 Internal Server Error`: Failed to update the profile.

**Example Response:**
```json
{
  "message": "User profile updated successfully."
}
```

---

### 4. Delete User Profile
**Endpoint:** `/users/profile/delete`

**Method:** `DELETE`

**Description:** Deletes a user profile based on the provided user ID.

**Request Body:**
- `user_id` (required): The ID of the user to be deleted.

**Response:**
- `200 OK`: Successfully deleted the user profile.
- `400 Bad Request`: Missing or invalid user ID.
- `404 Not Found`: User not found.
- `500 Internal Server Error`: Failed to delete the profile.

**Example Response:**
```json
{
  "message": "User profile deleted successfully."
}
```

---

