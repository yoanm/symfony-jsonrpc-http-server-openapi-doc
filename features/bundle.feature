Feature: demo symfony application

  Scenario: Check that all methods are available
    # Ensure methods with tag have been succesfully loaded
    When I send a "GET" request on "/my-custom-doc-endpoint/openapi.json" demoApp kernel endpoint
    Then I should have a "200" response from demoApp with following content:
    """
    {
      "openapi": "3.0.0",
      "servers": [
        {"url": "http://localhost"}
      ],
      "paths": {
        "/BundledMethodA/../my-custom-endpoint": {
          "post": {
            "summary": "\"bundledMethodA\" json-rpc method",
            "operationId": "BundledMethodA",
            "requestBody": {
              "required": true,
              "content": {
                "application/json": {
                  "schema": {
                    "allOf": [
                      {
                        "type": "object",
                        "required": ["jsonrpc", "method"],
                        "properties": {
                          "id": {"example": "req_id", "oneOf": [{"type": "string"}, {"type": "number"}]},
                          "jsonrpc": {"type": "string", "example": "2.0"},
                          "method": {"type": "string"},
                          "params": {"title": "Method parameters"}
                        }
                      },
                      {"type": "object", "properties": {"method": {"example": "bundledMethodA"}}}
                    ]
                  }
                }
              }
            },
            "responses": {
              "200": {
                "description": "JSON-RPC response",
                "content": {
                  "application/json": {
                    "schema": {
                      "allOf": [
                        {
                          "type": "object",
                          "required": ["jsonrpc"],
                          "properties": {
                            "id": {"example": "req_id", "oneOf": [{"type": "string"}, {"type": "number"}]},
                            "jsonrpc": {"type": "string", "example": "2.0"},
                            "result": {"title": "Result"},
                            "error": {"title": "Error"}
                          }
                        },
                        {"type": "object", "properties": {"result": {"description": "Method result"}}},
                        {
                          "type": "object",
                          "properties": {
                            "error": {
                              "oneOf": [
                                {"$ref": "#/components/schemas/ServerError-ParseError-32700"},
                                {"$ref": "#/components/schemas/ServerError-InvalidRequest-32600"},
                                {"$ref": "#/components/schemas/ServerError-MethodNotFound-32601"},
                                {"$ref": "#/components/schemas/ServerError-ParamsValidationsError-32602"},
                                {"$ref": "#/components/schemas/ServerError-InternalError-32603"}
                              ]
                            }
                          }
                        }
                      ]
                    }
                  }
                }
              }
            }
          }
        },
        "/BundledMethodB/../my-custom-endpoint": {
          "post": {
            "summary": "\"bundledMethodB\" json-rpc method",
            "operationId": "BundledMethodB",
            "requestBody": {
              "required": true,
              "content": {
                "application/json": {
                  "schema": {
                    "allOf": [
                      {
                        "type": "object",
                        "required": ["jsonrpc", "method"],
                        "properties": {
                          "id": {"example": "req_id", "oneOf": [{"type": "string"}, {"type": "number"}]},
                          "jsonrpc": {"type": "string", "example": "2.0"},
                          "method": {"type": "string"},
                          "params": {"title": "Method parameters"}
                        }
                      },
                      {"type": "object", "properties": {"method": {"example": "bundledMethodB"}}}
                    ]
                  }
                }
              }
            },
            "responses": {
              "200": {
                "description": "JSON-RPC response",
                "content": {
                  "application/json": {
                    "schema": {
                      "allOf": [
                        {
                          "type": "object",
                          "required": ["jsonrpc"],
                          "properties": {
                            "id": {"example": "req_id", "oneOf": [{"type": "string"}, {"type": "number"}]},
                            "jsonrpc": {"type": "string", "example": "2.0"},
                            "result": {"title": "Result"},
                            "error": {"title": "Error"}
                          }
                        },
                        {"type": "object", "properties": {"result": {"description": "Method result"}}},
                        {
                          "type": "object",
                          "properties": {
                            "error": {
                              "oneOf": [
                                {"$ref": "#/components/schemas/ServerError-ParseError-32700"},
                                {"$ref": "#/components/schemas/ServerError-InvalidRequest-32600"},
                                {"$ref": "#/components/schemas/ServerError-MethodNotFound-32601"},
                                {"$ref": "#/components/schemas/ServerError-ParamsValidationsError-32602"},
                                {"$ref": "#/components/schemas/ServerError-InternalError-32603"}
                              ]
                            }
                          }
                        }
                      ]
                    }
                  }
                }
              }
            }
          }
        }
      },
      "components": {
        "schemas": {
          "ServerError-ParseError-32700": {
            "title": "Parse error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32700}}}
            ]
          },
          "ServerError-InvalidRequest-32600": {
            "title": "Invalid request",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32600}}}
            ]
          },
          "ServerError-MethodNotFound-32601": {
            "title": "Method not found",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32601}}}
            ]
          },
          "ServerError-ParamsValidationsError-32602": {
            "title": "Params validations error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {
                "type": "object",
                "required": ["code", "data"],
                "properties": {
                  "code": {"example": -32602},
                  "data": {"type": "object", "nullable": true, "properties": { "violations": { "type": "array", "nullable": true, "items": {"type": "string"}}}}
                }
              }
            ]
          },
          "ServerError-InternalError-32603": {
            "title": "Internal error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {
                "type": "object",
                "required": ["code"],
                "properties": {
                  "code": {"example": -32603},
                  "data": {
                      "type": "object",
                      "nullable": true,
                      "properties": {
                        "_class": {"description": "Exception class", "type": "string", "nullable": true},
                        "_code":{"description": "Exception code", "type": "integer", "nullable": true},
                        "_message":{"description": "Exception message", "type": "string", "nullable": true},
                        "_trace":{"description": "PHP stack trace", "type": "array", "nullable": true, "items":{"type": "string"}}
                      }
                    }
                }
              }
            ]
          }
        }
      }
    }
    """

  Scenario: Check that additional information can be added thanks to OpenAPIDocCreatedEvent event
    Given I will use kernel with DocCreated listener
    When I send a "GET" request on "/my-custom-doc-endpoint/openapi.json" demoApp kernel endpoint
    Then I should have a "200" response from demoApp with following content:
    """
    {
      "openapi": "3.0.0",
      "servers": [
        {"url": "http://localhost"}
      ],
      "components": {
        "schemas": {
          "ServerError-ParseError-32700": {
            "title": "Parse error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32700}}}
            ]
          },
          "ServerError-InvalidRequest-32600": {
            "title": "Invalid request",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32600}}}
            ]
          },
          "ServerError-MethodNotFound-32601": {
            "title": "Method not found",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {"type": "object", "required": ["code"], "properties": {"code": {"example": -32601}}}
            ]
          },
          "ServerError-ParamsValidationsError-32602": {
            "title": "Params validations error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {
                "type": "object",
                "required": ["code", "data"],
                "properties": {
                  "code": {"example": -32602},
                  "data": {"type": "object", "nullable": true, "properties": {"violations": {"type": "array", "nullable": true, "items": {"type": "string"}}}}
                }
              }
            ]
          },
          "ServerError-InternalError-32603": {
            "title": "Internal error",
            "allOf": [
              {"type": "object", "required": ["code", "message"], "properties": {"code": {"type": "number"}, "message": {"type": "string"}}},
              {
                "type": "object",
                "required": ["code"],
                "properties": {
                  "code": {"example": -32603},
                  "data": {
                      "type": "object",
                      "nullable": true,
                      "properties": {
                        "_class": {"description": "Exception class", "type": "string", "nullable": true},
                        "_code":{"description": "Exception code", "type": "integer", "nullable": true},
                        "_message":{"description": "Exception message", "type": "string", "nullable": true},
                        "_trace":{"description": "PHP stack trace", "type": "array", "nullable": true, "items":{"type": "string"}}
                      }
                    }
                }
              }
            ]
          }
        }
      },
      "externalDocs": {
        "description": "Find out more about OpenAPI",
        "url": "http:\/\/swagger.io"
      }
    }
    """
