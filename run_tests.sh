#!/bin/bash

# Simple test runner for CapsLock API Automation
echo "Running CapsLock API Tests..."
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "Error: Composer is not installed. Please install Composer first."
    exit 1
fi

# Install dependencies
echo "Installing dependencies..."
composer install --no-progress

# Run tests using Codeception
echo "Running API Tests..."
vendor/bin/codecept run

echo ""
echo "Test execution complete."