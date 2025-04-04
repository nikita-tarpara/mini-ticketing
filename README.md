**System requirements**

- Operating System:  Linux OR Windows OS
- PHP Version: 8.1+

**Setup Instructions**

1. Clone the Project Repository
- git clone https:...

2. Go to your project directory
    cd /path to project directory

3. Configure the mongodb connections in .env file
   DB_USERNAME
   DB_PASSWORD

4. RUN docker-compose up --build

**Usage**

On Backend side : Use postman

1. POST request to create ticket

   POST http://127.0.0.1:8000/api/login

   Headers:

   Content-Type: application/json

   Body: Type- JSON

   {
       "title": "Ticket 1",
       "description": "Initial ticket",
       "status": "open"
   }
   
    Response that you will get:
   {
       "title": "Ticket 1",
       "description": "Initial ticket",
       "status": "open",
       "updated_at": "2025-04-04T09:55:05.970000Z",
       "created_at": "2025-04-04T09:55:05.970000Z"
   }

2. GET request to fetch tickets

   GET http://127.0.0.1:8000/api/login

   Response that you will get:
    [
        {
        "title": "Ticket 1",
        "description": "Initial ticket",
        "status": "open",
        "updated_at": "2025-04-04T09:55:05.970000Z",
        "created_at": "2025-04-04T09:55:05.970000Z",
        "id": "67efac799e6c4664b40c97d3"
        }
    ]


3. PUT request to edit ticket

   PUT http://127.0.0.1:8000/api/login/{id}
        {id}->it's id of ticket
   
   Headers:

   Content-Type: application/json

    Add parameter in body which is need to update
   Body: Type- JSON

   {
        "status": "in_progress"
   }

   Response that you will get:
   {
       "title": "Ticket 1",
       "description": "Initial ticket",
       "status": "in_progress",
       "updated_at": "2025-04-04T10:02:10.173000Z",
       "created_at": "2025-04-04T09:55:05.970000Z"
   }

3. DELETE request to delete ticket

    DELETE http://127.0.0.1:8000/api/login/{id}
    {id}->it's id of ticket

On Frontend side : Use browser

    link http://127.0.0.1:8000/dashboard
    
