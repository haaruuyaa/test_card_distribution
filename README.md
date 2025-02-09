# Card Distribution Application

## Overview
This application distributes a standard deck of 52 playing cards among a specified number of people. The backend is written in PHP (version 7.4) and serves as an API, while the frontend uses HTML, CSS, and JavaScript (with jQuery) to interact with the backend. The application is containerized using Docker for easy deployment.

---

## Requirements
- **PHP 7.4**
- **jQuery** (included via CDN)
- **Docker** (for running the backend)
- **Postman** or **cURL** (optional, for testing the backend API)

---

## Setup Instructions
### 1. Clone the Repository
```bash
git clone <repository-url>
cd test_card_distribution
cd backend
docker compose up -d --build #start docker container in detached mode
```

### 2. Now you can open the file in `frontend` folder with name `index.html` to test the distribution of the card logic


