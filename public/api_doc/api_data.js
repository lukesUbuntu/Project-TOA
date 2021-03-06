define({ "api": [
  {
    "type": "get",
    "url": "/GamesScore",
    "title": "returns all games scores",
    "name": "GamesScore",
    "description": "<p>returns all games and there scores</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/GamesScore",
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
            "description": "<p>Game ID of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>Name of game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "prefix",
            "description": "<p>Game prefix (refers to folder)</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Object</p> ",
            "optional": false,
            "field": "scores",
            "description": "<p>Lists all users scores for game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.id",
            "description": "<p>Users ID</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "scores.email",
            "description": "<p>Users Email</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.feathers_earned",
            "description": "<p>Users Email</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "scores.username",
            "description": "<p>Users username</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.score",
            "description": "<p>Users username</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n     \"success\": true,\n     \"data\": {\n              \"19\": {\n                 \"game_id\": \"19\",\n                 \"name\": \"TBlocks\",\n                 \"prefix\": \"tblocks\",\n                 \"scores\": [\n                         {\n                             \"id\": \"7\",\n                             \"email\": \"test2@gmail.com\",\n                             \"feathers_earned\": \"341\",\n                             \"username\": \"test3\",\n                             \"score\": \"150150\"\n                         },\n                         {\n                             \"id\": \"8\",\n                             \"email\": \"tester@tester.com\",\n                             \"feathers_earned\": \"16\",\n                             \"username\": \"tester\",\n                             \"score\": \"800\"\n                         }\n                         ]\n          }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/addFeather",
    "title": "adds a feather to the users account",
    "name": "addFeather",
    "description": "<p>adds a feather to the users account</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/addFeather\nhttp://localhost/api/addFeather?amount=5 //adds 5 feathers (1 > 5 max)",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "data",
            "description": "<p>updated</p> "
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/getFeathers",
    "title": "Returns the current users feather count",
    "name": "getFeathers",
    "description": "<p>returns users current feathers owned</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/getFeathers",
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
            "field": "feathers",
            "description": "<p>Users feather count</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-response",
          "content": "{\n  \"success\": true,\n     \"data\": {\n         \"feathers\": 0\n     }\n  }",
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
            "description": "<p>feathers count</p> "
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
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/getGameScore",
    "title": "returns all game scores for your game",
    "name": "getGameScore",
    "description": "<p>returns all game scores for your game or game_id</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/getGameScore\nhttp://localhost/api/getGameScore?game_id=19",
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
            "description": "<p>Game ID of the game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "name",
            "description": "<p>Name of game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "prefix",
            "description": "<p>Game prefix (refers to folder)</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Object</p> ",
            "optional": false,
            "field": "scores",
            "description": "<p>Lists all users scores for game</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.id",
            "description": "<p>Users ID</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "scores.email",
            "description": "<p>Users Email</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.feathers_earned",
            "description": "<p>Users Email</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "scores.username",
            "description": "<p>Users username</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>Int</p> ",
            "optional": false,
            "field": "scores.score",
            "description": "<p>Users username</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n     \"success\": true,\n     \"data\": {\n             \"game_id\": \"19\",\n              \"name\": \"TBlocks\",\n              \"prefix\": \"tblocks\",\n                 \"scores\": [\n                         {\n                             \"id\": \"7\",\n                             \"email\": \"test2@gmail.com\",\n                             \"feathers_earned\": \"341\",\n                             \"username\": \"test3\",\n                             \"score\": \"150150\"\n                         },\n                         {\n                             \"id\": \"8\",\n                             \"email\": \"tester@tester.com\",\n                             \"feathers_earned\": \"16\",\n                             \"username\": \"tester\",\n                             \"score\": \"800\"\n                         }\n                         ]\n          }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
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
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/removeFeather",
    "title": "removes a feather from the users account",
    "name": "removeFeather",
    "description": "<p>removes a feather from the users account</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/removeFeather\nhttp://localhost/api/removeFeather?amount=5 //adds 5 feathers (1 > 5 max)",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "data",
            "description": "<p>updated</p> "
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
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
          "content": "{\n     \"success\": true,\n         \"data\": {\n             \"id\":           \"2\",\n             \"email\":        \"test@test.com\",\n             \"permissions\":  null,\n             \"activated\":    \"1\",\n             \"activated_at\": null,\n             \"last_login\":   \"2015-08-27 00:34:53\",\n             \"first_name\":   null,\n             \"last_name\":    null,\n             \"created_at\":   \"2015-08-07 22:15:06\",\n             \"updated_at\":   \"2015-08-27 00:34:53\"\n\n}\n}",
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
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/usersGames",
    "title": "Returns all users games played",
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
          "content": "{\n     \"success\": true,\n     \"data\": {\n             \"game_game_id\": \"7\",\n             \"game_score\": \"100\",\n             \"users_id\": \"2\",\n                 \"game_details\": {\n                         \"game_id\": \"7\",\n                         \"name\": \"This is my test Game\",\n                         \"description\": \"The description\",\n                         \"start_file\": \"start.html\",\n                         \"author\": \"James\",\n                         \"prefix\": \"testgame\"\n             },\n     \"user_details\": {\n                 \"id\": \"2\",\n                 \"email\": \"test@test.com\",\n                 \"permissions\": null,\n                 \"activated\": \"1\",\n                 \"activated_at\": null,\n                 \"last_login\": \"2015-08-27 00:34:53\",\n                 \"first_name\": null,\n                 \"last_name\": null,\n                 \"created_at\": \"2015-08-07 22:15:06\",\n                 \"updated_at\": \"2015-08-27 00:34:53\"\n     }\n }\n}",
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
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/saveGameData?game_score=10",
    "title": "saves game data score",
    "name": "usersGamesAction",
    "description": "<p>returns a list of the current logged in users games</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/saveGameData",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "data",
            "description": "<p>updated game</p> "
          }
        ]
      }
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
        },
        {
          "title": "Failed-Prefix:",
          "content": "{\n  \"success\"  :   false,\n  \"data\"     :   \"Failed prefix\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  },
  {
    "type": "get",
    "url": "/words",
    "title": "Returns list of words with description english and maori",
    "name": "words",
    "description": "<p>returns users current feathers owned</p> ",
    "examples": [
      {
        "title": "Example usage:",
        "content": "http://localhost/api/words",
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
            "field": "index",
            "description": "<p>index of item</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "mri_word",
            "description": "<p>maori word</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "eng_word",
            "description": "<p>english translation of word</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "img_src",
            "description": "<p>image src tag of word</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "audio_src",
            "description": "<p>audio src tag of word</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "desc",
            "description": "<p>description of word</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-response",
          "content": "{\n \"success\": true,\n     \"data\": {\n         \"index\": \"2\",\n         \"mri_word\": \"kia ora\",\n         \"eng_word\": \"hello\",\n         \"img_src\": \"\",\n         \"desc\": \"\",\n         \"audio_src\": \"\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/ApiController.php",
    "group": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php",
    "groupTitle": "_home_toa_public_html_Project_TOA_app_controllers_ApiController_php"
  }
] });