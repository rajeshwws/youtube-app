## Youtube API App

This is a simplified prototype app that provide a simple interface to search Youtube via their public API. 

The Project is built on the [Laravel-Lumen](https://lumen.laravel.com).  

## Installation

Development environment requirements :
- [Docker](https://www.docker.com) >= 17.06 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/rajeshwws/youtube-app.git
$ cd youtube-app
$ cp .env.example .env
$ docker-compose run --rm --no-deps webapp composer install
$ docker-compose up -d
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

**There is no need to run ```php artisan serve```. PHP is already running in a dedicated container.**

## Useful commands

Running tests :
```bash
$ docker-compose run --rm --no-deps webapp ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect --debug --coverage-text
```

## Accessing the API

Clients can access to the REST API. API requests does not require authentication.

The table below shows the available endpoints.

```
+------+----------------+---------------------+----------------------+
| Verb | Path           | Role                | Action               |
+------+----------------+---------------------+----------------------+
| GET  | /              | Frontend Client     | Framework info       |
| POST | /search        | Search API endpoint | Search Youtube API   |
+------+----------------+---------------------+----------------------+
```

## Making the Search API Call
if you don't want to use the attached simple frontend, you can also make `POST` request to the search endpoint directly.
 - Using an API client such as Postman, make a Post request to `http://localhost:8000/search` with the sample data below
 
 ```json
{
	"query": "youtube"
}
```
 - You should get a similar response to this sample response
 
 ```json
[
    {
        "etag": "\"j6xRRd8dTPVVptg711_CSPADRfg/3yJLEwR3ILAP2KmccKg65JJgApg\"",
        "kind": "youtube#searchResult",
        "id": {
            "channelId": null,
            "kind": "youtube#video",
            "playlistId": null,
            "videoId": "FzG4uDgje3M"
        }
    },
    {
        "etag": "\"j6xRRd8dTPVVptg711_CSPADRfg/bwazJ9XxILZb0BiG6XxtE6NZCIg\"",
        "kind": "youtube#searchResult",
        "id": {
            "channelId": "UCbCmjCuTUZos6Inko4u57UQ",
            "kind": "youtube#channel",
            "playlistId": null,
            "videoId": null
        }
    },
    {
        "etag": "\"j6xRRd8dTPVVptg711_CSPADRfg/RDYm_qT4eypDXoNLCv0drSp5a24\"",
        "kind": "youtube#searchResult",
        "id": {
            "channelId": "UCBR8-60-B28hp2BmDPdntcQ",
            "kind": "youtube#channel",
            "playlistId": null,
            "videoId": null
        }
    },
    {
        "etag": "\"j6xRRd8dTPVVptg711_CSPADRfg/bvTfmziPXHIQbE9YutCX2aybrRk\"",
        "kind": "youtube#searchResult",
        "id": {
            "channelId": null,
            "kind": "youtube#playlist",
            "playlistId": "PLoaTLsTsV3hOUq5qk5SiWpwRT57WWqq6X",
            "videoId": null
        }
    },
    {
        "etag": "\"j6xRRd8dTPVVptg711_CSPADRfg/--aUNzPi2DKs2nxvOs_XcIQyRvg\"",
        "kind": "youtube#searchResult",
        "id": {
            "channelId": null,
            "kind": "youtube#video",
            "playlistId": null,
            "videoId": "DYlesHOaPkY"
        }
    }
]
```
