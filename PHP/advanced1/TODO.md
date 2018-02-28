# Advanced exercise 1

In this exercise, we want to create a CSV file from a set of data.

The data will be loaded from a JSON API at 'https://api.apis.guru/v2/list.json'.
The JSON API will return  a JSON string, to convert the response to array, use this function : 'json_decode($response, true)'.

We want in the csv file : the title of the prefered version info, the prefered version description, the prefered version name, the created entry and the prefered version update date in french format (d-m-Y H:i:s).

You MUST create 3 file with one function in each one, each file in it's own folder :
 * One function to download the data
 * One function to format the data
 * One function to insert the data into a file 

You MUST make use of namespace.

Api response example :
```json
{
    "1forge.com": {
        "added": "2017-05-30T08:34:14.000Z",
        "preferred": "0.0.1",
        "versions": {
            "0.0.1": {
                "added": "2017-05-30T08:34:14.000Z",
                "info": {
                    "contact": {
                        "email": "contact@1forge.com",
                        "name": "1Forge",
                        "url": "http://1forge.com"
                    },
                    "description": "Stock and Forex Data and Realtime Quotes",
                    "title": "1Forge Finance APIs",
                    "version": "0.0.1",
                    "x-apisguru-categories": [
                        "financial"
                    ],
                    "x-logo": {
                        "backgroundColor": "#24292e",
                        "url": "https://api.apis.guru/v2/cache/logo/http_1forge.com_logo.png"
                    },
                    "x-origin": [
                        {
                            "format": "swagger",
                            "url": "http://1forge.com/openapi.json",
                            "version": "2.0"
                        }
                    ],
                    "x-preferred": true,
                    "x-providerName": "1forge.com"
                },
                "swaggerUrl": "https://api.apis.guru/v2/specs/1forge.com/0.0.1/swagger.json",
                "swaggerYamlUrl": "https://api.apis.guru/v2/specs/1forge.com/0.0.1/swagger.yaml",
                "updated": "2017-06-27T16:49:57.000Z"
            }
        }
    },
    "6-dot-authentiqio.appspot.com": {
        "added": "2017-03-15T14:45:58.000Z",
        "preferred": "6",
        "versions": {
            "6": {
                "added": "2017-03-15T14:45:58.000Z",
                "info": {
                    "contact": {
                        "email": "hello@authentiq.com",
                        "name": "Authentiq team",
                        "url": "http://authentiq.io/support"
                    },
                    "description": "Strong authentication, without the passwords.",
                    "license": {
                        "name": "Apache 2.0",
                        "url": "http://www.apache.org/licenses/LICENSE-2.0.html"
                    },
                    "termsOfService": "http://authentiq.com/terms/",
                    "title": "Authentiq",
                    "version": "6",
                    "x-apisguru-categories": [
                        "security"
                    ],
                    "x-logo": {
                        "backgroundColor": "#F26641",
                        "url": "https://api.apis.guru/v2/cache/logo/https_www.authentiq.com_theme_images_authentiq-logo-a-inverse.svg"
                    },
                    "x-origin": [
                        {
                            "format": "swagger",
                            "url": "https://raw.githubusercontent.com/AuthentiqID/authentiq-docs/master/docs/swagger/issuer.yaml",
                            "version": "2.0"
                        }
                    ],
                    "x-preferred": true,
                    "x-providerName": "6-dot-authentiqio.appspot.com"
                },
                "swaggerUrl": "https://api.apis.guru/v2/specs/6-dot-authentiqio.appspot.com/6/swagger.json",
                "swaggerYamlUrl": "https://api.apis.guru/v2/specs/6-dot-authentiqio.appspot.com/6/swagger.yaml",
                "updated": "2017-10-03T18:36:19.000Z"
            }
        }
    }
]
```
