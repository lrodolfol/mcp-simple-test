import { McpServer } from "@modelcontextprotocol/sdk/server/mcp.js";
import { StdioServerTransport } from "@modelcontextprotocol/sdk/server/stdio.js";
import { z } from "zod";
import { getUsers, createUser, getUserById } from "./users_tool";

const API_BASE_URL = "http://localhost:8000"; //php api url

async function main() {
    try{
        const server = new McpServer({
            "name": "MCPServer",
            "version": "1.0.0",
        });

        server.tool(
            "readonlymysql", {},
            async () => {
                const informations = {
                    "Name": "Mysql",
                    "Environment": "Production"
                }
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `${JSON.stringify(informations)}`
                        }
                    ]
                }
            }
        );

        server.tool(
          "getUserById", {id: z.number()},
          async ({id}) => {
            const user = await getUserById(API_BASE_URL, id);
            return {
                content: [
                    {
                        "type": "text",
                        "text": `Usuário encontrado: ${JSON.stringify(user)}`
                    }
                ]
            }
          }
        );

        server.tool( 
            "getUsers", {},
            async () => {
                const users = await getUsers(API_BASE_URL);
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `Usuários encontrados: ${JSON.stringify(users, null, 2)}`
                        }
                    ]
                }
            }
        );

        server.tool(
            "createUser", {
                user: z.object({
                    name: z.string(),
                    age: z.number(),
                }),
            },
            async ({ user }) => {
                const newUser = await createUser(API_BASE_URL, user);
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `User created: ${newUser.name}, Age: ${newUser.age}`
                        }
                    ]
                }
            }
        );

        const transport = new StdioServerTransport();
        await server.connect(transport);
        console.error("Server is running and waiting for requests...");        
    }catch (error) {
        console.error('Error in main function:', error);
        throw error;
    }
}

main().catch((error) => {
    console.error('Error starting server:', error);
});
