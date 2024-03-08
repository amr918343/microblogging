# Task: Microblogging Social Network Service

We need you to implement a microblogging social network service on which users post and interact with messages known as "tweets". Users can post tweets and only their followers can see those tweets. Using Laravel please implement the following APIs:-

1. **Login API**: 
   - Allows users to log in with their email and password.
   - Email validation is required in the correct email format.

2. **Register API**:
   - Enables users to register with the following fields:
     - Email: Required, Unique, Valid email format.
     - Username: Required, No spaces allowed.
     - Password: Required, At least 8 characters containing upper and lowercase letters, at least 1 number, and at least 1 special character.
     - Image: Required, Format: PNG or JPG, Maximum size: 1MB.

3. **User Create Tweet API**:
   - Allows users to create tweets with a maximum of 140 characters.

4. **Follow User API**:
   - Users can follow other users through this API.

5. **User Timeline API**:
   - Returns all tweets from the users that the current user is following, paginated.

## Implementation Guidelines

For all the implemented APIs, please note the following:-
1. **Best Practices**:
   - Maintain best practices for coding, API design, and PHP practices.
2. **JSON Format**:
   - JSON is the only required format for responses.

## General Note

- Assume that millions of users are using this blog, so please keep in mind the best practices to maintain the performance of the blog.
