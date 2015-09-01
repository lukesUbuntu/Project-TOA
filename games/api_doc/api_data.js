define({ "api": [
  {
    "type": "get",
    "url": "/listGames",
    "title": "Returns all games",
    "name": "listGamesAction",
    "description": "<p>Returns all the games on the system from the plugin folder</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/listGames",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "game_id",
            "description": "<p>Game ID of the current game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>Name of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "description",
            "description": "<p>Description of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "start_file",
            "description": "<p>Start File that will be loaded</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "author",
            "description": "<p>Developer of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "prefix",
            "description": "<p>Prefix folder name of the game</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n     \"success\":true,\n     \"data\":[\n             {\n                \"game_id\":\"7\",\n                 \"name\":\"This is my test Game\",\n                 \"description\":\"The description\",\n                 \"start_file\":\"start.html\",\n                 \"author\":\"James\",\n                 \"prefix\":\"testgame\"\n             }\n         ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "no",
            "description": "<p>games in system</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Failed-Response:",
          "content": "{\n  \"success\"  :   false,\n  \"data\"     :   \"no games in system\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_project_toa_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_project_toa_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Return the current user",
    "name": "userAction",
    "description": "<p>Returns the current logged in users information</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/user",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>Users ID</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "first_name",
            "description": "<p>Users First name</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "last_name",
            "description": "<p>Users Last name</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>User email address</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "permissions",
            "description": "<p>permissions is admin (currently not implmented)</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "activated",
            "description": "<p>Is the users account activated or enabled</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "last_login",
            "description": "<p>Date time stamp of last login</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "created_at",
            "description": "<p>Date time stamp when account was registered</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\": true,\n        \"data\": {\n            \"id\":           \"2\",\n            \"email\":        \"test@test.com\",\n            \"permissions\":  null,\n            \"activated\":    \"1\",\n            \"activated_at\": null,\n            \"last_login\":   \"2015-08-27 00:34:53\",\n            \"first_name\":   null,\n            \"last_name\":    null,\n            \"created_at\":   \"2015-08-07 22:15:06\",\n            \"updated_at\":   \"2015-08-27 00:34:53\"\n        }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "no",
            "description": "<p>user logged in</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Failed-Response:",
          "content": "{\n   \"success\": false,\n   \"data\": \"no user logged in\"\n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_project_toa_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_project_toa_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/usersGames",
    "title": "Returns all users games",
    "name": "usersGamesAction",
    "description": "<p>returns a list of the current logged in users games</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/usersGames",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "game_game_id",
            "description": "<p>Game ID of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "game_score",
            "description": "<p>Users current score on this game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "users_id",
            "description": "<p>User ID</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Object</p> ",
            "optional": false,
            "field": "game_details",
            "description": "<p>Refer to Game::Object or api /listGames</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Object</p> ",
            "optional": false,
            "field": "user_details",
            "description": "<p>Refer to User::Object or api /user</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n    \"success\": true,\n        \"data\": {\n            \"game_game_id\": \"7\",\n            \"game_score\": \"100\",\n            \"users_id\": \"2\",\n            \"game_details\": {\n                \"game_id\": \"7\",\n                \"name\": \"This is my test Game\",\n                \"description\": \"The description\",\n                \"start_file\": \"start.html\",\n                \"author\": \"James\",\n                \"prefix\": \"testgame\"\n            },\n            \"user_details\": {\n                \"id\": \"2\",\n                \"email\": \"test@test.com\",\n                \"permissions\": null,\n                \"activated\": \"1\",\n                \"activated_at\": null,\n                \"last_login\": \"2015-08-27 00:34:53\",\n                \"first_name\": null,\n                \"last_name\": null,\n                \"created_at\": \"2015-08-07 22:15:06\",\n                \"updated_at\": \"2015-08-27 00:34:53\"\n            }\n        }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "no",
            "description": "<p>games in system</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Failed-Login:",
          "content": "{\n  \"success\"  :   false,\n  \"data\"     :   \"no user logged in\"\n}",
          "type": "json"
        },
        {
          "title": "Failed-Response:",
          "content": "{\n  \"success\"  :   false,\n  \"data\"     :   \"no game data found for user\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_project_toa_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_project_toa_app_controllers_ApiController_php"
  }
] });