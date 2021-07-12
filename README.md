# Installation
Run `make build` in order to install all application dependencies (you must have Docker installed).

This command will also populate the database with data, just in case you want to perform some requests.

# How to play with this app
This app exposes an **one-endpoint-API** . You can use the **hotels/{id}** endpoint in order to retrieve all the information about the {id} hotel.

Go to the `{PROJECT_FOLDER}/etc/endpoints/booking_tracker_api.http` file and you'll find some prepared requests. 
- If you are using `phpStorm`, the IDE will show a "Run all requests" option when opening said file.
- If you prefer another HTTP client (like Postman or a web-browser), the file contains all the necessary information.

## Exactly, what kind of pre-generated data I'll find in this app?
Good question. There are only two hotels defined in the database, but you could add more if you want. 
I prefer keeping things simple so I created the following structure:
- Hotel Overlook: **615cf276-f66c-4c6b-9c68-ba6f438f4c78** has six different bookings:
    - Guest *Jack Torrance* booked twice.
    - Guest *Wendy Torrance* booked thrice (she enjoyed the views I guess)
    - Guest *Danny Torrance* booked only once but at least he chose the suite. Good for you, Danny.
- Bates Motel: **88694bad-7660-4c79-9ea4-0cf80ef9f621** has six different bookings too:
    - Guest *Norman Bates* booked thrice the same room (he was a very lonely guy)
    - Guest *Marion Crane* booked only once, but she chose the suite. A well-tasted woman indeed.
    - Guest *Sam Loomis* booked twice.

# About the project structure...
Since the technical test is very solution-open, I chose to create a API REST with only one endpoint (using the GET verb because we are performing a query).

I used Symfony as framework but in a decoupled way: you'll find all the framework data in its own folder (`apps/BookingTrackerApi`) and 
I chose `Messenger` as a command bus in order to connect the Symfony controllers and the `src` folder.

As for the `src` folder, I decided to create two different contexts:
- `Shared`: here I placed all the repetitive classes that are used in the other contexts (e.g., primitive Value Objects, Collections...)
- `BookingTracker`: here you'll find all the code relative to the exercise separated by the three layers (Application, Domain, Infrastructure).
