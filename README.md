# Microblogging Social Network Service

Welcome to our microblogging social network service! This platform allows users to post and interact with messages called "tweets". Users can post tweets that are visible only to their followers. We've provided a detailed list of APIs to be implemented using Laravel, ensuring the highest standards of code quality and performance.

## APIs to Implement

1. **Login API**: Allows users to log in using their email and password. Email validation is required, ensuring correct email format.
   
2. **Register API**: Enables users to register with the following fields:
   - Email: Required, Unique, Valid email format.
   - Username: Required, No spaces allowed.
   - Password: Required, At least 8 characters containing upper and lowercase letters, at least 1 number, and at least 1 special character.
   - Image: Required, Format: PNG or JPG, Maximum size: 1MB.
   
3. **User Create Tweet API**: Allows users to create tweets with a maximum of 140 characters.

4. **Follow User API**: Users can follow other users through this API.

5. **User Timeline API**: Returns all tweets from the users that the current user is following, paginated.

## Implementation Guidelines

For all implemented APIs, ensure the following:
- **Best Practices**: Maintain best practices for coding, API design, and PHP practices.
- **JSON Format**: APIs must return responses in JSON format only.

## General Note

Considering the large user base of our microblogging platform, it's crucial to prioritize performance and scalability. Keep in mind the following:
- Optimize code and database queries for performance.
- Implement caching mechanisms where applicable to reduce server load.
- Ensure scalability by designing APIs and database schema with future growth in mind.

Thank you for your contribution to our microblogging social network service! Let's make it an amazing platform together! 🚀🌟
