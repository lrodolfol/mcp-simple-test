import axios from 'axios';

export interface User {
    name: string;
    age: number;
}

export async function getUsers(baseUrl: string): Promise<User[]> {
    try{
        const response = await axios.get<User[]>(`${baseUrl}/api/users`);
        return response.data;
    }catch (error) {
        console.error('Error fetching users:', error);
        throw error;
    }
}

export async function getUserById(baseUrl: string, id: number): Promise<User> {
    try{
        const response = await axios.get<User>(`${baseUrl}/api/users/${id}`);
        return response.data;
    }catch (error) {
        console.error('Error fetching users:', error);
        throw error;
    }
}

export async function createUser(baseUrl: string, user: User): Promise<User> {
    try {
        const response = await axios.post(`${baseUrl}/api/users`, user, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return response.data;
    } catch (error) {
        console.error('Error creating user:', error);
        throw error;
    }
}