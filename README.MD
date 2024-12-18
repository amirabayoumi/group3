# FASE 1: CLIENT SIDE

    $ npm run dev | npm start
    $ npm run build
    $ npm run preview

# FASE 2: SERVER SIDE WITH PHP

    $ npm run build:php => exports css and js for php files in watch-mode
    $ npm run preview:php => to use php built-in webserver. (XAMPP or MAMP can also be used...)

> Do not use /public folder for static assets when using build:php. Because Vite does not scan your html in the php file. It only exports and bundles js and css.
> So just use a /images folder.

# Pet Paradise

Pet Paradise is a dynamic platform designed to cater to the needs of pet owners. It offers an easy-to-navigate interface for exploring and purchasing a variety of pet products, from toys and food to grooming supplies. The platform provides both a feature-rich shopping experience for users and comprehensive management tools for administrators.

## Features

### User Features

- **Homepage**: Filter and sort products by categories, price, and popularity.
- **Product Detail Page**: View detailed product information, multiple images, and personalized recommendations.
- **Wishlist**: Save favorite products (available for logged-in users).
- **Shopping Cart**: Add products and proceed to checkout.

### Admin Features

- **Admin Dashboard**: Manage products, categories, and users.
- **CRUD Operations**:
  - Categories: Add, edit, and delete product categories.

## Technologies Used

- **Frontend**:
  - HTML and CSS for the user interface.
  - JavaScript (optional) for interactive features.
- **Backend**:
  - PHP for server-side logic and database interactions.
- **Database**: MySQL, with structured tables for Products, Categories, and Users.
- **Additional Tools**:
  - Bootstrap for styling the admin interface.
  - APIs for extended functionality:
    - **Fun Translations API**: Adds entertainment value by translating product descriptions into fun styles like Pirate, Yoda, or Shakespearean English.
    - **OpenWeather API**: Recommends weather-specific pet products and displays real-time weather widgets.

## Additional Features (Nice-to-Have)

- Product galleries with zoom functionality.
- "Product of the Day" section showcasing a highlighted item.
- Thematic translations for special events, e.g., Pirate Day.
- Outdoor product suggestions based on weather data.

## API Integrations

### Fun Translations API

This API translates product descriptions into fun styles for user entertainment.  
**Example**:

- Original: _"This cozy pet bed is perfect for your furry friend."_
- Pirate Style: _"Arrr! This cozy bed be perfect fer yer furry matey."_
- Yoda Style: _"Perfect for your furry friend, this bed is."_

### OpenWeather API

This API provides real-time weather data, forecasts, and alerts.  
**Example**:

- Input: _Location: Amsterdam_
- Output: _"Current Weather: 12°C, Light Rain."_
- Suggestion: \*"Raincoats for Dogs – Perfect for today's weather!"

## Database Architecture

The database includes structured tables to support:

- Products
- Categories
- Users
