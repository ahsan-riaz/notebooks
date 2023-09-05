
# Notebook App: RESTful API Documentation

## Overview

The Notebook App is a RESTful API designed to allow users to create and manage notebooks and their respective notes. This application is built using Laravel paired with MySQL. It has been dockerized for ease of setup and distribution.

## Prerequisites

- Docker & Docker Compose installed
- Postman or another API client (for testing endpoints)

## Setup

### 1. Build and Spin Up Docker Containers

Execute the following commands from the root directory of the project:

```bash
docker-compose build
docker-compose up -d
```

### 2. Database Setup

Create the necessary databases:

- `notebook`: Main database for application data.
- `notebook_test`: Database for testing purposes.

**Note**: Depending on the database container configuration, you might have to log in and create these databases manually.

### 3. Migrate Database

To set up the necessary database tables, execute:

```bash
docker-compose exec web php artisan migrate
```

### 4. Seed the Database with Test User

Populate the database with a test user using:

```bash
docker-compose exec web php artisan db:seed --class=UsersTableSeeder
```

Credentials for the test user are:

- **Email**: `test@example.com`
- **Password**: `password`

## Usage

## Base URL

All endpoints are prefixed with:
```
http://localhost:8080/public/api/v1
```

## Public Endpoints

### Login

**Endpoint**: `/login`

**Method**: `POST`

**Description**: Authenticate the user and return an access token.

**Payload**:
```json
{
    "email": "user@example.com",
    "password": "userpassword"
}
```

**Response**:
- **Success**: Returns an access token.
- **Error**: Descriptive error message.

---

## Authenticated Endpoints

These endpoints require an authentication token to be provided in the request header.

### Fetch Authenticated User

**Endpoint**: `/user`

**Method**: `GET`

**Description**: Retrieve the details of the authenticated user.

**Response**:
- **Success**: Returns the details of the authenticated user.
- **Error**: Descriptive error message.

### Logout

**Endpoint**: `/logout`

**Method**: `POST`

**Description**: Log out the authenticated user, invalidating their token.

**Response**:
- **Success**: A success message confirming the user has been logged out.
- **Error**: Descriptive error message.

### Fetch All Notebooks for Authenticated User

**Endpoint**: `/usernotebooks`

**Method**: `GET`

**Description**: Fetch all notebooks associated with the authenticated user.

**Response**:
- **Success**: Returns a list of notebooks.
- **Error**: Descriptive error message.

### CRUD Operations for Notebooks

This set of endpoints allows for the creation, retrieval, updating, and deletion of notebooks.

- **Create**: `POST /notebooks`
- **Read**: `GET /notebooks/{notebookId}`
- **Update**: `PUT /notebooks/{notebookId}`
- **Delete**: `DELETE /notebooks/{notebookId}`

### Fetch Notes for a Specific Notebook

**Endpoint**: `/notebooks/{notebook}/notes`

**Method**: `GET`

**Description**: Fetch all notes associated with a specific notebook.

**Response**:
- **Success**: Returns a list of notes.
- **Error**: Descriptive error message.

### CRUD Operations for Notes

This set of endpoints allows for the creation, retrieval, updating, and deletion of notes.

- **Create**: `POST /notes`
- **Read**: `GET /notes/{noteId}`
- **Update**: `PUT /notes/{noteId}`
- **Delete**: `DELETE /notes/{noteId}`


