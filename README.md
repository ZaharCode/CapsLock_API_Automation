# CapsLock API Test Suite

This repository contains a comprehensive test suite for an API using PHP and Codeception framework. The tests validate both GET and POST endpoints for the media buyers resource with proper schema validation, data integrity checks, and content-type verification.

## Codeception API Testing Setup

The project uses Codeception as its testing framework with the following modules enabled:

- **REST Module**: Provides REST API testing capabilities for making HTTP requests to endpoints like `/api/mediabuyers`
- **PhpBrowser Module**: Simulates browser behavior for web tests and provides additional functionality
- **Asserts Module**: Built-in PHP assertions for validating test results

The configuration in `codeception.yml` defines:
- Base URL: `http://localhost/api`
- Content-Type headers set to `application/json`
- Test suite configuration with proper paths and logging

## Repository Organization

```
.
├── composer.json              # Project dependencies and scripts
├── codeception.yml            # Codeception framework configuration
├── README.md                  # This documentation file
├── src/                       # Source files including factories
│   └── MediaBuyerFactory.php  # Factory for creating test data objects
├── schemas/                   # JSON schema definitions for validation
│   ├── get-media-buyers-schema.json    # Schema for GET /api/mediabuyers response
│   └── post-media-buyer-schema.json    # Schema for POST /api/mediabuyers request payload
└── tests/                     # Test files
    └── MediaBuyersTest.php     # Main test class with 8 comprehensive test cases
```

## Test Scenarios Selected

The following 8 test scenarios were selected to ensure comprehensive API validation:

1. **GET /api/mediabuyers returns HTTP 200 with correct Content-Type header**
2. **GET response body conforms to schema** 
3. **GET data field is always an array (even when empty)**
4. **GET every item has required fields: id, mbId, initials, name, email, slackUserId, active**
5. **GET emails are syntactically valid email addresses**
6. **GET active values are 0 or 1 (integers)**
7. **GET IDs are unique across the response**
8. **POST /api/mediabuyers with valid data returns 200, correct content-type and schema validation**

## Abstractions Introduced

The project implements several key abstractions that provide value at scale:

1. **MediaBuyerFactory**: Centralized factory pattern for creating consistent test data objects
   - Enables easy generation of valid, minimal, or invalid test payloads  
   - Reduces code duplication in tests requiring different data sets
   - Allows parameterization of test data through overrides

2. **JSON Schema Validation**: Standardized validation against defined schema files
   - Ensures API responses conform to expected structures
   - Provides clear error messages when validation fails
   - Makes it easy to update expectations as the API evolves

3. **REST Module Integration**: Leverages Codeception's built-in testing capabilities
   - Streamlines HTTP request handling and response assertions
   - Improves test readability with fluent interface syntax
   - Enables consistent test patterns across multiple endpoints

These abstractions provide:
- Reduced maintenance overhead when extending to new API endpoints  
- Consistent behavior for similar operations
- Easier debugging through centralized logic
- Improved scalability by abstracting common testing patterns

## Additional Improvements for Scalability/Maintainability

To enhance this project's scalability and maintainability:

1. **Data Setup/Teardown**: Implement fixtures or database seeding mechanisms to ensure consistent test environments
2. **Parallelization**: Use Codeception's parallel execution capabilities to speed up large test suites  
3. **CI Integration**: Configure continuous integration pipelines (GitHub Actions, Jenkins) for automated testing on code changes
4. **Schema Versioning**: Implement schema version control to track API contract evolution over time
5. **Contract Testing**: Add consumer-driven contracts to verify service compatibility with consumers
6. **Environment Configuration**: Separate test environments (local, staging, production) with appropriate configuration management

## Assumptions Made Where Contract Is Silent

1. **Response Format Consistency**: Assumes all API responses follow a consistent JSON structure with "data" field for GET requests and proper request payloads for POST
2. **HTTP Status Codes**: Assumes standard HTTP status codes (200 OK, 400 Bad Request) are appropriate for the given scenarios  
3. **Data Validations**: Assumes email addresses will follow common formats and that ID fields will be unique integers
4. **Schema Compliance**: Assumes JSON schemas accurately represent expected response structures and data types

## Files Included

### JSON Schemas
- `schemas/get-media-buyers-schema.json`: Defines the structure for GET /api/mediabuyers responses  
- `schemas/post-media-buyer-schema.json`: Defines the structure for POST /api/mediabuyers request payloads

### Helpers
- `src/MediaBuyerFactory.php`: Factory class for generating test data objects with different configurations (valid, minimal, invalid)

This approach ensures all tests are consistent, maintainable, and can be easily extended as the API grows.