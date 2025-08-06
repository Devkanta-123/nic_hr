#!/bin/bash

# Function to check if a directory exists
check_directory() {
  local dir="$1"
  if [ -d "$dir" ]; then
    echo "Directory '$dir' already exists."
    return 0
  else
    echo "Directory '$dir' does not exist."
    return 1
  fi
}

#Function to create a directory if it doesn't exist
make_directory() {
  local dir="$1"
  if ! check_directory "$dir"; then
    echo "Creating directory '$dir'."
    mkdir -p "$dir"
  fi
}





# Read the domain name from the user
DOMAIN="$1"

# Directory for the website
WEB_DIR="C:\xampp\htdocs\itplapp\app\test\ $DOMAIN"

#Function call for Check and create the directory
make_directory "$WEB_DIR"





# Create an index  HTML file for testing
echo "<html><body><h1>Welcome to $DOMAIN!</h1></body></html>" | tee "$WEB_DIR/index.html"



#Codes for testing Domain working or not using curl
response_code=$(curl -s -o /dev/null -w "%{http_code}" $DOMAIN)

if [ $response_code -eq 200 ]; then
    echo "*********Domain is working good response: $response_code "
else
    echo "Domain is not working. HTTP Status code: $response_code"
fi


echo " $DOMAIN created successfully."





