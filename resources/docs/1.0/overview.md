# Overview

---

- [About](#section-1)
- [API Reference](#section-2)

<a name="section-1"></a>
## Calypso API

- Calypso API - api service allows to implement your own front-end. 
- Developer does't need to develop his own server with dummy data.
- Developer can watch source code to get best practices of code writing

<a name="section-2"></a>
## API Reference

#### Authorization module
| Action          | Request                            | Method | Requirements |
|:----------------|:-----------------------------------|:-------|:-------------|
| Register        | `/api/auth/register`               | `POST` | Data         |
| Log in          | `/api/auth/login`                  | `POST` | Data         |
| Sign out        | `/api/auth/signout`                | `POST` | Bearer token |
| Reset password  | `/api/auth/reset-password`         | `POST` | Data         |
| Change password | `/api/auth/reset-password/{token}` | `POST` | Data, token  |



#### User module
| Action        | Request                  | Method  | Requirements        |
|:--------------|:-------------------------|:--------|:--------------------|
| Get users     | `/api/users`             | `PATCH` | data                |
| Store user    | `/api/users`             | `POST`  | Bearer token, data  |
| Show user     | `/api/users/{id}`        | `GET`   | data                |
| Update user   | `/api/users/{id}`        | `PATCH` | Bearer token, data  |
| Upload avatar | `/api/users/{id}/avatar` | `POST`  | Bearer token, data  |


#### Categories module
| Action          | Request                | Method  | Requirements       |
|:----------------|:-----------------------|:--------|:-------------------|
| Get categories  | `/api/categories`      | `PATCH` | data               |
| Store category  | `/api/categories`      | `POST`  | Bearer token, data |
| Show category   | `/api/categories/{id}` | `GET`   | data               |
| Update category | `/api/categories/{id}` | `PATCH` | Bearer token, data |



#### Posts module
| Action       | Request           | Method  | Requirements       |
|:-------------|:------------------|:--------|:-------------------|
| Get posts    | `/api/posts`      | `PATCH` | data               |
| Store post   | `/api/posts`      | `POST`  | Bearer token, data |
| Show post    | `/api/posts/{id}` | `GET`   | data               |
| Update post  | `/api/posts/{id}` | `PATCH` | Bearer token, data |

