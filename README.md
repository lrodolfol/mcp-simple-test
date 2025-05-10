# mcp-simple-test

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![](https://img.shields.io/badge/php-v8.1-blue)
![](https://img.shields.io/badge/node-v22.15.0-green)

## Structure
```
./
├── api-php/
│   └── paths../
│   └── composer files..
├── mcp-server/
│   └── paths../
│   └── npm files..
├── git files..
```

## Quick Install and use
```bash
git clone <REPOSITÓRIO_URL>
```
#### PHP - API Server
```bash
cd api-php
php -S localhost:8000
```
#### NODE - MCP Server
````bash
cd mcp-server
npm install
npm run build
node .\src\mcp.js
````
#### MPC client configurations
Update your client configuration like this:
````json
{
  "mcpServers": {
    "mcpUsers": {
      "command": "node",
      "args": [
        "C:\\projects\\simple-mcp-test\\mcp-server\\src\\mcp.js" #your path
      ]
    }
  }
}
````

Example queries:

```
Use mcpUsers and create a new User with this information: 
Name: Rodolfo Jesus
Age: 29
```
```
Use mcpUsers and create new Users with this information: 
Name: Rodolfo Jesus
Age: 29

Name: Kelly Cristina
Age: 31

Name: Jose Calos:
Age: 56
```
```
Use mcpUsers and get all registered users
```
```
Use mcpUsers and get user with Id = 1
```

## Author - Rodolfo Jesus

[Site](https://tinosnegocios.com.br) </br>
[Linkedin](https://www.linkedin.com/in/rodolfojesus/) 
