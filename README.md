# Installation
Run `make build` in order to install all application dependencies (you must have Docker installed).

This command will also populate the database with data, just in case you want to perform some requests.

# How to use this app
This app exposes a **two-endpoints-API** . You can use the **hotels/{id}** endpoint in order to retrieve all the information about one specific hotel, or use the **hotels/** endpoint to view all the available info.

Go to the `{PROJECT_FOLDER}/etc/endpoints/booking_tracker_api.http` file, and you'll find some prepared requests. 
- If you are using `phpStorm`, the IDE will show a "Run all requests" option when opening said file.
- If you prefer going with another HTTP client (like Postman or a web-browser), the file contains all the necessary information to help you to create your own requests.

## Exactly, what kind of pre-generated data does this app have?
Good question. **There are only two hotels defined in the database**, but you can add more if you want. 
I prefer keeping things simple, so I created the following structure:
- Hotel Overlook: **615cf276-f66c-4c6b-9c68-ba6f438f4c78** has six different bookings:
    - Guest *Jack Torrance* booked twice (he chose `single` and `double` room).
    - Guest *Wendy Torrance* booked thrice (she always chose the `double` room)-
    - Guest *Danny Torrance* booked only once but at least he chose the `suite`.
- Bates Motel: **88694bad-7660-4c79-9ea4-0cf80ef9f621** has six different bookings too:
    - Guest *Norman Bates* booked thrice the same room (he chose `single`).
    - Guest *Marion Crane* booked only once, but she chose the `suite`. A well-tasted woman indeed.
    - Guest *Sam Loomis* booked twice (he chose `suite` and `double`).

## What about testing?
Simply execute `make test` to run all unit tests. Please note this command needs the app to be turned on.

## Can I manipulate or view the database?
Sure! The app has a PHPMyAdmin service running at http://localhost:8006, feel free to use this client to adapt the database at your own needs. 

# About the project structure...
Since the technical test is very solution-open, I chose to create an API REST with only one endpoint (using the GET verb because we are requesting data from the server).

I used Symfony as framework but in a decoupled way: you'll find all the framework data in its own folder (`apps/BookingTrackerApi`), and 
I chose `Messenger` as a bus in order to connect the Symfony controllers and the `src` folder.

As for the `src` folder, I decided to create two different contexts:
- `Shared`: here I placed all the repetitive classes that are used in the other contexts (e.g., primitive Value Objects, Collections...)
- `BookingTracker`: here you'll find all the code relative to the exercise separated by the three layers (Application, Domain, Infrastructure).
