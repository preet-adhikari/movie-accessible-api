
# An API on movie details.

For all the movie connosieurs, this API provides a complete functionality on movies from hollywood from titles to the budget that was invested. This is a TMDB dataset on the movies.





## Acknowledgements

 - [The Movie Database (TMDB)](https://www.themoviedb.org/)


## Technologies used

Built using MySQL as the Database with Laravel Sanctum as the API authorization and authentication.


## API Reference

#### Get all movies

```http
  GET /api/movies
```


#### Register 

```http
  POST /api/register/
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. Create a name for the user. |
| `email`      | `email` | **Required**. Create an email for the user. |
| `password`      | `string` | **Required**. Create a passord for the user. |
| `password_confirmation`      | `string` | **Required**. Same password as above. |


#### Login 

```http
  POST /api/login/
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `email` | **Required**. Email of the user. |
| `password`      | `string` | **Required**. Password of the user. |


#### Registering and logging in returns an API key through which you can access the APIs below:  

#### Search movies

```http
  POST /api/search/{params}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Api key necessary for verification. |
| `params`      | `string` | **Required**. Any string to search the movies. |

Returns an array of the movies.

#### Create a movie

```http
  POST /api/create/
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Api key necessary for verification. |
| `title`      | `string` | **Required**. Title of the movie. |
| `original_title`      | `string` | **Required**. Original title of the movie. Could be different from the title. |
| `release_date`      | `date` | **Required**. Release date of the movie. |
| `tagline`      | `string` | Tagline of the movie. |
| `genre`      | `json` | **Required**. 'id' as the genre id and 'name' as the genre name. |
| `description`      | `string` | **Required**. Title of the movie. |


### need to work on create

#### Get a particular movie from its ID.

```http
  GET /api/movies/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Api key necessary for verification. |
| `id`      | `integer` | **Required**. ID of the movie. |

Returns the movie: if it exists in the database. 

#### Delete a movie.

```http
  DELETE /api/movies/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Api key necessary for verification. |
| `id`      | `integer` | **Required**. ID of the movie. |

Deletes the movie and returns a 204 response. 




## Run Locally

Clone the project

```bash
  git clone https://github.com/preet-adhikari/movie-accessible-api.git
```

Go to the project directory

```bash
  cd movie-accessible-api
```

Generate a new environment key

```bash
  php artisan generate:key
```

Run composer update to update dependencies

```bash
  composer update
```


Start the server

```bash
  php artisan:serve
```

