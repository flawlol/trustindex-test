# Trustindex - Symfony project

## Project Description
This is a Symfony application built with Docker. It allows users to submit and view reviews for companies.

## Requirements
- Docker
- Docker Compose

## Setup Instructions

1. **Clone the Repository:**
   ```bash
   git clone <repository-url>
   cd <repository-directory>


2**Copy Environment File::**
    ```bash
    cp .env.example .env
    ```


3. **Start the Application::**
   Run the following command to start the application and set up the environment:
4. ```bash
   docker-compose up -d
   ```

This command will build the Docker containers and install the dependencies using Composer (this is handled in the entrypoint.sh script).

4. **Access the Application::**
Open your web browser and go to http://127.0.0.1/ to access the application.


## Additional Commands
- **Run Migrations:**
   ```bash
   docker-compose exec php bin/console doctrine:migrations:migrate
    ```

  View Logs:
   ```bash

    docker-compose logs -f
   ```

## **Endpoints:**
  - Base URL: http://127.0.0.1/
  - Create new review: http://127.0.0.1/review/new
  - Show review by ID: http://127.0.0.1/review/{id}
 
## License
This project is licensed under the MIT License.