# Recruitment API Test Suite

This repository contains an automated test suite for the Media Buyers REST API, designed using PHP and Codeception framework.

## Project Structure

```
.
├── composer.json         # PHP dependencies
├── .gitignore            # Git ignore rules
├── README.md             # Project documentation  
├── schemas/              # JSON schema definitions
│   ├── get-media-buyers-schema.json
│   └── post-media-buyer-schema.json
├── src/                  # Application source code
│   ├── MediaBuyerFactory.php  # Test data factories
│   └── SchemaValidator.php    # JSON schema validation logic
└── tests/                # Test suite
    └── MediaBuyersTest.php    # 8 automated test cases
```

## Features

- **8 Complete Test Cases**: Full API coverage with status code verification, data integrity checks, and schema validation
- **PHP/Codeception Framework**: Modern testing framework for robust API testing  
- **JSON Schema Validation**: Ensures all API responses match expected structures
- **Factory Pattern**: Consistent test data generation
- **Automated Testing**: Run tests with `composer test` or `vendor/bin/codecept run`

## Requirements

- PHP 7.4+
- Composer installed

## Setup Instructions

1. Install dependencies: `composer install`
2. Run tests: `composer test` or `vendor/bin/codecept run`

## Test Coverage

1. API accessibility verification
2. Response data structure validation  
3. Email format validation
4. Unique ID enforcement
5. HTTP status code checking
6. JSON schema compliance
7. Data integrity checks
8. Authentication header setup (configured via environment)

This test suite ensures reliable API functionality and prevents regressions in recruitment system endpoints.