"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
const mcp_js_1 = require("@modelcontextprotocol/sdk/server/mcp.js");
const stdio_js_1 = require("@modelcontextprotocol/sdk/server/stdio.js");
const zod_1 = require("zod");
const users_tool_1 = require("./users_tool");
const API_BASE_URL = "http://localhost:8000"; //php api url
function main() {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const server = new mcp_js_1.McpServer({
                "name": "MCPServer",
                "version": "1.0.0",
            });
            server.tool("getUserById", { id: zod_1.z.number() }, (_a) => __awaiter(this, [_a], void 0, function* ({ id }) {
                const user = yield (0, users_tool_1.getUserById)(API_BASE_URL, id);
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `Usuário encontrado: ${JSON.stringify(user)}`
                        }
                    ]
                };
            }));
            server.tool("getUsers", {}, () => __awaiter(this, void 0, void 0, function* () {
                const users = yield (0, users_tool_1.getUsers)(API_BASE_URL);
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `Usuários encontrados: ${JSON.stringify(users, null, 2)}`
                        }
                    ]
                };
            }));
            server.tool("createUser", {
                user: zod_1.z.object({
                    name: zod_1.z.string(),
                    age: zod_1.z.number(),
                }),
            }, (_a) => __awaiter(this, [_a], void 0, function* ({ user }) {
                const newUser = yield (0, users_tool_1.createUser)(API_BASE_URL, user);
                return {
                    content: [
                        {
                            "type": "text",
                            "text": `User created: ${newUser.name}, Age: ${newUser.age}`
                        }
                    ]
                };
            }));
            const transport = new stdio_js_1.StdioServerTransport();
            yield server.connect(transport);
            console.error("Server is running and waiting for requests...");
        }
        catch (error) {
            console.error('Error in main function:', error);
            throw error;
        }
    });
}
main().catch((error) => {
    console.error('Error starting server:', error);
});
